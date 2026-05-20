@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $page_meta_description)

@section('content')
    @php
        $heroImg = asset('assets/website/images/hero-wellness.jpg');
        $splitImgA = asset('assets/website/images/hero-wellness.jpg');
        $splitImgB = asset('assets/website/images/hero-wellness.jpg');
        $mapEmbed =
            'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d423286.27405770525!2d-118.69192095!3d34.020161!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c75ddc27da13%3A0xe22fdf6f254608f4!2sLos%20Angeles%2C%20CA!5e0!3m2!1sen!2sus!4v1710000000000!5m2!1sen!2sus';
    @endphp

    <section class="lp-hero lp-hero--location" aria-labelledby="location-hero-heading">
        <div class="lp-hero__bg" style="background-image: url('{{ $heroImg }}');" aria-hidden="true"></div>
        <div class="lp-hero__overlay" aria-hidden="true"></div>
        <div class="lp-hero__inner container-pns">
            <h1 class="lp-hero__title" id="location-hero-heading">
                <span class="lp-hero__line"><span class="lp-hero__accent">IV Wellness Studio</span> in Los Angeles</span>
            </h1>
        </div>
    </section>

    <section class="lp-split lp-split--light" aria-label="About our Los Angeles location">
        <div class="lp-split__inner container-pns">
            <div class="lp-split__content">
                <p>Balanced Body IV &amp; Wellness welcomes you to a calm, spa-inspired studio designed for restorative IV therapy, peptide support, and vitamin injections. Our Los Angeles location is built around medical standards, sterile technique, and the personalized attention you deserve.</p>
                <p>Whether you are visiting for your first drip or continuing a longer wellness plan, every appointment begins with a review of your goals, health history, and comfort. We keep the environment quiet, private, and unhurried so you can relax while your treatment is prepared and administered.</p>
                <p>From energy and immunity support to recovery and metabolic balance, our team helps you choose services that fit your lifestyle. Parking and studio details are shared when your visit is confirmed.</p>
            </div>
            <div class="lp-split__media">
                <img src="{{ $splitImgA }}" alt="Calming IV wellness studio interior" width="640" height="480" loading="lazy" decoding="async">
            </div>
        </div>
    </section>

    <section class="lp-split lp-split--light lp-split--reverse" aria-labelledby="location-process-heading">
        <div class="lp-split__inner container-pns">
            <div class="lp-split__media">
                <img src="{{ $splitImgB }}" alt="Registered nurse preparing a personalized IV wellness treatment" width="640" height="480" loading="lazy" decoding="async">
            </div>
            <div class="lp-split__content">
                <h2 class="lp-split__title" id="location-process-heading">
                    The process at our <span class="lp-split__title-accent">Los Angeles studio</span>
                </h2>
                <p>Your visit starts with a brief consultation and medical clearance. We review any labs you bring, discuss your concerns, and confirm the treatment plan that aligns with your goals.</p>
                <p>During your session, you relax in a comfortable setting while your IV drip or injection is administered with clinical oversight. Afterward, we share simple aftercare guidance and help you schedule follow-up care if needed.</p>
            </div>
        </div>
    </section>

    <section class="lp-map" aria-label="Map and directions">
        <div class="lp-map__frame">
            <iframe src="{{ $mapEmbed }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Balanced Body IV Wellness — Los Angeles area map"></iframe>
        </div>
    </section>

    @include('website.partials.page-faqs', [
        'pageKey' => 'locations',
        'sectionTitle' => 'Location & visit questions',
    ])

    @include('website.partials.book-your-visit')
@endsection
