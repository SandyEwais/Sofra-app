@extends('admin.layouts.app')
@section('title','Edit City')
@section('content')
<div class="card card-primary">
    
    
    <form action="{{route('cities.update',['city' => $city->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1" value="{{$city->name}}">
                @error('name')
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