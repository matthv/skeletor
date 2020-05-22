<header>
    <nav class="navbar navbar-expand-lg navbar-main">
        <a class="navbar-brand" href="{{ route('skeletor.admin.dashboard') }}">
            <img src="{{ asset('vendor/skeletor/images/logo.png') }}" alt="logo dashboard" />
        </a>
        <a href="#" class="toggle-sidebar">
            <i class="fas fa-bars"></i>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i> {{ Auth::guard('admin')->user() }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Déconnexion
                        </a>
                        <form id="logout-form" class="d-none" action="{{ route('skeletor.auth.logout') }}" method="POST">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>