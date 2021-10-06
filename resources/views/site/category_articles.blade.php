@extends('base.index')

@section('content')
    <br>
    <h3>Articles on <span class="text-secondary"><strong>{{ $category_title }}</strong></span></h3>
    <br>

    @if($cat_articles->isEmpty())
        <p class="text-center text-danger">no articles found</p>
    @else
        @foreach($cat_articles as $cat_article)
            <div class="row justify-content-start">
                <div class="col-sm-2 col-md-2 col-lg-2">
                    <a class="text-secondary" href="{{ route('article.full.show', $cat_article->slug) }}">
                        <img class="float-start card-img-top" src="/article_covers/{{ $cat_article->image }}"  width="150" height="130" alt="">
                    </a>
                </div>

                <div class="col-sm-8 col-md-8 col-lg-8">
                    <a class="text-warning" href="{{ route('article.full.show', $cat_article->slug) }}">
                        <h4><strong>{{ $cat_article->title }}</strong></h4>
                    </a>
                    <p class="mb-3 text-dark">
                        {{ date('d-m-Y', strtotime($cat_article->created_at)) }} |
                        {{ \Illuminate\Support\Str::upper($cat_article->author) }}<br>
                        {!! \Illuminate\Support\Str::limit($cat_article->body, 100, $end='...') !!}
                    </p>
                </div>
            </div><br>
        @endforeach
    @endif
    <div class="d-flex justify-content-center">
        {!! $cat_articles->links() !!}
    </div>

@endsection
