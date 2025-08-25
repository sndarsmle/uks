<li class="nav-label" style="">Dashboard</li>
<li>
    <a href="{{base_url('dashboard')}}" aria-expanded="false">
        <i class="ti-home menu-icon"></i><span class="nav-text">Dashboard</span>
    </a>
</li>
<li class="mega-menu mega-menu-sm" >
    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
        <i class="ti-write menu-icon"></i><span class="nav-text">Cetak Dokumen</span>
    </a>
    <ul aria-expanded="false" {{ ($menu == 'DCU' || $menu == 'DCU1') ? "class='collapse in'" : '' }}>
        <li><a href="{{base_url('cetakdoc/cariSiswaMcu')}}" {{ $menu == 'MCU' ? "class='active'" : '' }}>MCU</a></li>
        <li><a href="{{base_url('cetakdoc/cariSiswaDcu')}}" {{ $menu == 'DCU1' ? "class='active'" : '' }}>DCU</a></li>
        <li><a href="{{base_url('cetakdoc/Kunjungan')}}" {{ $menu == 'DCU1' ? "class='active'" : '' }}>Kunjungan</a></li>
    </ul>
</li>
<li class="nav-label" style="">VIP</li>
<li class="mega-menu mega-menu-sm">
    <a href="{{base_url('vip')}}" aria-expanded="false" {{ $menu == 'VIP' ? "class='active'" : '' }}>
        <i class="ti-write menu-icon"></i><span class="nav-text">VIP</span>
    </a>
</li>

<li class="nav-label" style="">AKUN</li>
<li>
    <a href="{{base_url('admin/logout')}}" aria-expanded="false">
        <i class="ti-power-off menu-icon"></i><span class="nav-text">Logout</span>
    </a>
</li>

