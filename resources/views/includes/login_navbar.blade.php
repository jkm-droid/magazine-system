<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a href="/" class="logo">
            <img src="{{ asset('site_images/firstcodeLogo.png') }}" alt="" class="img-fluid" style="max-width: 200px; max-height: 50px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex flex-row-reverse collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav" >
                <li class="nav-item">
                    <a class="nav-link active text-danger" style="font-size: larger;" aria-current="page" href="{{ route('admin.show.login') }}">Login</a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link text-danger" style="font-size: larger;" href="{{ route('admin.show.register') }}">Register</a>--}}
{{--                </li>--}}
            </ul>
        </div>
    </div>
</nav>
