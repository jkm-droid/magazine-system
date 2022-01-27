@extends('base.auth_user_index')

@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-warning">
            <div class="card-header text-center">
                <h3 class="put-black"><a href="/" class="h3">Industrialising Africa<br><small><strong>Publication</strong></small></a></h3>
                <p>Click the button below to download magazine.</p>
                <button class="btn btn-lg put-gold" style="background-color: black; box-shadow: 0 0 30px goldenrod;">
                    <a class="nav-link ml-4 put-gold text-uppercase" href="{{ route('magazine.download') }}">Download Now</a>
                </button>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection