@extends('base.admin_index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $article->title }}</h1>
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
    <div class="m-2">
        <a href="{{ route('articles.index') }}"><button class="btn btn-success btn-sm">Back</button></a>
    <h4 class="text-secondary">{{ \Illuminate\Support\Str::upper($article->category) }}</h4>
    <p>
        by {{ \Illuminate\Support\Str::upper($article->author) }}
        Published: {{ date('d-m-Y', strtotime($article->created_at)) }}
        Status:
        @if($article->status == 0)
            <span class="badge badge-danger">Draft</span>
        @else
            <span class="badge badge-success">Published</span>
        @endif
    </p>
    <img src="/article_covers/{{ $article->image }}" class="img-fluid" alt="">
    <p class="mt-3">{!! $article->body !!}</p>
    </div>
@endsection
