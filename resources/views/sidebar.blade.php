 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-hands-wash"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Loundry</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Nav Item - Pages Collapse Menu -->
    @if (Auth::user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#user"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user"></i>
            <span>User</span>
        </a>
        <div id="user" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Action Menu</h6>
                <a class="collapse-item" href="{{ url('laundry/user') }}">Data User</a>
                <a class="collapse-item" href="{{ url('laundry/registeruserpage') }}">Registrasi User</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#member"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-users"></i>
            <span>Pelanggan</span>
        </a>
        <div id="member" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Action Menu</h6>
                <a class="collapse-item" href="{{ url('laundry/pelanggan') }}">Data Pelanggan</a>
                <a class="collapse-item" href="{{ url('laundry/registerpage') }}">Registrasi Pelanggan</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#toko"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-store"></i>
            <span>Outlet</span>
        </a>
        <div id="toko" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Action Menu</h6>
                <a class="collapse-item" href="{{ url('laundry/outlet') }}">Data Outlet</a>
                <a class="collapse-item" href="{{ url('laundry/registeroutletpage') }}">Registrasi Outlet</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#paket"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cubes"></i>
            <span>Paket Laundry </span>
        </a>
        <div id="paket" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Action Menu</h6>
                <a class="collapse-item" href="{{ url('laundry/paket') }}">Data Paket</a>
                <a class="collapse-item" href="{{ url('laundry/registerpaketpage') }}">Registrasi Paket</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaksi"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Transaksi</span>
        </a>
        <div id="transaksi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Action Menu</h6>
                <a class="collapse-item" href="{{ url('laundry/transaksi') }}">Log Transaksi</a>
                <a class="collapse-item" href="{{ url('laundry/registertransaksipage') }}">Registrasi Transaksi</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('laundry/generate') }}">
            <i class="fas fa-fw fa-print"></i>
            <span>Generate Laporan</span></a>
    </li>
    @endif

    @if (Auth::user()->role == 'kasir')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaksi"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Transaksi</span>
        </a>
        <div id="transaksi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Action Menu</h6>
                <a class="collapse-item" href="{{ url('laundry/transaksi') }}">Log Transaksi</a>
                <a class="collapse-item" href="{{ url('laundry/registertransaksipage') }}">Registrasi Transaksi</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('laundry/generate') }}">
            <i class="fas fa-fw fa-print"></i>
            <span>Generate Laporan</span></a>
    </li>
    @endif

    @if (Auth::user()->role == 'owner')
    <li class="nav-item">
        <a class="nav-link" href="{{ url('laundry/generate') }}">
            <i class="fas fa-fw fa-print"></i>
            <span>Generate Laporan</span></a>
    </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->
