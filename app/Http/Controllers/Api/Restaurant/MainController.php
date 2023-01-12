<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\MealResource;
use App\Models\Meal;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function comments(Request $request){
        $comments = $request->user()->comments()->paginate(6);
        if(count($comments)){
            return responseJson(200,'success',CommentResource::collection($comments));
        }else{
            return responseJson(0,'No Data');
        }
    }
}
