@extends('admin.layouts.app')
@section('title','Settings')
@section('content')
<div class="card">
    <div class="card-body">
        <dl class="row">
            
            <dt class="col-sm-4">About Text:</dt>
            <dd class="col-sm-8">{{$settings->about_text}}</dd>
            <dt class="col-sm-4">Accounts:</dt>
            <dd class="col-sm-8">{{$settings->accounts}}</dd>
            <dt class="col-sm-4">Commission:</dt>
            <dd class="col-sm-8">{{$settings->commission}}%</dd>
            
        </dl>
        <a href="{{route('settings.edit',$settings->id)}}" class="btn btn-outline-secondary btn-xs"><i class="fas fa-edit"></i> Edit</a>
    </div>
    
</div>
@endsection