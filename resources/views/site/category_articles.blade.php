@extends('base.index')

@section('content')
    <section>
        <div class="container" style="margin-top: 40px;">
            <br>
            <h3>Articles on <span class="text-secondary"><strong>{{ $category_title }}</strong></span></h3>
            <br>

            @if($cat_articles->isEmpty())
                <p class="text-center text-danger">no articles found</p>
            @else
                @foreach($cat_articles as $article)
                    <div class="card mb-3 border-0 b-card-img-lazy" style=" background-color: #efeeee;">
                        <div class="row no-gutters">
                            <div class="col-md-2">
                                <a class="text-secondary" href="{{ route('site.article.full.show', $article->slug) }}">
                                    <img class="float-start card-img-top img-fluid" src="/article_covers/{{ $article->image }}" style="min-width: 150px; min-height: 130px;"  width="150" height="110" alt="">
                                </a>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body mt-0">
                                    <a class="text-secondary" href="{{ route('site.article.full.show', $article->slug) }}">
                                    <h5 class="card-title text-danger"><strong>{{ $article->title }}</strong></h5>
                                    <p class="card-text">{{ date('d-m-Y', strtotime($article->created_at)) }} |
                                        @foreach($article->categories as $article_cat)
                                            {{ \Illuminate\Support\Str::upper($article_cat->title) }}
                                        @endforeach
                                    </p>
                                    <p class="card-text">{!! \Illuminate\Support\Str::limit(strip_tags($article->body), $limit = 100, $end = '...') !!}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            @endif
            <div class="d-flex justify-content-center">
                {!! $cat_articles->links() !!}
            </div>
        </div>
    </section>
@endsection
