@extends('base.admin_index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Categories</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><b>Categories</b></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    @if($categories->isEmpty())
        <h4 class="text-center">No Category found. <a href="{{ route('category.create') }}">Add New</a></h4>
    @else
        <div class="col-12">
            <div class="card card-outline card-warning">
                <div class="card-header">

                    <a class="btn btn-sm put-gold background-black" href="{{ route('category.create') }}">
                        <h3 class="card-title">Add New Category</h3>
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
                            <th>Author</th>
                            <th>Image</th>
                            <th>Creation Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td><a>{{ $category->title }}</a></td>
                                <td>{{ $category->author }}</td>
                                <td><img src="category_covers/{{$category->image }}" alt="" class="img-fluid" style="height: 30px; width: 40px;"></td>
                                <td>{{ $category->created_at }}</td>

                                <td>
                                    <form action="{{ route('category.delete',$category->id) }}" method="POST">

                                        <a class="btn btn-primary btn-sm" href="{{ route('category.edit',$category->id) }}">Edit</a>

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

    {!! $categories->links() !!}

@endsection
