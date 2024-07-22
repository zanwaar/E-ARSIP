<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
    lang="id"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="{{ asset('public/sneat/') }}"
    data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{ config('app.name') }}</title>

    <meta name="description" content=""/>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo-black.png') }}"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('sneat/vendor/fonts/boxicons.css')}}"/>

    <!-- Core CSS -->
    <link rel="stylesheet" class="template-customizer-core-css" href="{{asset('sneat/vendor/css/core.css')}}"/>
    <link rel="stylesheet" class="template-customizer-theme-css"
          href="{{asset('sneat/vendor/css/theme-default.css')}}"/>
    <link rel="stylesheet" href="{{asset('sneat/css/demo.css')}}"/>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}"/>
    <link rel="stylesheet" href="{{asset('sneat/vendor/libs/sweetalert2/sweetalert2.min.css')}}"/>

    <!-- Page CSS -->
    @stack('style')

    <!-- Helpers -->
    <script src="{{ asset('sneat/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('sneat/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
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
                    <li class="menu-item ">
                        <a href="{{url('counter')}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Beranda</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">MENU UTAMA</span>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-mail-send"></i>
                            <div data-i18n="Dokument">Dokument</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item ">
                                <a href="{{ url('dokument/surat-masuk') }}" class="menu-link">
                                    <div data-i18n="Surat Masuk">Surat Masuk</div>
                                </a>
                            </li>
                            <li class="menu-item ">
                                <a href="{{ url('dokument/surat-keluar') }}" class="menu-link">
                                    <div data-i18n="Surat Keluar">Surat Keluar</div>
                                </a>
                            </li>
                            <li class="menu-item ">
                                <a href="{{ url('dokument/lainnya') }}" class="menu-link">
                                    <div data-i18n="Dokument lainya">Dokument lainya</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item ">
                        <a href="{{url('counter')}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Beranda</div>
                        </a>
                    </li>

                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <i class="bx bx-search fs-4 lh-0"></i>
                                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Place this tag where you want the button to render. -->
                            <li class="nav-item lh-1 me-3">
                                <a class="github-button" href="https://github.com/themeselection/sneat-html-admin-sneat-free" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star themeselection/sneat-html-admin-sneat-free on GitHub">Star</a>
                            </li>

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">John Doe</span>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-cog me-2"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <span class="d-flex align-items-center align-middle">
                                                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                                <span class="flex-grow-1 align-middle">Billing</span>
                                                <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="auth-login-basic.html">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Icons /</span> Box Icons</h4>

                        <p>
                            You can check complete list of box icons from
                            <a href="https://boxicons.com/" target="_blank">https://boxicons.com</a>
                        </p>

                        <!-- Icon container -->
                        <div class="d-flex flex-wrap" id="icons-container">
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-adobe mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">adobe</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-algolia mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">algolia</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-audible mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">audible</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-figma mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">figma</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-redbubble mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">redbubble</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-etsy mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">etsy</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-gitlab mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">gitlab</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-patreon mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">patreon</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-facebook-circle mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">facebook-circle</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-imdb mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">imdb</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-jquery mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">jquery</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-pinterest-alt mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">pinterest-alt</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-500px mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">500px</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-airbnb mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">airbnb</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-amazon mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">amazon</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-android mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">android</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-angular mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">angular</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-apple mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">apple</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-baidu mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">baidu</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-behance mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">behance</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-bing mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">bing</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-bitcoin mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">bitcoin</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-blogger mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">blogger</p>
                                </div>
                            </div>
                            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                <div class="card-body">
                                    <i class="bx bxl-bootstrap mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">bootstrap</p>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-center mx-auto gap-3">
                            <a href="https://boxicons.com/" target="_blank" class="btn btn-primary">View All Icons</a>
                            <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-sneat/documentation//Icons.html" class="btn btn-primary" target="_blank">How to use icons?</a>
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                , made with ❤️ by
                                <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                            </div>
                            <div>
                                <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                                <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                                <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-sneat/documentation/" target="_blank" class="footer-link me-4">Documentation</a>

                                <a href="https://github.com/themeselection/sneat-html-admin-sneat-free/issues" target="_blank" class="footer-link me-4">Support</a>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
   <!-- / Layout wrapper -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('sneat/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{ asset('sneat/vendor/libs/popper/popper.js')}}"></script>
<script src="{{ asset('sneat/vendor/js/bootstrap.js')}}"></script>
<script src="{{ asset('sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

<script src="{{ asset('sneat/vendor/js/menu.js')}}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('sneat/vendor/libs/masonry/masonry.js')}}"></script>
<script src="{{ asset('sneat/vendor/libs/sweetalert2/sweetalert2.all.min.js')}}"></script>

<!-- Main JS -->
<script src="{{ asset('sneat/js/main.js')}}"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>