<nav class="main-header navbar navbar-expand background-black put-gold">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link put-gold" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link put-gold">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search put-gold"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search put-gold"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link put-gold" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-danger navbar-badge put-red">{{ \Illuminate\Support\Facades\Auth::user()->all_notifications }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">
                    {{ \Illuminate\Support\Facades\Auth::user()->all_notifications }} Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i>
                    {{ \Illuminate\Support\Facades\Auth::user()->all_notifications }} Publish requests
                    <span class="float-right text-muted text-sm"></span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('notifications.all.show') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link put-gold" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link put-gold" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
        <!-- User Account Menu -->
        <li class="nav-item dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="nav-link dropdown-toggle put-gold" data-toggle="dropdown">
                <!-- The user image in the navbar-->
            {{--                <img src="/profile_pictures/{{ \Illuminate\Support\Facades\Auth::user()->profile_url }}" class="user-image" alt="User Image"/>--}}
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{ Auth::user()->username }}</span>

            </a>
            <ul class="dropdown-menu" style="background-color: black; color: goldenrod;">
                <!-- The user image in the menu -->
                <li class="user-header">
                    <img src="/profile_pictures/{{ \Illuminate\Support\Facades\Auth::user()->profile_url }}" class="img-circle" alt="User Image" />
                    <p>
                        {{ Auth::user()->email }} -
                        @if(\Illuminate\Support\Facades\Auth::user()->isSuperAdmin == 1)
                            Admin
                        @else
                            Author
                        @endif
                        <small>Member since {{ date_format(Auth::user()->created_at, 'M Y')}}</small>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="pull-left">
                        {{--                        <a href="{{ route('profile.index', \Illuminate\Support\Facades\Auth::user()->id) }}" class="btn btn-default btn-flat">Profile</a>--}}
                    </div>
                    <div class="pull-right">
                        {{--                        @if(Auth::guard('admin')->check())--}}
                        {{--                            <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">Sign out</a>--}}
                        {{--                        @else--}}
                        <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">Sign out</a>
                        {{--                        @endif--}}
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</nav>
