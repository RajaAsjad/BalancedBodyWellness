@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $page_meta_description)

@section('content')
    @php
        $hero = $page['hero'] ?? [];
        $welcome = $page['welcome'] ?? null;
        $process = $page['process'] ?? null;
        $locationName = $page['name'] ?? 'Location';
    @endphp

    @include('website.partials.wellness-page-hero', [
        'hero' => $hero,
        'eyebrow' => $hero['eyebrow'] ?? null,
        'lead' => $hero['lead'] ?? null,
        'headingId' => 'location-hero-heading',
        'modifier' => 'page-hero--location page-hero--location-landing',
    ])

    @if (!empty($welcome))
        <section class="loc-welcome" aria-labelledby="loc-welcome-heading">
            <div class="loc-welcome__inner container-pns">
                <div class="loc-welcome__content">
                    @if (!empty($welcome['label']))
                        <p class="loc-section-label">{{ $welcome['label'] }}</p>
                    @endif
                    @if (!empty($welcome['title']))
                        <h2 class="loc-welcome__title" id="loc-welcome-heading">{{ $welcome['title'] }}</h2>
                    @endif
                    @foreach ($welcome['paragraphs'] ?? [] as $paragraph)
                        <p class="loc-welcome__text">{!! $paragraph !!}</p>
                    @endforeach
                    @if (!empty($welcome['highlights']))
                        <ul class="loc-welcome__highlights">
                            @foreach ($welcome['highlights'] as $highlight)
                                <li>{{ $highlight }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                @if (!empty($welcome['services']))
                    <div class="loc-welcome__cards">
                        @foreach ($welcome['services'] as $service)
                            <article class="loc-service-card">
                                @if (!empty($service['title']))
                                    <h3 class="loc-service-card__title">{{ $service['title'] }}</h3>
                                @endif
                                @if (!empty($service['text']))
                                    <p class="loc-service-card__text">{{ $service['text'] }}</p>
                                @endif
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endif

    @if (!empty($process))
        <section class="loc-process" aria-labelledby="loc-process-heading">
            <div class="loc-process__inner container-pns">
                <header class="loc-process__header">
                    @if (!empty($process['label']))
                        <p class="loc-section-label">{{ $process['label'] }}</p>
                    @endif
                    @if (!empty($process['title']))
                        <h2 class="loc-process__title" id="loc-process-heading">{{ $process['title'] }}</h2>
                    @endif
                </header>
                @if (!empty($process['items']))
                    <div class="loc-process__grid">
                        @foreach ($process['items'] as $item)
                            <article class="loc-process-card">
                                @if (!empty($item['title']))
                                    <h3 class="loc-process-card__title">{{ $item['title'] }}</h3>
                                @endif
                                @if (!empty($item['text']))
                                    <p class="loc-process-card__text">{{ $item['text'] }}</p>
                                @endif
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endif

    @include('website.partials.page-faqs', [
        'pageKey' => 'location-detail',
        'locationSlug' => $slug,
        'sectionTitle' => 'Questions about visiting ' . $locationName,
    ])

    @include('website.partials.book-your-visit')
@endsection
