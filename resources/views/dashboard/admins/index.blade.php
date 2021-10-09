@extends('base.admin_index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Admins</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><b>Admins</b></li>
                        <li class="breadcrumb-item active"><b>All</b></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    @if($admins->isEmpty())
        <h4 class="text-center">No Admin found.</h4>
    @else
        <div class="col-12">
            <div class="card card-outline card-warning">
                <div class="card-header">

                    <a class="btn btn-sm btn-success" href="{{ route('admin.create') }}">
                        <h3 class="card-title">Add New Admin</h3>
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
                            <th>Role</th>
                            <th>Creation Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($admins as $admin)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td><a href="{{ route('admin.show', $admin->id) }}">{{ $admin->name }}</a></td>
                                <td>
                                    @foreach($admin->roles as $admin_role)
                                        @if($admin_role->slug == "admin")
                                            <span class="badge badge-danger">{{ $admin_role->name }}</span>
                                        @else
                                            <span class="badge badge-info">{{ $admin_role->name }}</span>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $admin->created_at }}</td>

                                <td>
                                    <form action="{{ route('admin.delete',$admin->id) }}" method="POST">

                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.show',$admin->id) }}">Show</a>
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.edit',$admin->id) }}">Edit</a>

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

    {!! $admins->links() !!}

@endsection
