@extends('admin.layouts.app')
@section('title','Add New City')
@section('content')
<div class="card card-primary">
    
    
    <form action="{{route('cities.store')}}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1" value="{{old('name')}}" placeholder="Enter City...">
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