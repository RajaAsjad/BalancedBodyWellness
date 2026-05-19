@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $page_meta_description)
@section('content')
    <section class="page-hero page-hero--wellness" aria-labelledby="services-hero-heading">
        <div class="container-pns">
            <p class="page-hero__eyebrow">Frequently Asked</p>
            <h1 class="page-hero__title" id="services-hero-heading">Good questions, clear answers.</h1>
            <p class="page-hero__note">Answers to common questions about IV therapy, pricing, and more.</p>
        </div>
    </section>

    <section class="section-pns section-pns--faq-wellness" aria-label="Frequently asked questions">
        <div class="container-pns faq-accordion-wrap">
            @forelse ($faqs as $faq)
                <details class="faq-accordion" @if ($loop->first) open @endif>
                    <summary class="faq-accordion__summary">
                        <span class="faq-accordion__question">{{ $faq->question }}</span>
                        <span class="faq-accordion__chevron" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6" />
                            </svg>
                        </span>
                    </summary>
                    <div class="faq-accordion__panel">
                        <div class="faq-accordion__answer">{!! nl2br(e($faq->answer)) !!}</div>
                    </div>
                </details>
            @empty
                <p class="faq-accordion__empty">No questions have been published yet. Please check back soon.</p>
            @endforelse
        </div>
    </section>
    @include('website.partials.book-your-visit')
@endsection
