<li class="nav-label" style="">Dashboard</li>
<li>
    <a href="{{base_url('dashboard')}}" aria-expanded="false">
        <i class="ti-home menu-icon"></i><span class="nav-text">Dashboard</span>
    </a>
</li>
<li class="nav-label" style="">MCU</li>
<li class="mega-menu mega-menu-sm">
    <a href="{{base_url('mcu')}}" aria-expanded="false" {{ $menu == 'MCU' ? "class='active'" : '' }}>
        <i class="ti-write menu-icon"></i><span class="nav-text">Rekam Pemeriksaan</span>
    </a>
</li>
<li class="mega-menu mega-menu-sm">
    <a href="{{ base_url('recordHistories') }}" aria-expanded="false" {{ $menu == 'RHS' ? "class='active'" : '' }}>
        <i class="ti-receipt menu-icon"></i><span class="nav-text">Riwayat Pemeriksaan</span>
    </a>
</li>
<li class="nav-label" style="">AKUN</li>
<li>
    <a href="{{base_url('admin/logout')}}" aria-expanded="false">
        <i class="ti-power-off menu-icon"></i><span class="nav-text">Logout</span>
    </a>
</li>

