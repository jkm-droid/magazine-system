@extends('base.admin_index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create New Admin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Admins</a></li>
                        <li class="breadcrumb-item active"><b>New Admin</b></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="col-12">
        <div class="card card-outline card-dark">
            <div class="card-header">
                <h3 class="card-title">
                    <a class="btn btn-sm put-gold background-black" href="{{ route('admin.index') }}">Back</a>
                </h3>
            </div>
            <!-- /.card-header -->

            <form role="form" method="post" action="{{ route('admin.send.link') }}" id="form_submit" enctype="multipart/form-data">
                @csrf
                <div class="card-body m-1">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Admin Email</label>
                            <input type="email" name="email" class="form-control" placeholder="enter email address">
                            @if ($errors->has('email'))
                                <div class="text-danger form-text">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                    </div>

                </div>

                <div class="card-footer">
                    <input type="submit" id="submit_button" value="Send Invitation Link" name="save_admin" class="btn background-gold">
                </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>

@endsection
