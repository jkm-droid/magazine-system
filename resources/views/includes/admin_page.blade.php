@if( Auth::user()->is_admin == 1)
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
                Roles
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('role.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View All</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('role.create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add New</p>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
                Permissions
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('permission.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View All</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('permission.create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add New</p>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.index') }}" class="nav-link">
            <i class="nav-icon fa fa-wrench"></i>
            <p>
                Admins
            </p>
        </a>
    </li>
@endif
