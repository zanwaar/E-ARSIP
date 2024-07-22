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
    lang="en"
    class="light-style customizer-hide"
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
    <link rel="icon" type="image/x-icon" href="{{asset('sneat/img/favicon/favicon.ico')}}"/>

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

    <!-- Page -->
    <link rel="stylesheet" href="{{asset('sneat/vendor/css/pages/page-auth.css')}}"/>
        <!-- Helpers -->
        <script src="{{asset('sneat/vendor/js/helpers.js')}}"></script>
</head>

<body>
<!-- Content -->

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <p class="text-center"><span class="fw-bold">E-ARSIP </span>PADA DINAS PENDIDIKAN DAN KEBUDAYAAN KABUPATEN MALUKU TENGAH</p>

                    <div class="app-brand justify-content-center">
                            <a href="{{ route('home') }}" class="app-brand-link gap-2">
                                <img src="{{ asset('logo.png') }}" alt="{{ config('app.name') }}" srcset="" width="75px">
                            </a>
                    </div>
                   
                    
                    <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                              type="text"
                              class="form-control @error('email') is-invalid @enderror"
                              id="email"
                              name="email"
                              placeholder="Enter your email"
                              autofocus
                            />
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                              <label class="form-label" for="password">Password</label>
                              <!-- <a href="auth-forgot-password-basic.html">
                                <small>Forgot Password?</small>
                              </a> -->
                            </div>
                            <div class="input-group input-group-merge">
                              <input
                                type="password"
                                id="password"
                                  class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password"
                              />
                              <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                          </div>
                        <div class="mt-2">
                            <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>

<!-- / Content -->
     <!-- / Layout wrapper -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('sneat/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{ asset('sneat/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{ asset('sneat/vendor/js/bootstrap.js')}}"></script>
    <script src="{{ asset('sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{ asset('sneat/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Main JS -->
    <script src="{{ asset('sneat/js/main.js')}}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>