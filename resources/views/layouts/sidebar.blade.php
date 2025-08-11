<div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
            {{-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div> --}}
            <div class="sidebar-brand-text mx-3">Inventi</div>
        </a>

        <hr class="sidebar-divider my-0">

        <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('kategori') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/kategori') }}">
                <i class="fas fa-fw fa-tags"></i>
                <span>Kategori Barang</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('barang') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/barang') }}">
                <i class="fas fa-fw fa-box"></i>
                <span>Barang</span>
            </a>
        </li>

        {{-- Barang Masuk --}}
        <li class="nav-item {{ request()->is('barang-masuk') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/barang-masuk') }}">
                <i class="fas fa-inbox"></i>
                <span>Barang Masuk</span>
            </a>
        </li>

        {{-- Barang Keluar --}}
        <li class="nav-item {{ request()->is('barang-keluar') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/barang-keluar') }}">
                <i class="fas fa-box-open"></i>
                <span>Barang Keluar</span>
            </a>
        </li>

        <!-- <li class="nav-item active">
            <a class="nav-link" href="{{ url('/laporan') }}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Laporan</span>
            </a>
        </li> -->

        <li class="nav-item {{ request()->is('pengaturan') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/pengaturan') }}">
                <i class="fas fa-fw fa-cog"></i>
                <span>Pengaturan</span>
            </a>
        </li>

        {{-- Divider --}}
        <hr class="sidebar-divider d-none d-md-block">

    </ul>




    <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div>

        </ul> --}}
    <!-- End of Sidebar -->