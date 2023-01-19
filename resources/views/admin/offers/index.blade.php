@extends('admin.layouts.app')
@section('title','Offers')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <form action="{{route('offers.index')}}">
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
            @if (count($offers))
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Discription</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($offers as $offer)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$offer->image}}</td>
                                    <td>{{$offer->title}}</td>
                                    <td>{{$offer->description}}</td>
                                    <td>{{$offer->start_date}}</td>
                                    <td>{{$offer->end_date}}</td>
                                    <td>
                                        <a href="#" data-target="{{$offer->id}}" class="btn btn-outline-danger btn-xs"><i class="fas fa-trash"></i> Delete</a>
                                        
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
        // $(".deleteBtn").click(function(){
        //     $("#confirmationModal").modal();
        //     $("#confirmationModalTitle").html("Deletion");
        //     $("#proceedBtn").addClass("btn btn-danger");
        //     var id = $(this).attr('data-target');
        //     $("#confirmationModalForm").attr('action','{{route("offers.destroy",["offer" => "id"])}}')
        // });
    </script>
@endpush