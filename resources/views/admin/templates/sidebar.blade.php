<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-nav ml-auto">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{asset('assets/img/avatar/avatar-1.png')}}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">
                    Hi, {{ ucfirst(auth()->guard('admin')->user()->name) }}
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="{{route('admin.profile.edit', auth()->guard('admin')->user()->id )}}" 
                    class="dropdown-item has-icon">
                    <i class="fas fa-user"></i> Ubah Profile
                </a>
                <form action="{{ route('admin.logout')}}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item has-icon text-danger">
                        <i class="mt-2 fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{url('admin')}}"><img src="{{asset('assets/img/logo.svg')}}" alt=""></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{url('admin')}}">Shuttle-In</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
                <a href="{{url('admin')}}" class="nav-link">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-header">Daftar Menu</li>
            <li class="{{ Request::routeIs('admin.drivers.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('admin.drivers.index')}}">
                    <i class="fas fa-user"></i> 
                    <span>Data Driver</span>
                </a>
            </li>
            <li class="{{ Request::routeIs('admin.shuttles.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('admin.shuttles.index')}}">
                    <i class="fas fa-shuttle-van"></i> 
                    <span>Data Shuttle</span>
                </a>
            </li>
            <li class="{{ Request::routeIs('admin.routes.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('admin.routes.index')}}">
                    <i class="fas fa-route"></i> 
                    <span>Data Rute</span>
                </a>
            </li>
            <li class="{{ Request::routeIs('admin.schedules.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('admin.schedules.index')}}">
                    <i class="fas fa-calendar-alt"></i> 
                    <span>Data Jadwal</span>
                </a>
            </li>
            <li class="{{ Request::routeIs('admin.customers') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('admin.customers')}}">
                    <i class="fa fa-users ml-1"></i> 
                    <span>Data Customer</span>
                </a>
            </li>
            <li class="{{ Request::routeIs('admin.bookings') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('admin.bookings')}}">
                    <i class="fas fa-receipt"></i> 
                    <span>Data Booking</span>
                </a>
            </li>
    </aside>
</div>