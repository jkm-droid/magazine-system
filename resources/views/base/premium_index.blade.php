<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Bootstrap CSS -->
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">--}}

<!--base assets, icons--->
    <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!--base jQuery--->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Vendor CSS Files -->
    <link href="{{ asset( 'assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{ asset( 'assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset( 'assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset( 'assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    {{--    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    <!--base css--->
    <link href="{{ asset('css/site_style.css') }}" rel="stylesheet">

    <!--pdf viewer css--->
    <link href="{{ asset('css/pdf_viewer_style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!--- toast section---->
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{ asset('/toast/css/eggy.css') }}" />
    <!-- Progressbar Styles -->
    <link rel="stylesheet" href="{{ asset('/toast/css/progressbar.css') }}" />
    <!-- Themes -->
    <link rel="stylesheet" href="{{ asset('/toast/css/theme.css') }}" />

    <!-- admin custom css style -->
    <link rel="stylesheet" href="{{ asset('/css/admin_style.css') }}" />

    <title>Industrialising Africa</title>
    <style>
        .container a{
            text-decoration: none;
        }
    </style>

</head>
<body>
@include('includes.premium_navbar')

<div class=" social-icons-float text-md-right pt-3 pt-md-0 fixed-top">
    <a href="https://twitter.com/AfroIndustry" class="twitter" target="_blank"><i class="bx bxl-twitter"></i></a>
    <a href="https://www.facebook.com/industrialisingafrica" class="facebook" target="_blank"><i class="bx bxl-facebook"></i></a>
    <a href="https://www.instagram.com/industrialafrica/" class="instagram" target="_blank"><i class="bx bxl-instagram"></i></a>
    <a href="https://www.linkedin.com/in/industrialising-africa-17b536211/" class="linkedin" target="_blank"><i class="bx bxl-linkedin"></i></a>
    <a href="https://www.youtube.com/c/IndustrialisingAfrica" target="_blank"><i class="bx bxl-youtube"></i></a>
</div>
@yield('content')

@include('includes.premium_footer')
{{--<div id="preloader"></div>--}}
<a href="#" class="back-to-top d-flex align-items-center bg-dark justify-content-center text-white"><strong>TOP</strong></a>
<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
{{--<script src="{{ asset('assets/vendor/purecounter/purecounter.js') }}"></script>--}}
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->

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
