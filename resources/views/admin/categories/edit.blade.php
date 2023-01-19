@extends('admin.layouts.app')
@section('title','Edit Category')
@section('content')
<div class="card card-primary">
    
    
    <form action="{{route('categories.update',['category' => $category->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1" value="{{$category->name}}">
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