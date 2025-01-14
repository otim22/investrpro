<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>SenteShield</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('vendor/libs/apex-charts/apex-charts.css') }}" />
    
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('js/config.js') }}"></script>
    <style>
        .bg-menu-theme .menu-link,
        .bg-menu-theme .menu-horizontal-prev,
        .bg-menu-theme .menu-horizontal-next {
            color: #a6a7a9;
        }
        .bg-menu-theme .menu-link:hover, .bg-menu-theme .menu-link:focus,
        .bg-menu-theme .menu-horizontal-prev:hover,
        .bg-menu-theme .menu-horizontal-prev:focus,
        .bg-menu-theme .menu-horizontal-next:hover,
        .bg-menu-theme .menu-horizontal-next:focus {
            color: #030303;
        }
        html:not(.layout-menu-collapsed) .bg-menu-theme .menu-inner .menu-item.open > .menu-link, .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.open > .menu-link,
        html:not(.layout-menu-collapsed) .bg-menu-theme .menu-inner .menu-item .menu-link:not(.active):hover,
        .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item .menu-link:not(.active):hover {
            background-color: rgb(207, 207, 212);
        }
        .bg-menu-theme .menu-inner > .menu-item.active > .menu-link {
            color: #030303;
            background-color: #ffffff !important;
        }
        .bg-menu-theme .menu-inner > .menu-item.active:before {
            background: #ffffff !important;
        }
        .bg-menu-theme .menu-item.active > .menu-link {
            color: #ffffff;
            background-color: #011338 !important;
        }
    </style>
    @stack('styles')
</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

            <!-- Menu -->
            @include('admin.layouts.aside')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                @include('admin.layouts.nav')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    @yield('content')

                    <!-- Footer -->
                    @include('admin.layouts.footer')
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
    <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('js/dashboards-analytics.js') }}"></script>
    @stack('scripts')
</body>

</html>
