<!-- navbar section -->
<header id="header" class="fixed-top">
    <div id="header" class="navbar navbar-expand-md">
        <div class="container" >
            @if(\Illuminate\Support\Facades\Auth::check())
                <a href="{{ route('portal') }}" class="logo"><img src="{{ asset('site_images/ialogo.png') }}" alt="" class="img-fluid"></a>

                <nav id="navbar" class="navbar navbar-light">
                    <ul class="text-uppercase text-dark">
                        <li><a class="nav-link" href="{{ route('portal.magazine.show')  }}">Publication</a></li>
                        <li><a class="nav-link" href="{{ route('portal')  }}">Articles</a></li>
                        <li class="nav-item dropdown text-uppercase">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Sections
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach($all_categories as $category)
                                    <li class="">
                                        <a class="dropdown-item" href="{{ route('portal.category.article.show', $category->slug) }}">
                                            {{ \Illuminate\Support\Str::upper($category->title) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a class="nav-link" href="https://firstcodecorporation.com/" target="_blank">FirstCode</a></li>
                        
                        <form class="d-flex col-md-3 ml-3" style="height: 30px; margin-left: 5px;" method="GET" action="{{ route('portal.search') }}">
                            @csrf
                            <input style="border: 1px solid goldenrod;" name="search" class="form-control me-2" type="search" placeholder="enter keyword" aria-label="Search">
                            <button class="btn btn-sm btn-outline-warning" type="submit">Search</button>
                        </form>

                        <li class="nav-item dropdown text-uppercase">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="/profile_pictures/{{ \Illuminate\Support\Facades\Auth::user()->profile }}" width="30" height="30" class="rounded-circle" alt="">
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li class="">
                                    <a class="dropdown-item">
                                        {{ \Illuminate\Support\Facades\Auth::user()->email }}
                                    </a>
                                </li>
                                <li class="">
                                    <a class="dropdown-item" href="{{ route('user.logout') }}">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>

                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav>
                <!-- .navbar -->
            @else
                <a href="/" class="logo"><img src="{{ asset('site_images/ialogo.png') }}" alt="" class="img-fluid"></a>

                <nav id="navbar" class="navbar navbar-light">
                    <ul class="text-uppercase text-dark">
                        <li><a class="nav-link scrollto" href="https://firstcodecorporation.com/" target="_blank">FirstCode</a></li>
                        <li><a class="nav-link scrollto" href="{{ route('site.archives.show')  }}">Publication</a></li>

{{--                        <li class="nav-item dropdown text-uppercase">--}}
{{--                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                Articles--}}
{{--                            </a>--}}
{{--                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
{{--                                @foreach($leading_articles as $leading)--}}
{{--                                    <li class="">--}}
{{--                                        <a class="dropdown-item" href="{{ route('site.article.full.show', $leading->slug) }}">--}}
{{--                                            {{ \Illuminate\Support\Str::upper($leading->title) }}--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </li>--}}

                        <li class="nav-item dropdown text-uppercase">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Articles
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach($all_categories as $category)
                                    <li class="">
                                        <a class="dropdown-item" href="{{ route('site.category.all.articles.show', $category->slug) }}">
                                            {{ \Illuminate\Support\Str::upper($category->title) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <li><a class="nav-link scrollto" href="{{ route('show.register') }}">Subscribe</a></li>

                        @if( Route::currentRouteName() == 'site.home')
                            <li><a class="nav-link scrollto" href="{{ route('site.faqs.show') }}">FAQS</a></li>
                            <li><a class="nav-link scrollto" href="{{ route('site.about.show') }}">About</a></li>
                        @endif

                        <li><a class="nav-link scrollto ml-4" href="#footer">Contacts</a></li>
                        <li><a class="nav-link ml-4" href="{{ route('show.login') }}">Login</a></li>

                        @if( Route::currentRouteName() == 'site.home' | Route::currentRouteName() == 'site.faqs.show' | Route::currentRouteName() == 'site.about.show')

                        @else
                            <form class="d-flex col-md-3 ml-3" style="height: 30px; margin-left: 5px;" method="GET" action="{{ route('site.articles.search') }}">
                                @csrf
                                <input style="border: 1px solid goldenrod;" name="search" class="form-control me-2" type="search" placeholder="enter keyword" aria-label="Search">
                                <button class="btn btn-sm btn-outline-warning" type="submit">Search</button>
                            </form>

                        @endif
                    </ul>

                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav>
                <!-- .navbar -->
            @endif
        </div>
    </div>

</header>
<!-- end navbar section -->
