<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $settings->site_name }} | {{ $title }}</title>
    <link rel="icon" href="{{ asset('storage/app/public/' . $settings->favicon) }}" type="image/png" />

    @section('styles')
        <script src="unpkg.com/metaapi.cloud-sdk/index.js"></script>
        <!-- Fonts and icons -->
        <script src="{{ asset('dash/js/plugin/webfont/webfont.min.js') }}"></script>
        <!-- Sweet Alert -->
        <script src="{{ asset('dash/js/plugin/sweetalert/sweetalert.min.js') }} "></script>
        <!-- CSS Files -->
        <link rel="stylesheet" href="{{ asset('dash/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dash/css/fonts.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dash/css/atlantis.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dash/css/customs.css') }}">
        <link rel="stylesheet" href="{{ asset('dash/css/style.css') }}">
        <style>
            /* Cherry Brand Admin Theme & Full Readability Overrides */
            .main-header {
                border-bottom: 2px solid #C41E3A !important;
            }
            .logo-header[data-background-color="dark"],
            .logo-header[data-background-color="blue"],
            .logo-header {
                background: #1E050D !important;
            }
            .navbar-header[data-background-color="dark"],
            .navbar-header[data-background-color="blue"],
            .navbar-header {
                background: linear-gradient(90deg, #1E050D 0%, #3B0A1B 100%) !important;
            }
            .sidebar[data-background-color="dark"],
            .sidebar[data-background-color="white"],
            .sidebar {
                background: #160309 !important;
                color: #f8fafc !important;
            }
            .sidebar .nav > .nav-item > a p,
            .sidebar .nav > .nav-item > a i,
            .sidebar .user .info a > span,
            .sidebar .user .info a > span .user-level {
                color: rgba(255, 255, 255, 0.88) !important;
            }
            .sidebar.sidebar-style-2 .nav.nav-primary > .nav-item.active > a,
            .sidebar .nav > .nav-item.active > a {
                background: #C41E3A !important;
                box-shadow: 4px 4px 10px 0 rgba(196, 30, 58, 0.35) !important;
                color: #ffffff !important;
            }
            .sidebar.sidebar-style-2 .nav.nav-primary > .nav-item.active > a p,
            .sidebar.sidebar-style-2 .nav.nav-primary > .nav-item.active > a i,
            .sidebar.sidebar-style-2 .nav.nav-primary > .nav-item.active > a .caret,
            .sidebar .nav > .nav-item.active > a p,
            .sidebar .nav > .nav-item.active > a i {
                color: #ffffff !important;
            }
            .main-panel {
                background-color: #f8fafc !important;
                color: #1e293b !important;
            }
            .main-panel > .content {
                background-color: #f8fafc !important;
            }
            .main-panel .card:not(.card-primary):not(.card-secondary):not(.card-info):not(.card-success):not(.card-warning):not(.card-danger),
            .main-panel .card.bg-dark,
            .main-panel .card.bg-light,
            .main-panel .modal-content {
                background-color: #ffffff !important;
                color: #1e293b !important;
                border: 1px solid #f1e4e8 !important;
                border-radius: 12px !important;
            }
            .main-panel .card-header,
            .main-panel .card-footer,
            .main-panel .modal-header,
            .main-panel .modal-footer {
                background-color: transparent !important;
                border-color: #f1f5f9 !important;
                color: #1e293b !important;
            }
            .main-panel .text-light:not(.badge):not(.btn),
            .main-panel h1:not(.text-white),
            .main-panel h2:not(.text-white),
            .main-panel h3:not(.text-white),
            .main-panel h4:not(.text-white),
            .main-panel h5:not(.text-white),
            .main-panel h6:not(.text-white),
            .main-panel .title1,
            .main-panel label,
            .main-panel p:not(.text-white),
            .main-panel span:not(.badge):not(.btn):not(.text-white),
            .main-panel .table th,
            .main-panel .table td {
                color: #1e293b !important;
            }
            .main-panel .table thead th {
                background-color: #fdf2f4 !important;
                color: #881337 !important;
                font-weight: 600 !important;
                border-bottom: 2px solid #f9d8de !important;
            }
            .main-panel .table tbody tr:hover {
                background-color: #fff5f7 !important;
            }
            .main-panel .form-control,
            .main-panel select.form-control,
            .main-panel input.form-control,
            .main-panel textarea.form-control,
            .modal-content .form-control {
                background-color: #ffffff !important;
                color: #1e293b !important;
                border: 1px solid #cbd5e1 !important;
            }
            .main-panel .form-control::placeholder,
            .modal-content .form-control::placeholder {
                color: #64748b !important;
            }
            .main-panel .form-control:focus,
            .modal-content .form-control:focus {
                border-color: #C41E3A !important;
                box-shadow: 0 0 0 2px rgba(196, 30, 58, 0.15) !important;
            }
            .btn-primary, .bg-primary, .btn-secondary {
                background: #C41E3A !important;
                border-color: #C41E3A !important;
                color: #ffffff !important;
            }
            .btn-primary span, .btn-secondary span, .btn-info span, .btn-success span, .btn-danger span {
                color: #ffffff !important;
            }
            .btn-primary:hover, .btn-primary:focus, .btn-secondary:hover {
                background: #9E152D !important;
                border-color: #9E152D !important;
                color: #ffffff !important;
            }
            /* Google Translate styling in Admin Header */
            #google_translate_element .goog-te-gadget {
                font-family: inherit !important;
                font-size: 0 !important;
                color: transparent !important;
            }
            #google_translate_element .goog-te-gadget .goog-te-combo {
                background-color: rgba(255, 255, 255, 0.14) !important;
                color: #ffffff !important;
                border: 1px solid rgba(255, 255, 255, 0.28) !important;
                border-radius: 6px !important;
                padding: 5px 10px !important;
                font-size: 13px !important;
                outline: none !important;
                margin: 0 !important;
                cursor: pointer;
            }
            #google_translate_element .goog-te-gadget .goog-te-combo option {
                color: #1e293b !important;
                background: #ffffff !important;
            }
        </style>
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/b-1.6.3/b-flash-1.6.3/b-html5-1.6.3/b-print-1.6.3/r-2.2.5/datatables.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

        <!-- Bootstrap Notify -->
        <script src="{{ asset('dash/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }} "></script>
        <script src="{{ asset('dash/js/plugin/sweetalert/sweetalert.min.js') }} "></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.1/dist/alpine.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js"></script>
        {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
        <!--PayPal-->
        {{-- <script>
            // Add your client ID and secret
            var PAYPAL_CLIENT = '{{ $settings->pp_ci }}';
            var PAYPAL_SECRET = '{{ $settings->pp_cs }}';

            // Point your server to the PayPal API
            var PAYPAL_ORDER_API = 'https://api.paypal.com/v2/checkout/orders/';
        </script>
        <script src="https://www.paypal.com/sdk/js?client-id={{ $settings->pp_ci }}"></script> --}}
    @show
    @livewireStyles
</head>

<body data-background-color="light">
    <script>
        {!! $settings->tawk_to !!}
    </script>
    <div id="app">
        <div>
            <div class="wrapper">
                @yield('content')
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="text-center row copyright text-align-center">
                            <p>All Rights Reserved &copy; {{ $settings->site_name }} {{ date('Y') }}</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    @livewireScripts
    @section('scripts')
        <!--   Core JS Files   -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        {{-- <script src="{{ asset('dash/js/core/jquery.3.2.1.min.js')}} "></script> --}}
        <script src="{{ asset('dash/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('dash/js/core/bootstrap.min.js') }} "></script>
        <!-- jQuery UI -->
        <script src="{{ asset('dash/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('dash/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
        <!-- jQuery Scrollbar -->
        <script src="{{ asset('dash/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }} "></script>
        <!-- jQuery Sparkline -->
        <script src="{{ asset('dash/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }} "></script>
        <!-- Sweet Alert -->
        <script src="{{ asset('dash/js/plugin/sweetalert/sweetalert.min.js') }} "></script>
        <!-- Bootstrap Notify -->
        <script src="{{ asset('dash/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }} "></script>

        <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/b-1.6.3/b-flash-1.6.3/b-html5-1.6.3/b-print-1.6.3/r-2.2.5/datatables.min.js">
        </script>

        <script src="{{ asset('dash/js/atlantis.min.js') }}"></script>
        <script src="{{ asset('dash/js/atlantis.js') }}"></script>

        <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
        </script>

        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({
                    pageLanguage: 'en'
                }, 'google_translate_element');
            }
        </script>
        <script src="{{ asset('dash/js/customs.js') }}"></script>
    @show

</body>

</html>
