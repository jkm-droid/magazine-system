<nav class="navbar navbar-expand-lg background-black" style="border-bottom: 2px solid goldenrod">
    <div class="container-fluid">
        <a href="/" class="logo">
            <img src="{{ asset('site_images/ialogo.png') }}" alt="" class="img-fluid" style="max-width: 200px; max-height: 50px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex flex-row-reverse collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav put-gold text-uppercase" >
                <li><a class="nav-link" href="{{ route('site.faqs.show') }}">FAQS</a></li>
                <li><a class="nav-link" href="{{ route('site.about.show') }}">About</a></li>

                @if( Route::currentRouteName() == 'show.login')
                    <li class="nav-item">
                        <a class="nav-link active put-gold text-uppercase" aria-current="page" href="{{ route('show.register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link put-gold text-uppercase" href="{{ route('show.login') }}">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
