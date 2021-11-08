@extends('base.auth_user_index')

@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-warning">
            <div class="card-header text-center">
                <h3 class="put-black"><a href="/" class="h3">Industrialising Africa<br><small><strong>Magazine</strong></small></a></h3>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <p class="alert alert-success">{{ $message }}</p>
                @endif
                @if ($message = Session::get('error'))
                    <p class="alert alert-danger">{{ $message }}</p>
                @endif
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ route('user.login') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Email or Username">
                        @if ($errors->has('username'))
                            <div class="text-danger form-text">{{ $errors->first('username') }}</div>
                        @endif
                    </div>
                    <div class=" mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        @if ($errors->has('password'))
                            <div class="text-danger form-text">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember_me" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block background-black put-gold text-uppercase">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                    <a href="{{ route('show.register') }}" class="text-center">I don't have a membership</a>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
