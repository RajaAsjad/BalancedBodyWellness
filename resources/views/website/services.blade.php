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
                        ['title' => 'High Dose Glutathione', 'desc' => 'Decreases inflammation and supports detoxification.', 'icon' => 'glutathione'],
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

    <section class="services-section vitamin-injections--quick-boost" aria-labelledby="quick-boost-injections-heading">
        <div class="container-pns">
            <header class="vitamin-injections__header">
                <p class="vitamin-injections__eyebrow">
                    <span class="vitamin-injections__eyebrow-icon" aria-hidden="true">
                        @include('website.partials.syringe-icon', ['size' => 16])
                    </span>
                    <span class="vitamin-injections__eyebrow-text">Wellness injections</span>
                </p>
                <h2 class="vitamin-injections__title" id="quick-boost-injections-heading">Quick Boost Injections</h2>
            </header>

            <div class="vitamin-injections__grid vitamin-injections__grid--quad" role="list">
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

    <section class="vitamin-injections" aria-labelledby="vitamin-injections-heading">
        <div class="container-pns">
            <header class="vitamin-injections__header">
                <p class="vitamin-injections__eyebrow">
                    <span class="vitamin-injections__eyebrow-icon" aria-hidden="true">
                        @include('website.partials.syringe-icon', ['size' => 16])
                    </span>
                    <span class="vitamin-injections__eyebrow-text">Wellness injections</span>
                </p>
                <h2 class="vitamin-injections__title" id="vitamin-injections-heading">IM Injections</h2>
            </header>

            <div class="vitamin-injections__tier">
                <header class="vitamin-injections__tier-header">
                    <h3 class="vitamin-injections__tier-title" id="standard-im-injections-heading">⭐ Standard IM Injections</h3>
                    <p class="vitamin-injections__tier-lede">Foundational wellness boosters for everyday vitality.</p>
                </header>

                <div class="vitamin-injections__grid" role="list" aria-labelledby="standard-im-injections-heading">
                    @php
                        $standardInjections = [
                            ['title' => 'B12 — Energy & Mood Support', 'desc' => 'A fast acting boost that supports natural energy, mood balance, and mental clarity while helping reduce fatigue.'],
                            ['title' => 'B Complex — Energy & Stress Relief', 'desc' => 'A blend of essential B vitamins that enhances metabolism, supports the nervous system, and improves stress resilience.'],
                            ['title' => 'Vitamin D — Immunity & Bone Health', 'desc' => 'Supports immune strength, mood balance, and calcium absorption for bone health and overall vitality.'],
                            ['title' => 'Biotin — Hair, Skin & Nail Support', 'desc' => 'Promotes stronger hair and nails, supports healthy skin, and aids metabolic function.'],
                            ['title' => 'L Carnitine — Fat Metabolism & Energy', 'desc' => 'Enhances fat burning, boosts energy, and supports heart and muscle health.'],
                            ['title' => 'Lipo (MIC) — Metabolism Support', 'desc' => 'Supports fat metabolism, liver detoxification, and energy production — a favorite for weight loss programs.'],
                            ['title' => 'Chromium', 'desc' => 'Supports healthy blood sugar metabolism and appetite regulation.'],
                            ['title' => 'Glutathione — Antioxidant & Detox', 'desc' => 'A master antioxidant that supports detoxification, brightens the skin, and reduces oxidative stress.'],
                            ['title' => 'Toradol — Anti Inflammatory Relief', 'desc' => 'Helps reduce pain, inflammation, and headaches when clinically appropriate.'],
                            ['title' => 'Zofran — Anti Nausea Support', 'desc' => 'Provides relief from nausea and vomiting, ideal for motion sickness, migraines, or pregnancy.'],
                        ];
                    @endphp

                    @foreach ($standardInjections as $inj)
                        <article class="inject-card reveal" role="listitem">
                            <div class="inject-card__icon" aria-hidden="true">
                                @include('website.partials.syringe-icon', ['size' => 20, 'class' => 'inject-card__syringe'])
                            </div>
                            <h4 class="inject-card__title">{{ $inj['title'] }}</h4>
                            <p class="inject-card__desc">{{ $inj['desc'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>

            <div class="vitamin-injections__tier vitamin-injections__tier--premium">
                <header class="vitamin-injections__tier-header">
                    <h3 class="vitamin-injections__tier-title" id="premium-im-injections-heading">💎 Premium IM Injections</h3>
                    <p class="vitamin-injections__tier-lede">Advanced, high value boosters for elevated wellness.</p>
                </header>

                <div class="vitamin-injections__grid" role="list" aria-labelledby="premium-im-injections-heading">
                    @php
                        $premiumInjections = [
                            ['title' => 'NAD+ IM — Cellular Energy & Anti Aging', 'desc' => 'Supports mitochondrial function, brain clarity, metabolism, and longevity. Ideal for fatigue, brain fog, and anti aging support.'],
                            ['title' => 'CoQ10 IM — Heart & Cellular Energy', 'desc' => 'Boosts cellular energy, supports cardiovascular health, and reduces inflammation — especially beneficial for clients on statins.'],
                            ['title' => 'ALA IM — Antioxidant & Nerve Support', 'desc' => 'A powerful antioxidant that supports nerve health, blood sugar balance, and detoxification.'],
                            ['title' => 'Amino Blend — Performance & Recovery', 'desc' => 'Supports muscle recovery, joint health, and physical performance — ideal for active lifestyles.'],
                            ['title' => 'Tri Immune Blend — Immunity & Vitality', 'desc' => 'A powerful combination of Glutathione, Vitamin C, and Zinc to strengthen immunity and reduce inflammation.'],
                            ['title' => 'L Carnitine + B12 Combo — Metabolism & Energy', 'desc' => 'A dual action metabolic and energy booster for clients seeking fat burning and stamina support.'],
                            ['title' => 'Biotin + B Complex Combo — Beauty & Vitality', 'desc' => 'A beauty focused blend that supports hair, skin, nails, energy, and mood.'],
                            ['title' => 'Glutathione IM — Detox & Skin Brightening', 'desc' => 'Advanced antioxidant therapy for detoxification, liver support, and complexion enhancement.'],
                        ];
                    @endphp

                    @foreach ($premiumInjections as $inj)
                        <article class="inject-card inject-card--premium reveal" role="listitem">
                            <div class="inject-card__icon" aria-hidden="true">
                                @include('website.partials.syringe-icon', ['size' => 20, 'class' => 'inject-card__syringe'])
                            </div>
                            <h4 class="inject-card__title">{{ $inj['title'] }}</h4>
                            <p class="inject-card__desc">{{ $inj['desc'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
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
    @include('website.partials.page-faqs', [
        'pageKey' => 'services',
        'sectionTitle' => 'Service questions',
        'sectionNote' => 'Common questions about our IV drips, peptides, and injections.',
    ])

    @include('website.partials.book-your-visit')
@endsection
