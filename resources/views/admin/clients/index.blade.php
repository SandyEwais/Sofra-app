@extends('admin.layouts.app')
@section('title','Clients')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                
                <div class="card-tools">
                    <form action="{{route('clients.index')}}">
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
            @if (count($clients))
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Neighborhood</th>
                                <th>Action</th>
                                <th>Activation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$client->name}}</td>
                                    <td>{{$client->email}}</td>
                                    <td>{{$client->phone}}</td>
                                    <td>{{$client->neighborhood->name}}</td>
                                    <td>
                                        <a data-value="{{'clients,'.$client->id}}" class="btn btn-outline-danger btn-xs deleteBtn"><i class="fas fa-trash"></i> Delete</a>
                                    </td>
                                    <td>
                                        <a data-value="{{'clients,'.$client->id}}{{$client->activation == 1 ? ',Deactivation' : ',Activation' }}" class="btn {{$client->activation == 1 ? 'btn-dark' : 'btn-outline-light'}} btn-xs activateBtn"><i class=""></i> {{$client->activation == 1 ? 'Activated' : 'Deactivated'}}</a>
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