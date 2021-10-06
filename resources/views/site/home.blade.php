@extends('base.index')

@section('content')
    @if($feature_article->isEmpty())
    @else
        <div class="">
            <a href="{{ route('article.full.show', $feature_article[0]->slug) }}">
                <h2 class="text-warning">{{ $feature_article[0]->title }}</h2>
                <p class="text-dark">
                    {{ date('d-m-Y', strtotime($feature_article[0]->created_at)) }} |
                    {{ ucfirst($feature_article[0]->author) }} |
                    @foreach($feature_article[0]->categories as $feature_cat)
                        {{ \Illuminate\Support\Str::upper($feature_cat->title) }}
                    @endforeach
                </p>
                <img src="/article_covers/{{ $feature_article[0]->image }}" class="img-fluid col-md-12">
                <p style="font-size: 20px;" class="text-dark">{!! \Illuminate\Support\Str::limit($feature_article[0]->body, 150, $end='...') !!}</p>
            </a>
        </div>
    @endif
    <h3>Latest <span class="text-secondary"><strong>Articles</strong></span></h3>
    <br><br>

    @if($articles->isEmpty())
        no articles found
    @else
        @foreach($articles as $article)
            <div class="row justify-content-start">
                <div class="col-sm-2 col-md-2 col-lg-2">
                    <a class="text-secondary" href="{{ route('article.full.show', $article->slug) }}">
                        <img class="float-start card-img-top" src="/article_covers/{{ $article->image }}"  width="150" height="110" alt="">
                    </a>
                </div>

                <div class="col-sm-8 col-md-8 col-lg-8">
                    <a class="text-warning" href="{{ route('article.full.show', $article->slug) }}">
                        <h4><strong>{{ $article->title }}</strong></h4>
                    </a>
                    {{ date('d-m-Y', strtotime($article->created_at)) }} |
                    @foreach($article->categories as $article_cat)
                        {{ \Illuminate\Support\Str::upper($article_cat->title) }}
                    @endforeach
                    <p>{!! \Illuminate\Support\Str::limit($article->body, 100, $end='...') !!} </p>
                </div>
            </div><br>
        @endforeach
    @endif
    <div class="d-flex justify-content-center">
        {!! $articles->links() !!}
    </div>

    <div class="justify-content-start">
        <h4 class="mb-3">More to Read</h4>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($more_articles as $more)
                <div class="col">
                    <div class="card h-100" style="border:none;">
                        <a href="{{ route('article.full.show', $article->slug) }}">
                            <img src="/article_covers/{{ $more->image }}" class="card-img-top" alt="..." height="200">
                            <div class="card-body">
                                @foreach($more->categories as $more_cat)
                                    <div class="text-secondary"><h5>{{ \Illuminate\Support\Str::upper($more_cat->title) }}</h5></div>
                                @endforeach
                                <h4 class="card-title">
                                    <a class="text-warning" href="{{ route('article.full.show', $article->slug) }}">{{ $article->title }}</a>
                                </h4>
                                <p class="card-text">{!! \Illuminate\Support\Str::limit($more->body, 80, $end='...') !!}</p>
                            </div>

                            <div class="card-footer" style="border:none;">
                                <small class="">{{ \Illuminate\Support\Str::upper(date('F Y', strtotime($article->created_at))) }}</small>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div><br>

    </div>

@endsection
