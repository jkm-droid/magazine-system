@extends('base.admin_index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create New Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Categories</a></li>
                        <li class="breadcrumb-item active"><b>New Category</b></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="col-12">
        <div class="card card-outline card-dark">
            <div class="card-header">
                <h3 class="card-title">
                    <a class="btn btn-sm put-gold background-black" href="{{ route('categories.index') }}">Back</a>
                </h3>
            </div>
            <!-- /.card-header -->

            <form role="form" method="post" action="{{ route('category.save') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body m-1">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Category Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter category title" id="title">
                            @if ($errors->has('title'))
                                <div class="text-danger form-text">{{ $errors->first('title') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label for="image" class="form-label">Category Cover Image(Optional)</label>
                            <input type="file" name="image" class="form-control" placeholder="enter article image" id="image">
                            @if ($errors->has('image'))
                                <div class="text-danger form-text">{{ $errors->first('image') }}</div>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <input type="submit" id="submit_button" value="Save Category" name="save_category" class="btn background-gold">
                </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>

@endsection
