@extends('base.admin_index')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Industrialising Africa <b class="put-black">Magazine</b></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->
    <section class="content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $total_articles }}</h3>

                            <p>Articles</p>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-albums"></i>
                        </div>
                        <a href="{{ route('articles.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $author_articles }}</h3>

                            <p>My Articles</p>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-albums-outline"></i>
                        </div>
                        <a href="{{ route('my_articles.index', \Illuminate\Support\Facades\Auth::user()->id) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $total_users }}</h3>

                            <p>Registered Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion-android-people"></i>
                        </div>
                        <a href="{{ route('categories.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $total_admins }}</h3>

                            <p>Admins</p>
                        </div>
                        <div class="icon">
                            <i class="ion-android-people"></i>
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->isSuperAdmin == 1)
                            <a href="{{ route('admin.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        @else
                            <a href="/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        @endif
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- end small boxes -->

            <!-- Main row -->
            <div class="row">

                <!-- tables -->

                <!-- left column -->
                <section class="col-lg-6 connectedSortable">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Recent Articles</h3>

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
                            @if($recent_articles->isEmpty())
                                <p class="text-center">no articles found</p>
                            @else
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($recent_articles as $recent_article)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $recent_article->title }}</td>
                                            <td>{{ $recent_article->created_at }}</td>
                                            @if($recent_article->status == 1)
                                                <td><span class="badge badge-success">Published</span></td>
                                            @else
                                                <td><span class="badge badge-danger">Draft</span></td>
                                            @endif
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- end left column-->

                <!-- right column -->
                <section class="col-lg-6 connectedSortable">
                    <!-- card categories-->
                    <div class="card card-outline card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Recent Categories</h3>

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
                            @if($recent_categories->isEmpty())
                                <p class="text-danger">no categories found</p>
                            @else
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Cover</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($recent_categories as $recent_category)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $recent_category->title }}</td>
                                            <td><img src="category_covers/{{ $recent_category->image }}" height="30" width="40" alt=""></td>
                                            <td>{{ $recent_category->created_at }}</td>
                                            <td><i class="text-success fa fa-check-circle"></i></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- end card categories-->

                    {{--                    <!-- Calendar -->--}}
                    {{--                    <div class="card bg-gradient-success">--}}
                    {{--                        <div class="card-header border-0">--}}

                    {{--                            <h3 class="card-title">--}}
                    {{--                                <i class="far fa-calendar-alt"></i>--}}
                    {{--                                Calendar--}}
                    {{--                            </h3>--}}
                    {{--                            <!-- tools card -->--}}
                    {{--                            <div class="card-tools">--}}
                    {{--                                <!-- button with a dropdown -->--}}
                    {{--                                <div class="btn-group">--}}
                    {{--                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">--}}
                    {{--                                        <i class="fas fa-bars"></i>--}}
                    {{--                                    </button>--}}
                    {{--                                    <div class="dropdown-menu" role="menu">--}}
                    {{--                                        <a href="#" class="dropdown-item">Add new event</a>--}}
                    {{--                                        <a href="#" class="dropdown-item">Clear events</a>--}}
                    {{--                                        <div class="dropdown-divider"></div>--}}
                    {{--                                        <a href="#" class="dropdown-item">View calendar</a>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">--}}
                    {{--                                    <i class="fas fa-minus"></i>--}}
                    {{--                                </button>--}}
                    {{--                                <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">--}}
                    {{--                                    <i class="fas fa-times"></i>--}}
                    {{--                                </button>--}}
                    {{--                            </div>--}}
                    {{--                            <!-- /. tools -->--}}
                    {{--                        </div>--}}
                    {{--                        <!-- /.card-header -->--}}
                    {{--                        <div class="card-body pt-0">--}}
                    {{--                            <!--The calendar -->--}}
                    {{--                            <div id="calendar" style="width: 100%"></div>--}}
                    {{--                        </div>--}}
                    {{--                        <!-- /.card-body -->--}}
                    {{--                    </div>--}}
                    {{--                    <!-- end calendar -->--}}

                </section>
                <!-- end right column-->

                <!-- end tables-->

            </div>
            <!-- end main row -->
        </div>
        <!-- end container-fluid -->

    </section>
@endsection
