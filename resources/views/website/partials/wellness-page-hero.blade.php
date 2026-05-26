{{-- Light mint/cream hero — matches About, FAQs, Contact, Services listing --}}
@php
    $hero = $hero ?? [];
    $eyebrow = $eyebrow ?? ($hero['eyebrow'] ?? null);
    $lead = $lead ?? ($hero['lead'] ?? null);
    $headingId = $headingId ?? 'page-hero-heading';
    $modifier = $modifier ?? '';
@endphp
<section class="page-hero page-hero--wellness{{ $modifier ? ' ' . $modifier : '' }}" aria-labelledby="{{ $headingId }}">
    <div class="container-pns">
        @if ($eyebrow)
            <p class="page-hero__eyebrow">{{ $eyebrow }}</p>
        @endif
        <h1 class="page-hero__title" id="{{ $headingId }}">
            @if (!empty($titleHtml))
                {!! $titleHtml !!}
            @elseif (str_contains($modifier ?? '', 'page-hero--location-landing'))
                @if (!empty($hero['title_main']))
                    <span class="page-hero__title-line page-hero__title-line--primary">{{ $hero['title_main'] }}</span>
                @endif
            @elseif (($hero['title_style'] ?? 'white_first') === 'iv_vitamin')
                @if (!empty($hero['title_prefix']))
                    <span class="page-hero__title-line">{{ $hero['title_prefix'] }} <em class="page-hero__title-accent">{{ $hero['title_main'] ?? '' }}</em>@if (!empty($hero['title_suffix'])) {{ $hero['title_suffix'] }}@endif</span>
                @else
                    <span class="page-hero__title-line"><em class="page-hero__title-accent">{{ $hero['title_main'] ?? '' }}</em>@if (!empty($hero['title_suffix'])) {{ $hero['title_suffix'] }}@endif</span>
                @endif
            @elseif (str_contains($modifier ?? '', 'page-hero--service'))
                {{-- Standard service hero: line 1 dark, line 2 sage (Methylene Blue, Peptide Therapy, NAD, etc.) --}}
                @if (!empty($hero['title_main']))
                    <span class="page-hero__title-line page-hero__title-line--primary">{{ $hero['title_main'] }}</span>
                @endif
                @if (!empty($hero['title_accent']))
                    <span class="page-hero__title-line page-hero__title-line--secondary">{{ $hero['title_accent'] }}</span>
                @endif
            @elseif (($hero['title_style'] ?? 'white_first') === 'gold_first')
                @if (!empty($hero['title_main']))
                    <span class="page-hero__title-line"><em class="page-hero__title-accent page-hero__title-accent--gold">{{ $hero['title_main'] }}</em></span>
                @endif
                @if (!empty($hero['title_accent']))
                    <span class="page-hero__title-line">{{ $hero['title_accent'] }}</span>
                @endif
            @else
                @if (!empty($hero['title_main']))
                    <span class="page-hero__title-line">{{ $hero['title_main'] }}</span>
                @endif
                @if (!empty($hero['title_accent']))
                    <span class="page-hero__title-line"><em class="page-hero__title-accent">{{ $hero['title_accent'] }}</em></span>
                @endif
            @endif
        </h1>
        @if ($lead)
            <p class="page-hero__note">{{ $lead }}</p>
        @endif
    </div>
</section>
