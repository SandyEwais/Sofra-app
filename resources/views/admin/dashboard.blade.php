@inject('clients', 'App\Models\Client')
@inject('restaurants', 'App\Models\Restaurant')
@inject('comments', 'App\Models\Comment')
@inject('regions', 'App\Models\Neighborhood')
@extends('admin.layouts.app')
@section('title','Dashboard')
@section('content')
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
    <span class="info-box-icon bg-info elevation-1"><i class="	fas fa-map-marked-alt"></i></span>
    <div class="info-box-content">
    <span class="info-box-text">Regions</span>
    <span class="info-box-number">
    {{$regions->count()}}
    </span>
    </div>
    
    </div>
    
    </div>
    
    <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
    <span class="info-box-icon bg-danger elevation-1"><i class="far fa-star"></i></span>
    <div class="info-box-content">
    <span class="info-box-text">Reviews</span>
    <span class="info-box-number">{{$comments->count()}}</span>
    </div>
    
    </div>
    
    </div>
    
    
    <div class="clearfix hidden-md-up"></div>
    <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-hamburger"></i></span>
    <div class="info-box-content">
    <span class="info-box-text">Restaurants</span>
    <span class="info-box-number">{{$restaurants->count()}}</span>
    </div>
    
    </div>
    
    </div>
    
    <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
    <div class="info-box-content">
    <span class="info-box-text">New Clients</span>
    <span class="info-box-number">{{$clients->count()}}</span>
    </div>
    
    </div>
    
    </div>
    
    </div>

    <div class="card-footer">
        <div class="row">
        <div class="col-sm-3 col-6">
        <div class="description-block border-right">
        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
        <h5 class="description-header">$35,210.43</h5>
        <span class="description-text">TOTAL REVENUE</span>
        </div>
        
        </div>
        
        <div class="col-sm-3 col-6">
        <div class="description-block border-right">
        <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
        <h5 class="description-header">$10,390.90</h5>
        <span class="description-text">TOTAL COST</span>
        </div>
        
        </div>
        
        <div class="col-sm-3 col-6">
        <div class="description-block border-right">
        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
        <h5 class="description-header">$24,813.53</h5>
        <span class="description-text">TOTAL PROFIT</span>
        </div>
        
        </div>
        
         <div class="col-sm-3 col-6">
        <div class="description-block">
        <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
        <h5 class="description-header">1200</h5>
        <span class="description-text">GOAL COMPLETIONS</span>
        </div>
        
        </div>
        </div>
        
        </div>
@endsection