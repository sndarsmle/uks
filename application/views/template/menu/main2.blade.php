<li class="nav-label">Dashboard</li>
<li>
    <a href="{{base_url('dashboard')}}" aria-expanded="false">
        <i class="ti-home menu-icon"></i><span class="nav-text">Dashboard</span>
    </a>
</li>
<li class="mega-menu mega-menu-sm" >
    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
        <i class="ti-write menu-icon"></i><span class="nav-text">MCU / Screening</span>
    </a>
    <ul aria-expanded="false"  {{ $menu == 'CMCU' ? "class='collapse in'" : '' }}>
        <li><a href="{{base_url('wali')}}" {{ $menu == 'CMCU' ? "class='active'" : '' }}>Lihat Data</a></li>
    </ul>
</li>
<li class="mega-menu mega-menu-sm" >
    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
        <i class="ti-write menu-icon"></i><span class="nav-text">DCU</span>
    </a>
    <ul aria-expanded="false"  {{ $menu == 'CDCU' ? "class='collapse in'" : '' }}>
        <li><a href="{{base_url('wali/dcu')}}" {{ $menu == 'CDCU' ? "class='active'" : '' }}>Lihat Data</a></li>
    </ul>
</li>
<li class="mega-menu mega-menu-sm {{ $menu == 'WC' ? 'active' : '' }}">
    <a href="{{base_url('wali/checkup_periode')}}" aria-expanded="false">
        <i class="ti-write menu-icon"></i><span class="nav-text">Pemeriksaan Mingguan</span>
    </a>
</li>
<li class="mega-menu mega-menu-sm {{ $menu == 'FLP' ? 'active' : '' }}">
    <a href="{{base_url('wali/followup')}}" aria-expanded="false">
        <i class="ti-write menu-icon"></i><span class="nav-text">FollowUP/Rujukan</span>
    </a>
</li>
<li class="mega-menu mega-menu-sm {{ $menu == 'MCU' ? 'active' : '' }}">
    <a href="{{base_url('mcu')}}" aria-expanded="false">
        <i class="ti-write menu-icon"></i><span class="nav-text">Pemeriksaan Berjalan</span>
    </a>
</li>
<li class="mega-menu mega-menu-sm {{ $menu == 'PS' ? 'active' : '' }}" >
    <a href="{{base_url('wali/profile')}}" aria-expanded="false">
        <i class="ti-user menu-icon"></i><span class="nav-text">Profil Siswa</span>
    </a>
</li>
<li>
    <a href="{{base_url('admin/logout')}}" aria-expanded="false">
        <i class="ti-power-off menu-icon"></i><span class="nav-text">Logout</span>
    </a>
</li>


