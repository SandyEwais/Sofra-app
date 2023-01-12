<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\NeighborhoodResource;
use App\Models\Category;
use App\Models\City;
use App\Models\ContactMessage;
use App\Models\Neighborhood;
use App\Models\Settings;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function contact(Request $request){
        $validator = validator()->make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
            'type' => 'required'
        ]);
        if($validator->fails()){
            return responseJson('0','failure',$validator->errors());
        }
        ContactMessage::create($request->all());
        return responseJson(200,'success');
    }

    public function settings(){
        $settings = Settings::first();
        return responseJson(200,'success',$settings);
    }

    public function categories(){
        $categories = Category::all();
        if(count($categories)){
            return responseJson(200,'success',CategoryResource::collection($categories));
        }
    }
    public function cities(){
        $cities = City::all();
        if(count($cities)){
            return responseJson(200,'success',CityResource::collection($cities));
        }
    }

    public function neighborhoods(){
        $neighborhoods = Neighborhood::all();
        if(count($neighborhoods)){
            return responseJson(200,'success',NeighborhoodResource::collection($neighborhoods));
        }
    }
}
