@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $page_meta_description)
@section('content')
    <section class="page-hero page-hero--wellness" aria-labelledby="services-hero-heading">
        <div class="container-pns">
            <p class="page-hero__eyebrow">Our Policies</p>
            <h1 class="page-hero__title" id="services-hero-heading">Clear, considered, transparent.</h1>
            <p class="page-hero__note">Our policies and procedures to ensure a safe and comfortable experience.</p>
        </div>
    </section>

    <section class="section-pns section-pns--policies-wellness" aria-label="Policies">
        <div class="container-pns policies-wellness__inner">
            <div class="policies-grid">
                @forelse ($policies as $policy)
                    <article class="policies-card">
                        <h2 class="policies-card__title">{{ $policy->title }}</h2>
                        <div class="policies-card__description">{!! nl2br(e($policy->description)) !!}</div>
                    </article>
                @empty
                    <p class="policies-grid__empty">No policies have been published yet. Please check back
                        soon.</p>
                @endforelse
            </div>
        </div>
    </section>
    @include('website.partials.book-your-visit')
@endsection
