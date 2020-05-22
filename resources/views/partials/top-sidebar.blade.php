<a class="logo my-2" href="{{ route('skeletor.admin.dashboard') }}">
    <img src="{{ asset(config('skeletor.logo')) }}" width="260" alt="logo dashboard" />
</a>
<div class="user">
    <div class="layer"></div>
    <div class="profile text-center py-3">
        <a href="{{ route(config('skeletor.route_prefix') . '.account') }}">
            <i class="fas fa-user-circle fa-5x d-block mb-2"></i>
        </a>
        {{ Auth::guard('admin')->user() }}
        <a class="logout" href="" title="déconnexion" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-power-off"></i>
        </a>
        <form id="logout-form" class="d-none" action="{{ route('skeletor.auth.logout') }}" method="POST">
            @csrf
        </form>
    </div>
</div>
