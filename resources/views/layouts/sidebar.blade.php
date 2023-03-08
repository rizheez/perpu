<div class="sidebar">

    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav">
                <li class="nav-item active">
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
                <li class="nav-item">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Informasi</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('buku') }}">
                                    <i class="fas fa-book"></i>
                                    <span>Buku</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('penulis.index') }}">
                                    <i class="fas fa-user"></i>
                                    <span>Penulis</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('kategori.index') }}">
                                    <i class="fas fa-bookmark"></i>
                                    <span>Kategori</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#forms">
                        <i class="fas fa-list
                        "></i>
                        <p>Peminjaman</p>

                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#tables">
                        <i class="fas fa-users"></i>
                        <p>Anggota</p>

                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#maps">
                        <i class="fas fa-user-tie"></i>
                        <p>Petugas</p>
                    </a>

                </li>

            </ul>
        </div>
    </div>
</div>
