<!-- Nav Item - Dashboard -->
<li class="nav-item {{ Nav::isRoute('home') }}">
    <a class="nav-link" href="{{ route('home') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>{{ __('Dashboard') }}</span></a>
</li>

<!-- Nav Item - Dashboard -->
<li class="nav-item {{ Nav::isRoute('transaksi.list-kamar') }}">
    <a class="nav-link" href="{{ route('transaksi.list-kamar') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>{{ __('Daftar Kamar') }}</span></a>
</li>

<!-- Nav Item - Dashboard -->
<li class="nav-item {{ Nav::isRoute('transaksi.my-trx') }}">
    <a class="nav-link" href="{{ route('transaksi.my-trx') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>{{ __('Transaksi Saya') }}</span></a>
</li>
