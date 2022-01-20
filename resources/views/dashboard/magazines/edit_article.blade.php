@extends('base.admin_index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">"{{ $magazine_article->title }}"</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Magazines</a></li>
                        <li class="breadcrumb-item"><b>View Magazine</b></li>
                        <li class="breadcrumb-item active"><b>Edit Article</b></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section>
        <div class="col-12">
            <div class="card card-outline card-dark">
                <div class="card-header">

                    <a class="btn btn-sm put-gold background-black" href="{{ route('magazine.show', $magazine_article->magazine->id) }}">
                        <h3 class="card-title">Back</h3>
                    </a>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <!----magazine article edit form section--->
                    <form method="post" action="{{ route('magazine.article.update', $magazine_article->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body m-1">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Article Title</label>
                                    <input type="text" name="title" value="{{ $magazine_article->title }}" class="form-control" placeholder="enter magazine title" id="title">
                                    @if ($errors->has('title'))
                                        <div class="text-danger form-text">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="image" class="form-label">Article Cover Image</label>
                                    <input type="file" name="image" class="form-control" placeholder="enter magazine image" id="image">
                                </div>
                            </div>

                            <div>
                                <label for="description" class="form-label">Article Description</label>
                                <textarea class="form-control summernote" name="description" rows="4" placeholder="Write a short description about the article...">
                                    {{ $magazine_article->description }}
                                </textarea>
                                @if ($errors->has('description'))
                                    <div class="text-danger form-text">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" id="submit_button" value="Update Article" name="add_article" class="btn background-gold">
                        </div>
                    </form>
                    <!----end magazine article edit form section--->

                </div>
            </div>
        </div>
    </section>
@endsection
