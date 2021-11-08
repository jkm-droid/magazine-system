<!-- navbar section -->
<header id="header" class="fixed-top">
    <div id="header" class="fixed-top navbar navbar-expand-md">
        <div class="container" >
            <a href="{{ route('portal') }}" class="logo"><img src="{{ asset('site_images/ialogo.png') }}" alt="" class="img-fluid"></a>

            <nav id="navbar" class="navbar navbar-light">
                <ul class="text-uppercase text-dark">
                    <li><a class="nav-link" href="https://firstcodecorporation.com/" target="_blank">FirstCode</a></li>
                    <li><a class="nav-link" href="{{ route('portal.magazine.show')  }}">Magazine</a></li>
                    <li><a class="nav-link" href="{{ route('portal')  }}">Articles</a></li>
                    <li class="nav-item dropdown text-uppercase">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
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
        </div>
    </div>

</header>

<!-- end navbar section -->
