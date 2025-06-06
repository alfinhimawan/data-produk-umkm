<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/owner/dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Owner UMKM</div>
    </a>
    <hr class="sidebar-divider my-0">
    <!-- Dashboard -->
    <li class="nav-item {{ request()->is('owner/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('owner/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Manajemen Produk</div>
    <!-- Kategori (lihat saja) -->
    <li class="nav-item {{ request()->is('owner/categories*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('owner/categories') }}">
            <i class="fas fa-tags"></i>
            <span>Kategori Produk</span>
        </a>
    </li>
    <!-- Produk Saya (CRUD produk sendiri) -->
    <li class="nav-item {{ request()->is('owner/products*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('owner/products') }}">
            <i class="fas fa-box"></i>
            <span>Produk Saya</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Profil & UMKM</div>
    <!-- Edit Profil UMKM -->
    <li class="nav-item {{ request()->is('owner/umkm-profile*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('owner/umkm-profile') }}">
            <i class="fas fa-user-edit"></i>
            <span>Profil UMKM</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
