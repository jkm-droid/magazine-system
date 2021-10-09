@extends('base.admin_index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Assign Admin Roles</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Admins</a></li>
                        <li class="breadcrumb-item active"><b>Assign Roles</b></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="col-12">
        <div class="card card-outline card-danger">
            <div class="card-header">
                <h3 class="card-title">Responsive Hover Table</h3>
            </div>
            <!-- /.card-header -->

            <form role="form" method="post" action="{{ route('admin.update', $admin->id) }}" id="form_submit" enctype="multipart/form-data">
                @csrf
                <div class="card-body m-1">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="title" class="form-label">Admin Username</label>
                            <input type="text" name="username" value="{{ $admin->username }}" class="form-control" readonly>
                            @if ($errors->has('username'))
                                <div class="text-danger form-text">{{ $errors->first('username') }}</div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <label for="title" class="form-label">Admin Full Name</label>
                            <input type="text" name="name" value="{{ $admin->name }}" class="form-control" readonly>
                            @if ($errors->has('name'))
                                <div class="text-danger form-text">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <label for="title" class="form-label">Admin Email</label>
                            <input type="email" name="email" value="{{ $admin->email }}" class="form-control" readonly>
                            @if ($errors->has('email'))
                                <div class="text-danger form-text">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="role" class="form-label">Admin Role</label>
                            <select multiple name="role" class="form-select form-control" aria-label="Default select example" autofocus>
                                <option value="" disabled selected>Select Admin Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('role'))
                                <div class="text-danger form-text">{{ $errors->first('role') }}</div>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <input type="submit" id="submit_button" value="Assign Role to Admin" name="save_admin" class="btn btn-success">
                </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection
