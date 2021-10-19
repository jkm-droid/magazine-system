@extends('base.index')

@section('content')
    <section>
        <div class="container col-md-7" style="margin-top: 40px;">
            @foreach($article[0]->categories as $article_cat)
                <h6 class="text-gray-dark">{{ \Illuminate\Support\Str::upper($article_cat->title) }}</h6>
            @endforeach
            <h3>{{ $article[0]->title }}</h3>
            <p>
                by {{ \Illuminate\Support\Str::upper($article[0]->author) }}
                Published: {{ date('d-m-Y', strtotime($article[0]->created_at)) }}
            </p>
            <img src="/article_covers/{{ $article[0]->image }}" class="img-fluid col-md-12" alt="" style="max-height: 450px;">
            <p class="mt-3 mb-3 m-2">{!! $article[0]->body !!}</p>

            @if($author_articles->isEmpty())
            @else
                <div class="justify-content-start mt-2 mb-3">
                    <h4 class="mb-2"><strong class="text-danger">More Articles</strong> from the <strong class="text-bold text-secondary">Author</strong></h4>

                    <div class="row row-cols-1 row-cols-md-4 g-4 mt-3">
                        @foreach($author_articles as $author_article)
                            <div class="col">
                                <div class="card h-100" style="border:none;">
                                    <a href="{{ route('site.article.full.show', $author_article->slug) }}">
                                        <img src="/article_covers/{{ $author_article->image }}" class="card-img-top" alt="..." height="150">
                                        <div class="card-body">
                                            @foreach($author_article->categories as $more_cat)
                                                <div class="text-secondary row">
                                                    <h6>
                                                        {{ \Illuminate\Support\Str::upper($more_cat->title) }}|
                                                        <small style="font-size: 14px;" class="text-dark">{{ \Illuminate\Support\Str::upper(date('d-m-Y', strtotime($author_article->created_at))) }}</small>
                                                    </h6>

                                                </div>

                                            @endforeach
                                            <h5 class="card-title">
                                                <a class="text-warning" href="{{ route('site.article.full.show', $author_article->slug) }}">{{ $author_article->title }}</a>
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
