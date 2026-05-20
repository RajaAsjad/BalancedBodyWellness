@php
    use App\Support\WebsiteSeo;
@endphp
@if (WebsiteSeo::isIndexable())
    <script type="application/ld+json">{!! json_encode(WebsiteSeo::organizationJsonLd($home_page_data ?? []), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    <script type="application/ld+json">{!! json_encode(WebsiteSeo::websiteJsonLd(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endif
@stack('structured-data')
