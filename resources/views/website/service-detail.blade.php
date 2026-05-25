@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $page_meta_description)

@section('content')
    @php
        use Illuminate\Support\Str;

        $placeholder = \App\Models\Services::imagePlaceholderUrl();
        $heroImg = $service ? $service->imageUrl('description_image') : $placeholder;
        $imgA = $service ? $service->imageUrl('description_image') : $placeholder;
        $imgB = $service ? $service->imageUrl('benefit_image') : $placeholder;
        $imgC = $placeholder;
        $imgD = $service ? $service->imageUrl('question_image') : $placeholder;

        $serviceName = $service?->heading ?? ($placeholder['label'] ?? 'Hydration Revival IV Drip');
        $serviceIntro = filled($service?->description)
            ? $service->description
            : 'A thoughtfully formulated IV drip designed to restore fluids, support energy, and help you feel refreshed — with medical oversight in a calm, spa-inspired setting.';
        $benefitItems = $service ? $service->displayList('benefits') : [];
        $questionItems = $service ? $service->displayList('questions') : [];

        if (count($benefitItems) === 0) {
            $benefitItems = [
                'Rapid hydration with balanced electrolytes',
                'B-vitamin support for natural energy',
                'Optional add-ons tailored to your goals',
                'Administered with sterile technique and RN oversight',
            ];
        }
        if (count($questionItems) === 0) {
            $questionItems = [
                'Feeling run-down, dehydrated, or low on energy?',
                'Recovering from travel, illness, or a demanding week?',
                'Wanting a gentle introduction to IV wellness?',
            ];
        }
    @endphp

    <section class="lp-hero lp-hero--service" aria-labelledby="service-hero-heading">
        <div class="lp-hero__bg" style="background-image: url('{{ $heroImg }}');" aria-hidden="true"></div>
        <div class="lp-hero__overlay" aria-hidden="true"></div>
        <div class="lp-hero__inner container-pns">
            <h1 class="lp-hero__title" id="service-hero-heading">{{ $serviceName }}</h1>
            <p class="lp-hero__lead">Personalized IV wellness with clinical standards and a calm, restorative experience.</p>
        </div>
    </section>

    <section class="lp-split lp-split--light" aria-labelledby="service-overview-heading">
        <div class="lp-split__inner container-pns">
            <div class="lp-split__content">
                <h2 class="lp-split__title" id="service-overview-heading">
                    What is <span class="lp-split__title-accent">{{ $serviceName }}</span>?
                </h2>
                <p>{{ $serviceIntro }}</p>
                <p>This service is ideal when your body needs efficient hydration and targeted nutrient support without the sluggishness that can come from oral supplements alone. Sessions are unhurried, private, and tailored to how you feel that day.</p>
                <p>Before we begin, we confirm your medical history, discuss any medications or conditions, and answer questions so you know exactly what to expect.</p>
            </div>
            <div class="lp-split__media">
                <img src="{{ $imgA }}" alt="{{ $serviceName }} — wellness treatment" width="640" height="480" loading="lazy" decoding="async">
            </div>
        </div>
    </section>

    <section class="lp-split lp-split--dark lp-split--reverse" aria-labelledby="service-benefits-heading">
        <div class="lp-split__inner container-pns">
            <div class="lp-split__media">
                <img src="{{ $imgB }}" alt="Client receiving IV wellness care" width="640" height="480" loading="lazy" decoding="async">
            </div>
            <div class="lp-split__content">
                <h2 class="lp-split__title" id="service-benefits-heading">
                    Key <span class="lp-split__title-accent">benefits</span>
                </h2>
                <p>Many clients choose this drip when they want to feel more balanced, clear, and ready for the week ahead. Benefits vary by individual, but commonly reported experiences include:</p>
                <ul class="lp-split__list">
                    @foreach ($benefitItems as $benefit)
                        <li>{{ is_string($benefit) ? $benefit : '' }}</li>
                    @endforeach
                </ul>
                <a href="{{ url('/contact') }}" class="btn btn--wellness-outline lp-split__btn">Book Now</a>
            </div>
        </div>
    </section>

    <section class="lp-split lp-split--light" aria-labelledby="service-process-heading">
        <div class="lp-split__inner container-pns">
            <div class="lp-split__content">
                <h2 class="lp-split__title" id="service-process-heading">
                    Your <span class="lp-split__title-accent">visit</span> step by step
                </h2>
                <p>We keep the process simple and transparent from booking through aftercare.</p>
                <ul class="lp-split__list">
                    <li>Request an appointment online or by phone</li>
                    <li>Complete intake forms and medical clearance</li>
                    <li>Arrive at our studio for a brief consultation</li>
                    <li>Receive your IV drip in a comfortable, private setting</li>
                    <li>Leave with aftercare guidance and optional follow-up planning</li>
                </ul>
                <a href="{{ url('/contact') }}" class="btn btn--wellness-primary lp-split__btn">Request appointment</a>
            </div>
            <div class="lp-split__media">
                <img src="{{ $imgC }}" alt="Relaxing IV wellness session" width="640" height="480" loading="lazy" decoding="async">
            </div>
        </div>
    </section>

    <section class="lp-split lp-split--dark lp-split--reverse" aria-labelledby="service-right-heading">
        <div class="lp-split__inner container-pns">
            <div class="lp-split__media">
                <img src="{{ $imgD }}" alt="Wellness consultation" width="640" height="480" loading="lazy" decoding="async">
            </div>
            <div class="lp-split__content">
                <h2 class="lp-split__title" id="service-right-heading">Is it right for you?</h2>
                <p>This treatment may be a good fit if you relate to any of the following:</p>
                <ul class="lp-split__list">
                    @foreach ($questionItems as $question)
                        <li>{{ is_string($question) ? $question : '' }}</li>
                    @endforeach
                </ul>
                <p>If you are unsure, our team will help you decide during your consultation. Safety always comes first — we review your history before recommending any protocol.</p>
                <p class="lp-split__back">
                    <a href="{{ route('services') }}">&larr; View all services</a>
                </p>
            </div>
        </div>
    </section>

    @include('website.partials.page-faqs', [
        'pageKey' => 'service-detail',
        'serviceId' => $service?->id,
        'sectionTitle' => 'Questions about ' . ($serviceName ?? 'this service'),
    ])

    @include('website.partials.book-your-visit')
@endsection
