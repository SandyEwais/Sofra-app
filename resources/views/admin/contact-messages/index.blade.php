@extends('admin.layouts.app')
@section('title','Contact Messages')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <form action="{{route('contact-messages.index')}}">
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
            @if (count($contactMessages))
                        <div class="card-body p-0">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contactMessages as $contactMessage)
                                        <tr data-widget="expandable-table" aria-expanded="false">
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$contactMessage->name}}</td>
                                            <td>{{$contactMessage->email}}</td>
                                            <td>{{$contactMessage->phone}}</td>
                                            <td>{{$contactMessage->type}}</td>
                                            <td><a href="#" data-target="{{$contactMessage->id}}" class="btn btn-outline-danger btn-xs"><i class="fas fa-trash"></i> Delete</a></td>
                                        </tr>
                                        <tr class="expandable-body">
                                            <td colspan="5">
                                                <p style="">{{$contactMessage->message}}</p>
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
       
    </script>
@endpush