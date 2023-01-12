<?php

namespace App\Http\Controllers\Api\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MealResource;

class MealController extends Controller
{
    public function allMeals(Request $request){
        $meals = $request->user()->meals()->paginate(6);
        if(count($meals)){
            return responseJson(200,'success',MealResource::collection($meals));
        }
    }
    public function addMeal(Request $request){
        $validator = validator()->make($request->all(),[
            'image' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'price_sale' => 'required',
            'time' => 'required',
        ]);
        if($validator->fails()){
            return responseJson(0,'failure',$validator->errors());
        }
        $meal = $request->user()->meals()->create($request->all());
        if($meal) {
            return responseJson(200,'success',new MealResource($meal));
        }
        
    }
    public function editMeal(Request $request){
        $validator = validator()->make($request->all(),[
            'meal_id' => 'required',
            'image' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'price_sale' => 'required',
            'time' => 'required',
        ]);
        if($validator->fails()){
            return responseJson(0,'failure',$validator->errors());
        }
        $meal = $request->user()->meals()->where('id',$request->meal_id)->first();
        if($meal){
            $update = $meal->update($request->all());
            if($update){
                return responseJson(200,'success',new MealResource($meal->fresh()));
            }
        }

    }

    public function deleteMeal(Request $request){
        $validator = validator()->make($request->all(),[
            'meal_id' => 'required',
        ]);
        if($validator->fails()){
            return responseJson(0,'failure',$validator->errors());
        }
        $meal = $request->user()->meals()->where('id',$request->meal_id)->first();
        if($meal){
            $delete = $meal->delete();
            if($delete){
                return responseJson(200,'success','Meal Deleted Successfully');
            }
        }else{
            return responseJson(0,'failure');
        }
        
    }
}
