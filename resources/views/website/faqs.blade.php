@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $page_meta_description)
@push('structured-data')
    @php
        use App\Support\WebsiteSeo;
        $allFaqs = $faqGroups->flatten(1);
        $faqSchema = WebsiteSeo::faqPageJsonLd($allFaqs);
    @endphp
    @if ($faqSchema)
        <script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @endif
@endpush
@section('content')
    <section class="page-hero page-hero--wellness" aria-labelledby="faqs-hero-heading">
        <div class="container-pns">
            <p class="page-hero__eyebrow">Frequently Asked</p>
            <h1 class="page-hero__title" id="faqs-hero-heading">Good questions, clear answers.</h1>
            <p class="page-hero__note">Browse FAQs by page — each section of our website has its own questions.</p>
        </div>
    </section>

    @forelse ($faqGroups as $groupKey => $pageFaqs)
        @php
            $firstFaq = $pageFaqs->first();
            $partialPageKey = $firstFaq?->page_key ?? $groupKey;
        @endphp
        @include('website.partials.page-faqs', [
            'pageKey' => $partialPageKey,
            'pageFaqs' => $pageFaqs,
            'serviceId' => $firstFaq?->service_id,
            'sectionTitle' => \App\Models\Faq::groupSectionTitle($groupKey, $pageFaqs),
            'hideFaqLink' => true,
        ])
    @empty
        <section class="section-pns section-pns--faq-wellness">
            <div class="container-pns">
                <p class="faq-accordion__empty">No questions have been published yet. Please check back soon.</p>
            </div>
        </section>
    @endforelse

    @include('website.partials.book-your-visit')
@endsection
