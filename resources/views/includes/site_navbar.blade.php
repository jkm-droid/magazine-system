<!-- navbar section -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

        <a href="/" class="logo"><img src="{{ asset('site_images/firstcodeLogo.png') }}" alt="" class="img-fluid"></a>

        <nav id="navbar" class="navbar">
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
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->

    </div>
</header>
<!-- end navbar section -->
