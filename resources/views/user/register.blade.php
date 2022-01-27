@extends('base.auth_user_index')

@section('content')
    <div class="subscribe-box">
        <div class="card card-outline card-dark">
            <div class="card-header text-center">
                <h3><a href="/" class="h3">
                        Subscribe to Industrialising Africa<br><small><strong class="put-black">Publication</strong></small>
                    </a>
                </h3>
            </div>

            @if ($message = Session::get('error'))
                <p class="alert alert-danger">{{ $message }}</p>
            @endif
            <form action="{{ route('user.register') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username">
                            @if ($errors->has('username'))
                                <div class="text-danger form-text"><small>{{ $errors->first('username') }}</small></div>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                            @if ($errors->has('email'))
                                <div class="text-danger form-text"><small>{{ $errors->first('email') }}</small></div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="First Name">
                            @if ($errors->has('first_name'))
                                <div class="text-danger form-text"><small>{{ $errors->first('first_name') }}</small></div>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
                            @if ($errors->has('last_name'))
                                <div class="text-danger form-text"><small>{{ $errors->first('last_name') }}</small></div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="number" class="form-control" name="phone_number" value="{{ old('phone_number') }}" placeholder="Phone Number e.g. 0700012300">
                            @if ($errors->has('phone_number'))
                                <div class="text-danger form-text"><small>{{ $errors->first('phone_number') }}</small></div>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <select name="country" class="form-select form-control" aria-label="Default select example" autofocus>
                                <option value="" disabled selected>Select Country</option>
                                    <option value="KE">Kenya</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('country'))
                                <div class="text-danger form-text"><small>{{ $errors->first('country') }}</small></div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            @if ($errors->has('password'))
                                <div class="text-danger form-text"><small>{{ $errors->first('password') }}</small></div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <input type="password" class="form-control" name="password_confirm" placeholder="Confirm Password">
                            @if ($errors->has('password_confirm'))
                                <div class="text-danger form-text"><small>{{ $errors->first('password_confirm') }}</small></div>
                            @endif
                        </div>
                    </div>

                    <!-- /.col -->
                    <div class="card-footer bg-white text-center">
                        <div class="mt-3 text-center col-md-12">
                            <button type="submit" class="btn btn-primary put-gold background-black btn-block text-uppercase">Register</button>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="{{ route('show.login') }}" class="text-center" style="margin-bottom: 30px;">I already have a membership</a>

            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
@endsection
