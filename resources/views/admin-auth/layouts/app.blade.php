<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Admin') — Balanced Body Wellness</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    @php
        $authFav = $home_page_data['header_favicon'] ?? '';
    @endphp
    @if (!empty($authFav))
        <link rel="icon" href="{{ asset('admin/assets/images/page/' . $authFav) }}" type="image/png"
            sizes="16x16">
    @endif
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="theme-color" content="#1a3f3c">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/toastr.min.css') }}">
    <style>
        /* Admin auth — wellness photo backdrop + glass card */
        :root {
            --auth-input-bg: #f7f5f0;
            --auth-card-tint: rgba(255, 255, 255, 0.93);
            --auth-brand-500: #2d6a62;
            --auth-brand-600: #1a5c54;
            --auth-brand-deep: #143d38;
            --auth-accent: #4a9a8e;
            --auth-mint: #3d9a8e;
            --auth-text: #1d2b33;
            --auth-muted: #5f6f68;
            --auth-border: rgba(45, 106, 98, 0.2);
            --auth-gold: #c4a35a;
            --auth-gold-soft: rgba(196, 163, 90, 0.35);
            --auth-font-display: 'Playfair Display', Georgia, serif;
            --auth-font-body: 'Poppins', system-ui, sans-serif;
        }

        /* AdminLTE sets `.login-page{background:#d2d6de}` — override + full-bleed backdrop layer */
        body.hold-transition.login-page.sidebar-mini,
        body.hold-transition.login-page,
        body.login-page {
            position: relative;
            margin: 0 !important;
            min-height: 100vh !important;
            background: transparent !important;
            font-family: var(--auth-font-body);
            color: var(--auth-text);
        }

        body.login-page::before {
            content: '';
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background-color: #142825;
            background-image:
                linear-gradient(168deg, rgba(18, 42, 38, 0.88) 0%, rgba(45, 106, 98, 0.52) 38%, rgba(12, 32, 30, 0.9) 100%),
                url("{{ asset('assets/admin/auth-background.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        @media (max-width: 768px) {
            body.login-page::before {
                background-attachment: scroll;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            body.login-page::before {
                background-attachment: scroll;
            }
        }

        body.login-page::after {
            display: none !important;
        }

        .admin-auth-portal,
        body.login-page > .login-box {
            position: relative;
            z-index: 1;
        }

        .admin-auth-portal {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: clamp(1rem, 4vw, 2.5rem) 1rem;
        }

        .admin-auth-layout {
            width: 100%;
            max-width: 440px;
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 1.25rem;
        }

        .admin-auth-card {
            position: relative;
            width: 100%;
            background: var(--auth-card-tint);
            border: 1px solid rgba(255, 255, 255, 0.55);
            border-radius: 22px;
            box-shadow:
                0 4px 6px -1px rgba(0, 0, 0, 0.08),
                0 24px 48px -12px rgba(15, 40, 36, 0.45),
                0 0 0 1px rgba(45, 106, 98, 0.06) inset;
            padding: clamp(1.5rem, 4vw, 2.15rem) clamp(1.35rem, 4vw, 2rem) 2rem;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }

        .admin-auth-card::before {
            content: '';
            position: absolute;
            left: 1.25rem;
            right: 1.25rem;
            top: 0;
            height: 3px;
            border-radius: 0 0 4px 4px;
            background: linear-gradient(90deg, var(--auth-brand-500), var(--auth-gold), var(--auth-mint));
            opacity: 0.95;
        }

        .admin-auth-card__header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1.2rem;
            border-bottom: 1px solid rgba(45, 106, 98, 0.1);
        }

        .admin-auth-card__mark {
            width: 52px;
            height: 52px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--auth-font-display);
            font-weight: 800;
            font-size: 0.95rem;
            letter-spacing: 0.02em;
            color: #fff;
            border-radius: 14px;
            background: linear-gradient(145deg, var(--auth-brand-deep) 0%, var(--auth-brand-500) 42%, var(--auth-mint) 100%);
            box-shadow:
                0 4px 14px rgba(45, 106, 98, 0.35),
                0 0 0 1px rgba(255, 255, 255, 0.12) inset;
        }

        .admin-auth-card__name {
            font-family: var(--auth-font-display);
            font-size: clamp(1.2rem, 3.5vw, 1.45rem);
            font-weight: 800;
            color: var(--auth-text);
            letter-spacing: -0.02em;
            margin: 0 0 0.25rem;
            line-height: 1.2;
        }

        .admin-auth-card__panel {
            margin: 0;
            font-size: 0.8125rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--auth-brand-500);
        }

        .admin-auth-card__tagline {
            margin: 0.35rem 0 0;
            font-size: 0.8125rem;
            font-weight: 400;
            color: var(--auth-muted);
            line-height: 1.45;
        }

        .admin-auth-form {
            margin: 0;
        }

        .admin-auth-field {
            margin-bottom: 1.15rem;
        }

        .admin-auth-label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--auth-text);
            margin-bottom: 0.4rem;
        }

        .admin-auth-input {
            width: 100%;
            padding: 0.72rem 1rem;
            font-size: 0.9375rem;
            font-family: var(--auth-font-body);
            border: 1px solid rgba(45, 106, 98, 0.22);
            border-radius: 12px;
            background-color: var(--auth-input-bg) !important;
            color: var(--auth-text);
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
        }

        .admin-auth-input::placeholder {
            color: #8b9199;
        }

        .admin-auth-input:hover {
            border-color: rgba(45, 106, 98, 0.32);
        }

        .admin-auth-input:focus {
            outline: none;
            border-color: var(--auth-brand-500);
            box-shadow: 0 0 0 3px rgba(45, 106, 98, 0.18);
            background-color: #fff !important;
        }

        /* Chrome / Edge autofill — keep warm cream instead of bright blue */
        .admin-auth-input:-webkit-autofill,
        .admin-auth-input:-webkit-autofill:hover,
        .admin-auth-input:-webkit-autofill:focus {
            -webkit-text-fill-color: var(--auth-text);
            caret-color: var(--auth-text);
            box-shadow: 0 0 0 1000px var(--auth-input-bg) inset !important;
            transition: background-color 99999s ease-out 0s;
        }

        .admin-auth-input:-webkit-autofill:focus {
            box-shadow: 0 0 0 1000px #fff inset, 0 0 0 3px rgba(45, 106, 98, 0.18) !important;
        }

        .admin-auth-error {
            display: block;
            font-size: 0.78rem;
            color: #b91c1c;
            margin-top: 0.35rem;
        }

        .admin-auth-options {
            margin: 0.15rem 0 1.35rem;
        }

        .admin-auth-remember {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8125rem;
            color: var(--auth-muted);
            cursor: pointer;
            user-select: none;
            margin: 0;
        }

        .admin-auth-remember input {
            width: 1.05rem;
            height: 1.05rem;
            accent-color: var(--auth-brand-500);
            cursor: pointer;
        }

        .admin-auth-submit {
            width: 100%;
            padding: 0.82rem 1.1rem;
            font-family: var(--auth-font-body);
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.03em;
            color: #fff;
            border: none;
            border-radius: 9999px;
            cursor: pointer;
            background: linear-gradient(135deg, var(--auth-brand-600) 0%, var(--auth-brand-500) 40%, var(--auth-accent) 100%);
            box-shadow:
                0 4px 16px rgba(45, 106, 98, 0.38),
                0 0 0 1px rgba(255, 255, 255, 0.12) inset;
            transition: transform 0.18s ease, box-shadow 0.22s ease, filter 0.2s ease;
        }

        .admin-auth-submit:hover {
            filter: brightness(1.05);
            transform: translateY(-2px);
            box-shadow:
                0 10px 28px rgba(45, 106, 98, 0.42),
                0 0 0 1px rgba(196, 163, 90, 0.35) inset;
        }

        .admin-auth-submit:active {
            transform: translateY(0);
        }

        .admin-auth-submit:focus {
            outline: none;
            box-shadow:
                0 0 0 3px var(--auth-gold-soft),
                0 8px 22px rgba(45, 106, 98, 0.4);
        }

        @media (max-width: 400px) {
            .admin-auth-card__mark {
                width: 46px;
                height: 46px;
                font-size: 0.85rem;
            }
        }

        /* Forgot password / change password (AdminLTE .login-box) */
        .login-page .login-box {
            width: 100%;
            max-width: 440px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .login-page .login-box .login-logo {
            color: #fff;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.35);
            font-family: var(--auth-font-display);
            text-align: center;
            margin-bottom: 1rem;
        }

        .login-page .login-box-body {
            background: var(--auth-card-tint);
            border: 1px solid rgba(255, 255, 255, 0.55);
            border-radius: 22px;
            padding: 1.5rem 1.35rem;
            box-shadow:
                0 24px 48px -12px rgba(15, 40, 36, 0.45),
                0 0 0 1px rgba(45, 106, 98, 0.06) inset;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }
    </style>
    @stack('styles')
    @stack('css')
</head>

<body class="hold-transition login-page sidebar-mini">

    @yield('content')

    <script src="{{ asset('admin/assets/js/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.inputmask.extensions.js') }}"></script>
    <script src="{{ asset('admin/assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('admin/assets/js/icheck.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/fastclick.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/demo.js') }}"></script>
    <script src="{{ asset('admin/assets/js/toastr.min.js') }}"></script>
    <script>
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
    @stack('scripts')
    @stack('js')
</body>

</html>
