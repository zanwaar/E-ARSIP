<!DOCTYPE html>
<html class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('public/template/') }}" data-template="vertical-menu-template-free" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    <meta name="description" content="" />
    @livewireStyles
    <!-- Favicon -->

    <link rel="icon" type="image/x-icon" href="{{ asset('logo-black.png') }}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('build/assets/app-a8457a2b.css')}}" />
    <link rel="stylesheet" href="{{asset('template/vendor/fonts/boxicons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" class="template-customizer-core-css" href="{{asset('template/vendor/css/core.css')}}" />
    <link rel="stylesheet" class="template-customizer-theme-css" href="{{asset('template/vendor/css/theme-default.css')}}" />
    <link rel="stylesheet" href="{{asset('template/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('template/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('template/vendor/libs/sweetalert2/sweetalert2.min.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
    <!-- Helpers -->
    <script src="{{ asset('template/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('template/js/config.js') }}"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    @stack('style')
    <style>
        .pagination .page-link {
            background-color: #696cff;
            /* Ganti dengan warna primary yang sesuai */
            color: #fff;
        }

        .pagination .page-item.disabled .page-link {
            color: #696cff;
            background-color: rgba(105, 108, 255, 0.16);

            /* Warna teks putih */
        }

        /* Activity */
        .activity {
            font-size: 14px;
        }

        .activity .activity-item .activite-label {
            color: #888;
            position: relative;
            flex-shrink: 0;
            flex-grow: 0;
            min-width: 64px;
        }

        .activity .activity-item .activite-label::before {
            content: "";
            position: absolute;
            right: -11px;
            width: 4px;
            top: 0;
            bottom: 0;
            background-color: #eceefe;
        }

        .activity .activity-item .activity-badge {
            margin-top: 3px;
            z-index: 1;
            font-size: 11px;
            line-height: 0;
            border-radius: 50%;
            flex-shrink: 0;
            border: 3px solid #fff;
            flex-grow: 0;
        }

        .activity .activity-item .activity-content {
            padding-left: 10px;
            padding-bottom: 20px;
        }

        .activity .activity-item:first-child .activite-label::before {
            top: 5px;
        }

        .activity .activity-item:last-child .activity-content {
            padding-bottom: 0;
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @livewire('components.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <div class="layout-menu-toggle navbar-nav center mx-3 mx-lg-4 d-xl-none  mt-2">
                    <div class="card">
                        <a class="nav-item nav-link px-0 me-xl-4  d-flex w-100 flex-wrap align-items-center px-2" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i> <span>E-ARSIP </span>
                        </a>
                    </div>
                </div>


                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    {{ $slot }}

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

                                <a href="https://themeselection.com/demo/template-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>

                                <a href="https://github.com/themeselection/template-html-admin-template-free/issues" target="_blank" class="footer-link me-4">Support</a>
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
    @livewireScript
    <!-- / Layout wrapper -->
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />
    @stack('scripts')

</body>

</html>