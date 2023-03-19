<nav class="navbar navbar-header navbar-expand-lg">

    <div class="container-fluid">

        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">

            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        @if (!Auth::guard('petugas')->user()->hasRole('admin'))
                            <img src="{{ asset('storage/petugas/profile/' . Auth::guard('petugas')->user()->profile) }}"
                                alt="..." class="avatar-img rounded-circle">
                        @elseif (Auth::guard('petugas')->user()->hasRole('admin'))
                            <img src="{{ asset('assets/img/blank-profile.png') }}" alt="..."
                                class="avatar-img rounded-circle">
                            {{-- <img src="" alt="..." class="avatar-img rounded-circle">
                            {{-- <h4 class="text-white">Logout</h4> --}}
                        @endif
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    @if (!Auth::guard('petugas')->user()->hasRole('admin'))
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg"><img
                                        src="{{ asset('storage/petugas/profile/' . Auth::guard('petugas')->user()->profile) }}"
                                        alt="image profile" class="avatar-img rounded"></div>
                                <div class="u-text">
                                    <h4 class="text-uppercase">{{ Auth::guard('petugas')->user()->nama }}</h4>
                                    <p class="text-muted">Petugas</p>
                                    <p class="text-muted"><i
                                            class="btn-success btn-link btn-rounded bi bi-circle-fill"></i>
                                        ONLINE</p>
                                </div>

                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item"
                                href="{{ route('petugas.account', Auth::guard('petugas')->user()->id) }}">Account
                                Setting</a>
                            <div class="dropdown-divider"></div>
                            {{-- <div class="avatar-lg"><img src="" alt="image profile" class="avatar-img rounded"></div> --}}
                        </li>
                        <li>


                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            {{-- <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="btn btn-rounded btn-danger btn-sm">Logout</a> --}}
                        </li>
                    @elseif (Auth::guard('petugas')->user()->hasRole('admin'))
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg"><img src="{{ asset('assets/img/blank-profile.png') }}"
                                        alt="image profile" class="avatar-img rounded"></div>
                                <div class="u-text">
                                    <h4 class="text-uppercase">Administrator</h4>
                                    <p class="text-muted">Administrator</p>
                                </div>

                            </div>
                        </li>
                        <li>
                            {{-- <div class="u-text">
                                <div class="avatar-lg">
                                    <img src="{{ asset('storage/petugas/profile/' . Auth::guard('petugas')->user()->profile) }}"
                                        alt="image profile" class="avatar-img rounded">
                                    Logout
                                </div> --}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </li>
                    @endif

                </ul>
            </li>

        </ul>
    </div>
</nav>
