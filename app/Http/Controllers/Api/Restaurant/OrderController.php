<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    //new orders
    public function newOrders(Request $request){
        $orders = $request->user()->orders()->where('state','=','pending')->latest()->paginate(6);
        if(count($orders)){
            return responseJson(200,'succuess',OrderResource::collection($orders));
        }else{
            return responseJson(0,'No Data');
        }
    }
    public function acceptOrder(Request $request){
        $validator = validator()->make($request->all(),[
            'order_id' => 'required|exists:orders,id'
        ]);
        if($validator->fails()){
            return responseJson(0,'failure',$validator->errors());
        }
        $order = $request->user()->orders->where('id',$request->order_id)->first();
        if($order){
            
            if($order->state == 'pending'){
                $order->update([
                    'state' => 'accepted'
                ]);
                $notification = $order->client->notifications()->create([
                    'title' => 'Accepted !!!',
                    'content' => 'Restaurant ' . $request->user()->name . ' Accepted The Order',
                    'order_id' => $order->id
                ]);
        
                $tokens = $order->client->ctokens()->where('token','!=','')->pluck('token')->toArray();
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
        }else{
            return responseJson(0,'failure','Something Went Wrong');
        }
        
    }
    public function rejectOrder(Request $request){
        $validator = validator()->make($request->all(),[
            'order_id' => 'required|exists:orders,id'
        ]);
        if($validator->fails()){
            return responseJson(0,'failure',$validator->errors());
        }
        $order = $request->user()->orders->where('id',$request->order_id)->first();
        if($order){
            if($order->state == 'pending'){
                $order->update([
                    'state' => 'rejected'
                ]);
                $notification = $order->client->notifications()->create([
                    'title' => 'Rejected !!!',
                    'content' => 'Restaurant ' . $request->user()->name . ' Rejected The Order',
                    'order_id' => $order->id
                ]);
        
                $tokens = $order->client->ctokens()->where('token','!=','')->pluck('token')->toArray();
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
        }else{
            return responseJson(0,'failure','Something Went Wrong');
        }
    }


    //current orders
    public function currentOrders(Request $request){}
    //past orders
    public function pastOrders(Request $request){}
}
