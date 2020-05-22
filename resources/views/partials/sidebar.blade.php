<aside class="sidebar">
    @include('skeletor::partials.top-sidebar')
    <ul>
        <li>
            <a href="{{ route('skeletor.admin.dashboard') }}" class="{{ Route::currentRouteName() == 'skeletor.admin.dashboard' ? 'active' : '' }}">
                <i class="fas fa-desktop fa-lg"></i> <span>{{ __('skeletor::skeletor.dashboard') }}</span>
            </a>
        </li>
    </ul>
</aside>