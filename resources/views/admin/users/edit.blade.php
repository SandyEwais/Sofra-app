@inject('roles', 'Spatie\Permission\Models\Role')
@extends('admin.layouts.app')
@section('title','Edit User')
@section('content')
<div class="card card-primary">
    <form action="{{route('users.update',$user->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>Name</label>
                <input name="name" type="text" class="form-control" value="{{$user->name}}" placeholder="Enter Name">
                @error('name')
                    <p class="text-danger text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Email</label>
                <input name="email" type="email" class="form-control" value="{{$user->email}}" placeholder="Enter Email">
                @error('email')
                    <p class="text-danger text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role_id[]" multiple class="custom-select rounded-0" id="exampleSelectRounded0">
                    <option value="" selected disabled hidden >Select</option>
                    @foreach ($roles->all() as $role)
                        <option {{$user->hasRole($role->id) ? 'selected' : ''}} value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
                @error('role_id')
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