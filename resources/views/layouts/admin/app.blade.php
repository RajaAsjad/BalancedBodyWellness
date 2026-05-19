<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}" />
    @php
        $adminFav = trim($home_page_data['header_favicon'] ?? '');
        $adminFavExt = $adminFav !== '' ? strtolower(pathinfo($adminFav, PATHINFO_EXTENSION)) : '';
        $adminFavMime = match ($adminFavExt) {
            'png' => 'image/png',
            'jpg', 'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'ico' => 'image/x-icon',
            'svg' => 'image/svg+xml',
            'webp' => 'image/webp',
            default => '',
        };
    @endphp
    @if ($adminFav !== '')
        <link rel="apple-touch-icon" sizes="180x180"
            href="{{ asset('admin/assets/images/page/' . $adminFav) }}">
        <link rel="icon" href="{{ asset('admin/assets/images/page/' . $adminFav) }}"
            @if ($adminFavMime !== '') type="{{ $adminFavMime }}" @endif sizes="32x32">
    @else
        <link rel="icon" href="{{ asset('assets/website/favicon-la.svg') }}" type="image/svg+xml"
            sizes="any">
        <link rel="apple-touch-icon" href="{{ asset('assets/website/favicon-la.svg') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/jquery.fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/toastr.min.css') }}">

    <style>
        label {
            font-weight: bold;
            font-size: 12px;
        }
    </style>

    <style>
        /* Wellness overrides (app loads after style.css — reinforces teal theme) */
        :root {
            --admin-shell: #142824;
            --admin-shell-soft: #1e3834;
            --admin-pink: #2d6a62;
            --admin-pink-deep: #1a3f3c;
            --admin-orange: #4a9a8e;
            --admin-cream: #fafaf8;
            --admin-cream-mid: #eef2f0;
            --admin-text: #1d2b33;
            --admin-gold: #c9a157;
        }

        .skin-blue .wrapper,
        .skin-blue .main-header,
        .skin-blue .main-header .navbar,
        .skin-blue .main-sidebar,
        .content-header .content-header-right a,
        .content .form-horizontal .btn-success {
            /*  background-color: #000000!important; */
            /* background-image: url('{{ asset("assets/website/images/login.png") }}');
            background-size: cover;
            background-position: center; */
        }

        .main-sidebar {
            margin-top: 150px !important;
            height: calc(100vh - 150px) !important;
            overflow: hidden !important;
            display: flex !important;
            flex-direction: column !important;
        }

        .sidebar-menu>li {
            padding: 2px !important;
        }

        img#header-logo {
            width: 210px;
            position: absolute;
            left: 10px;
            top: 100%;
            height: 80px;
        }

        .skin-blue .main-sidebar .sidebar-menu>li>a,
        .skin-blue .main-sidebar .treeview-menu>li>a {
            color: rgba(255, 255, 255, 0.9) !important;
        }

        .skin-blue .main-header .navbar .nav>li>a {
            color: rgba(255, 255, 255, 0.92) !important;
        }

        .content a:not(.btn):not(.paginate_button) {
            color: #1d5c54 !important;
        }

        .content a:not(.btn):not(.paginate_button):hover {
            color: #134038 !important;
        }

        a.btn.btn-primary.btn-sm:hover {
            color: #fff !important;
            background: linear-gradient(135deg, var(--admin-pink) 0%, var(--admin-orange) 100%) !important;
            border-color: rgba(45, 106, 98, 0.4) !important;
            font-weight: 700;
        }

        button.btn.btn-success.pull-left:hover {
            color: #fff !important;
            background: linear-gradient(135deg, var(--admin-pink) 0%, var(--admin-orange) 100%) !important;
            border-color: rgba(45, 106, 98, 0.4) !important;
        }

        .content-header>h1,
        .content-header .content-header-left h1,
        .content-header h1 {
            color: var(--admin-text) !important;
        }

        .content h3 {
            color: var(--admin-text) !important;
        }

        .main-header .navbar .nav>li>a:hover,
        .main-header .navbar .nav .open>a {
            background-color: rgba(45, 106, 98, 0.2) !important;
        }

        .navbar-nav>.user-menu>.dropdown-menu>.user-footer {
            background-color: var(--admin-shell) !important;
        }

        .navbar-nav>.user-menu>.dropdown-menu>.user-footer .btn-default {
            color: #fff !important;
            background: linear-gradient(135deg, var(--admin-pink) 0%, var(--admin-orange) 100%) !important;
            border: none !important;
            border-radius: 30px !important;
        }

        .navbar-nav>.user-menu>.dropdown-menu>.user-footer .btn-default:hover {
            color: #fff !important;
            background: linear-gradient(135deg, #1a5c54 0%, #3d9a8e 100%) !important;
            border-radius: 30px !important;
            transition: all 0.25s ease-in-out !important;
            box-shadow: 0 0 0 3px rgba(45, 106, 98, 0.35) !important;
        }

        .box.box-info {
            border-top-color: var(--admin-pink) !important;
        }

        .nav-tabs-custom>.nav-tabs>li.active {
            border-top-color: var(--admin-pink-deep) !important;
        }

        a.active {
            background: linear-gradient(135deg, var(--admin-pink) 0%, var(--admin-orange) 100%) !important;
            color: #fff !important;
            font-weight: 700;
        }

        .btn-active {
            color: #fff !important;
            background: linear-gradient(135deg, var(--admin-pink) 0%, var(--admin-orange) 100%) !important;
            border-color: rgba(45, 106, 98, 0.45) !important;
            font-weight: 600;
            transition: all 0.25s ease-in-out;
        }

        .btn-active:hover {
            color: #fff !important;
            background: linear-gradient(135deg, #1a5c54 0%, #3d9a8e 100%) !important;
            border-color: rgba(45, 106, 98, 0.55) !important;
            box-shadow: 0 4px 14px rgba(45, 106, 98, 0.28);
        }

        .info-box {
            display: block;
            min-height: 90px;
            background: var(--admin-shell) !important;
            width: 100%;
            box-shadow: 0 8px 24px rgba(28, 25, 23, 0.12);
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid rgba(45, 106, 98, 0.14);
        }

        .info-box:hover {
            background: linear-gradient(135deg, #0f1f1c 0%, var(--admin-shell-soft) 100%) !important;
            box-shadow: 0 10px 28px rgba(45, 106, 98, 0.18);
        }

        .info-box-content {
            padding: 10px 25px;
            margin-left: 90px;
        }

        .info-box-icon {
            background: linear-gradient(135deg, var(--admin-pink) 0%, var(--admin-orange) 100%) !important;
        }

        .info-box-text {
            color: rgba(201, 161, 87, 0.95) !important;
        }

        .info-box-number {
            color: #dceee9 !important;
        }

        span.info-box-icon i {
            color: #fff !important;
        }

        span.info-box-icon i:hover {
            color: #fff7ed !important;
        }

        a.active.blk {
            color: #fff !important;
        }

        .skin-blue .sidebar-menu>li:hover>a {
            background: rgba(45, 106, 98, 0.28) !important;
        }

        .skin-blue .sidebar-menu>li>.treeview-menu {
            margin: 0 !important;
        }

        .skin-blue .sidebar-menu>li>a {
            border-left: 0 !important;
        }

        .nav-tabs-custom>.nav-tabs>li {
            border-top-width: 1px !important;
        }

        label.error {
            color: #dc3545;
            font-size: 14px;
        }

        .pagination>.active>span {
            z-index: 3;
            color: #fff !important;
            background: linear-gradient(135deg, var(--admin-pink) 0%, var(--admin-orange) 100%) !important;
            border-color: rgba(45, 106, 98, 0.45);
        }

        .pagination>.active>span:hover {
            z-index: 3;
            color: #fff !important;
            background: linear-gradient(135deg, #1a5c54 0%, #3d9a8e 100%) !important;
            border-color: rgba(26, 90, 82, 0.55);
        }

        .pagination>li>a:hover {
            z-index: 2;
            color: #fff !important;
            background: linear-gradient(135deg, var(--admin-pink-deep) 0%, #3d9a8e 100%);
            border-color: rgba(45, 106, 98, 0.4);
        }

        .pagination>li>a {
            background: #fff;
            color: var(--admin-text) !important;
        }

        /* Modal (e.g. invoice create) */
        img.modal-image {
            width: 20%;
        }

        .modal-title {
            margin: 0;
            text-align: center;
            font-weight: 800;
            color: var(--admin-text);
        }

        .modal-header {
            padding: 15px;
            background: linear-gradient(180deg, #fff 0%, var(--admin-cream) 100%);
            border-bottom: 2px solid rgba(45, 106, 98, 0.35);
        }
    </style>

    @stack('css')
</head>

<body class="hold-transition fixed skin-blue sidebar-mini">
    <div class="wrapper">
        <!--header-->
        @include('layouts.admin.header')

        <!--sidebar-->
        @include('layouts.admin.sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>
</body>

<!-- Script -->
<script src="{{ asset('admin/assets/js/jquery-2.2.4.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/select2.full.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/jscolor.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.inputmask.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.inputmask.extensions.js') }}"></script>
<script src="{{ asset('admin/assets/js/moment.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('admin/assets/js/icheck.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/fastclick.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.fancybox.pack.js') }}"></script>
<script src="{{ asset('admin/assets/js/app.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/summernote.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/demo.js') }}"></script>
<script src="{{ asset('admin/assets/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.validate.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('admin/assets/js/toastr.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/search.js') }}"></script>

<!-- Optional Bootstrap JS and dependencies -->


<script>
    @if(Session::has('message'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.success("{{ session('message') }}");
    @endif

    @if(Session::has('error'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.warning("{{ session('warning') }}");
    @endif

    (function() {
        $(function() {
            setTimeout(function() {
                var $sidebar = $('.main-sidebar .sidebar');
                if ($sidebar.length && $sidebar.parent().hasClass('slimScrollDiv')) {
                    $sidebar.parent().replaceWith($sidebar);
                }
            }, 100);
        });
    })();
</script>
@stack('js')
{{-- <script>
    // Disable right-click
    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    });

    // Disable developer tools shortcuts
    document.addEventListener('keydown', function (e) {
        // F12
        if (e.key === "F12" || e.keyCode === 123) {
            e.preventDefault();
            return false;
        }
        // Ctrl+Shift+I/J/C
        if (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J' || e.key === 'C')) {
            e.preventDefault();
            return false;
        }
        // Ctrl+U/S/P
        if (e.ctrlKey && (e.key === 'U' || e.key === 'S' || e.key === 'P')) {
            e.preventDefault();
            return false;
        }
    });

    // Disable selection & drag
    document.addEventListener('dragstart', e => e.preventDefault());
    document.addEventListener('selectstart', e => e.preventDefault());
</script> --}}


</html>