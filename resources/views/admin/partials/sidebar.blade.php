<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Components Collapse Menu -->
    <li class="nav-item {{ request()->is('components/buttons') || request()->is('components/cards') ? 'active' : '' }}">
        <a class="nav-link {{ request()->is('components/buttons') || request()->is('components/cards') ? '' : 'collapsed' }}" href="#"
            data-toggle="collapse" data-target="#collapseComponents"
            aria-expanded="{{ request()->is('components/buttons') || request()->is('components/cards') ? 'true' : 'false' }}"
            aria-controls="collapseComponents">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseComponents"
            class="collapse {{ request()->is('components/buttons') || request()->is('components/cards') ? 'show' : '' }}"
            aria-labelledby="headingComponents" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item {{ request()->is('components/buttons') ? 'active' : '' }}" href="{{ url('components/buttons') }}">Buttons</a>
                <a class="collapse-item {{ request()->is('components/cards') ? 'active' : '' }}" href="{{ url('components/cards') }}">Cards</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ request()->is('utilities/color') || request()->is('utilities/border') || request()->is('utilities/animation') || request()->is('utilities/other') ? 'active' : '' }}">
        <a class="nav-link {{ request()->is('utilities/color') || request()->is('utilities/border') || request()->is('utilities/animation') || request()->is('utilities/other') ? '' : 'collapsed' }}"
            href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="{{ request()->is('utilities/color') || request()->is('utilities/border') || request()->is('utilities/animation') || request()->is('utilities/other') ? 'true' : 'false' }}"
            aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities"
            class="collapse {{ request()->is('utilities/color') || request()->is('utilities/border') || request()->is('utilities/animation') || request()->is('utilities/other') ? 'show' : '' }}"
            aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item {{ request()->is('utilities/color') ? 'active' : '' }}" href="{{ url('utilities/color') }}">Colors</a>
                <a class="collapse-item {{ request()->is('utilities/border') ? 'active' : '' }}" href="{{ url('utilities/border') }}">Borders</a>
                <a class="collapse-item {{ request()->is('utilities/animation') ? 'active' : '' }}" href="{{ url('utilities/animation') }}">Animations</a>
                <a class="collapse-item {{ request()->is('utilities/other') ? 'active' : '' }}" href="{{ url('utilities/other') }}">Other</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->is('pages/404') || request()->is('pages/blank') ? 'active' : '' }}">
        <a class="nav-link {{ request()->is('pages/404') || request()->is('pages/blank') ? '' : 'collapsed' }}"
            href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="{{ request()->is('pages/404') || request()->is('pages/blank') ? 'true' : 'false' }}"
            aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages"
            class="collapse {{ request()->is('pages/404') || request()->is('pages/blank') ? 'show' : '' }}"
            aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item {{ request()->is('pages/404') ? 'active' : '' }}" href="{{ url('pages/404') }}">404 Page</a>
                <a class="collapse-item {{ request()->is('pages/blank') ? 'active' : '' }}" href="{{ url('pages/blank') }}">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item {{ request()->is('charts') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('charts') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span>
        </a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item {{ request()->is('tables') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('tables') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
