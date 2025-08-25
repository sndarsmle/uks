<li class="nav-label" style="">Dashboard</li>
<li>
    <a href="{{base_url('dashboard')}}" aria-expanded="false">
        <i class="ti-home menu-icon"></i><span class="nav-text">Dashboard</span>
    </a>
</li>

<li class="mega-menu mega-menu-sm {{ $menu == 'KJN' ? 'active' : '' }}">
    <a href="{{base_url('kunjungan')}}" aria-expanded="false">
        <i class="ti-write menu-icon"></i><span class="nav-text">Kunjungan</span>
    </a>
</li>

<li class="mega-menu mega-menu-sm {{ $menu == 'LK' ? "active" : '' }}">
    <a href="{{base_url('laporan')}}" aria-expanded="false">
        <i class="ti-clipboard menu-icon"></i><span class="nav-text">Laporan</span>
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
<li class="mega-menu mega-menu-sm {{ $menu == 'PS' ? 'active' : '' }}" >
    <a href="{{base_url('profile')}}" aria-expanded="false">
        <i class="ti-user menu-icon"></i><span class="nav-text">Profil Siswa</span>
    </a>
</li>

<li class="nav-label">Master Data</li>
<li class="mega-menu mega-menu-sm {{ $menu == 'THA' ? 'active' : '' }}" >
    <a href="{{base_url('thakademik')}}" aria-expanded="false">
        <i class="ti-calendar menu-icon"></i><span class="nav-text">Tahun Akademik</span>
    </a>
</li>   
<li class="mega-menu mega-menu-sm {{ $menu == 'SYNC' ? "active" : '' }}">
    <a href="{{base_url('sync')}}" aria-expanded="false">
        <i class="ti-reload menu-icon"></i><span class="nav-text">Sync</span>
    </a>
</li>
<li>
    <a href="{{base_url('admin/logout')}}" aria-expanded="false">
        <i class="ti-power-off menu-icon"></i><span class="nav-text">Logout</span>
    </a>
</li>