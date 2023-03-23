<nav class="navbar navbar-header navbar-expand-lg">

    <div class="container-fluid">

        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            @if (!Auth::guard('petugas')->check())
                <li class="nav-item dropdown hidden-caret">
                    <a href="{{ route('login') }}" class="text-white" style="font-size: 17px;"><i
                            class="bi bi-box-arrow-in-right mr-1"></i>Login</a>
                </li>
            @else
                <li class="nav-item dropdown hidden-caret">
                    <a href="{{ route('dashboard') }}" class="text-white" style="font-size: 17px;"><i
                            class="bi bi-house-door-fill mr-1"></i>Dashboard</a>
                </li>
            @endif

        </ul>
    </div>
</nav>
