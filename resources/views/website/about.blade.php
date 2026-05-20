@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $page_meta_description)
@section('content')
    <section class="page-hero page-hero--wellness" aria-labelledby="about-hero-heading">
        <div class="container-pns">
            <p class="page-hero__eyebrow">About Us</p>
            <h1 class="page-hero__title" id="services-hero-heading">A practice rooted in genuine care.</h1>
            <p class="page-hero__note">Balanced Body IV Wellness was founded to bring thoughtful, medically-guided IV therapy to clients who take their health seriously — without the cold, clinical feel.</p>
        </div>
    </section>

    <section class="section-pns section-pns--about-wellness" aria-label="About our practice">
        <div class="container-pns">
            <div class="about-wellness-prose about-wellness-prose--story">
                <h2 class="about-wellness-prose__welcome">Welcome to Balanced Body IV &amp; Wellness</h2>
                <p>My name is <strong>Carmen</strong>, owner and operator of Balanced Body IV &amp; Wellness. I am a Critical Care Registered Nurse with over <strong>15 years of experience</strong> in some of the most demanding areas of healthcare, including <strong>Cardiac Care, Transplants, Surgical Critical Care, and Medical ICU.</strong> Caring for others has always been at the heart of who I am &mdash; and wellness has always been my passion.</p>
                <p>Throughout my career and personal health journey, I have seen firsthand the powerful impact that IV therapy, targeted nutrients, and wellness-focused treatments can have on the body. I&rsquo;ve personally experienced benefits such as <strong>increased energy, improved mental clarity, enhanced mood, better blood sugar balance, lower cholesterol</strong>, and an overall improvement in my quality of life. These transformations inspired me to create a space where others could experience the same level of support, healing, and vitality.</p>
                <p>Balanced Body IV &amp; Wellness was founded with a simple mission: <strong>to help people feel better, live healthier, and support long-term wellness and longevity.</strong></p>
                <p>Here, every client receives <strong>personalized care.</strong> I take the time to understand your medical history, review your labs, listen to your concerns, and learn about your goals so I can tailor your treatments to your individual needs. Whether you&rsquo;re seeking more energy, stronger immunity, improved metabolism, better recovery, or overall balance, I&rsquo;m here to guide you every step of the way.</p>
                <p class="about-wellness-prose__last">My goal is to help you become the <strong>healthiest, strongest, and most vibrant version of yourself</strong> &mdash; because when we feel our best, we live our best.</p>
            </div>
        </div>
    </section>

    <section class="section-pns section-pns--stand-for-wellness" aria-labelledby="stand-for-heading">
        <div class="stand-for-wellness__inner">
            <h2 class="stand-for-wellness__heading" id="stand-for-heading">What we stand for</h2>
            <ul class="stand-for-wellness__grid">
                <li class="stand-for-card">
                    <div class="stand-for-card__icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="stand-for-card__icon-svg" aria-hidden="true">
                            <path
                                d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5">
                            </path>
                        </svg>
                    </div>
                    <h3 class="stand-for-card__title">Care First</h3>
                    <p class="stand-for-card__desc">Your wellbeing leads every recommendation we make.</p>
                </li>
                <li class="stand-for-card">
                    <div class="stand-for-card__icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="stand-for-card__icon-svg" aria-hidden="true">
                            <path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526">
                            </path>
                            <circle cx="12" cy="8" r="6"></circle>
                        </svg>
                    </div>
                    <h3 class="stand-for-card__title">Clinical Standards</h3>
                    <p class="stand-for-card__desc">Sterile technique, quality compounds, medical oversight.</p>
                </li>
                <li class="stand-for-card">
                    <div class="stand-for-card__icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="stand-for-card__icon-svg" aria-hidden="true">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <path d="M16 3.128a4 4 0 0 1 0 7.744"></path>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <h3 class="stand-for-card__title">Personal Service</h3>
                    <p class="stand-for-card__desc">Small practice attention &mdash; never assembly line.</p>
                </li>
                <li class="stand-for-card">
                    <div class="stand-for-card__icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="stand-for-card__icon-svg" aria-hidden="true">
                            <path
                                d="M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z">
                            </path>
                            <path d="M20 2v4"></path>
                            <path d="M22 4h-4"></path>
                            <circle cx="4" cy="20" r="2"></circle>
                        </svg>
                    </div>
                    <h3 class="stand-for-card__title">Calm Environment</h3>
                    <p class="stand-for-card__desc">A serene space designed for genuine restoration.</p>
                </li>
            </ul>
        </div>
    </section>
    @include('website.partials.page-faqs', [
        'pageKey' => 'about-us',
        'sectionTitle' => 'About our practice',
    ])

    @include('website.partials.book-your-visit')

@endsection
