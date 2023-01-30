@extends('admin.layouts.app')
@section('title','Neighborhoods')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @can('neighborhoods_create')
                <h3 class="card-title">
                    <a class="btn btn-info" href="{{route('neighborhoods.create')}}"><i class="fa fa-plus"></i> New Neighborhood</a>
                </h3>
                @endcan
                
                <div class="card-tools">
                    <form action="{{route('neighborhoods.index')}}">
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
            @if (count($neighborhoods))
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>City</th>
                                @if (Auth::user()->can('neighborhoods_edit') ||Auth::user()->can('neighborhoods_delete') )
                                <th>Action</th>
                                @endif
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($neighborhoods as $neighborhood)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$neighborhood->name}}</td>
                                    <td>{{$neighborhood->city->name}}</td>
                                    <td>
                                        @can('neighborhoods_edit')
                                        <a href="{{route('neighborhoods.edit',['neighborhood' => $neighborhood->id])}}" class="btn btn-outline-secondary btn-xs"><i class="fas fa-edit"></i> Edit</a>
                                        @endcan
                                        @can('neighborhoods_delete')
                                        <a data-value="{{'neighborhoods,'.$neighborhood->id}}" class="btn btn-outline-danger btn-xs deleteBtn"><i class="fas fa-trash"></i> Delete</a>
                                        @endcan
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
            $("#proceedBtn").removeClass("btn btn-secondary").addClass("btn btn-danger");
            var data = $(this).attr('data-value');
            $("#proceedBtn").attr('data-value',data);
        });
    </script>
@endpush