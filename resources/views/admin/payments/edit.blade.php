@inject('restaurants', 'App\Models\Restaurant')
@extends('admin.layouts.app')
@section('title','Add New Payment')
@section('content')
<div class="card card-primary">
    
    
    <form action="{{route('payments.update',['payment' => $payment->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Amount Paid</label>
                <input name="paid_fees" type="text" class="form-control" id="exampleInputEmail1" value="{{$payment->paid_fees}}" placeholder="Enter Amount Paid...">
                @error('paid_fees')
                    <p class="text-danger text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleSelectRounded0">Select Restaurant</label>
                <select name="restaurant_id" class="custom-select rounded-0" id="exampleSelectRounded0">
                    <option value="" selected disabled hidden >Select</option>
                    @foreach ($restaurants->all() as $restaurant)
                        <option value="{{$restaurant->id}}">{{$restaurant->name}}</option>
                    @endforeach
                </select>
                @error('restaurant_id')
                    <p class="text-danger text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Payment Date And Time</label>
                <input name="payment_date" type="datetime-local" class="form-control" id="exampleInputEmail1" value="{{$payment->payment_date}}" placeholder="Enter Amount Paid...">
                @error('payment_date')
                    <p class="text-danger text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Notes:</label>
                <textarea name="notes"class="form-control" id="exampleInputEmail1" placeholder="Enter Notes...">{{$payment->notes}}</textarea>
                @error('notes')
                    <p class="text-danger text-sm">{{$message}}</p>
                @enderror
            </div>
            
        </div>
        
            
        <div class="card-footer">
            <button type="submit" class="btn btn-info">Submit</button>
        </div>
    </form>
</div>
@endsection