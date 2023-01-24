@extends('admin.layouts.app')
@section('title',$restaurant->name)
@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fas fa-truck-loading"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Orders</span>
                <span class="info-box-number">{{$restaurant->orders->count()}}</span>
            </div>
        
        </div>
    
    </div>
    
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-coins"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Revenue</span>
                <span class="info-box-number">{{$restaurant->orders->sum('restaurant_net')}}</span>
            </div>
        
        </div>
    
    </div>
    
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="far fa-comment"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Comments</span>
                <span class="info-box-number">{{$restaurant->comments->count()}}</span>
            </div>
        
        </div>
    
    </div>
    
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Rate</span>
                <span class="info-box-number">{{$restaurant->star_rate}}</span>
            </div>
        
        </div>
    
    </div>
    
</div>
<div class="card">
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-4">Name:</dt>
            <dd class="col-sm-8">{{$restaurant->name}}</dd>
            <dt class="col-sm-4">Email:</dt>
            <dd class="col-sm-8">{{$restaurant->email}}</dd>
            <dt class="col-sm-4">Phone:</dt>
            <dd class="col-sm-8">{{$restaurant->phone}}</dd>
            <dt class="col-sm-4">Minimum Charge:</dt>
            <dd class="col-sm-8">${{$restaurant->minimum_charge}}</dd>
            <dt class="col-sm-4">Delivery Fees:</dt>
            <dd class="col-sm-8">{{$restaurant->delivery_fees}}</dd>
            <dt class="col-sm-4">State:</dt>
            <dd class="col-sm-8">{{$restaurant->state}}</dd>
            <dt class="col-sm-4">Contact Phone:</dt>
            <dd class="col-sm-8">{{$restaurant->contact_phone}}</dd>
            <dt class="col-sm-4">Whatsapp:</dt>
            <dd class="col-sm-8">{{$restaurant->whatsapp}}</dd>
            <dt class="col-sm-4">Location:</dt>
            <dd class="col-sm-8">{{$restaurant->neighborhood->name.', '.$restaurant->neighborhood->city->name}}</dd>
        </dl>
    </div>
    
</div>
@endsection