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
{{--                by {{ \Illuminate\Support\Str::upper($article->author) }}--}}
                Published: {{ date('d-m-Y', strtotime($article->created_at)) }}
            </p>
            <img src="/article_covers/{{ $article->image }}" class="img-fluid col-md-12" alt="" style="max-height: 350px;">
            @if($article->type == "premium")
                <p class="mt-3 mb-3 m-2">
{{--                    {!! \Illuminate\Support\Str::limit(strip_tags($article->body), $limit = 713, $end = '...') !!}--}}
                    {!! $article->body !!}
                </p>
                <div class="text-center">
                    @if($article->language == "english")
                        <p class="put-red">For the complete article, please subscribe for a copy of the latest edition of Industrialising Africa magazine</p>
                        <button class="btn put-gold" style="background-color: black; box-shadow: 0 0 30px goldenrod;">
                            <a class="nav-link ml-4 put-gold text-uppercase" href="{{ route('show.register') }}">SUBSCRIBE</a>
                        </button>
                        <br>
                        <button class="btn put-gold" style="background-color: black; box-shadow: 0 0 30px goldenrod; margin-top: 10px;">
                            <a class="nav-link ml-4 put-gold text-uppercase" href="https://order.firstcodecorporation.com/user/">get hardcopy</a>
                        </button>
                    @else
                        <p class="put-red">Pour lire l’intégralité de l’article, veuillez vous abonner à la dernière édition du magazine Industrialising Africa.</p>
                        <button class="btn put-gold" style="background-color: black; box-shadow: 0 0 30px goldenrod;">
                            <a class="nav-link ml-4 put-gold text-uppercase" href="{{ route('show.register') }}">S'ABONNER</a>
                        </button>
                        <br>
                        <button class="btn put-gold" style="background-color: black; box-shadow: 0 0 30px goldenrod; margin-top: 10px;">
                            <a class="nav-link ml-4 put-gold text-uppercase" href="https://order.firstcodecorporation.com/user/">get hardcopy</a>
                        </button>
                    @endif
                </div>
            @else
                <p class="mt-3 mb-3 m-2">
                    {!! $article->body !!}
                </p>
            @endif
        </div>
    </section>
@endsection
