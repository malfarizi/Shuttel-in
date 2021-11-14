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
            <a href="#" data-toggle="dropdown" 
            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, Ujang Maman</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="{{route('admin.profile.edit', 1)}}" class="dropdown-item has-icon">
                    <i class="fas fa-user"></i> Ubah Profile
                </a>
                <a href="#" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html"><img src="../assets/img/logo.svg" alt=""></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Shuttle-In</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item">
                <a href="{{url('admin')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Menu</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Data</span></a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('admin.drivers.index')}}">Driver</a></li>
                <li><a class="nav-link" href="{{route('admin.shuttles.index')}}">Shuttle</a></li>
                <li><a class="nav-link" href="{{route('admin.routes.index')}}">Rute</a></li>
                <li><a class="nav-link" href="{{route('admin.schedules.index')}}">Jadwal</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="{{route('admin.customers')}}"><i class="far fa-square"></i> <span>Customer</span></a></li>
            <li><a class="nav-link" href="{{route('admin.booking')}}"><i class="far fa-square"></i> <span>Reservasi</span></a></li>
    </aside>
</div>