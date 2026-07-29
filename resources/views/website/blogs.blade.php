@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $page_meta_description)
@section('content')
    <section class="page-hero page-hero--wellness" aria-labelledby="blogs-hero-heading">
        <div class="container-pns">
            <p class="page-hero__eyebrow">Insights &amp; Education</p>
            <h1 class="page-hero__title" id="blogs-hero-heading">Wellness articles worth reading.</h1>
            <p class="page-hero__note">Practical guidance on IV therapy, recovery, hydration, and long-term vitality from the Balanced Body team.</p>
        </div>
    </section>

    <section class="section-pns section-pns--blogs-wellness" aria-label="Blog articles">
        <div class="container-pns">
            @if ($blogs->isNotEmpty())
                <div class="blogs-grid">
                    @foreach ($blogs as $blog)
                        <article class="blog-card">
                            <a href="{{ route('blog-detail', $blog->slug) }}" class="blog-card__media">
                                <img src="{{ $blog->imageUrl() }}" alt="{{ $blog->name }}" loading="lazy" width="640" height="400">
                            </a>
                            <div class="blog-card__body">
                                @if ($blog->displayDate())
                                    <time class="blog-card__date" datetime="{{ $blog->displayDate()->toDateString() }}">
                                        {{ $blog->displayDate()->format('M j, Y') }}
                                    </time>
                                @endif
                                <h2 class="blog-card__title">
                                    <a href="{{ route('blog-detail', $blog->slug) }}">{{ $blog->name }}</a>
                                </h2>
                                <p class="blog-card__excerpt">{{ $blog->excerpt(140) }}</p>
                                <a href="{{ route('blog-detail', $blog->slug) }}" class="blog-card__link">
                                    Read article <span aria-hidden="true">→</span>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <p class="blogs-grid__empty">No articles have been published yet. Please check back soon.</p>
            @endif
        </div>
    </section>

    @include('website.partials.page-faqs', [
        'pageKey' => 'blogs',
        'sectionTitle' => 'Blogs FAQ',
        'sectionNote' => 'Common questions about our wellness articles and IV therapy insights.',
    ])

    @include('website.partials.book-your-visit')
@endsection
