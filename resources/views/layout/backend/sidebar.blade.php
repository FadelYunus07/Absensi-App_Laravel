<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <i class="fa-solid fa-family"></i>
        </div>
        <div class="sidebar-brand-text mx-3">ABSENSI</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    {{-- @can('guru') --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dash') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>  
    @can('siswa')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('jadwalkls') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Jadwal Pelajaran</span></a>
    </li>  
        
    @endcan
    {{-- @elseCan('siswa')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Dashboard</span></a>
    </li>
    @elseCan('admin')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Dashboard</span></a>
    </li>
    @endCan --}}
    @can('guru')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('masters') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Master Kelas</span></a>
    </li>
    @endcan

    @can('admin')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('masters') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Master Kelas</span></a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('qr-hadir') }}">
            <i class="fa fa-fw fa-qrcode"></i>
            <span>QR Kehadiran</span></a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('presensiGuru') }}">
            <i class="fa fa-fw fa-qrcode"></i>
            <span>Presensi Guru</span></a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('laporHadirGuru') }}">
            <i class="fa fa-fw fa-qrcode"></i>
            <span>Laporan Kehadiran Guru</span></a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('laporHadirSiswa') }}">
            <i class="fa fa-fw fa-qrcode"></i>
            <span>Laporan Kehadiran Siswa</span></a>
    </li>
    
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('hdrGuru.pdf') }}">
            <i class="fa fa-fw fa-qrcode"></i>
            <span>Cetak Kehadiran Guru</span></a>
    </li> --}}

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-table"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('kelolaUser') }}">User</a>
                <a class="collapse-item" href="{{ route('admin') }}">Admin</a>
                <a class="collapse-item" href="{{ route('guru') }}">Guru</a>
                <a class="collapse-item" href="{{ route('siswa') }}">Siswa</a>
                <a class="collapse-item" href="{{ route('mapels') }}">Mapel</a>
            </div>
        </div>
    </li>
    @endCan
    <!-- Divider -->
    {{-- <hr class="sidebar-divider"> --}}
    
    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>
    
    @can('guru')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('scanner') }}">
            <i class="fa fa-fw fa-qrcode" aria-hidden="true"></i>
            <span>Scan QR Kelas</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('indexhdrGuru') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Scan Hadir Guru</span></a>
    </li>
    @endcan
    @can('siswa')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('scanner') }}">
            <i class="fa fa-fw fa-qrcode" aria-hidden="true"></i>
            <span>Scan QR Kelas</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('indexhdrSiswa') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Scan Hadir Siswa</span></a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('presensikls') }}">
            <i class="fa fa-fw fa-qrcode" aria-hidden="true"></i>
            <span>Laporan Presensi Kelas</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('presensi.pdf') }}">
            <i class="fa fa-fw fa-qrcode" aria-hidden="true"></i>
            <span>Cetak Laporan Presensi Kelas</span></a>
    </li> --}}
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('scanner') }}">
            <i class="fa fa-fw fa-qrcode" aria-hidden="true"></i>
            <span>Scan QR</span></a>
    </li> --}}
    @endcan



    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="{{ route('scanner') }}">Scan QR</a>
                <a class="collapse-item" href="{{ route('buttons') }}">Buttons</a>
                <a class="collapse-item" href="{{ route('cards') }}">Cards</a>
            </div>
        </div>
    </li> --}}

    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('guru.submit_izin') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Izin Kehadiran</span></a>
    </li> --}}
    {{-- @can('admin')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('presensikls') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Laporan Absensi Guru</span></a>
    </li>
    @endcan --}}
        

    <!-- Nav Item - Utilities Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="{{ route('utilities-colors') }}">Colors</a>
                <a class="collapse-item" href="{{ route('utilities-borders') }}">Borders</a>
                <a class="collapse-item" href="{{ route('utilities-animations') }}">Animations</a>
                <a class="collapse-item" href="{{ route('utilities-other') }}">Other</a>
            </div>
        </div>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Addons
    </div> --}}

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
                <a class="collapse-item" href="{{ route('login') }}">Login</a>
                <a class="collapse-item" href="{{ route('register') }}">Register</a>
                <a class="collapse-item" href="{{ route('forgot-password') }}">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="{{ route('404-page') }}">404 Page</a>
                <a class="collapse-item" href="{{ route('blank-page') }}">Blank Page</a>
            </div>
        </div>
    </li> --}}

    <!-- Nav Item - Charts -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('chart') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('tables') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li> --}}

    <li class="nav-item">
        <a class="nav-link" href="{{ route('profile') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Profile</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>