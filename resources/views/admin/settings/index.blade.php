
@extends('admin.layouts.app')
@section('title','Edit Settings')
@section('content')
<div class="card card-primary">
    @if (session('message'))
        <div x-data={show:true} x-init="setTimeout(() => show =false,3000)">
            <div x-show="show" x-transition.duration.500ms class="alert alert-success alert-dismissible">
                    {{session('message')}}
            </div>
        </div>
    @endif
    <form action="{{route('settings.update',$settings->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>About Text</label>
                <textarea name="about_text" class="form-control">{{$settings->about_text}}</textarea>
                @error('about_text')
                    <p class="text-danger text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Accounts</label>
                <input name="accounts" type="text" class="form-control" value="{{$settings->accounts}}">
                @error('accounts')
                    <p class="text-danger text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Commission <span class="text-muted text-sm">(must enter a percentage. ex:60%)</span></label>
                <div class="input-group mb-3">
                    <input name="commission" type="text" class="form-control" value="{{$settings->commission}}">
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                    @error('commission')
                        <p class="text-danger text-sm">{{$message}}</p>
                    @enderror
                </div>
            </div>
            
        </div>
        @can('settings_edit')
        <div class="card-footer">
            <button type="submit" class="btn btn-info">Submit</button>
        </div>
        @endcan
    </form>
</div>
@endsection