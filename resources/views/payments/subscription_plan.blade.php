@extends('base.auth_user_index')

@section('content')

    <div class="card card-outline card-warning">
        <div class="card-header text-center">
            <h3 class="put-black"><a href="/" class="h3">Industrialising Africa<br><small><strong>Magazine</strong></small></a></h3>
            <h4 class="text-center">Select your subscription plan</h4>
        </div>

        <form action="{{ route('save.subscription.plan', $user->email) }}" method="post">
            @csrf
            <div class="card-body">
                <div class="row mb-3">
                    <div class="form-check col-md-6">
                        <input class="form-check-input" type="radio" name="subscription_plan" value="6" {{ (old('subscription_plan') == '6') ? 'checked' : ''}} id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            <span class="badge badge-info">Quarterly Plan ($6)</span>
                        </label>
                    </div>
                    <div class="form-check col-md-6">
                        <input class="form-check-input" type="radio" name="subscription_plan" value="24" {{ (old('subscription_plan') == '24') ? 'checked' : ''}} id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            <span class="badge badge-success">Annual Plan ($24)</span>
                        </label>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>

            <div class="card-footer bg-white text-center mb-3">
                <button type="submit" class="btn btn-primary put-gold background-black btn-block text-uppercase">subscribe NOW</button>
            </div>
            <!-- /.card -->
        </form>

@endsection
