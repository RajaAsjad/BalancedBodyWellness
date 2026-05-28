@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $page_meta_description)
@section('content')
    <section class="page-hero page-hero--wellness" aria-labelledby="services-hero-heading">
        <div class="container-pns">
            <p class="page-hero__eyebrow">Our menu</p>
            <h1 class="page-hero__title" id="services-hero-heading">Treatments tailored to you.</h1>
            <p class="page-hero__note">Pricing discussed at consultation. All services require medical clearance. Payment in person.</p>
        </div>
    </section>

    <section class="drip-menu" aria-labelledby="drip-menu-heading">
        <div class="container-pns">
            <header class="drip-menu__header">
                <div class="drip-menu__intro">
                    <p class="drip-menu__eyebrow">IV hydration drips</p>
                    <h2 class="drip-menu__title" id="drip-menu-heading">The Drip Menu</h2>
                </div>
                <p class="drip-menu__lede">11 thoughtfully formulated IV blends. Sessions typically 60–90 minutes.</p>
            </header>

            <div class="drip-menu__grid" role="list">
                @php
                    $drips = [
                        ['title' => 'Energy Boost', 'desc' => 'B-complex, B12, amino acids and electrolytes to restore vitality and combat fatigue.', 'icon' => 'zap'],
                        ['title' => 'Immunity Defense', 'desc' => 'High-dose vitamin C, zinc and minerals to strengthen your immune response.', 'icon' => 'shield'],
                        ['title' => 'Beauty Glow', 'desc' => 'Glutathione, biotin and vitamin C for radiant skin, hair and nails.', 'icon' => 'sparkles'],
                        ['title' => 'Recovery & Performance', 'desc' => 'Amino acids and electrolytes to support muscle recovery and athletic output.', 'icon' => 'heart-pulse'],
                        ['title' => 'Hangover Relief', 'desc' => 'Rapid rehydration with anti-nausea and anti-inflammatory support.', 'icon' => 'sun'],
                        ['title' => 'Mental Clarity', 'desc' => 'Magnesium, taurine and B-vitamins to support focus and reduce mental fog.', 'icon' => 'brain'],
                        ['title' => "Myers' Cocktail", 'desc' => 'The classic blend of vitamins and minerals for overall wellness and energy.', 'icon' => 'dumbbell'],
                        ['title' => 'Anti-Aging', 'desc' => 'NAD+ adjuncts, glutathione and antioxidants to support cellular longevity.', 'icon' => 'vial'],
                        ['title' => 'Pure Hydration', 'desc' => 'Sterile saline + electrolytes for fast, deep hydration.', 'icon' => 'droplet'],
                        ['title' => 'Migraine Relief', 'desc' => 'Magnesium, B2 and anti-inflammatory support to ease tension and migraines.', 'icon' => 'pulse'],
                        ['title' => 'Detox & Reset', 'desc' => 'Glutathione-forward blend to support natural detox pathways.', 'icon' => 'leaf'],
                    ];
                @endphp

                @foreach ($drips as $drip)
                    <article class="drip-card reveal" role="listitem">
                        <div class="drip-card__icon" aria-hidden="true">
                            @include('website.partials.drip-icon', ['icon' => $drip['icon']])
                        </div>
                        <h3 class="drip-card__title">{{ $drip['title'] }}</h3>
                        <p class="drip-card__desc">{{ $drip['desc'] }}</p>
                    </article>
                @endforeach
            </div>

        </div>
    </section>

    <section class="services-section peptide-therapy--services" aria-labelledby="peptide-therapy-heading">
        <div class="container-pns">
            <header class="peptide-therapy__header">
                <p class="peptide-therapy__eyebrow">
                    <span class="peptide-therapy__eyebrow-icon" aria-hidden="true">
                        @include('website.partials.peptide-pill-icon', ['size' => 18])
                    </span>
                    <span class="peptide-therapy__eyebrow-text">Common nutrients</span>
                </p>
                <h2 class="peptide-therapy__title" id="peptide-therapy-heading">Common Nutrients</h2>  
                <p class="peptide-therapy__sub">Common nutrients that are used in our services.</p>
            </header>

            @if ($services->isEmpty())
                <p class="services__empty">Services will be published soon. Please check back or contact us to learn more.</p>
            @else
            <div class="services__grid" role="list">
                @foreach ($services as $service)
                    @php
                        $benefitItems = $service->displayList('benefits');
                        $questionItems = $service->displayList('questions');
                        $serviceSlug = \Illuminate\Support\Str::slug($service->heading);
                    @endphp
                    <article class="service-tab-card reveal" role="listitem" data-service-tab-card> 
                        <h3 class="service-tab-card__title">
                            <a href="{{ route('service.detail', $serviceSlug) }}" class="service-tab-card__title-link">{{ $service->heading }}</a>
                        </h3>

                        <div class="service-tab-card__tabs" role="tablist" aria-label="{{ $service->heading }} details">
                            <button type="button" class="service-tab-card__tab is-active service-tab-card__tab--alt" role="tab" aria-selected="true" data-service-tab="description">Description</button>
                            <button type="button" class="service-tab-card__tab service-tab-card__tab--alt" role="tab" aria-selected="false" data-service-tab="benefits">Benefits</button>
                            <button type="button" class="service-tab-card__tab service-tab-card__tab--alt" role="tab" aria-selected="false" data-service-tab="questions">Is it right for you?</button>
                        </div>

                        <div class="service-tab-card__panels">
                            <div class="service-tab-card__panel is-active" role="tabpanel" data-service-panel="description">
                                <div class="service-tab-card__text">
                                    {!! nl2br(e($service->description)) !!}
                                </div>
                            </div>
                            <div class="service-tab-card__panel" role="tabpanel" data-service-panel="benefits" hidden>
                                @if (count($benefitItems))
                                    <ul class="service-tab-card__list">
                                        @foreach ($benefitItems as $benefit)
                                            <li>{!! nl2br(e($benefit)) !!}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="service-tab-card__empty">Benefits information coming soon.</p>
                                @endif
                            </div>
                            <div class="service-tab-card__panel" role="tabpanel" data-service-panel="questions" hidden>
                                @if (count($questionItems))
                                    <ul class="service-tab-card__list service-tab-card__list--questions">
                                        @foreach ($questionItems as $question)
                                            <li>{!! nl2br(e($question)) !!}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="service-tab-card__empty">Ask our team during your consultation—we will help you decide if this service fits your goals.</p>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            @endif
        </div>
    </section>
    <section class="peptide-therapy" aria-labelledby="peptide-therapy-heading">
        <div class="container-pns">
            <header class="peptide-therapy__header">
                <p class="peptide-therapy__eyebrow">
                    <span class="peptide-therapy__eyebrow-icon" aria-hidden="true">
                        @include('website.partials.syringe-icon', ['size' => 18])
                    </span>
                    <span class="peptide-therapy__eyebrow-text">Peptide therapy</span>
                </p>
                <h2 class="peptide-therapy__title" id="peptide-therapy-heading">Targeted Peptide Protocols</h2>
                <p class="peptide-therapy__sub">Programs are individualized after consultation and medical screening.</p>
            </header>

            <div class="peptide-therapy__grid" role="list">
                @php
                    $peptides = [
                        ['title' => 'BPC-157', 'desc' => 'Supports tissue repair, gut health and recovery.'],
                        ['title' => 'Sermorelin', 'desc' => 'Stimulates natural growth hormone production for sleep, recovery and vitality.'],
                        ['title' => 'GLP-1 Programs', 'desc' => 'Medically supervised metabolic support for weight & appetite goals.'],
                        ['title' => 'Thymosin Alpha-1', 'desc' => 'Immune modulation and resilience support.'],
                        ['title' => 'TB-500', 'desc' => 'Promotes faster muscle and tissue recovery, hair growth, helps reduce inflammation, and supports healing after injuries or intense physical activity.'],
                        ['title' => 'PTD-DBM', 'desc' => 'May support cellular regeneration, tissue repair, hair growth, and overall recovery while promoting healthy inflammatory response.'],
                        ['title' => 'GHK-CU', 'desc' => 'Copper peptide known for skin rejuvenation, collagen production, improved hair health, and enhanced wound healing.'],
                        ['title' => 'Tesamorelin', 'desc' => 'Growth hormone-releasing peptide commonly used to help improve body composition, reduce abdominal fat, and support recovery and energy levels.'],
                        ['title' => 'MOTS-C', 'desc' => 'Mitochondrial peptide designed to enhance metabolism, improve energy production, support fat utilization, and promote exercise performance.'],
                        ['title' => 'CJC-1295', 'desc' => 'Long-acting growth hormone peptide that may help improve sleep quality, muscle recovery, lean muscle development, and overall vitality.'],
                    ];
                @endphp

                @foreach ($peptides as $peptide)
                    <article class="peptide-card reveal" role="listitem">
                        <div class="peptide-card__icon-wrap" aria-hidden="true">
                            @include('website.partials.syringe-icon', ['size' => 20, 'class' => 'peptide-card__pill'])
                        </div>
                        <div class="peptide-card__body">
                            <h3 class="peptide-card__title">{{ $peptide['title'] }}</h3>
                            <p class="peptide-card__desc">{{ $peptide['desc'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="vitamin-injections" aria-labelledby="vitamin-injections-heading">
        <div class="container-pns">
            <header class="vitamin-injections__header">
                <p class="vitamin-injections__eyebrow">
                    <span class="vitamin-injections__eyebrow-icon" aria-hidden="true">
                        @include('website.partials.syringe-icon', ['size' => 16])
                    </span>
                    <span class="vitamin-injections__eyebrow-text">Wellness injections</span>
                </p>
                <h2 class="vitamin-injections__title" id="vitamin-injections-heading">Quick Boost Injections</h2>
            </header>

            <div class="vitamin-injections__grid" role="list">
                @php
                    $injections = [
                        ['title' => 'Vitamin B12', 'desc' => 'Energy, mood and metabolic support in minutes.'],
                        ['title' => 'MIC / Lipo-Mino', 'desc' => 'Methionine, inositol & choline to support fat metabolism.'],
                        ['title' => 'Glutathione', 'desc' => "The body's master antioxidant for skin, liver and detox."],
                        ['title' => 'Vitamin D3', 'desc' => 'Immune, mood and bone health support.'],
                    ];
                @endphp

                @foreach ($injections as $inj)
                    <article class="inject-card reveal" role="listitem">
                        <div class="inject-card__icon" aria-hidden="true">
                            @include('website.partials.syringe-icon', ['size' => 20, 'class' => 'inject-card__syringe'])
                        </div>
                        <h3 class="inject-card__title">{{ $inj['title'] }}</h3>
                        <p class="inject-card__desc">{{ $inj['desc'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    @include('website.partials.page-faqs', [
        'pageKey' => 'services',
        'sectionTitle' => 'Service questions',
        'sectionNote' => 'Common questions about our IV drips, peptides, and injections.',
    ])

    @include('website.partials.book-your-visit')
@endsection
