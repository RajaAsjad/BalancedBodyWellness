@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $page_meta_description)

@section('content')
    @php
        $hp = config('home_page');
    @endphp

    {{-- Hero --}}
    <section class="hero hero--wellness hero--wellness-dark" aria-label="Hero section">
        <div class="hero__bg" aria-hidden="true"><div class="hero-w__gradient hero-w__gradient--dark"></div></div>
        <div class="hero__inner hero__inner--wide">
            <div class="hero__content">
                @if (!empty($hp['hero']['eyebrow']))
                    <p class="hero-w__eyebrow hero-w__eyebrow--plain">{{ $hp['hero']['eyebrow'] }}</p>
                @endif
                <h1 class="hero-w__title hero-w__title--dark">
                    <span class="hero-w__title-line"><em class="hero-w__title-accent hero-w__title-accent--gold">Restore</em> your balance</span>
                    <span class="hero-w__title-line">with IV Therapy</span>
                    <span class="hero-w__title-line">NYC,</span>
                    <span class="hero-w__title-line">from the inside out.</span>
                </h1>
                @if (!empty($hp['hero']['lead']))
                    <p class="hero-w__lead hero-w__lead--dark">{{ $hp['hero']['lead'] }}</p>
                @endif
                <div class="hero__ctas hero-w__ctas">
                    <a href="{{ url('/contact') }}" class="btn btn--gold btn--lg">Book a Consultation</a>
                    <a href="{{ url('/services') }}" class="btn btn--ghost-light btn--lg">Explore Services</a>
                </div>
                @if (!empty($hp['hero']['footnote']))
                    <p class="hero-w__footnote hero-w__footnote--dark">{{ $hp['hero']['footnote'] }}</p>
                @endif
            </div>
            @if (!empty($hp['hero']['why_choose']))
                <aside class="hero-w__why" aria-labelledby="why-choose-heading">
                    <h2 class="hero-w__why-title" id="why-choose-heading">Why Choose Balanced Body</h2>
                    <ul class="hero-w__why-list">
                        @foreach ($hp['hero']['why_choose'] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </aside>
            @endif
        </div>
    </section>

    {{-- About --}}
    <section class="hp-about" id="about" aria-labelledby="hp-about-heading">
        <div class="hp-about__inner container-pns">
            <div class="hp-about__content">
                @if (!empty($hp['about']['label']))
                    <p class="hp-section-label">{{ $hp['about']['label'] }}</p>
                @endif
                @if (!empty($hp['about']['title']))
                    <h2 class="hp-about__title" id="hp-about-heading">{{ $hp['about']['title'] }}</h2>
                @endif
                @foreach ($hp['about']['paragraphs'] ?? [] as $paragraph)
                    <p class="hp-about__text">{{ $paragraph }}</p>
                @endforeach
                <a href="{{ url('/contact') }}" class="btn btn--wellness-primary hp-about__btn">Schedule a Consultation</a>
            </div>
            @if (!empty($hp['about']['stats']))
                <div class="hp-about__stats" role="list">
                    @foreach ($hp['about']['stats'] as $stat)
                        <article class="hp-about__stat" role="listitem">
                            <p class="hp-about__stat-value">{{ $stat['value'] }}</p>
                            <p class="hp-about__stat-label">{{ $stat['label'] }}</p>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Services --}}
    <section class="hp-services" id="services" aria-labelledby="hp-services-heading">
        <div class="hp-services__inner container-pns">
            <div class="hp-services__grid">
                @foreach ($hp['services'] ?? [] as $service)
                    <article class="hp-service-card reveal">
                        @if (!empty($service['icon']))
                            <div class="hp-service-card__icon" aria-hidden="true">{{ $service['icon'] }}</div>
                        @endif
                        @if (!empty($service['title']))
                            <h3 class="hp-service-card__title">{{ $service['title'] }}</h3>
                        @endif
                        @if (!empty($service['text']))
                            <p class="hp-service-card__text">{{ $service['text'] }}</p>
                        @endif
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Featured treatments --}}
    @if (!empty($hp['featured']))
        <section class="hp-featured" aria-labelledby="hp-featured-heading">
            <div class="hp-featured__inner container-pns">
                <header class="hp-featured__header">
                    @if (!empty($hp['featured']['badge']))
                        <p class="hp-badge hp-badge--outline">{{ $hp['featured']['badge'] }}</p>
                    @endif
                    @if (!empty($hp['featured']['title']))
                        <h2 class="hp-featured__title" id="hp-featured-heading">{{ $hp['featured']['title'] }}</h2>
                    @endif
                    @if (!empty($hp['featured']['lead']))
                        <p class="hp-featured__lead">{{ $hp['featured']['lead'] }}</p>
                    @endif
                </header>
                <div class="hp-featured__grid">
                    @foreach ($hp['featured']['items'] ?? [] as $item)
                        <article class="hp-featured-card">
                            @if (!empty($item['label']))
                                <p class="hp-featured-card__label">{{ $item['label'] }}</p>
                            @endif
                            @if (!empty($item['title']))
                                <h3 class="hp-featured-card__title">{{ $item['title'] }}</h3>
                            @endif
                            @if (!empty($item['text']))
                                <p class="hp-featured-card__text">{{ $item['text'] }}</p>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Step-by-step process --}}
    @if (!empty($hp['process']))
        <section class="hp-process" aria-labelledby="hp-process-heading">
            <div class="hp-process__inner container-pns">
                <header class="hp-process__header">
                    @if (!empty($hp['process']['badge']))
                        <p class="hp-badge">{{ $hp['process']['badge'] }}</p>
                    @endif
                    @if (!empty($hp['process']['title']))
                        <h2 class="hp-process__title" id="hp-process-heading">{{ $hp['process']['title'] }}</h2>
                    @endif
                    @if (!empty($hp['process']['lead']))
                        <p class="hp-process__lead">{{ $hp['process']['lead'] }}</p>
                    @endif
                </header>
                <div class="hp-process__grid">
                    @foreach ($hp['process']['items'] ?? [] as $item)
                        <article class="hp-process-card">
                            @if (!empty($item['title']))
                                <h3 class="hp-process-card__title">{{ $item['title'] }}</h3>
                            @endif
                            @if (!empty($item['steps']))
                                <div class="hp-process-card__steps">
                                    @foreach ($item['steps'] as $index => $step)
                                        @if ($index > 0)
                                            <span class="hp-process-card__arrow" aria-hidden="true">→</span>
                                        @endif
                                        <span class="hp-process-card__step">{{ $step }}</span>
                                    @endforeach
                                </div>
                            @endif
                            @if (!empty($item['text']))
                                <p class="hp-process-card__text">{{ $item['text'] }}</p>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Formulations --}}
    @if (!empty($hp['formulations']))
        <section class="hp-formulas" aria-labelledby="hp-formulas-heading">
            <div class="hp-formulas__inner container-pns">
                <header class="hp-formulas__header">
                    @if (!empty($hp['formulations']['badge']))
                        <p class="hp-badge">{{ $hp['formulations']['badge'] }}</p>
                    @endif
                    @if (!empty($hp['formulations']['title']))
                        <h2 class="hp-formulas__title" id="hp-formulas-heading">{{ $hp['formulations']['title'] }}</h2>
                    @endif
                    @if (!empty($hp['formulations']['lead']))
                        <p class="hp-formulas__lead">{{ $hp['formulations']['lead'] }}</p>
                    @endif
                </header>
                <div class="hp-formulas__grid">
                    @foreach ($hp['formulations']['items'] ?? [] as $formula)
                        <article class="hp-formula-card">
                            @if (!empty($formula['title']))
                                <header class="hp-formula-card__head">
                                    <p class="hp-formula-card__label">FORMULATION FOCUS</p>
                                    <h3 class="hp-formula-card__title">{{ $formula['title'] }}</h3>
                                </header>
                            @endif
                            @if (!empty($formula['entries']))
                                <ul class="hp-formula-card__list">
                                    @foreach ($formula['entries'] as $entry)
                                        <li><strong>{{ $entry['name'] }} :</strong> {{ $entry['text'] }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Premium add-ons --}}
    @if (!empty($hp['addons']))
        <section class="hp-addons" aria-labelledby="hp-addons-heading">
            <div class="hp-addons__inner container-pns">
                <header class="hp-addons__header">
                    @if (!empty($hp['addons']['badge']))
                        <p class="hp-badge">{{ $hp['addons']['badge'] }}</p>
                    @endif
                    @if (!empty($hp['addons']['title']))
                        <h2 class="hp-addons__title" id="hp-addons-heading">{{ $hp['addons']['title'] }}</h2>
                    @endif
                    @if (!empty($hp['addons']['lead']))
                        <p class="hp-addons__lead">{{ $hp['addons']['lead'] }}</p>
                    @endif
                </header>
                <div class="hp-addons__grid">
                    @foreach ($hp['addons']['items'] ?? [] as $addon)
                        <article class="hp-addon-card">
                            @if (!empty($addon['badge']))
                                <p class="hp-addon-card__badge">{{ $addon['badge'] }}</p>
                            @endif
                            @if (!empty($addon['title']))
                                <h3 class="hp-addon-card__title">{{ $addon['title'] }}</h3>
                            @endif
                            @if (!empty($addon['text']))
                                <p class="hp-addon-card__text">{{ $addon['text'] }}</p>
                            @endif
                            @if (!empty($addon['features']))
                                <ul class="hp-addon-card__list">
                                    @foreach ($addon['features'] as $feature)
                                        <li>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Our promise --}}
    @if (!empty($hp['promise']))
        <section class="hp-promise" aria-labelledby="hp-promise-heading">
            <div class="hp-promise__inner container-pns">
                <header class="hp-promise__header">
                    @if (!empty($hp['promise']['badge']))
                        <p class="hp-badge hp-badge--outline-light">{{ $hp['promise']['badge'] }}</p>
                    @endif
                    @if (!empty($hp['promise']['title']))
                        <h2 class="hp-promise__title" id="hp-promise-heading">{{ $hp['promise']['title'] }}</h2>
                    @endif
                    @if (!empty($hp['promise']['lead']))
                        <p class="hp-promise__lead">{{ $hp['promise']['lead'] }}</p>
                    @endif
                </header>
                <div class="hp-promise__body">
                    @if (!empty($hp['promise']['body']))
                        <p>{{ $hp['promise']['body'] }}</p>
                    @endif
                    @if (!empty($hp['promise']['closing']))
                        <p>{{ $hp['promise']['closing'] }}</p>
                    @endif
                    <div class="hp-promise__actions">
                        <a href="{{ url('/contact') }}" class="btn btn--gold btn--lg">Book Consultation</a>
                        <a href="tel:6264066538" class="btn btn--ghost-light btn--lg">Call (626) 406-6538</a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Areas we serve --}}
    @if (!empty($hp['areas']))
        <section class="hp-areas" aria-labelledby="hp-areas-heading">
            <div class="hp-areas__inner container-pns">
                @if (!empty($hp['areas']['title']))
                    <h2 class="hp-areas__title" id="hp-areas-heading">{{ $hp['areas']['title'] }}</h2>
                @endif
                @if (!empty($hp['areas']['locations']))
                    <div class="hp-areas__rows">
                        @foreach (array_chunk($hp['areas']['locations'], 4) as $row)
                            <div class="hp-areas__row">
                                @foreach ($row as $location)
                                    <span class="hp-areas__pill">📍 {{ $location }}</span>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- Get started CTA --}}
    @if (!empty($hp['cta']))
        <section class="hp-cta" aria-labelledby="hp-cta-heading">
            <div class="hp-cta__inner container-pns">
                @if (!empty($hp['cta']['badge']))
                    <p class="hp-badge">{{ $hp['cta']['badge'] }}</p>
                @endif
                @if (!empty($hp['cta']['title']))
                    <h2 class="hp-cta__title" id="hp-cta-heading">{!! str_replace('restored', '<em>restored</em>', e($hp['cta']['title'])) !!}</h2>
                @endif
                @if (!empty($hp['cta']['lead']))
                    <p class="hp-cta__lead">{{ $hp['cta']['lead'] }}</p>
                @endif
                <div class="hp-cta__actions">
                    <a href="{{ url('/contact') }}" class="btn btn--wellness-primary btn--lg">Request Appointment</a>
                    <a href="tel:6264066538" class="btn btn--wellness-outline btn--lg">Call (626) 406-6538</a>
                </div>
            </div>
        </section>
    @endif

    {{-- Contact --}}
    @if (!empty($hp['contact']['columns']))
        <section class="hp-contact" aria-label="Contact information">
            <div class="hp-contact__inner container-pns">
                <div class="hp-contact__grid">
                    @foreach ($hp['contact']['columns'] as $column)
                        <div class="hp-contact__col">
                            @if (!empty($column['title']))
                                <h3 class="hp-contact__title">{{ $column['title'] }}</h3>
                            @endif
                            @foreach ($column['lines'] ?? [] as $line)
                                @if ($column['title'] === 'CONCIERGE PHONE & TEXT LINE' && str_contains($line, '(626)'))
                                    <p><a href="tel:6264066538" class="hp-contact__link">{{ $line }}</a></p>
                                @elseif ($column['title'] === 'EMAIL OUR CLINICAL TEAM' && str_contains($line, '@'))
                                    <p><a href="mailto:{{ $line }}" class="hp-contact__link">{{ $line }}</a></p>
                                @else
                                    <p>{{ $line }}</p>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('website.partials.page-faqs', [
        'pageKey' => 'home',
        'sectionTitle' => 'Questions about IV wellness',
        'sectionNote' => 'Quick answers before you book your first visit.',
    ])
@endsection
