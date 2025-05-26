<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/admin/dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin UMKM</div>
    </a>
    <hr class="sidebar-divider my-0">
    <!-- Dashboard -->
    <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Manajemen Data</div>
    <!-- Data User UMKM -->
    <li class="nav-item {{ request()->is('admin/users*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-users"></i>
            <span>Data User UMKM</span>
        </a>
    </li>
    <!-- Kategori Produk -->
    <li class="nav-item {{ request()->is('admin/categories*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('categories.index') }}">
            <i class="fas fa-tags"></i>
            <span>Kategori Produk</span>
        </a>
    </li>
    <!-- Produk UMKM -->
    <li class="nav-item {{ request()->is('admin/products*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('products.index') }}">
            <i class="fas fa-box"></i>
            <span>Produk UMKM</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Laporan & Fitur</div>
    <!-- Laporan Produk -->
    <li class="nav-item {{ request()->is('admin/reports*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin/reports') }}">
            <i class="fas fa-chart-bar"></i>
            <span>Laporan Produk</span>
        </a>
    </li>
    <!-- Search & Filter Produk -->
    <li class="nav-item {{ request()->is('admin/products/search') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin/products/search') }}">
            <i class="fas fa-search"></i>
            <span>Search & Filter Produk</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
