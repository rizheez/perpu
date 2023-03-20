<div class="sidebar">

    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav">
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>

                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Data</h4>
                </li>
                <li class="nav-item {{ request()->routeIs(['buku.*', 'penerbit.*', 'kategori.*']) ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Master Data</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li class="nav-item {{ request()->routeIs('buku.*') ? 'active' : '' }}">
                                <a href="{{ route('buku.index') }}">
                                    <i class="fas fa-book"></i>
                                    <span>Buku</span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('penerbit.*') ? 'active' : '' }}">
                                <a href="{{ route('penerbit.index') }}">
                                    <i class="fas fa-user"></i>
                                    <span>Penerbit</span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                                <a href="{{ route('kategori.index') }}">
                                    <i class="fas fa-bookmark"></i>
                                    <span>Kategori</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
                    <a href="{{ route('peminjaman.index') }}">
                        <i class="fas fa-list
                        "></i>
                        <p>Peminjaman</p>

                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('anggota.*') ? 'active' : '' }}">
                    <a href="{{ route('anggota.index') }}">
                        <i class="fas fa-users"></i>
                        <p>Anggota</p>

                    </a>
                </li>

                @if (Auth::guard('petugas')->user()->hasRole('admin'))
                    <li class="nav-item {{ request()->routeIs('petugas.*') ? 'active' : '' }}">
                        <a href="{{ route('petugas.index') }}">
                            <i class="fas fa-user-tie"></i>
                            <p>Petugas</p>
                        </a>
                    </li>
                @endif


            </ul>
        </div>
    </div>
</div>
