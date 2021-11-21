@extends('base.index')

@section('content')
    <section>
        <div class="container" style="margin-top: 40px;">
            @foreach($article->categories as $article_cat)
                <h6 class="text-gray-dark">{{ \Illuminate\Support\Str::upper($article_cat->title) }}</h6>
            @endforeach
            <h3 class="put-black">{{ $article->title }}</h3>
            <p>
                by {{ \Illuminate\Support\Str::upper($article->author) }}
                Published: {{ date('d-m-Y', strtotime($article->created_at)) }}
            </p>
            <img src="/article_covers/{{ $article->image }}" class="img-fluid col-md-12" alt="" style="max-height: 350px;">

            @if($article->type == "premium")
                @if(\Illuminate\Support\Facades\Auth::user()->payment_status == 1)
                    <p class="mt-3 mb-3 m-2">{!! $article->body !!}</p>
                @else
                    <p class="mt-3 mb-3 m-2">
                        {!! \Illuminate\Support\Str::limit(strip_tags($article->body), $limit = 713, $end = '...') !!}
                    </p>
                    <div class="text-center">
                        <p class="put-red">For the complete article, please subscribe for a copy of the latest edition of Industrialising Africa magazine</p>
                        <button class="btn put-gold" style="background-color: black; box-shadow: 0 0 30px goldenrod;">
                            <a class="nav-link ml-4 put-gold text-uppercase" href="{{ route('show.register') }}">SUBSCRIBE</a>
                        </button>
                        <br>
                        <button class="btn put-gold" style="background-color: black; box-shadow: 0 0 30px goldenrod; margin-top: 10px;">
                            <a class="nav-link ml-4 put-gold text-uppercase" href="https://order.firstcodecorporation.com/user/">get hardcopy</a>
                        </button>
                    </div>
                @endif
            @else
                <p class="mt-3 mb-3 m-2">
                    {!! $article->body !!}
                </p>
            @endif

            @if($author_articles->isEmpty())
            @else
                <div class="justify-content-start mt-2 mb-3">
                    <h4 class="mb-2"><strong class="put-black">More Articles</strong> from the <strong class="text-bold put-gold">Author</strong></h4>

                    <div class="row row-cols-1 row-cols-md-4 g-4 mt-3">
                        @foreach($author_articles as $author_article)
                            <div class="col">
                                <div class="card h-100" style="border:none;">
                                    <a href="{{ route('portal.full.article.show', $author_article->slug) }}">
                                        <div class="img-hover-zoom--slowmo">
                                            <img src="/article_covers/{{ $author_article->image }}" class="card-img-top" alt="..." height="150">
                                        </div>
                                        <div class="card-body bg-dark">
                                            @foreach($author_article->categories as $more_cat)
                                                <div class="text-white row">
                                                    <h6>
                                                        {{ \Illuminate\Support\Str::upper($more_cat->title) }}|
                                                        <small style="font-size: 14px;">{{ \Illuminate\Support\Str::upper(date('d-m-Y', strtotime($author_article->created_at))) }}</small>
                                                    </h6>

                                                </div>

                                            @endforeach
                                            <h5 class="card-title">
                                                <a class="text-warning" href="{{ route('portal.full.article.show', $author_article->slug) }}">{{ $author_article->title }}</a>
                                            </h5>
                                            {{--                                                                                <p class="card-text">{!! \Illuminate\Support\Str::limit($author_article->body, 80, $end='...') !!}</p>--}}
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
