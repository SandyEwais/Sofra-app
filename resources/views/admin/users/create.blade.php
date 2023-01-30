@inject('roles', 'Spatie\Permission\Models\Role')
@extends('admin.layouts.app')
@section('title','Add New User')
@section('content')
<div class="card card-primary">
    <form action="{{route('users.store')}}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Name</label>
                <input name="name" type="text" class="form-control" value="{{old('name')}}" placeholder="Enter Name">
                @error('name')
                    <p class="text-danger text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Email</label>
                <input name="email" type="email" class="form-control" value="{{old('email')}}" placeholder="Enter Email">
                @error('email')
                    <p class="text-danger text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role_id[]" multiple class="custom-select rounded-0" id="exampleSelectRounded0">
                    <option value="" selected disabled hidden >Select</option>
                    @foreach ($roles->all() as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
                @error('role_id')
                    <p class="text-danger text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input name="password" type="password" class="form-control" value="{{old('password')}}" placeholder="Enter Password">
                @error('password')
                    <p class="text-danger text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input name="password_confirmation" type="password" class="form-control" value="{{old('password_confirmation')}}" placeholder="Confirm Password">
                @error('password_confirmation')
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