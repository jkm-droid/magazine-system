@extends('base.admin_index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Admins/Authors</h1>
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
            <div class="card card-outline card-dark">
                <div class="card-header">

                    <a class="btn btn-sm put-gold background-black" href="{{ route('admin.create') }}">
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
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Super Admin</th>
                            <th></th>
                            <th>Creation Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($admins as $admin)
                            <tr class="admin-data-row">
                                <td>{{ ++$i }}</td>
                                <td><a href="{{ route('admin.show', $admin->id) }}">{{ $admin->name }}</a></td>
                                <td>{{ $admin->username }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>
                                    @foreach($admin->roles as $admin_role)
                                        @if($admin_role->slug == "admin")
                                            <span class="badge badge-danger">{{ $admin_role->name }}</span>
                                        @else
                                            <span class="badge badge-info">{{ $admin_role->name }}</span>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @if($admin->isSuperAdmin == 1)
                                        <span class="text-center"><i class="text-success fa fa-check-circle"></i></span>
                                    @else
                                        <span><i class="text-danger fa fa-times-circle"></i></span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin.make.super', $admin->id) }}" method="post" id="admin-make-form" class="admin-make-form">
                                        @csrf
                                        <input type="hidden" id="admin-id" value="{{ $admin->id }}">
                                        @if($admin->isSuperAdmin == 1)
                                            <button id="make-super-admin" type="submit" data-id="{{ $admin->id }}" class="btn badge badge-danger">Demote</button>
                                        @else
                                            <button id="make-super-admin" type="submit" data-id="{{ $admin->id }}" class="btn badge badge-info">Promote</button>
                                        @endif

                                    </form>

                                </td>
                                <td>{{ $admin->created_at }}</td>

                                @if(\Illuminate\Support\Facades\Auth::user()->id != $admin->id)
                                    <td>
                                        <form action="{{ route('admin.delete',$admin->id) }}" method="POST">

                                            <a class="btn btn-primary btn-sm" href="{{ route('admin.show',$admin->id) }}">Show</a>
                                            <a class="btn btn-sm background-gold" href="{{ route('admin.edit',$admin->id) }}">Edit</a>

                                            @csrf
                                            @method('PUT')

                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <script type="text/javascript">
            $(document).ready(function (){

                $('.admin-data-row').hover(function (){

                    if(!$(this).hasClass('hoverd')){

                        $(this).addClass('hoverd');
                        $(this).find('.admin-make-form').show();
                    }
                }, function (){
                    $(this).removeClass('hoverd');
                });
            });
        </script>
    @endif

    {!! $admins->links() !!}

@endsection
