@php
    use App\Support\WebsiteSeo;

    $seoTitle = WebsiteSeo::pageTitle(trim($__env->yieldContent('title')));
    $seoDescription = WebsiteSeo::metaDescription(trim($__env->yieldContent('meta_description')));
    $seoCanonical = WebsiteSeo::canonicalUrl(trim($__env->yieldContent('canonical')));
    $seoRobots = WebsiteSeo::robotsDirective(trim($__env->yieldContent('meta_robots')));
    $seoOgImage = WebsiteSeo::ogImageUrl($home_page_data ?? []);
    $seoSiteName = WebsiteSeo::siteName();
    $seoTwitter = trim((string) config('seo.twitter_handle'));
    $seoLocale = (string) config('seo.locale', 'en_US');
@endphp
<meta name="description" content="{{ $seoDescription }}">
<meta name="robots" content="{{ $seoRobots }}">
<meta name="googlebot" content="{{ $seoRobots }}">
<link rel="canonical" href="{{ $seoCanonical }}">
<meta property="og:type" content="website">
<meta property="og:locale" content="{{ $seoLocale }}">
<meta property="og:site_name" content="{{ $seoSiteName }}">
<meta property="og:title" content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDescription }}">
<meta property="og:url" content="{{ $seoCanonical }}">
<meta property="og:image" content="{{ $seoOgImage }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoTitle }}">
<meta name="twitter:description" content="{{ $seoDescription }}">
<meta name="twitter:image" content="{{ $seoOgImage }}">
@if ($seoTwitter !== '')
    <meta name="twitter:site" content="{{ $seoTwitter }}">
@endif
@yield('seo_extra')
