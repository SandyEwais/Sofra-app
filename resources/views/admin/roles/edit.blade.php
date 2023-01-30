@inject('permissions', 'Spatie\Permission\Models\Permission')
@extends('admin.layouts.app')
@section('title','Edit Role')
@section('content')
<div class="card card-primary">
    
    @if (session('message'))
            <div x-data={show:true} x-init="setTimeout(() => show =false,3000)">
                <div x-show="show" x-transition.duration.500ms class="alert alert-success alert-dismissible">
                        {{session('message')}}
                </div>
            </div>
    @endif
    <form action="{{route('roles.update',$role->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>Name</label>
                <input name="name" type="text" class="form-control" value="{{$role->name}}">
                @error('name')
                    <p class="text-danger text-sm">{{$message}}</p>
                @enderror
            </div>
            <label>Permissions</label>

        
            <div class="row">
                <div class="col-sm-12">
                
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="selectAll" value="option1">
                            <label for="selectAll" class="custom-control-label">Select All</label>
                            
                        </div>
                    </div>
                </div>   
            </div>
            
            <div class="row">
                @foreach ($permissions->all() as $permission)
                    <div class="col-sm-2">
                    
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input 
                                @if ($role->hasPermissionTo($permission->id))
                                    checked
                                @endif
                                name="permissions[]" class="custom-control-input" type="checkbox" id="customCheckbox{{$loop->iteration}}" value="{{$permission->id}}">
                                <label for="customCheckbox{{$loop->iteration}}" class="custom-control-label">{{$permission->name}}</label>
                                
                            </div>
                        </div>
                    </div> 
                @endforeach
                
            </div>
            @error('permissions')
                <p class="text-danger text-sm">{{$message}}</p>
            @enderror
        </div>
            
        <div class="card-footer">
            <button type="submit" class="btn btn-info">Submit</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
    <script>
        $("#selectAll").click(function(){
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

        });
        $("input[type=checkbox]").click(function() {
            if (!$(this).prop("checked")) {
                $("#selectAll").prop("checked", false);
            }
        });
    </script>
@endpush