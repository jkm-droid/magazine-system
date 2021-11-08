@extends('base.premium_index')

@section('content')
    <section>
        <div class="container" style="margin-top: 40px;">
            <br>
            <h3 class="put-black">Articles on <span class="put-gold"><strong>{{ $category_title }}</strong></span></h3>
            <br>

            @if($cat_articles->isEmpty())
                <p class="text-center text-danger">no articles found</p>
            @else
                @foreach($cat_articles as $article)
                    <div class="card border-0" style=" background-color: #faf9f9;">
                        <div class="row no-gutters">

                            <div class="col-md-2">
                                <a class="text-secondary" href="{{ route('portal.full.article.show', $article->slug) }}">

                                    <img class="float-start card-img-top img-fluid " src="/article_covers/{{ $article->image }}" style="min-width: 150px; min-height: 130px;"   alt="">
                                </a>
                            </div>
                            <div class="col-md-10">
                                <div class="card-body mt-0">
                                    <a class="text-secondary" href="{{ route('portal.full.article.show', $article->slug) }}">
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
                {!! $cat_articles->links() !!}
            </div>
        </div>
    </section>
@endsection
