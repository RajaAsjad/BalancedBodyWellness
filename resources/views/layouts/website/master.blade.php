<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @include('layouts.website.partials.seo-head')
    @php
        $fav = trim($home_page_data['header_favicon'] ?? '');
    @endphp
    @if ($fav !== '')
        <link rel="apple-touch-icon" sizes="180x180"
            href="{{ asset('admin/assets/images/page/' . $fav) }}">
        <link rel="icon" href="{{ asset('admin/assets/images/page/' . $fav) }}" type="image/png"
            sizes="32x32">
    @else
        {{-- Default tab / PWA icon: LA mark (matches nav fallback when no admin favicon) --}}
        <link rel="icon" href="{{ asset('assets/website/favicon-la.svg') }}" type="image/svg+xml"
            sizes="any">
        <link rel="apple-touch-icon" href="{{ asset('assets/website/favicon-la.svg') }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/website/css/portfolio.css') }}">
    @stack('styles')
    @include('layouts.website.partials.structured-data')
</head>

<body @if (request()->routeIs('index')) data-nav-hash-root @endif>
    @include('layouts.website.header')

    <main id="main">
        @yield('content')
    </main>

    @include('layouts.website.footer')

    <script src="{{ asset('assets/website/js/portfolio.js') }}" defer></script>
    @stack('js')
</body>

</html>
