@extends('layouts.website.master')
@section('title', $meta_title)
@section('meta_description', $meta_description)
@section('og_type', 'article')
@if ($blog->image)
@section('og_image', url($blog->imageUrl()))
@endif
@section('content')
    <section class="page-hero page-hero--wellness" aria-labelledby="blog-detail-heading">
        <div class="container-pns">
            <p class="page-hero__eyebrow">
                <a href="{{ route('blogs') }}" class="page-hero__crumb">Blogs</a>
                <span aria-hidden="true"> / </span>
                Article
            </p>
            <h1 class="page-hero__title" id="blog-detail-heading">{{ $blog->name }}</h1>
            @if ($blog->displayDate())
                <p class="page-hero__note">
                    <time datetime="{{ $blog->displayDate()->toDateString() }}">{{ $blog->displayDate()->format('F j, Y') }}</time>
                </p>
            @endif
        </div>
    </section>

    <article class="section-pns section-pns--blog-detail" aria-labelledby="blog-detail-heading">
        <div class="container-pns blog-detail__inner">
            <div class="blog-detail__featured">
                <img src="{{ $blog->imageUrl() }}" alt="{{ $blog->name }}" width="1200" height="675">
            </div>

            @if ($blog->short_description)
                <div class="blog-detail__lead">
                    {!! $blog->short_description !!}
                </div>
            @endif

            @if ($blog->description)
                <div class="blog-detail__content">
                    {!! $blog->description !!}
                </div>
            @endif

            <div class="blog-detail__footer">
                <a href="{{ route('blogs') }}" class="blog-detail__back">&larr; Back to all blogs</a>
            </div>
        </div>
    </article>

    @if (isset($relatedBlogs) && $relatedBlogs->isNotEmpty())
        <section class="section-pns section-pns--related-blogs" aria-labelledby="related-blogs-heading">
            <div class="container-pns">
                <header class="related-blogs__head">
                    <p class="related-blogs__eyebrow">Keep reading</p>
                    <h2 class="related-blogs__title" id="related-blogs-heading">More wellness articles</h2>
                </header>
                <div class="blogs-grid blogs-grid--related">
                    @foreach ($relatedBlogs as $related)
                        <article class="blog-card">
                            <a href="{{ route('blog-detail', $related->slug) }}" class="blog-card__media">
                                <img src="{{ $related->imageUrl() }}" alt="{{ $related->name }}" loading="lazy" width="640" height="400">
                            </a>
                            <div class="blog-card__body">
                                @if ($related->displayDate())
                                    <time class="blog-card__date" datetime="{{ $related->displayDate()->toDateString() }}">
                                        {{ $related->displayDate()->format('M j, Y') }}
                                    </time>
                                @endif
                                <h3 class="blog-card__title">
                                    <a href="{{ route('blog-detail', $related->slug) }}">{{ $related->name }}</a>
                                </h3>
                                <a href="{{ route('blog-detail', $related->slug) }}" class="blog-card__link">
                                    Read article <span aria-hidden="true">→</span>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('website.partials.page-faqs', [
        'pageKey' => 'blog-detail',
        'blogSlug' => $blog->slug,
        'sectionTitle' => 'Frequently asked questions',
        'sectionNote' => 'Common questions related to this article and our wellness treatments.',
    ])

    @include('website.partials.book-your-visit')
@endsection
