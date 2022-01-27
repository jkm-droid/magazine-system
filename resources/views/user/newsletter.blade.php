@extends('base.auth_user_index')

@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-warning">
            <div class="card-header text-center">
                <h3 class="put-black"><a href="/" class="h3">Industrialising Africa<br><small><strong>Publication</strong></small></a></h3>
                <p>To download the digital copy, enter this details.</p>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <p class="alert alert-success">{{ $message }}</p>
                @endif
                @if ($message = Session::get('error'))
                    <p class="alert alert-danger">{{ $message }}</p>
                @endif
                <form action="{{ route('user.newsletter') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Name">
                        @if ($errors->has('name'))
                            <div class="text-danger form-text"><small>{{ $errors->first('name') }}</small></div>
                        @endif
                    </div>
                    <div class=" mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        @if ($errors->has('email'))
                            <div class="text-danger form-text"><small>{{ $errors->first('email') }}</small></div>
                        @endif
                    </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block background-black put-gold text-uppercase">Sign In</button>
                        </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection