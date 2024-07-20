<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light"><i class="fas fa-drumstick-bite"></i><span style="margin-left: 10px;">EventOrganization </span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ !empty(Auth::user()->profile_picture)?asset(Auth::user()->profile_picture):asset("assets/dist/img/avatar5.png") }}" class="user-image img-circle elevation-2"
                     style="height:40px;" alt="User Image">
                <span class="brand-text font-weight-light" style="color: white">EventOrganization </span>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            {{--<li class="nav-item">
                <a href="{{ route("dashboard") }}" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
            </li>--}}
            <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{url('admin/dashboard')}}"   class=" nav-link {{Request::is('admin/dashboard') ? 'active' : ''}}">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/bookings')}}" class="nav-link {{Request::is('admin/bookings') ? 'active' : ''}}">
                        <i class="fas fa-highlighter"></i>
                        <p>
                            Bookings
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/events')}}" class="nav-link {{Request::is('admin/events') ? 'active' : ''}}">
                        <i class="fas fa-tags"></i>
                        <p>
                            Events
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/outlets')}}" class="nav-link {{Request::is('admin/outlets') ? 'active' : ''}}">
                        <i class="fas fa-microphone"></i>
                        <p>
                           Event Speaker
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/participants')}}" class="nav-link {{Request::is('admin/participants') ? 'active' : ''}}">
                        <i class="fas fa-users"></i>
                        <p>
                            participants
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('Users/admin/Customer')}}" class="nav-link {{Request::is('Users/admin/Customer') ? 'active' : ''}}">
                        <i class="fas fa-store-alt"></i>
                        <p>
                            Table Top
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/user')}}" class="nav-link {{Request::is('admin/user') ? 'active' : ''}}">
                        <i class="fas fa-people-arrows"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
@section("script")


@endsection
