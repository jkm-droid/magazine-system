@extends('base.admin_index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit "{{ $article->title }}"</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Articles</a></li>
                        <li class="breadcrumb-item active"><b>Edit Article</b></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="col-12">
        <div class="card card-outline card-dark">
            <div class="card-header">
                <h3 class="card-title">
                    <a class="btn btn-sm put-gold background-black" href="{{ route('articles.index') }}">Back</a>
                </h3>
            </div>
            <!-- /.card-header -->

            <form role="form" method="post" action="{{ route('article.update', $article->id) }}" id="form_submit" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body m-1">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Article Title</label>
                            <input type="text" name="title" value="{{ $article->title }}" class="form-control" placeholder="enter article title" id="title">
                            @if ($errors->has('title'))
                                <div class="text-danger form-text">{{ $errors->first('title') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label for="image" class="form-label">Article Cover Image</label>
                            <input type="file" name="image" class="form-control" placeholder="enter article image" id="image">
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6 mt-3">
                            <label for="category" class="form-label">Article Category</label>
                            <select name="category" id="category" class="form-select form-control" aria-label="Default select example" autofocus>
                                @if($article->category)
                                    <option value="{{ $article->category }}" selected>{{ $article->category }}</option>
                                @endif
                                <option value="" disabled>Select article category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category'))
                                <div class="text-danger form-text">{{ $errors->first('category') }}</div>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label for="body" class="form-label">Article Description/Body</label>
                        <textarea class="form-control summernote" name="body" id="body" rows="4">{{ $article->body }}</textarea>
                        @if ($errors->has('body'))
                            <div class="text-danger form-text">{{ $errors->first('body') }}</div>
                        @endif
                    </div>

                    <div class="check-primary mt-2">
                        <input type="checkbox" name="status" id="status">
                        <label for="status">
                            Draft
                        </label>
                    </div>
                </div>

                <div class="card-footer">
                    <input type="submit" id="submit_button" value="Update Article" name="update_articles" class="btn background-gold">
                </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>

@endsection
