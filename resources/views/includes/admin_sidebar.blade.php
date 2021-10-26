<div class="sidebar background-black put-gold">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex put-gold">
        <div class="image">
            <img src="/profile_pictures/{{ \Illuminate\Support\Facades\Auth::user()->profile_url }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info put-gold">
            <a style="color: goldenrod;" href="#" class="d-block put-gold">{{ Auth::user()->email }}</a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
{{--    <div class="form-inline">--}}
{{--        <div class="input-group" data-widget="sidebar-search">--}}
{{--            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">--}}
{{--            <div class="input-group-append">--}}
{{--                <button class="btn btn-sidebar">--}}
{{--                    <i class="fas fa-search fa-fw"></i>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

<!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="nav-icon fa fa-home"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('my_articles.index', \Illuminate\Support\Facades\Auth::user()->id) }}" class="nav-link">
                    <i class="nav-icon fa fa-clone"></i>
                    <p>
                        My Articles
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Articles
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if( Auth::user()->is_admin == 1)
                        <li class="nav-item">
                            <a href="{{ route('articles.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a href="{{ route('article.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add New</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-bars"></i>
                    <p>
                        Categories
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if( Auth::user()->is_admin == 1)
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('category.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add New</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-bars"></i>
                    <p>
                        Magazines
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if( Auth::user()->is_admin == 1)
                        <li class="nav-item">
                            <a href="{{ route('magazines.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('magazine.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add New</p>
                        </a>
                    </li>
                </ul>
            </li>

            @include('includes.admin_page')
            {{--                <li class="nav-item">--}}
            {{--                    <a href="{{ route('profile') }}" class="nav-link">--}}
            {{--                        <i class="nav-icon fa fa-wrench"></i>--}}
            {{--                        <p>--}}
            {{--                            Profile--}}
            {{--                        </p>--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            <li class="nav-header">LABELS</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-circle text-danger"></i>
                    <p class="text">Important</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-circle text-warning"></i>
                    <p>Warning</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-circle text-info"></i>
                    <p>Informational</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
