@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $page_meta_description)

@section('content')
    <section class="hero hero--wellness" aria-label="Hero section">
      <div class="hero__bg" aria-hidden="true">
        <div class="hero-w__gradient"></div>
      </div>
      <div class="hero__inner">
        <div class="hero__content">
          <div class="hero-w__eyebrow">
            <svg class="hero-w__eyebrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"></path>
              <path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"></path>
            </svg>
            <span>Holistic IV Wellness</span>
          </div>
          <h1 class="hero-w__title">
            Restore your <em class="hero-w__title-accent">balance</em>, from the inside out.
          </h1>
          <p class="hero-w__lead">
            Thoughtfully formulated IV drips, peptides, and vitamin injections — delivered with medical care in a calming, spa-inspired setting.
          </p>
          <div class="hero__ctas hero-w__ctas">
            <a href="{{ url('contact') }}" class="btn btn--wellness-primary btn--lg">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
              </svg>
              Book a Consultation
            </a>
            <a href="{{ url('services') }}" class="btn btn--wellness-outline btn--lg">Explore Services</a>
          </div>
          <p class="hero-w__footnote">Medical clearance required · in-person payment only</p>
        </div>
        <div class="hero__visual hero-w__visual">
          <div class="hero-w__art-card">
            <img src="{{ asset('assets/website/images/hero-wellness.jpg') }}" alt="Calm wellness illustration — restorative IV care" width="640" height="640" loading="eager" class="hero-w__art-img">
          </div>
        </div>
      </div> 
    </section>

    <section class="offer" id="services" aria-labelledby="offer-heading">
      <div class="offer__inner">
        <header class="offer__header">
          <p class="offer__eyebrow">What we offer</p>
          <h2 class="offer__title" id="offer-heading">A modern approach to feeling well.</h2>
        </header>
        <div class="offer__grid">
          <article class="offer-card reveal">
            <div class="offer-card__icon offer-card__icon--soft" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22a7 7 0 0 0 7-7c0-5-7-13-7-13S5 10 5 15a7 7 0 0 0 7 7z"></path>
              </svg>
            </div>
            <h3 class="offer-card__title">IV Hydration</h3>
            <p class="offer-card__desc">10+ targeted drip formulations for energy, recovery, immunity &amp; beauty.</p>
          </article>
          <article class="offer-card reveal">
            <div class="offer-card__icon offer-card__icon--soft" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.65" stroke-linecap="round" stroke-linejoin="round">
                <path d="M8 10l1 2 2 1-2 1-1 2-1-2-2-1 2-1 1-2z"></path>
                <path d="M16 5.5l.65 2 2 .65-2 .65-.65 2-.65-2-2-.65 2-.65.65-2z"></path>
                <path d="M15.5 15.5l.5 1.5 1.5.5-1.5.5-.5 1.5-.5-1.5-1.5-.5 1.5-.5.5-1.5z"></path>
              </svg>
            </div>
            <h3 class="offer-card__title">Peptide Therapy</h3>
            <p class="offer-card__desc">Curated peptide protocols supporting longevity, performance &amp; repair.</p>
          </article>
          <article class="offer-card reveal">
            <div class="offer-card__icon offer-card__icon--soft" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                <polyline points="7 12 9 12 10 10 12 14 13 12 17 12"></polyline>
              </svg>
            </div>
            <h3 class="offer-card__title">Wellness Injections</h3>
            <p class="offer-card__desc">Vitamin B12, MIC, glutathione and more — quick, effective boosts.</p>
          </article>
          <article class="offer-card reveal">
            <div class="offer-card__icon offer-card__icon--soft" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                <polyline points="9 12 11 14 15 10"></polyline>
              </svg>
            </div>
            <h3 class="offer-card__title">Medical Clearance</h3>
            <p class="offer-card__desc">Every client is reviewed for safety before any therapy is administered.</p>
          </article>
        </div>
      </div>
    </section>

    <section class="promise section" id="about" aria-labelledby="promise-heading">
      <div class="container">
        <div class="promise__grid">
          <div class="promise__content reveal">
            <p class="promise__eyebrow">Our promise</p>
            <h2 class="promise__title" id="promise-heading">Wellness that feels intentional.</h2>
            <p class="promise__lead">Every visit is designed around clarity, comfort, and clinical rigor — so you always know what you are receiving, why it matters, and how it supports your goals.</p>
            <p class="promise__body">From your first conversation through follow-up care, we prioritize education, consent, and a calm environment that respects your time and your body.</p>
            <a href="{{ url('/about-us') }}" class="promise__link">Read our story <span class="promise__link-arrow" aria-hidden="true">→</span></a>
          </div>
          <div class="promise__stats reveal reveal--right" role="list">
            <article class="promise-stat reveal" role="listitem">
              <p class="promise-stat__value">10+</p>
              <p class="promise-stat__label">IV drip formulas</p>
            </article>
            <article class="promise-stat reveal" role="listitem">
              <p class="promise-stat__value">100%</p>
              <p class="promise-stat__label">Medically cleared</p>
            </article>
            <article class="promise-stat reveal" role="listitem">
              <p class="promise-stat__value">30–60</p>
              <p class="promise-stat__label">Minute sessions</p>
            </article>
            <article class="promise-stat reveal" role="listitem">
              <p class="promise-stat__value">1:1</p>
              <p class="promise-stat__label">Personal care</p>
            </article>
          </div>
        </div>
      </div>
    </section>

    @include('website.partials.page-faqs', [
        'pageKey' => 'home',
        'sectionTitle' => 'Questions about IV wellness',
        'sectionNote' => 'Quick answers before you book your first visit.',
    ])

    @include('website.partials.book-your-visit')
@endsection
