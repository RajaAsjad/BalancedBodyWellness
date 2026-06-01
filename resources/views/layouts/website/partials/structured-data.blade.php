@php
    use App\Support\WebsiteSeo;
@endphp
@if (WebsiteSeo::isIndexable())
    @php $homeSeo = $home_page_data ?? []; @endphp
    <script type="application/ld+json">{!! json_encode(WebsiteSeo::websiteJsonLd(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    <script type="application/ld+json">{!! json_encode(WebsiteSeo::organizationJsonLd($homeSeo), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    <script type="application/ld+json">{!! json_encode(WebsiteSeo::localBusinessJsonLd($homeSeo), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endif
@stack('structured-data')
