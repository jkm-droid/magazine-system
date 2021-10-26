@extends('base.admin_index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">"{{ $magazine->title }}"</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Magazines</a></li>
                        <li class="breadcrumb-item active"><b>View Magazine</b></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section>
        <div class="col-12">
            <div class="card card-outline card-dark">
                <div class="card-header">

                    <a class="btn btn-sm put-gold background-black" href="{{ route('magazines.index') }}">
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
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-outline">
                                <div class="card-body m-1">
                                    <img src="/magazine_covers/{{ $magazine->image }}" alt="" class="img-fluid">
                                    <h4 class="mt-2">{{ $magazine->issue }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="card card-outline">
                                <div class="card-header">
                                    <h3 class="card-title"><a class="btn btn-sm put-gold background-black" onclick="showForm()">Add Article</a></h3>
                                    <script>
                                        //show the form to add an article
                                        function showForm(){
                                            $(document).ready(function() {
                                                // e.preventDefault();

                                                document.getElementById('magazine-article').style.display = 'block';
                                                document.getElementById('magazine-articles-display').style.display = 'none';
                                            });
                                        }
                                    </script>
                                </div>
                                <!----magazine article creation form section--->
                                <form method="post" action="{{ route('magazine.article.add', $magazine->id) }}" enctype="multipart/form-data" id="magazine-article" style="display: none;">
                                    @csrf
                                    <div class="card-body m-1">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="title" class="form-label">Article Title</label>
                                                <input type="text" name="title" class="form-control" placeholder="enter magazine title" id="title">
                                                @if ($errors->has('title'))
                                                    <div class="text-danger form-text">{{ $errors->first('title') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="image" class="form-label">Article Cover Image</label>
                                                <input type="file" name="image" class="form-control" placeholder="enter magazine image" id="image">
                                                @if ($errors->has('image'))
                                                    <div class="text-danger form-text">{{ $errors->first('image') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div>
                                            <label for="description" class="form-label">Article Description</label>
                                            <textarea class="form-control summernote" name="description" rows="4" placeholder="Write a short description about the article..."></textarea>
                                            @if ($errors->has('description'))
                                                <div class="text-danger form-text">{{ $errors->first('description') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <input type="submit" id="submit_button" value="Save Article" name="add_article" class="btn background-gold">
                                    </div>
                                </form>
                                <!----end magazine article creation form section--->

                                <!----show magazine articles section--->
                                <div id="magazine-articles-display">
                                    @if($magazine->magazine_articles->isEmpty())
                                        <p class="text-center">No articles found for this issue</p>
                                    @else
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($magazine->magazine_articles as $mag_article)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $mag_article->title }}</td>
                                                    <td>{!! \Illuminate\Support\Str::limit(strip_tags($mag_article->description), $limit = 50, $end = '...') !!}</td>
                                                    <td><img src="/magazine_covers/{{ $mag_article->image }}" height="30" width="40" alt=""></td>
                                                    <td>
                                                        <form action="{{ route('magazine.article.delete', $mag_article->id) }}" method="POST">

                                                            {{--                                                    <a class="btn btn-info btn-sm" href="{{ route('magazine.article.show',$mag_article->id) }}">Show</a>--}}

                                                            <a class="btn btn-primary btn-sm" href="{{ route('magazine.article.edit',$mag_article->id) }}">Edit</a>

                                                            @csrf
                                                            @method('PUT')

                                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                                <!----end show magazine articles section--->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
