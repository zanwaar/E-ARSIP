<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="" class="app-brand-link">
            <img src="{{ asset('logo-b.png') }}" alt="{{ config('app.name') }}" width="30">
            <span class="app-brand-text demo text-black fw-bolder ms-2">{{ config('app.name') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>


    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Beranda</div>
            </a>
        </li>
        @role('admin')
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Kelola Pengguna</span>
        </li>
        <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('bidang*') ? 'active' : '' }}">
            <a href="{{url('bidang/list')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-git-merge"></i>
                <div data-i18n="Kelola Bidang">Kelola Bidang</div>
            </a>
        </li>
        <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('pengguna*') ? 'active' : '' }}">
            <a href="{{url('pengguna/list')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <div data-i18n="Analytics">Daftar Pengguna</div>
            </a>
        </li>
        @endrole

        <!-- <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('jabatan*') ? 'active' : '' }}">
            <a href="{{url('jabatan/list')}}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-briefcase-alt-2'></i>
                <div data-i18n="Analytics">Jabatan</div>
            </a>
        </li> -->
        <!-- <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Menu Lainnya</span>
        </li> -->
        @php
        $user = auth()->user();
        @endphp

        <!-- Menu items for users who are NOT 'admin' or 'staffAdmin' -->
        @if (!$user->hasAnyRole(['admin', 'staffAdmin']))
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Disposisi</span>
        </li>
        <li class="position-relative menu-item {{ $activeRoute === 'surat.disposisi' ? 'active' : '' }}">
            <a href="{{ route('surat.disposisi') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-mail-send"></i>
                <div data-i18n="Analytics">Surat Disposisi</div>
            </a>
            @if ($total_count > 0)
            <span style="right: 24px; top: 12px;" class="position-absolute badge bg-label-danger">{{ $total_count }}</span>
            @endif
        </li>
        @endif


        @role('staffAdmin')
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">FILE DOKUMENT</span>
        </li>
        <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('dokument.surat-masuk') ? 'active' : '' }}">
            <a href="{{ route('dokument.surat-masuk') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder-plus "></i>
                <div data-i18n="Analytics">Surat Masuk</div>
            </a>
        </li>
        <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('dokument.surat-keluar') ? 'active' : '' }}">
            <a href="{{url('dokument/surat-keluar')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder-open"></i>
                <div data-i18n="Analytics">Surat Keluar</div>
            </a>
        </li>
        <li class="menu-item ">
            <a href="{{url('counter')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div data-i18n="Analytics">Lainnya</div>
            </a>
        </li>
        @endrole


        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">PROFILE</span>
        </li>

        <li class="menu-item ">
            <a href="{{url('counter')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">Profile</div>
            </a>
        </li>
        <li class="menu-item ">
            <a href="{{url('counter')}}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-shield-alt-2'></i>
                <div data-i18n="Analytics">Ubah Password</div>
            </a>
        </li>
        <li class="menu-item">
            <form action="{{ route('logout') }}" method="post" class="mx-4">
                @csrf
                <button type="submit" class="w-100 d-flex py-2 align-items-center rounded ">
                    <i class='bx bx-left-arrow-circle mx-2' style="font-size:  24px;"></i>
                    <div data-i18n="Analytics">Logout</div>
                </button>
            </form>
        </li>

    </ul>
</aside>