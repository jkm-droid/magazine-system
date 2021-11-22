@extends('base.admin_index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">"{{ $article->title }}" Preview</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Articles</a></li>
                        <li class="breadcrumb-item active"><b>View Article</b></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section>
        <div class="col-md-10 m-2 mt-0">
            <a class="btn put-gold background-black btn-sm" href="{{ route('my_articles.index', \Illuminate\Support\Facades\Auth::user()->id) }}">
                Back
            </a>
            <div class="card" style="padding: 15px;">
                @foreach($article->categories as $article_cat)
                    <h4 class="text-secondary">{{ \Illuminate\Support\Str::upper($article_cat->title) }}</h4>
                @endforeach
                <h1 class="m-0">{{ $article->title }}</h1>
                <p>
                    by {{ \Illuminate\Support\Str::upper($article->author) }}
                    Published: {{ date('d-m-Y', strtotime($article->created_at)) }}
                </p>
                <img src="/article_covers/{{ $article->image }}" class="img-fluid col-md-12" style="max-height: 300px;" alt="">
                <p class="mt-3">{!! $article->body !!}</p>

                @if(\Illuminate\Support\Facades\Auth::user()->isSuperAdmin == 1 && $article->status == 0)

                    <div class="text-center">
                        <a class="btn put-gold background-black text-uppercase" href="{{ route('article.publish', $article->id) }}">Publish article</a>
                    </div>

                @endif
            </div>
        </div>
    </section>
@endsection
