@extends('base.auth_user_index')

@section('content')
    <div class="subscribe-box">
        <div class="card card-outline card-dark">
            <div class="card-header text-center">
                <h3><a href="/" class="h3">Subscribe to Industrialising Africa<br><small><strong class="put-black">Magazine</strong></small></a></h3>
            </div>

            <p class="login-box-msg">Your personal information</p>
            @if ($message = Session::get('error'))
                <p class="alert alert-danger">{{ $message }}</p>
            @endif
            <form action="{{ route('user.register') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="username" placeholder="Username">
                            @if ($errors->has('username'))
                                <div class="text-danger form-text">{{ $errors->first('username') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                            @if ($errors->has('email'))
                                <div class="text-danger form-text">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="first_name" placeholder="First Name">
                            @if ($errors->has('first_name'))
                                <div class="text-danger form-text">{{ $errors->first('first_name') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                            @if ($errors->has('last_name'))
                                <div class="text-danger form-text">{{ $errors->first('last_name') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="number" class="form-control" name="phone_number" placeholder="Phone Number e.g. 0700012300">
                            @if ($errors->has('phone_number'))
                                <div class="text-danger form-text">{{ $errors->first('phone_number') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <select name="country" class="form-select form-control" aria-label="Default select example" autofocus>
                                <option value="" disabled selected>Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('country'))
                                <div class="text-danger form-text">{{ $errors->first('country') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class=" mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        @if ($errors->has('password'))
                            <div class="text-danger form-text">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                    <p class="card-text text-center">Select your subscription plan:</p>

                    <div class="row mb-3">
                        <div class="form-check col-md-6">
                            <input class="form-check-input" type="radio" name="subscription_plan" value="6" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                <span class="badge badge-info">Quarterly Plan ($6)</span>
                            </label>
                        </div>
                        <div class="form-check col-md-6">
                            <input class="form-check-input" type="radio" name="subscription_plan" value="24" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                <span class="badge badge-success">Annual Plan ($24)</span>
                            </label>
                        </div>
                    </div>

                    <!-- /.col -->
                    <div class="card-footer bg-white">
                        <div class="col-md-6 mt-3">
                            <button type="submit" class="btn btn-primary put-gold background-black btn-block text-uppercase">Proceed</button>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="{{ route('show.login') }}" class="text-center">I already have a membership</a>

            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
@endsection
