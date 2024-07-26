<div>
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
            <li class="position-relative menu-item {{ $activeRoute === 'home' ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Beranda</div>
                </a>
            </li>
            @role('admin')
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Kelola Pengguna</span>
            </li>
            <li class="position-relative menu-item {{ $activeRoute === 'bidang.index' ? 'active' : '' }}">
                <a href="{{ route('bidang.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-git-merge"></i>
                    <div data-i18n="Kelola Bidang">Kelola Bidang</div>
                </a>
            </li>
            <li class="position-relative menu-item {{ $activeRoute === 'pengguna.listpengguna' ? 'active' : '' }}">
                <a href="{{ route('pengguna.listpengguna') }}" class="menu-link">
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
            <li class="position-relative menu-item {{ $activeRoute === 'surat.disposisi' || $activeRoute === 'disposisi.id' ? 'active' : '' }}">
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
           <li class="position-relative menu-item {{ $activeRoute === 'dokument.surat-masuk' || $activeRoute === 'disposisi.id' ? 'active' : '' }}">
                <a href="{{ route('dokument.surat-masuk') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-folder-plus"></i>
                    <div data-i18n="Analytics">Surat Masuk</div>
                </a>
            </li>

            <li class="position-relative menu-item {{ $activeRoute === 'dokument.surat-keluar'  || $activeRoute === 'detail.suratKeluar' ? 'active' : '' }}">
                <a href="{{ route('dokument.surat-keluar') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-folder-open"></i>
                    <div data-i18n="Analytics">Surat Keluar</div>
                </a>
            </li>
            <li class="position-relative menu-item {{ $activeRoute === 'dokument.lainnya' ? 'active' : '' }}">
                <a href="{{ route('dokument.lainnya') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-folder"></i>
                    <div data-i18n="Analytics">Lainnya</div>
                </a>
            </li>
            @endrole


            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">PROFILE</span>
            </li>

            <li class="position-relative menu-item {{ $activeRoute === 'profile' ? 'active' : '' }}">
                <a href="{{ route('profile') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="Analytics">Profile</div>
                </a>
            </li>
            <li class="position-relative menu-item {{ $activeRoute === 'password' ? 'active' : '' }}">
                <a href="{{ route('password') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bx-shield-alt-2'></i>
                    <div data-i18n="Analytics">Ubah Password</div>
                </a>
            </li>
            <li class="menu-item">
                <a wire:click.prevent="log()" class="menu-link dz-cursor-pointer">
                    <i class='menu-icon tf-icons bx bx-log-out'></i>
                    <div data-i18n="log">Logout</div>
                </a>

            </li>

        </ul>


    </aside>
    <!-- Modal -->
    <div class="modal fade" id="logout" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class='menu-icon tf-icons bx bx-log-out mb-3' style="font-size: 33px;"></i>
                    <p>Are you sure you want to logout?</p>
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-secondary w-100 dz-block" data-bs-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                        <div class="col-6">
                            <form action="{{ route('logout') }}" method="post" class="">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100 dz-block ">
                                    <div data-i18n="Analytics">Yes, Logout</div>
                                </button>
                            </form>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    var modal = new bootstrap.Modal(document.getElementById('logout'), {
        backdrop: 'static',
        keyboard: false
    });
    window.addEventListener("log", function(event) {
        $("#logout").modal("show");
    });
    // window.onload = function() {
    //     $("#logout").modal("show");
    // }
</script>
@endpush