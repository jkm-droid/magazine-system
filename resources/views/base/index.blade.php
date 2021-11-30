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
{{--    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>--}}
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

    <title>Industrialising Africa</title>
    <style>
        .container a{
            text-decoration: none;
        }
    </style>
</head>
<body>
@include('includes.site_navbar')

<div class=" social-icons-float text-md-right pt-3 pt-md-0 fixed-top">
    <a href="https://twitter.com/AfroIndustry" class="twitter" target="_blank"><i class="bx bxl-twitter"></i></a>
    <a href="https://www.facebook.com/industrialisingafrica" class="facebook" target="_blank"><i class="bx bxl-facebook"></i></a>
    <a href="https://www.instagram.com/industrialafrica/" class="instagram" target="_blank"><i class="bx bxl-instagram"></i></a>
    <a href="https://www.linkedin.com/in/industrialising-africa-17b536211/" class="linkedin" target="_blank"><i class="bx bxl-linkedin"></i></a>
    <a href="https://youtu.be/q5RdTnSVzPw" target="_blank"><i class="bx bxl-youtube"></i></a>
</div>
@yield('content')

@include('includes.site_footer')

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
{{--<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>--}}

<script>
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function(){
        var currentscrollPos = window.pageYOffset;
        if (prevScrollpos > currentscrollPos) {
            document.getElementById("header").style.top = "0";
        }else{
            document.getElementById("header").style.top = "-60px";
        }
        prevScrollpos = currentscrollPos;
    }
</script>
<script>
    $(document).ready(function(){
        $('.nav-tabs > li > a').hover(function() {
            //get the category id from the nav link
            var category_id = $(this).attr('data-id');
            console.log(category_id);

            $.ajax({
                url: '{{ url('/category/article') }}/' + category_id,
                type: 'GET',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'category_id': category_id,
                },
                success: function (response) {
                    console.log(response);
                    let content = '';
                    content += '<div class="row row-cols-1 row-cols-md-3 g-4">';
                    if (response.length > 0){
                        for (var a = 0; a < 3; a++) {
                            content += '<div class="col">';
                            // content += '<a href=" ' + "/article/" + response[a].slug + ' ">';
                            content += ' <div class="card h-100" style="border:none; word-break: break-word;">';

                            content += '<img src=" ' + "/article_covers/" + response[a].image + ' " class="card-img-top" alt="..." height="150" style="width: 100%;">';
                            content += '<div class="card-body">';

                            content += '<h4 class="card-title"><a class="text-warning" style="word-break: break-word;" " ' + "/article/" + response[a].slug + ' ">' + response[a].title + '</a></h4>';
                            content += '<p class="card-text">' + response[a].article_body + '</p>';

                            content += '</div>';

                            content += '<div class="card-footer text-center" style="border:none;">';
                            content += '<small class="text-center">' + response[a].formatted_date + '</small>';
                            content += '</div>';

                            content += '</div>';
                            // content += '</a>';
                            content += '</div>';
                        }
                    }else{
                        content += '<small class="text-center">' + "No articles for this category" + '</small>';
                    }
                    content += '</div>';

                    $("#articles-box").html(content);

                },

                failure: function (response) {
                    console.log("something went wrong");
                }
            });
            $(this).tab('show');
        });
    })
</script>

<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>
</body>
</html>
