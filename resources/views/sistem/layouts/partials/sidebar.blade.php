<!-- Sidebar navigation-->
<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul id="sidebarnav">
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('sistem.dashboard') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Transaksi</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('sistem.transaksi') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-file"></i>
                </span>
                <span class="hide-menu">Laporan Transaksi</span>
            </a>
        </li>
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">SPK</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('sistem.nilai') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Nilai</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('sistem.kriteria') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Kriteria</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('sistem.hitung.kriteria') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Hitung Kriteria</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('sistem.hitung.alternatif') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Hitung Alternatif</span>
            </a>
        </li>

        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Menu</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('sistem.kategori') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Kategori Barang</span>
            </a>
        </li>        
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('sistem.barang') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Barang</span>
            </a>
        </li>

        @if(Auth::guard('websistem')->user()->role=='Administrator')
            
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('sistem.bank') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Bank</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('sistem.rekening') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Rekening</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('sistem.jasakirim') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Jasa Kirim</span>
            </a>
        </li>
        
        @endif
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('sistem.contact') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Contact</span>
            </a>
        </li>

        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">User Management</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('sistem.pegawai') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Pegawai</span>
            </a>
        </li>

        @if(Auth::guard('websistem')->user()->role=='Administrator')
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Setting</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('sistem.slider') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-photo"></i>
                    </span>
                    <span class="hide-menu">Slider</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('sistem.setting') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-settings"></i>
                    </span>
                    <span class="hide-menu">Setting Website</span>
                </a>
            </li>
        @endif
        
    </ul>
    <a href="{{ route('sistem.logout') }}" class="btn btn-danger fs-2 fw-semibold d-block"><i class="ti ti-logout"></i> Sign Out</a>
</nav>
<!-- End Sidebar navigation -->
