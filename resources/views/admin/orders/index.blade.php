@extends('admin.layouts.app')
@section('title','Orders')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                
                <div class="card-tools">
                    <form action="{{route('orders.index')}}">
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
            @if (count($orders))
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Restaurant</th>
                                <th>State</th>
                                <th>Payment Method</th>
                                @if (Auth::user()->can('orders_show'))
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$order->restaurant->name}}</td>
                                    <td>{{$order->state}}</td>
                                    <td>{{$order->payment_method}}</td>
                                    <td>
                                        @can('orders_show')
                                        <a href="{{route('orders.show',$order->id)}}" class="btn btn-outline-info btn-xs"><i class="fas fa-eye"></i> Show</a>
                                        @endcan
                                        <a class="btn btn-light btn-xs"><i class="fas fa-print"></i> Print</a>
                                        
                                    </td>
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