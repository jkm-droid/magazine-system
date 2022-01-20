@extends('base.admin_index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit "{{ $role->name }}"</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Roles</a></li>
                        <li class="breadcrumb-item active"><b>Edit Role</b></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="col-12">
        <div class="card card-outline card-danger">
            <div class="card-header">
                <h3 class="card-title"><a class="btn btn-sm put-gold background-black" href="{{ route('role.index') }}">Back</a></h3>
            </div>
            <!-- /.card-header -->

            <form role="form" method="post" action="{{ route('role.update', $role->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body m-1">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Role Name</label>
                            <input type="text" name="name" value="{{ $role->name }}" class="form-control" placeholder="Enter role name">
                            @if ($errors->has('name'))
                                <div class="text-danger form-text">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6 mt-3">
                            <label for="title" class="form-label">Current Permissions  <span class="text-info">Check to remove</span></label>
                            <div class="form-check">
{{--                                <div class="row">--}}
                                    @foreach($role->permissions as $permission)
                                        <div class="col">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permission->slug }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
{{--                                </div>--}}

                                @if ($errors->has('permission'))
                                    <div class="text-danger form-text">{{ $errors->first('permission') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6 mt-3">
                            <label for="title" class="form-label">Add New Permissions <span class="text-info">Check to add</span></label>
                            <div class="form-check">
{{--                                <div class="row">--}}

                                    @for($np = 0; $np < count($new_permissions); $np++)
                                        <div class="col-4">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $new_permissions[$np] }}">
                                                {{ $new_permissions[$np] }}
                                            </label>
                                        </div>
                                    @endfor
{{--                                </div>--}}

                                @if ($errors->has('permission'))
                                    <div class="text-danger form-text">{{ $errors->first('permission') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <input type="submit" id="submit_button" value="Update Role" name="save_role" class="btn background-gold">
                </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>

@endsection
