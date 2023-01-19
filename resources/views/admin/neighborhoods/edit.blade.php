@inject('cities', 'App\Models\City')
@extends('admin.layouts.app')
@section('title','Edit Neighborhood')
@section('content')
<div class="card card-primary">
    
    
    <form action="{{route('neighborhoods.update',['neighborhood' => $neighborhood->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1" value="{{$neighborhood->name}}">
                @error('name')
                    <p class="text-danger text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleSelectRounded0">Select City</label>
                <select name="city_id" class="custom-select rounded-0" id="exampleSelectRounded0">
                    <option value="" selected disabled hidden >Select</option>
                    @foreach ($cities->all() as $city)
                        <option {{$city->id == $neighborhood->city_id ? 'selected' : ''}} value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </select>
                @error('city_id')
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