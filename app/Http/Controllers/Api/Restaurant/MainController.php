<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\MealResource;
use App\Models\Comment;
use App\Models\Meal;
use App\Models\Restaurant;
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
    public function payments(Request $request){
        $totalSales =  $request->user()->orders()->sum('total_order_price');
        $totalCommissions =  $request->user()->orders()->sum('app_commission');
        $totalPayments =  $request->user()->payments()->sum('paid_fees');
        $remaining = $totalCommissions - $totalPayments;
        return responseJson(200,'success',compact('totalSales','totalCommissions','totalPayments','remaining'));
    }

    public function rating(Request $request){
        $ratings = Comment::where('restaurant_id',$request->user()->id)->get('rate');
        $ratingValues = [];

        foreach ($ratings as $rating) {
            $ratingValues[] = $rating->rate;
        }

        $ratingAverage = collect($ratingValues)->sum() / $ratings->count();
        $update = $request->user()->update([
            'star_rate' => $ratingAverage
        ]);
        if($update) {
            return responseJson(200,'success');
        }else{
            return responseJson(404,'failure','Something Went Wrong');
        }

    }
}
