<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function allOffers(Request $request){
        $offers = $request->user()->offers()->paginate(6);
        if(count($offers)){
            return responseJson(200,'success',OfferResource::collection($offers));
        }
    }
    public function addOffer(Request $request){
        $validator = validator()->make($request->all(),[
            'image' => 'required',
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|before_or_equal:date_end',
            'end_date' => 'required|after_or_equal:date_start'
        ]);
        if($validator->fails()){
            return responseJson(0,'failure',$validator->errors());
        }
        $offer = $request->user()->offers()->create($request->all());
        if($offer) {
            return responseJson(200,'success',new OfferResource($offer));
        }
        
    }
    public function editOffer(Request $request){
        $validator = validator()->make($request->all(),[
            'offer_id' => 'required',
            'image' => 'required',
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|before_or_equal:date_end',
            'end_date' => 'required|after_or_equal:date_start'
        ]);
        if($validator->fails()){
            return responseJson(0,'failure',$validator->errors());
        }
        $offer = $request->user()->offers()->find($request->offer_id);
        if($offer){
            $update = $offer->update($request->all());
            if($update){
                return responseJson(200,'success',new OfferResource($offer->fresh()));
            }
        }else{
            return responseJson(0,'failure');
        }

    }

    public function deleteOffer(Request $request){
        $validator = validator()->make($request->all(),[
            'offer_id' => 'required',
        ]);
        if($validator->fails()){
            return responseJson(0,'failure',$validator->errors());
        }
        $offer = $request->user()->offers()->find($request->offer_id);
        if($offer){
            $delete = $offer->delete();
            if($delete){
                return responseJson(200,'success','Offer Deleted Successfully');
            }
        }else{
            return responseJson(0,'failure');
        }
        
    }
}
