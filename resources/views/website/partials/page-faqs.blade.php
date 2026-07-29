@php
    use App\Models\Faq;

    $pageKey = $pageKey ?? 'home';
    $sectionTitle = $sectionTitle ?? 'Frequently asked questions';
    $sectionNote = $sectionNote ?? null;
    $serviceId = $serviceId ?? null;
    $serviceSlug = $serviceSlug ?? null;
    $locationSlug = $locationSlug ?? null;
    $blogSlug = $blogSlug ?? null;
    $pageFaqs = isset($pageFaqs)
        ? $pageFaqs
        : Faq::forPage($pageKey, $serviceId, $serviceSlug, $locationSlug, $blogSlug)->get();
    $sectionId = $pageKey
        . ($locationSlug ? '-loc-' . $locationSlug : '')
        . ($blogSlug ? '-blog-' . $blogSlug : '')
        . ($serviceSlug ? '-slug-' . $serviceSlug : ($serviceId ? '-service-' . $serviceId : ''));
@endphp

@if ($pageFaqs->isNotEmpty())
    <section class="section-pns section-pns--faq-wellness page-faqs-section" aria-labelledby="page-faqs-{{ $sectionId }}">
        <div class="container-pns">
            <header class="page-faqs-section__head">
                <p class="page-faqs-section__eyebrow">FAQ</p>
                <h2 class="page-faqs-section__title" id="page-faqs-{{ $sectionId }}">{{ $sectionTitle }}</h2>
                @if ($sectionNote)
                    <p class="page-faqs-section__note">{{ $sectionNote }}</p>
                @endif
            </header>
            <div class="faq-accordion-wrap">
                @foreach ($pageFaqs as $faq)
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
                @endforeach
            </div>
            @if (!($hideFaqLink ?? false))
                <p class="page-faqs-section__more">
                    <a href="{{ route('faqs') }}">View all FAQs <span aria-hidden="true">→</span></a>
                </p>
            @endif
        </div>
    </section>
@endif
