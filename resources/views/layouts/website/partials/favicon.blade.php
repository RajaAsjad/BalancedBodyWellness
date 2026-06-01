@php
    use App\Support\WebsiteSeo;

    $faviconUrl = WebsiteSeo::faviconPublicUrl($home_page_data ?? []);
    $faviconMime = WebsiteSeo::faviconMimeFromUrl($faviconUrl);
    $isRaster = ! str_contains($faviconMime, 'svg');
@endphp
<link rel="icon" href="{{ $faviconUrl }}" @if ($faviconMime !== '') type="{{ $faviconMime }}" @endif @if ($isRaster) sizes="48x48" @else sizes="any" @endif>
@if ($isRaster)
    <link rel="icon" href="{{ $faviconUrl }}" type="{{ $faviconMime }}" sizes="192x192">
@endif
<link rel="shortcut icon" href="{{ $faviconUrl }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ $faviconUrl }}">
