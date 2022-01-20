@extends('base.admin_index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Roles</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><b>Roles</b></li>
                        <li class="breadcrumb-item active"><b>All</b></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    @if($roles->isEmpty())
        <h4 class="text-center">No Role found. <a href="{{ route('role.create') }}">Add New</a></h4>
    @else
        <div class="col-12">
            <div class="card card-outline card-warning">
                <div class="card-header">

                    <a class="btn btn-sm put-gold background-black" href="{{ route('role.create') }}">
                        <h3 class="card-title">Add New Role</h3>
                    </a>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Author</th>
                            <th>Permissions</th>
                            <th>Creation Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td><a href="{{ route('role.show', $role->slug) }}">{{ $role->name }}</a></td>
                                <td>{{ $role->author }}</td>
                                <td>{{ count($role->permissions) }}<br>
                                    @foreach($role->permissions as $role_perm)
                                        <small class="text-success">[{{ $role_perm->name }}]</small>
                                    @endforeach
                                </td>
                                <td>{{ $role->created_at }}</td>

                                <td>
                                    <form action="{{ route('role.delete',$role->id) }}" method="POST">

                                        <a class="btn btn-primary btn-sm" href="{{ route('role.show',$role->slug) }}">Show</a>
                                        <a class="btn btn-sm put-black background-gold" href="{{ route('role.edit',$role->slug) }}">Edit</a>

                                        @csrf
                                        @method('PUT')

                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    @endif

    {!! $roles->links() !!}

@endsection
