@extends('base.index')

@section('content')
    <section>
        <div class="container" style="margin-top: 40px;">
            @if($article->categories )
                @foreach($article->categories as $article_cat)
                    <h6 class="text-gray-dark">{{ \Illuminate\Support\Str::upper($article_cat->title) }}</h6>
                @endforeach
            @endif
            <h3 class="put-black">{{ $article->title }}</h3>
            <p>
                by {{ \Illuminate\Support\Str::upper($article->author) }}
                Published: {{ date('d-m-Y', strtotime($article->created_at)) }}
            </p>
            <img src="/article_covers/{{ $article->image }}" class="img-fluid col-md-12" alt="" style="max-height: 350px;">
            @if($article->type == "premium")
                <p class="mt-3 mb-3 m-2">
                    {!! \Illuminate\Support\Str::limit(strip_tags($article->body), $limit = 713, $end = '...') !!}
                </p>
                <div class="text-center">
                    <p class="put-red">For the complete article, please subscribe for a copy of the latest edition of Industrialising Africa magazine</p>
                    <a class="btn btn-dark btn-lg put-gold background-black" href="{{ route('show.register') }}">SUBSCRIBE</a>
                </div>
            @else
                <p class="mt-3 mb-3 m-2">
                    {!! $article->body !!}
                </p>
            @endif
        </div>
    </section>
@endsection
