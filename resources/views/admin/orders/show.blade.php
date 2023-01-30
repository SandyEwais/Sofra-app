@extends('admin.layouts.app')
@section('title',$order->restaurant->name . "'s Order")
@section('content')
<div class="card">
    <div class="card-body">
        <label class="text-xl">Order Details</label>
        <dl class="row">
            <dt class="col-sm-4">State:</dt>
            <dd class="col-sm-8">{{$order->state}}</dd>
            <dt class="col-sm-4">Total Order Price:</dt>
            <dd class="col-sm-8">{{$order->total_order_price}}</dd>
            <dt class="col-sm-4">Payment Method:</dt>
            <dd class="col-sm-8">{{$order->payment_method}}</dd>
            <dt class="col-sm-4">Delivery Fees:</dt>
            <dd class="col-sm-8">{{$order->delivery_fees}}</dd>
            <dt class="col-sm-4">App Commission:</dt>
            <dd class="col-sm-8">{{$order->app_commission}}</dd>
        </dl>
        <label class="text-xl">Client Details</label>
        <dl class="row">
            <dt class="col-sm-4">Name:</dt>
            <dd class="col-sm-8">{{$order->client->name}}</dd>
            <dt class="col-sm-4">Phone Number:</dt>
            <dd class="col-sm-8">{{$order->client->phone}}</dd>
            <dt class="col-sm-4">Delivery Address:</dt>
            <dd class="col-sm-8">{{$order->delivery_address}}</dd>
            <dt class="col-sm-4">Notes:</dt>
            <dd class="col-sm-8">{{$order->notes}}</dd>
        </dl>
        <label class="text-xl">Restaurant Details</label>
        <dl class="row">
            <dt class="col-sm-4">Name:</dt>
            <dd class="col-sm-8">{{$order->restaurant->name}}</dd>
            <dt class="col-sm-4">Phone Number:</dt>
            <dd class="col-sm-8">{{$order->restaurant->phone}}</dd>
            <dt class="col-sm-4">Location:</dt>
            <dd class="col-sm-8">{{$order->restaurant->neighborhood->name.', '.$order->restaurant->neighborhood->city->name}}</dd>
        </dl>
    </div>
    
</div>
@endsection