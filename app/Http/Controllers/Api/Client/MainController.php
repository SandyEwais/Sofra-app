<?php

namespace App\Http\Controllers\Api\Client;

use App\Models\Meal;
use App\Models\Offer;
use App\Models\Comment;
use App\Models\Restaurant;
use App\Models\Neighborhood;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Http\Resources\MealResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\CommentResource;
use App\Http\Resources\RestaurantResource;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\OrderResource;

class MainController extends Controller
{
    
    
    public function allRestaurants(Request $request){
        $restaurants = Restaurant::where(function($query) use($request){
            if($request->has('city_id')){
                $neighborhood = Neighborhood::where('city_id',$request->city_id)->first();
                $query->where('neighborhood_id',$neighborhood->id);
            }
            if($request->has('search')){
                $query->filter(request(['search']));
            }
        })->paginate(6);
        if(count($restaurants)){
            return responseJson(200,'success',RestaurantResource::collection($restaurants));
        }else{
            return responseJson(0,'No Data');
        }
    }

    public function singleRestaurant(Request $request){
        $restaurant = Restaurant::where('id',$request->restaurant_id)->with('meals','comments')->first();
        if(!$restaurant){
            return responseJson(0,'failure');
        }
        return responseJson(200,'success',new RestaurantResource($restaurant));
    }

    public function singleMeal(Request $request){
        $meal = Meal::where('id',$request->meal_id)->first();
        if(!$meal){
            return responseJson(0,'failure');
        }
        return responseJson(200,'success',new MealResource($meal));
    }

    public function addComment(Request $request){
        $validator = validator()->make($request->all(),[
            'rate' => 'required',
            'body' => 'required',
        ]);
        if($validator->fails()){
            return responseJson('0','failure',$validator->errors());
        }
        $comment = Comment::create($request->all());
        return responseJson(200,'success',new CommentResource($comment));

    }

    public function allNotifications(Request $request){
        $notifications = $request->user()->notifications()->latest()->paginate(6);
        return responseJson(200,'success',NotificationResource::collection($notifications));
    }

    public function allOffers(){
        $offers = Offer::latest()->paginate(6);
        return responseJson(200,'success',OfferResource::collection($offers));
    }

    


}
