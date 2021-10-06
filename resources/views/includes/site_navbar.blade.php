<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid">
        <a class="navbar-brand text-uppercase" href="{{ route('home') }}">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <div class="nav-item mega-dropdown">
                    <button class="dropbtn text-uppercase">Articles
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="mega-dropdown-content">
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <ul class="nav nav-tabs nav-pills flex-column category-tabs" id="myTab" role="tablist">
                                    @foreach($categories as $category)
                                        <li class="nav-item category-tab" style="padding-top: 9px; width: 100%;">
                                            <a class="nav-link mega-nav-link" style="text-decoration: none;"
                                               id="home-tab" data-toggle="tab" href="#home" role="tab" data-id="{{ $category->id }}"
                                               aria-controls="home" aria-selected="true">{{ \Illuminate\Support\Str::upper($category->title) }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- /.col-md-4 -->
                            <div class="col-md-10">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div  id="articles-box" style="padding: 10px; margin: 10px;">
                                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                                @if($one_category->isEmpty())
                                                    <h5>No articles for this category</h5>
                                                @else
                                                    @if(count($one_category) >= 3)
                                                        @for($a = 0; $a < 3; $a++)
                                                            <div class="col">
                                                                <div class="card h-100 bg-black" style="border:none; background-color: black;">
                                                                    {{--                                                            <a class="m-0" href="{{ route('article.full.show', $cat_article->slug) }}">--}}
                                                                    <img src="/article_covers/{{ $one_category[$a]->image }}" style="width: 100%;" class="card-img-top" alt="..." height="150">

                                                                    <div class="card-body" style="overflow-wrap: break-word; word-wrap: break-word;" >
                                                                        <p style="display: inline-block;" class="card-link card-title">
                                                                            <a style="text-decoration: none; width: auto;  display: inline-block;" class="text-warning card-link" href="{{ route('article.full.show', $one_category[$a]->slug) }}">
                                                                                {{ $one_category[$a]->title }}
                                                                            </a>
                                                                        </p>
                                                                        <p class="card-text">{!! \Illuminate\Support\Str::limit($one_category[$a]->body, 40, $end='...') !!}</p>
                                                                    </div>

                                                                    <div class="card-footer text-center" style="border:none; margin-top: 0;">
                                                                        <small class="">{{ \Illuminate\Support\Str::upper(date('d-m-Y', strtotime($one_category[$a]->created_at))) }}</small>
                                                                    </div>
                                                                    {{--                                                            </a>--}}
                                                                </div>
                                                            </div>
                                                        @endfor
                                                    @endif
                                                @endif
                                            </div><br>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- /.col-md-8 -->
                        </div>

                    </div>
                </div>

                <div class="category-dropdown">
                    <button class="dropbtn text-uppercase">Categories
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <div class="row">
                            @foreach($all_categories as $category)
                                <div  style="padding: 10px; " class="col">
                                    <a  href="{{ route('category.all.articles.show', $category->slug) }}">{{ \Illuminate\Support\Str::upper($category->title) }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <li class="nav-item text-uppercase">
                    <a class="nav-link active text-uppercase" aria-current="page" href="#">About us</a>
                </li>

                <li class="nav-item text-uppercase">
                    <a class="nav-link active text-uppercase" aria-current="page" href="#">Contacts</a>
                </li>

            </ul>
            <form class="d-flex" method="GET" action="{{ route('articles.search') }}">
                @csrf
                <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
