<!-- navbar section -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

        <a href="/" class="logo"><img src="{{ asset('site_images/firstcodeLogo.png') }}" alt="" class="img-fluid"></a>

        <nav id="navbar" class="navbar navbar-light">
            <ul class="text-uppercase text-dark">
                <li><a class="nav-link scrollto active" href="/">Home</a></li>
                <li><a class="nav-link scrollto" href="{{ route('site.articles.show')  }}">Articles</a></li>
                <li class="nav-item dropdown text-uppercase">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach($all_categories as $category)
                            <li>
                                <a class="dropdown-item" href="{{ route('site.category.all.articles.show', $category->slug) }}">
                                    {{ \Illuminate\Support\Str::upper($category->title) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="{{ route('site.faqs.show') }}">FAQS</a></li>
                <li><a class="nav-link scrollto" href="{{ route('site.about.show') }}">About Us</a></li>

                <li><a class="nav-link scrollto" href="#footer">Contacts</a></li>
                @if( Route::currentRouteName() == 'site.home')

                @else
                    <form class="d-flex col-md-3 ml-3" style="height: 30px;" method="GET" action="{{ route('site.articles.search') }}">
                        @csrf
                        <input style="border: 1px solid red;" name="search" class="form-control me-2" type="search" placeholder="enter keyword" aria-label="Search">
                        <button class="btn btn-sm btn-outline-danger" type="submit">Search</button>
                    </form>

                @endif
            </ul>

            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->

    </div>
</header>
<!-- end navbar section -->
