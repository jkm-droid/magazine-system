@extends('base.index')

@section('content')
    <section>
        <div class="container">
            @if($feature_article)
                <a href="{{ route('portal.full.article.show', $feature_article->slug) }}" class="col-md-12">
                    <div class="card mb-3" style="margin-top: 40px;">
                        <div class="row g-0">
                            <div class="col-md-7">
                                <img src="/article_covers/{{ $feature_article->image }}"
                                     class="img-fluid rounded-start portal-image" alt="..." width="100%" style="max-height: 350px;">
                            </div>
                            <div class="col-md-5">
                                <div class="card-body">
                                    <h4 class="card-title put-black">{{ $feature_article->title }}</h4>
                                    <p class="card-text">
                                        {{ \Illuminate\Support\Str::upper($feature_article->author) }} |

                                        @foreach($feature_article->categories as $feature_cat)
                                            {{ \Illuminate\Support\Str::upper($feature_cat->title) }} |
                                        @endforeach

                                        {{ date('d-m-Y', strtotime($feature_article->created_at)) }}
                                    </p>
                                    <p class="card-text">
                                        <small class="text-muted">{!! \Illuminate\Support\Str::limit(strip_tags($feature_article->body), $limit = 200, $end = '...') !!}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @else
            @endif

            <h3 class="mt-4 put-black">Explore <span class="put-gold"><strong>Articles</strong></span></h3>
            <br>

            @if($articles->isEmpty())
                no articles found
            @else
                @foreach($articles as $article)
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
                {!! $articles->links() !!}
            </div>
        </div>
    </section>
@endsection
