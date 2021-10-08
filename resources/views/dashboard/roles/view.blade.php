@extends('base.admin_index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View <strong>{{ $role->name }}</strong> Role</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Roles</a></li>
                        <li class="breadcrumb-item active"><b>View Role</b></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="col-12">
        <div class="card card-outline card-danger">
            <div class="card-header">
                <h3 class="card-title"><a class="btn btn-success btn-sm" href="{{ route('role.index') }}">Back</a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body m-1">
                <h4>Role Name:
                <span class="badge badge-danger">{{ $role->name }}</span></h4>
                <h4>Author:
                {{ $role->author }}</h4>
                <h4>Permissions:</h4>
                @foreach($role->permissions as $role_perm)
                    <h5><span class="badge badge-info">{{ $role_perm->name }}</span></h5>
                @endforeach
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection
