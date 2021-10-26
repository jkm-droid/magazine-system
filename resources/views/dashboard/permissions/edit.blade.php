@extends('base.admin_index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit "{{ $permission->name }}"</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('permission.index') }}">Permissions</a></li>
                        <li class="breadcrumb-item active"><b>Edit Permission</b></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="col-12">
        <div class="card card-outline card-danger">
            <div class="card-header">
                <h3 class="card-title"><a class="btn btn-sm put-gold background-black" href="{{ route('permission.index') }}">Back</a></h3>
            </div>
            <!-- /.card-header -->

            <form role="form" method="post" action="{{ route('permission.update', $permission->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body m-1">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Permission Name</label>
                            <input type="text" name="name" value="{{ $permission->name }}" class="form-control" placeholder="Enter permission name" id="title">
                            @if ($errors->has('name'))
                                <div class="text-danger form-text">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <input type="submit" id="submit_button" value="Update Permission" name="save_permission" class="btn background-gold">
                </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>

@endsection
