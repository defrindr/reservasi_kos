<!-- Nav Item - Dashboard -->
<li class="nav-item {{ Nav::isRoute('home') }}">
    <a class="nav-link" href="{{ route('home') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>{{ __('Dashboard') }}</span></a>
</li>


<!-- Nav Item - Profile -->
<li class="nav-item {{ Nav::isRoute('kamar-kos') }}">
    <a class="nav-link" href="{{ route('kamar-kos.index') }}">
        <i class="fas fa-fw fa-user"></i>
        <span>{{ __('Kamar Kos') }}</span>
    </a>
</li>


<!-- Nav Item - Profile -->
<li class="nav-item {{ Nav::isRoute('penyewa') }}">
    <a class="nav-link" href="{{ route('penyewa.index') }}">
        <i class="fas fa-fw fa-user"></i>
        <span>{{ __('Penyewa') }}</span>
    </a>
</li>
