@extends('layouts.admin.app')
@section('title', $page_title ?? 'Dashboard')

@push('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Balanced Body IV Wellness — teal, sage, cream, gold (matches public site) */
        .pg-dash {
            --dash-teal: #2d6a62;
            --dash-teal-mid: #3a8076;
            --dash-teal-light: #4a9a8e;
            --dash-teal-deep: #1a3f3c;
            --dash-gold: #c9a157;
            --dash-gold-soft: rgba(201, 161, 87, 0.2);
            --dash-sage: rgba(90, 125, 108, 0.18);
            --dash-mint: rgba(138, 190, 175, 0.16);
            min-height: calc(100vh - 100px);
            background: linear-gradient(180deg, #fafaf8 0%, #eef2f0 100%);
            padding: 0 1.5rem 2.5rem;
        }

        .pg-dash__banner {
            width: 100%;
            margin: 15px auto 2.5rem;
            padding: 3.5rem 2rem;
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid rgba(45, 106, 98, 0.14);
            box-shadow: 0 8px 32px rgba(29, 43, 51, 0.06);
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }

        .pg-dash__banner::before {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 0;
            background:
                radial-gradient(ellipse 80% 55% at 75% 25%, var(--dash-mint) 0%, transparent 58%),
                radial-gradient(ellipse 55% 45% at 15% 85%, var(--dash-sage) 0%, transparent 52%),
                radial-gradient(ellipse 45% 35% at 92% 70%, var(--dash-gold-soft) 0%, transparent 48%);
            animation: pgDashMesh 18s ease-in-out infinite alternate;
            pointer-events: none;
        }

        @keyframes pgDashMesh {
            0% {
                transform: translate(0, 0) scale(1);
            }

            100% {
                transform: translate(-10px, 12px) scale(1.02);
            }
        }

        .pg-dash__welcome {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .pg-dash__welcome-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-weight: 800;
            font-size: clamp(2rem, 5vw, 3.5rem);
            line-height: 1.1;
            letter-spacing: -0.02em;
            margin: 0;
            background: linear-gradient(135deg, #1d2b33 0%, var(--dash-teal-deep) 28%, var(--dash-teal) 55%, var(--dash-teal-light) 85%, var(--dash-gold) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: welcomeFloat 3s ease-in-out infinite;
        }

        @keyframes welcomeFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-6px);
            }
        }

        .pg-dash__welcome-subtitle {
            font-family: 'Poppins', system-ui, sans-serif;
            font-size: clamp(1rem, 2vw, 1.25rem);
            font-weight: 500;
            color: #5f6f68;
            margin: 1rem 0 0;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            animation: subtitlePulse 2.5s ease-in-out infinite;
        }

        @keyframes subtitlePulse {

            0%,
            100% {
                opacity: 0.75;
            }

            50% {
                opacity: 1;
            }
        }

        .pg-dash__grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        .pg-dash__card {
            background: #fff;
            border-radius: 16px;
            padding: 1.75rem 1.5rem;
            box-shadow: 0 4px 16px rgba(29, 43, 51, 0.06);
            border: 1px solid rgba(45, 106, 98, 0.12);
            text-decoration: none;
            color: inherit;
            display: block;
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.35s ease, border-color 0.35s ease;
            position: relative;
            overflow: hidden;
            opacity: 0;
            transform: translateY(24px);
            animation: cardFadeIn 0.55s ease forwards;
        }

        .pg-dash__card:nth-child(1) {
            animation-delay: 0.08s;
        }

        .pg-dash__card:nth-child(2) {
            animation-delay: 0.15s;
        }

        .pg-dash__card:nth-child(3) {
            animation-delay: 0.22s;
        }

        .pg-dash__card:nth-child(4) {
            animation-delay: 0.29s;
        }

        .pg-dash__card:nth-child(5) {
            animation-delay: 0.36s;
        }

        .pg-dash__card:nth-child(6) {
            animation-delay: 0.43s;
        }

        .pg-dash__card:nth-child(7) {
            animation-delay: 0.5s;
        }

        .pg-dash__card:nth-child(8) {
            animation-delay: 0.57s;
        }

        @keyframes cardFadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pg-dash__card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(74, 154, 142, 0.14), transparent);
            transition: left 0.5s ease;
        }

        .pg-dash__card:hover::before {
            left: 100%;
        }

        .pg-dash__card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(45, 106, 98, 0.14);
            border-color: rgba(45, 106, 98, 0.28);
            color: inherit;
            text-decoration: none;
        }

        .pg-dash__card-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
            transition: transform 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .pg-dash__card:hover .pg-dash__card-icon {
            transform: scale(1.08) rotate(4deg);
        }

        .pg-dash__card-icon.brand {
            background: linear-gradient(135deg, #1a3f3c 0%, var(--dash-teal) 45%, var(--dash-teal-light) 100%);
            color: #fff;
            box-shadow: 0 6px 18px rgba(45, 106, 98, 0.32);
            animation: iconPulse 2.5s ease-in-out infinite;
        }

        @keyframes iconPulse {

            0%,
            100% {
                box-shadow: 0 6px 18px rgba(45, 106, 98, 0.32);
            }

            50% {
                box-shadow: 0 8px 26px rgba(45, 106, 98, 0.45);
            }
        }

        .pg-dash__card-value {
            font-family: 'Poppins', system-ui, sans-serif;
            font-size: 2.35rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
            transition: color 0.3s ease;
            background: linear-gradient(135deg, #1d2b33, #3d524d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .pg-dash__card:hover .pg-dash__card-value {
            background: linear-gradient(135deg, var(--dash-teal-deep), var(--dash-teal) 50%, var(--dash-gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .pg-dash__card-label {
            font-family: 'Poppins', system-ui, sans-serif;
            font-size: 0.9375rem;
            color: #5f6f68;
            margin-top: 0.25rem;
            font-weight: 500;
            position: relative;
            z-index: 1;
        }

        @media (max-width: 1200px) {
            .pg-dash__grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 992px) {
            .pg-dash__grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .pg-dash__banner {
                padding: 2.5rem 1.5rem;
            }

            .pg-dash__card-value {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .pg-dash {
                padding: 0 1rem 1.5rem;
            }

            .pg-dash__banner {
                padding: 2rem 1.25rem;
                margin-bottom: 1.5rem;
            }

            .pg-dash__grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .pg-dash__card {
                padding: 1.25rem;
            }

            .pg-dash__card-value {
                font-size: 1.65rem;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .pg-dash__banner::before,
            .pg-dash__welcome-title,
            .pg-dash__welcome-subtitle,
            .pg-dash__card-icon.brand {
                animation: none !important;
            }

            .pg-dash__card {
                animation: none !important;
                opacity: 1 !important;
                transform: none !important;
            }
        }
    </style>
@endpush

@section('content')
    <section class="content pg-dash">
        @php 
            $contactUsIndex = Route::has('contactus.index') ? route('contactus.index') : '#'; 
            $faqIndex = Route::has('faq.index') ? route('faq.index') : '#'; 
            $policyIndex = Route::has('policy.index') ? route('policy.index') : '#';
            $servicesIndex = Route::has('services.index') ? route('services.index') : '#';
        @endphp

        <div class="pg-dash__banner">
            <div class="pg-dash__welcome">
                <h1 class="pg-dash__welcome-title">Welcome <br>Balanced Body IV Wellness</h1>
                <p class="pg-dash__welcome-subtitle">Manage your website</p>
            </div>
        </div>

        <div class="pg-dash__grid">
            {{-- <a href="{{ $sliderIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-sliders" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $slidersTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Home Sliders</div>
            </a> --}}

            {{-- <a href="{{ $bannerIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-picture-o" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $bannersTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Banners</div>
            </a> --}}

            {{-- <a href="{{ $testimonialIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-quote-left" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $testimonialsTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Testimonials</div>
            </a> --}}

            <a href="{{ $contactUsIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $contactUsTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Contact Messages</div>
            </a>

            <a href="{{ $faqIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-question-circle" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $faqTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">FAQs</div>
            </a>

            <a href="{{ $policyIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-file-text" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $policyTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Policies</div>
            </a>
            <a href="{{ $servicesIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-cogs" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $servicesTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Services</div>
            </a>
            {{-- <a href="{{ $shopContactIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-shopping-bag" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $shopContactTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Shop Contacts</div>
            </a> --}}

            {{-- <a href="{{ $videoIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-video-camera" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $videoTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Videos</div>
            </a>

            {{-- <a href="{{ $audioIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-music" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $audioTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Audio Tracks</div>
            </a>

            <a href="{{ $galleryIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-camera" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $galleryTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Photo Gallery</div>
            </a> --}}
        </div>
    </section>
@endsection
