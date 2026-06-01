<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @include('layouts.website.partials.seo-head')
    @include('layouts.website.partials.analytics-head')
    @include('layouts.website.partials.favicon')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/website/css/portfolio.css') }}">
    @stack('styles')
    @include('layouts.website.partials.structured-data')
</head>

<body @if (request()->routeIs('index')) data-nav-hash-root @endif>
    @if (trim((string) config('seo.gtm_container_id')) !== '')
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id={{ config('seo.gtm_container_id') }}"
                height="0" width="0" style="display:none;visibility:hidden" title="Google Tag Manager"></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endif
    @include('layouts.website.header')

    <main id="main">
        @yield('content')
    </main>

    @include('layouts.website.footer')

    <script src="{{ asset('assets/website/js/portfolio.js') }}" defer></script>
    @stack('js')
</body>

</html>
