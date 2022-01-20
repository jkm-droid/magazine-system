@extends('base.admin_index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create New Role</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Roles</a></li>
                        <li class="breadcrumb-item active"><b>New Role</b></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="col-12">
        <div class="card card-outline card-danger">
            <div class="card-header">
                <h3 class="card-title">
                    <a class="btn btn-sm put-gold background-black" href="{{ route('role.index') }}">Back</a>
                </h3>
            </div>
            <!-- /.card-header -->

            <form role="form" method="post" action="{{ route('role.save') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body m-1">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Role Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter role name" id="title">
                            @if ($errors->has('name'))
                                <div class="text-danger form-text">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row-cols-3 row-cols-md-4 g-4">
                        <div class="col-md-6 mt-3">
                            <label for="title" class="form-label">Select Permissions</label>
                            <div class="form-check">
{{--                                <div class="row">--}}
                                    @foreach($permissions as $permission)
                                        <div class="col">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permission->id }}">
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

                    <div class="card-footer">
                        <input type="submit" id="submit_button" value="Save Role" name="save_role" class="btn background-gold">
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>

@endsection
