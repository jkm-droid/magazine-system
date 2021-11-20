<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-dashboard/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('admin-dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-dashboard/dist/css/adminlte.min.css') }}">
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <script src="https://online.tingg.africa/v2/tingg-checkout.js"></script>
    <!--- toast section---->
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{ asset('/toast/css/eggy.css') }}" />
    <!-- Progressbar Styles -->
    <link rel="stylesheet" href="{{ asset('/toast/css/progressbar.css') }}" />
    <!-- Themes -->
    <link rel="stylesheet" href="{{ asset('/toast/css/theme.css') }}" />
    <title>Industrialising Africa</title>
</head>
<body  style="background-color: #ece9e9;">
@include('includes/auth_navbar')

<div class="hold-transition register-page login-page"  style="background-color: #ece9e9;">
    @yield('content')
</div>

{{--@include('includes/site_footer')--}}
<!-- Optional JavaScript; choose one of the two! -->
<script src="https://online.tingg.africa/v2/tingg-checkout.js"></script>
{{--<script src="{{ asset('/js/ting.js') }}"></script>--}}

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script type="text/javascript">
    @if(Session::has('success'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.success("{{ session('success') }}");
    @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.error("{{ session('error') }}");
    @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.info("{{ session('info') }}");
    @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.warning("{{ session('warning') }}");
    @endif
</script>
</body>
</html>
