@extends('base.index')

@section('content')
    <!----french lead stories Section----->
    <section id="hero" class="d-flex align-items-center"  >
        <div class="container position-relative">
            <div class="row justify-content-center">
{{--                <div class="icon-boxes">--}}
                    <h3 class="text-center"><strong class="put-gold">Lead</strong> Stories</h3>

                    @if($leading_articles)
                        <div class="row row-cols-1 row-cols-md-4 g-4 mt-3">
                            @foreach($leading_articles as $leading)
                                <div class="col">
                                    <div class="card h-100 icon-box" style="border:none;">
                                        <a href="{{ route('site.article.full.show', $leading->slug) }}">
                                            <div class="">
                                                <img src="/article_covers/{{ $leading->image }}" class="card-img-top" alt="..." height="150">
                                            </div>
                                            <div class="card-body background-black">
                                                <h5 class="card-title">
                                                    <a class="text-warning" href="{{ route('site.article.full.show', $leading->slug) }}">{{ $leading->title }}</a>
                                                </h5>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
{{--                </div>--}}

            </div>
        </div>
    </section>
    <!--- end french lead stories section---->

    <!----editorial article section---->
    @include('includes.editorial')
    <!----end editorial article section---->
@endsection
