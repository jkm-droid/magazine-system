@extends('base.index')

@section('content')
    @foreach($article[0]->categories as $article_cat)
    <h4 class="text-secondary">{{ \Illuminate\Support\Str::upper($article_cat->title) }}</h4>
    @endforeach
    <h2>{{ $article[0]->title }}</h2>
    <p>
        by {{ \Illuminate\Support\Str::upper($article[0]->author) }}
        Published: {{ date('d-m-Y', strtotime($article[0]->created_at)) }}
    </p>
    <img src="/article_covers/{{ $article[0]->image }}" class="img-fluid col-md-12" alt="">
    <p class="mt-3">{!! $article[0]->body !!}</p>
@endsection
