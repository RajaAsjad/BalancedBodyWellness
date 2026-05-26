@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $page_meta_description)

@section('content')
    @php
        $hero = $page['hero'] ?? [];
        $overview = $page['overview'] ?? [];
        $supports = $page['supports'] ?? [];
        $dripMenu = $page['drip_menu'] ?? [];
        $serviceName = $page['name'] ?? 'Service';
    @endphp

    @include('website.partials.wellness-page-hero', [
        'hero' => $hero,
        'headingId' => 'sp-hero-heading',
        'modifier' => 'page-hero--service',
    ])

    {{-- What It Is --}}
    @if (!empty($overview))
        <section class="sp-overview" aria-labelledby="sp-overview-heading">
            <div class="sp-overview__inner container-pns">
                <div class="sp-overview__content">
                    @if (!empty($overview['label']))
                        <p class="sp-section-label">{{ $overview['label'] }}</p>
                    @endif
                    @if (!empty($overview['title']))
                        <h2 class="sp-overview__title" id="sp-overview-heading">{{ $overview['title'] }}</h2>
                    @endif
                    @foreach ($overview['paragraphs'] ?? [] as $paragraph)
                        <p class="sp-overview__text">{!! $paragraph !!}</p>
                    @endforeach
                </div>
                @if (!empty($overview['features']))
                    <div class="sp-overview__cards">
                        @foreach ($overview['features'] as $feature)
                            <article class="sp-feature-card">
                                @if (!empty($feature['title']))
                                    <h3 class="sp-feature-card__title">{{ $feature['title'] }}</h3>
                                @endif
                                @if (!empty($feature['text']))
                                    <p class="sp-feature-card__text">{{ $feature['text'] }}</p>
                                @endif
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- IV Drip Menu --}}
    @if (!empty($dripMenu))
        <section class="sp-drip-menu" aria-labelledby="sp-drip-menu-heading">
            <div class="sp-drip-menu__inner container-pns">
                @if (!empty($dripMenu['title']))
                    <h2 class="sp-drip-menu__title" id="sp-drip-menu-heading">{{ $dripMenu['title'] }}</h2>
                @endif
                @if (!empty($dripMenu['items']))
                    <div class="sp-drip-menu__grid">
                        @foreach ($dripMenu['items'] as $drip)
                            <article class="sp-drip-card">
                                @if (!empty($drip['title']))
                                    <h3 class="sp-drip-card__title">{{ $drip['title'] }}</h3>
                                @endif
                                @if (!empty($drip['text']))
                                    <p class="sp-drip-card__text">{{ $drip['text'] }}</p>
                                @endif
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- Clinical Nutrient Support / Key Ingredients --}}
    @if (!empty($supports))
        <section class="sp-supports" aria-labelledby="sp-supports-heading">
            <div class="sp-supports__inner container-pns">
                <div class="sp-supports__header">
                    @if (!empty($supports['label']))
                        <p class="sp-section-label sp-section-label--light">{{ $supports['label'] }}</p>
                    @endif
                    @if (!empty($supports['title']))
                        <h2 class="sp-supports__title" id="sp-supports-heading">{{ $supports['title'] }}</h2>
                    @endif
                    @if (!empty($supports['lead']))
                        <p class="sp-supports__lead">{{ $supports['lead'] }}</p>
                    @endif
                </div>
                @if (!empty($supports['items']))
                    <div class="sp-supports__grid">
                        @foreach ($supports['items'] as $item)
                            <article class="sp-support-card">
                                @if (!empty($item['title']))
                                    <h3 class="sp-support-card__title">{{ $item['title'] }}</h3>
                                @endif
                                @if (!empty($item['text']))
                                    <p class="sp-support-card__text">{{ $item['text'] }}</p>
                                @endif
                            </article>
                        @endforeach
                    </div>
                @endif
                @if (!empty($supports['stats']))
                    <div class="sp-stats" role="list" aria-label="Treatment highlights">
                        @foreach ($supports['stats'] as $stat)
                            <div class="sp-stats__item" role="listitem">
                                @if (!empty($stat['value']))
                                    <span class="sp-stats__value{{ !empty($stat['serif']) ? ' sp-stats__value--serif' : '' }}">{{ $stat['value'] }}</span>
                                @endif
                                @if (!empty($stat['label']))
                                    <span class="sp-stats__label">{{ $stat['label'] }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endif

    @include('website.partials.page-faqs', [
        'pageKey' => 'service-detail',
        'serviceSlug' => $slug,
        'sectionTitle' => 'Questions about ' . $serviceName,
    ])

    @include('website.partials.book-your-visit')
@endsection
