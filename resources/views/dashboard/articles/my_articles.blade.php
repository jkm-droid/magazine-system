@extends('base.admin_index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">My Articles</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><b>Articles</b></li>
                        <li class="breadcrumb-item active"><b>My Articles</b></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    @if($articles->isEmpty())
        <h3 class="text-danger text-center">no articles found!</h3>
    @else
        <div class="col-12">
            <div class="card card-outline card-warning">
                <div class="card-header">

                    <a class="btn btn-sm put-gold background-black" href="{{ route('article.create') }}">
                        <h3 class="card-title">Add New Article</h3>
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
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Type</th>
                            <th>Language</th>
                            <th>Image</th>
                            <th>Author</th>
                            <th>Creation Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <td><a href="{{ route('article.show', $article->id) }}">{{ $article->title }}</a></td>
                                @if($article->categories->isEmpty())
                                    <td></td>
                                @else
                                    @foreach($article->categories as $category)
                                        <td>{{ $category->title }}</td>
                                    @endforeach
                                @endif
                                <td>{{ $article->type }}</td>
                                <td>{{ $article->language }}</td>
                                <td>
                                    <img src="/article_covers/{{ $article->image }}" alt="" height="40" width="50">
                                </td>
                                <td>{{ $article->author }}</td>
                                <td>{{ \Carbon\Carbon::parse($article->created_at)->format('j M,Y') }}</td>
                                @if($article->status  == 1)
                                    <td><i class="text-success fa fa-check-circle"></i></td>
                                @else
                                    <td><i class="text-danger fa fa-times-circle"></i></td>
                                @endif

                                <td>
                                    <form action="{{ route('article.delete',$article->id) }}" method="POST">

                                        <a class="btn btn-info btn-sm" href="{{ route('article.show',$article->id) }}">Show</a>

                                        <a class="btn btn-primary btn-sm" href="{{ route('article.edit',$article->id) }}">Edit</a>

                                        @csrf
                                        @method('PUT')

                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    @endif

    {!! $articles->links() !!}

@endsection
