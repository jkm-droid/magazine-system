@extends('base.admin_index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create New Magazine</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('magazines.index') }}">Magazines</a></li>
                        <li class="breadcrumb-item active"><b>New Magazine</b></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="col-12">
        <div class="card card-outline card-dark">
            <div class="card-header">
                <h3 class="card-title"><a class="btn btn-sm put-gold background-black" href="{{ route('magazines.index') }}">Back</a></h3>
            </div>
            <!-- /.card-header -->

            <form role="form" method="post" action="{{ route('magazine.save') }}" id="form_submit" enctype="multipart/form-data">
                @csrf
                <div class="card-body m-1">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Magazine Title</label>
                            <input type="text" name="title" class="form-control" placeholder="enter magazine title" id="title">
                            @if ($errors->has('title'))
                                <div class="text-danger form-text">{{ $errors->first('title') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label for="issue" class="form-label">Magazine Issue</label>
                            <input type="text" name="issue" class="form-control" placeholder="enter magazine issue e.g June-September 2021">
                            @if ($errors->has('issue'))
                                <div class="text-danger form-text">{{ $errors->first('issue') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="copy" class="form-label">Magazine Digital Copy(only pdfs)</label>
                            <input type="file" name="copy" class="form-control" placeholder="enter magazine copy">
                            @if ($errors->has('copy'))
                                <div class="text-danger form-text">{{ $errors->first('copy') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label for="image" class="form-label">Magazine Cover Image</label>
                            <input type="file" name="image" class="form-control" placeholder="enter magazine image" id="image">
                            @if ($errors->has('image'))
                                <div class="text-danger form-text">{{ $errors->first('image') }}</div>
                            @endif
                        </div>
                    </div>

                    <div  style="display: none" class="progress mt-3">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                             aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">File Upload 75%
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <input type="submit" id="submit_button" value="Save Magazine" name="save_magazines" class="btn background-gold">
                </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>

@endsection
