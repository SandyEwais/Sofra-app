<?php

namespace App\Http\Controllers\Api\Client;

use App\Models\Meal;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function newOrder(Request $request){
        $validator = validator()->make($request->all(),[
            'sets.*.meal_id' => 'required|exists:meals,id',
            'sets.*.quantity' => 'required',
            'payment_method' => 'required|in:online,cash',
            'restaurant_id' => 'required|exists:restaurants,id',
            'address' => 'required'
        ]);
        if($validator->fails()){
            return responseJson(422,'failure',$validator->errors());
        }
        $restaurant = Restaurant::find($request->restaurant_id);
        if($restaurant->state == 'closed'){
            return responseJson(0,'failure','Restaurant is closed now, come back during working hours');
        }
        $delivery_fees = $restaurant->delivery_fees;
        DB::transaction(function() use ($request, $restaurant, $delivery_fees) {
            $order = $request->user()->orders()->create([
                'notes' => $request->notes,
                'delivery_address' => $request->address,
                'payment_method' => $request->payment_method,
                'restaurant_id' => $restaurant->id,
                'delivery_fees' => $delivery_fees
            ]);
            
            $mealsCost = 0;
    
            foreach($request->sets as $set){
                $meal = Meal::where('id',$set['meal_id'])->first();
                $readySet = [
                    $set['meal_id'] => [
                        'quantity' => $set['quantity'],
                        'meal_price' => $meal->price_sale ? $meal->price_sale : $meal->price,
                        'notes' => $set['notes'] ? $set['notes'] : ''
                    ]
                ];
                $order->meals()->attach($readySet);
                $mealsCost += (($meal->price_sale ? $meal->price_sale : $meal->price) * $set['quantity']);
            }
    
            if($mealsCost < $restaurant->minimum){
                $order->meals()->delete();
                $order->delete();
                return responseJson(0,'failure','Minimum Charge is ' . $restaurant->minimum);
            }
    
            $total = $mealsCost + $delivery_fees;
            $commission = (settings()->commission/100) * $mealsCost;
            $restaurantNet = $total - $commission;
            $order->update([
                'meals_cost' => $mealsCost,
                'total_order_price' => $total,
                'app_commission' => $commission,
                'restaurant_net' => $restaurantNet
            ]);
    
            $notification = $restaurant->notifications()->create([
                'title' => 'NEW ORDER REQUESTED',
                'content' => 'You Received A New Order From ' . $request->user()->name,
                'order_id' => $order->id
            ]);
    
            $tokens = $restaurant->ctokens()->where('token','!=','')->pluck('token')->toArray();
            if(count($tokens)){
                $title = $notification->title;
                $content = $notification->content;
                $data = [
                    'order_id' => $notification->order_id
                ];
                $send = notifyByFirebase($title, $content, $tokens, $data);
                info('firebase result:' . $send);
            }
        });
        
        
        return responseJson('1','success');
    }

    public function pastOrders(Request $request){
        $orders = $request->user()->orders()->whereIn('state',['delivered','rejected','declined'])->latest()->paginate(5);
        if(count($orders)){
            return responseJson(200,'success',OrderResource::collection($orders));
        }else{
            return responseJson(0,'failure','No Past Orders');
        }
    }

    public function currentOrders(Request $request){
        $orders = $request->user()->orders()->whereIn('state',['Accepted','pending'])->latest()->paginate(5);
        if(count($orders)){
            return responseJson(200,'success',OrderResource::collection($orders));
        }else{
            return responseJson(0,'failure','No Current Orders');
        }
    }

    public function receiveOrder(Request $request){
        $validator = validator()->make($request->all(),[
            'order_id' => 'required|exists:orders,id'
        ]);
        if($validator->fails()){
            return responseJson(0,'failure',$validator->errors());
        }
        $order = Order::find($request->order_id);
        if($order->state == 'accepted'){
            $order->update([
                'state' => 'delivered'
            ]);
            $notification = $order->restaurant->notifications()->create([
                'title' => 'Delivered !!!',
                'content' => 'Client ' . $request->user()->name . ' Received The Order',
                'order_id' => $order->id
            ]);
    
            $tokens = $order->restaurant->ctokens()->where('token','!=','')->pluck('token')->toArray();
            if(count($tokens)){
                $title = $notification->title;
                $content = $notification->content;
                $data = [
                    'order_id' => $notification->order_id
                ];
                $send = notifyByFirebase($title, $content, $tokens, $data);
                info('firebase result:' . $send);
            }
            return responseJson('1','success',new OrderResource($order->fresh()));


        }else{
            return responseJson(0,'failure','Something Went Wrong');
        }

    }
    public function declineOrder(Request $request){
        $validator = validator()->make($request->all(),[
            'order_id' => 'required|exists:orders,id'
        ]);
        if($validator->fails()){
            return responseJson(0,'failure',$validator->errors());
        }
        $order = Order::find($request->order_id);
        if($order->state == 'accepted'){
            $order->update([
                'state' => 'declined'
            ]);
            $notification = $order->restaurant->notifications()->create([
                'title' => 'Declined !!!',
                'content' => 'Client ' . $request->user()->name . ' Declined The Order',
                'order_id' => $order->id
            ]);
    
            $tokens = $order->restaurant->ctokens()->where('token','!=','')->pluck('token')->toArray();
            if(count($tokens)){
                $title = $notification->title;
                $content = $notification->content;
                $data = [
                    'order_id' => $notification->order_id
                ];
                $send = notifyByFirebase($title, $content, $tokens, $data);
                info('firebase result:' . $send);
            }
            return responseJson('1','success',new OrderResource($order->fresh()));


        }else{
            return responseJson(0,'failure','Something Went Wrong');
        }
    }
}
