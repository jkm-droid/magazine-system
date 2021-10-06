<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Industrialising Africa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <div class="nav-item mega-dropdown">
                    <button class="dropbtn">Dropdown
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="mega-dropdown-content">
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <ul class="nav nav-tabs nav-pills flex-column category-tabs" id="myTab" role="tablist">
                                    @foreach($categories as $category)
                                        <li class="nav-item" style="padding-top: 9px;">
                                            <a class="nav-link mega-nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" data-id="{{ $category->id }}"
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
                                                @for($a = 0; $a < 3; $a++)
                                                    <div class="col">
                                                        <div class="card h-100 bg-black" style="border:none; background-color: black;">
                                                            {{--                                                            <a class="m-0" href="{{ route('article.full.show', $cat_article->slug) }}">--}}
                                                            <img src="/article_covers/{{ $category->articles[$a]->image }}" style="width: 100%;" class="card-img-top" alt="..." height="150">
                                                            <div class="card-body" style="overflow-wrap: break-word; word-wrap: break-word;" >

                                                                <a style="text-decoration: none; overflow-wrap: break-word;" class="text-warning" href="{{ route('article.full.show', $category->articles[$a]->slug) }}">
                                                                    <p style="overflow-wrap: break-word; width: 10px;" class="card-text"> {{ $category->articles[$a]->title }}</p>
                                                                </a>

                                                                <p class="card-text">{!! \Illuminate\Support\Str::limit($category->articles[$a]->body, 40, $end='...') !!}</p>
                                                            </div>

                                                            <div class="card-footer text-center" style="border:none;">
                                                                <small class="">{{ \Illuminate\Support\Str::upper(date('d-m-Y', strtotime($category->articles[$a]->created_at))) }}</small>
                                                            </div>
                                                            {{--                                                            </a>--}}
                                                        </div>
                                                    </div>
                                                @endfor
                                            </div><br>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- /.col-md-8 -->
                        </div>

                    </div>
                </div>

            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
