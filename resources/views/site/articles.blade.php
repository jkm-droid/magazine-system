@extends('base.index')

@section('content')
    <section>
        <div class="container" style="margin-top: 40px;">

            @if($feature_article->isEmpty())
            @else
                <a href="{{ route('site.article.full.show', $feature_article[0]->slug) }}" class="img-fluid col-md-12">

                    <div class="card card-shadow img-hover-zoom--slowmo">

                        <img src="/article_covers/{{ $feature_article[0]->image }}" class="img-fluid col-md-12 article-image" width="100%" style="max-height: 450px; opacity: 0.6;" alt="">

                        <div class="card-img-overlay article-cover-content">
                            <h4 class="card-title put-black">{{ $feature_article[0]->title }}</h4>
                            <p class="card-text put-black mt-auto">
                                {{ \Illuminate\Support\Str::upper($feature_article[0]->author) }} |

                                @foreach($feature_article[0]->categories as $feature_cat)
                                    {{ \Illuminate\Support\Str::upper($feature_cat->title) }} |
                                @endforeach

                                {{ date('d-m-Y', strtotime($feature_article[0]->created_at)) }}
                            </p>
                            <h5 class="card-title text-dark explore-more">Explore More<i class="bx bxs-right-arrow"></i></h5>
                        </div>

                    </div>

                </a>

            @endif
            <br><br>
            <h3 class="mt-4 put-black">Latest <span class="put-gold"><strong>Articles</strong></span></h3>
            <br>

            @if($articles->isEmpty())
                no articles found
            @else
                @foreach($articles as $article)
                    <div class="card border-0" style=" background-color: #faf9f9;">
                        <div class="row no-gutters">

                            <div class="col-md-2">
                                <a class="text-secondary" href="{{ route('site.article.full.show', $article->slug) }}">

                                    <img class="float-start card-img-top img-fluid " src="/article_covers/{{ $article->image }}" style="min-width: 150px; min-height: 130px;"   alt="">
                                </a>
                            </div>

                            <div class="col-md-10">
                                <div class="card-body mt-0">
                                    <a class="text-secondary" href="{{ route('site.article.full.show', $article->slug) }}">
                                        <p class="card-title put-black">{{ $article->title }}</p>

                                        <p class="card-text">{{ date('d-m-Y', strtotime($article->created_at)) }} |
                                            @foreach($article->categories as $article_cat)
                                                {{ \Illuminate\Support\Str::upper($article_cat->title) }}
                                            @endforeach
                                            <br>
                                            {!! \Illuminate\Support\Str::limit(strip_tags($article->body), $limit = 100, $end = '...') !!}
                                        </p>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div><br>
                @endforeach

            @endif
            <div class="d-flex justify-content-center">
                {!! $articles->links() !!}
            </div>

            @if($more_articles->isEmpty())
            @else
                <h4 class="mb-4 mt-4 put-black"><strong>More</strong> to <strong class="put-gold">Read</strong></h4>
                <div class="justify-content-start">

                    <div class="row row-cols-1 row-cols-md-4 g-3">
                        @foreach($more_articles as $more)
                            <div class="col">
                                <div class="card h-100" style="border:none; box-shadow: 0 0 10px goldenrod;">
                                    <a href="{{ route('site.article.full.show', $more->slug) }}">

                                        <div class="img-hover-zoom--slowmo">
                                            <img src="/article_covers/{{ $more->image }}" class="card-img-top" alt="..." height="200">
                                        </div>

                                        <div class="card-body bg-dark text-white">
                                            @foreach($more->categories as $more_cat)
                                                <div class="text-warning"><h6>{{ \Illuminate\Support\Str::upper($more_cat->title) }}</h6></div>
                                            @endforeach
                                            <h5 class="card-title">
                                                <a class="put-gold" href="{{ route('site.article.full.show', $more->slug) }}">{{ $more->title }}</a>
                                            </h5>
                                            <p class="card-text">{!! \Illuminate\Support\Str::limit(strip_tags($more->body), $limit = 50, $end = '...') !!}</p>
                                        </div>

                                        <div class="card-footer" style="border:none;">
                                            <small class="put-black">{{ \Illuminate\Support\Str::upper(date('F Y', strtotime($more->created_at))) }}</small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div><br>

                </div>
            @endif
        </div>
    </section>
@endsection
