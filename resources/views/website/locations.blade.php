@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $page_meta_description)

@section('content')
    <section class="page-hero page-hero--wellness page-hero--location" aria-labelledby="locations-hero-heading">
        <div class="container-pns">
            <p class="page-hero__eyebrow">Locations</p>
            <h1 class="page-hero__title" id="locations-hero-heading">IV Wellness Across New York</h1>
            <p class="page-hero__note">Medically guided IV therapy, peptide support, and wellness injections — delivered in calm, spa-inspired studios throughout the region.</p>
        </div>
    </section>

    <section class="loc-index" aria-label="Our locations">
        <div class="loc-index__inner container-pns">
            <div class="loc-index__grid">
                @foreach ($locations as $slug => $location)
                    <a href="{{ route('location.page', ['slug' => $slug]) }}" class="loc-index-card">
                        <h2 class="loc-index-card__title">{{ $location['name'] ?? $slug }}</h2>
                        @if (!empty($location['hero']['lead']))
                            <p class="loc-index-card__text">{{ \Illuminate\Support\Str::limit($location['hero']['lead'], 120) }}</p>
                        @endif
                        <span class="loc-index-card__link">View location <span aria-hidden="true">→</span></span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    @include('website.partials.book-your-visit')
@endsection
