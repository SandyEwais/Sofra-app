@inject('permissions', 'Spatie\Permission\Models\Permission')
@extends('admin.layouts.app')
@section('title','Add New Role')
@section('content')
<div class="card card-primary">
    
    
    <form action="{{route('roles.store')}}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Name</label>
                <input name="name" type="text" class="form-control" value="{{old('name')}}" placeholder="Enter Name">
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
                                <input name="permissions[]" class="custom-control-input" type="checkbox" id="customCheckbox{{$loop->iteration}}" value="{{$permission->id}}">
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