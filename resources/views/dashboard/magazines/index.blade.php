@extends('base.admin_index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Magazines</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><b>Magazines</b></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    @if(count($magazines) == 0)
        <h4 class="text-center">No magazine found. <a href="{{ route('magazine.create') }}">Add New</a></h4>
    @else
        <div class="col-12">
            <div class="card card-outline card-dark">
                <div class="card-header">

                    <a class="btn btn-sm put-gold background-black" href="{{ route('magazine.create') }}">
                        <h3 class="card-title">Add New Magazine</h3>
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
                            <th>Issue</th>
                            <th>Image</th>
                            <th>Creation Date</th>
                            <th>Status</th>
                            @if(\Illuminate\Support\Facades\Auth::user()->is_admin = 1)
                                <th></th>
                                <th>Action</th>
                            @endif
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($magazines as $magazine)
                            <tr>
                                <td><a href="{{ route('magazine.show', $magazine->id) }}">{{ $magazine->title }}</a></td>
                                <td>{{ $magazine->issue }}</td>
                                <td>
                                    <img src="/magazine_covers/{{ $magazine->image }}" alt="" height="40" width="50">
                                </td>
                                <td>{{ $magazine->created_at }}</td>
                                @if($magazine->published  == 1)
                                    <td><i class="text-success fa fa-check-circle"></i></td>
                                @else
                                    <td><i class="text-danger fa fa-times-circle"></i></td>
                                @endif

                                @if(\Illuminate\Support\Facades\Auth::user()->is_admin = 1)

                                    <td>
                                        @if($magazine->published  == 1)
                                            <form action="{{ route('magazine.publish',$magazine->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-warning btn-sm">Draft</button>
                                            </form>
                                        @else
                                            <form action="{{ route('magazine.publish',$magazine->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-sm" >Publish</button>
                                            </form>
                                        @endif

                                    </td>

                                    <td>
                                        <form action="{{ route('magazine.delete',$magazine->id) }}" method="POST">

                                            <a class="btn btn-info btn-sm" href="{{ route('magazine.show',$magazine->id) }}">Show</a>

                                            <a class="btn btn-primary btn-sm" href="{{ route('magazine.edit',$magazine->id) }}">Edit</a>

                                            @csrf
                                            @method('PUT')

                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>

                                @endif

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

    {!! $magazines->links() !!}

@endsection
