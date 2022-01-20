@extends('base.auth_user_index')

@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-warning border-success">
            <div class="card-header text-center">
                <h3 class="put-black"><a href="/" class="h3">Industrialising Africa<br><small><strong>Publication</strong></small></a></h3>
            </div>
            <div class="card-body text-center">
                @if ($message = Session::get('success'))
                    <p class="alert alert-success">{{ $message }}</p>
                @endif

                <p class="login-box-msg text-center alert-success" style="padding: 10px;">
                    You have successfully subscribed to Industrialising Africa Publication
                </p>
                <br>
                <a href="{{ route('show.login') }}" class="text-center btn put-gold background-black">Continue to Login Page</a>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
