@extends('admin.layouts.app')
@section('title','Restaurants')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                
                <div class="card-tools">
                    <form action="{{route('restaurants.index')}}">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
            
            @if (session('message'))
            <div x-data={show:true} x-init="setTimeout(() => show =false,3000)">
                <div x-show="show" x-transition.duration.500ms class="alert alert-success alert-dismissible">
                        {{session('message')}}
                </div>
            </div>
            @endif
            @if (count($restaurants))
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                @can('offers_access')
                                    <th>Offers</th>
                                @endcan
                                @can('payments_access')
                                    <th>Payments</th>
                                @endcan
                                @if (Auth::user()->can('restaurants_show') ||Auth::user()->can('restaurants_delete') )
                                <th>Action</th>
                                @endif
                                @can('restaurants_activate')
                                <th>Activation</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($restaurants as $restaurant)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$restaurant->image}}</td>
                                    <td>{{$restaurant->name}}</td>
                                    @can('offers_access')
                                    <td><a href="{{route('offers.index')}}?restaurant_id={{$restaurant->id}}" class="btn btn-outline-success btn-xs"><i class="fas fa-dollar-sign"></i> Offers</a></td>
                                    @endcan
                                    @can('payments_access')
                                    <td><a href="{{route('payments.index')}}?restaurant_id={{$restaurant->id}}" class="btn btn-outline-success btn-xs"><i class="far fa-credit-card"></i> Payments</a></td>
                                    @endcan
                                    <td>
                                        @can('restaurants_show')
                                        <a href="{{route('restaurants.show',$restaurant->id)}}" class="btn btn-outline-info btn-xs"><i class="fas fa-eye"></i> Show</a>
                                        @endcan
                                        @can('restaurants_delete')
                                        <a data-value="{{'restaurants,'.$restaurant->id}}" class="btn btn-outline-danger btn-xs deleteBtn"><i class="fas fa-trash"></i> Delete</a>
                                        @endcan
                                        
                                    </td>
                                    @can('restaurants_activate')
                                    <td>
                                        <a data-value="{{'restaurants,'.$restaurant->id}}{{$restaurant->activation == 1 ? ',Deactivation' : ',Activation' }}" class="btn {{$restaurant->activation == 1 ? 'btn-dark' : 'btn-outline-light'}} btn-xs activateBtn"><i class=""></i> {{$restaurant->activation == 1 ? 'Activated' : 'Deactivated'}}</a>
                                    </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="card-body">
                    <div class="alert alert-warning alert-dismissible">
                        <h5><i class="icon fas fa-exclamation-triangle"></i></h5>
                        No data available to show.
                    </div>
                </div>
            @endif
            
            
        </div>
        
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(".deleteBtn").click(function(){
            $("#confirmationModal").modal();
            $("#confirmationModalTitle").html("Deletion");
            $("#proceedBtn").removeClass("btn btn-secondary btn-warning").addClass("btn btn-danger");
            var data = $(this).attr('data-value');
            $("#proceedBtn").attr('data-value',data);
        });
        $(".activateBtn").click(function(){
            var data = $(this).attr('data-value');
            var array = data.split(',');
            var process = array[2];
            $("#confirmationModal").modal();
            $("#confirmationModalTitle").html(process);
            $("#proceedBtn").removeClass("btn btn-secondary btn-danger").addClass("btn btn-warning");
            
            $("#proceedBtn").attr('data-value',data);
        });
    </script>
@endpush