@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $page_meta_description)
@section('content')
    @php
        $contactPhoneDisplay = '(914) 745-6924';
        $contactPhoneTel = '9147456924';
        $contactEmail = 'info@balancedbodyivwellness.com';
        $contactInstagramUrl = 'https://instagram.com/balancedbodyivwellness';
        $contactInstagramHandle = '@balancedbodyivwellness';
        $rawAddress = 'Mobile Services';
    @endphp

    <section class="page-hero page-hero--wellness page-hero--contact" aria-labelledby="contact-hero-heading">
        <div class="container-pns">
            <p class="page-hero__booking-pill">
                <span class="page-hero__booking-pill__icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </span>
                <span class="page-hero__booking-pill__text">Book your visit</span>
            </p>
            <h1 class="page-hero__title" id="contact-hero-heading">Let&rsquo;s get you scheduled.</h1>
            <p class="page-hero__note">Send us a request and we&rsquo;ll confirm your appointment, share intake forms, and
                walk you through medical clearance.</p>
        </div>
    </section>

    <section class="section-pns section-pns--contact-appt" aria-label="Request an appointment">
        <div class="container-pns contact-appt">
            <div class="contact-appt__grid">
                <div class="contact-appt__main">
                    <div class="contact-appt__card contact-appt__card--form">
                        <h2 class="contact-appt__form-title">Request an appointment</h2>

                        @if (session('status'))
                            <p class="contact-appt__flash contact-appt__flash--success" role="status">{{ session('status') }}
                            </p>
                        @endif

                        <form class="contact-appt__form" action="{{ route('contactus.store') }}" method="post"
                            novalidate>
                            @csrf

                            @if ($errors->any())
                                <div class="contact-appt__flash contact-appt__flash--error" role="alert">
                                    <p class="contact-appt__flash-title">Please fix the following:</p>
                                    <ul class="contact-appt__flash-list">
                                        @foreach ($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="contact-appt__fields">
                                <div class="contact-appt__row contact-appt__row--2">
                                    <div class="contact-appt__field">
                                        <label class="contact-appt__label" for="contact-full-name">Full name <span
                                                class="contact-appt__req" aria-hidden="true">*</span></label>
                                        <input class="contact-appt__input" id="contact-full-name" name="full_name"
                                            type="text" autocomplete="name" required maxlength="200"
                                            value="{{ old('full_name') }}" placeholder="Jane Doe">
                                    </div>
                                    <div class="contact-appt__field">
                                        <label class="contact-appt__label" for="contact-phone">Phone <span
                                                class="contact-appt__req" aria-hidden="true">*</span></label>
                                        <input class="contact-appt__input" id="contact-phone" name="phone" type="tel"
                                            autocomplete="tel" required maxlength="50" value="{{ old('phone') }}"
                                            placeholder="(914) 745-6924">
                                    </div>
                                </div>
                                <div class="contact-appt__field">
                                    <label class="contact-appt__label" for="contact-email">Email <span class="contact-appt__req"
                                            aria-hidden="true">*</span></label>
                                    <input class="contact-appt__input" id="contact-email" name="email" type="email"
                                        autocomplete="email" required maxlength="100" value="{{ old('email') }}"
                                        placeholder="you@example.com">
                                </div>
                                <div class="contact-appt__row contact-appt__row--2">
                                    <div class="contact-appt__field">
                                        <label class="contact-appt__label" id="contact-service-label" for="contact-service-trigger">Service of interest</label>
                                        <div class="contact-appt__select" data-contact-service-select>
                                            <select class="contact-appt__select-native" id="contact-service" name="service_of_interest" tabindex="-1" aria-hidden="true">
                                                <option value="">Select a service</option>
                                                @if (!empty($servicePages))
                                                    <optgroup label="Service pages">
                                                        @foreach ($servicePages as $servicePage)
                                                            @php $pageValue = 'page:' . $servicePage['slug']; @endphp
                                                            <option value="{{ $pageValue }}" {{ old('service_of_interest') === $pageValue ? 'selected' : '' }}>
                                                                {{ $servicePage['label'] }}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>
                                                @endif
                                                @if ($services->isNotEmpty())
                                                    <optgroup label="Common Nutrients">
                                                        @foreach ($services as $service)
                                                            @php $serviceValue = 'service:' . $service->id; @endphp
                                                            <option value="{{ $serviceValue }}" {{ old('service_of_interest') === $serviceValue ? 'selected' : '' }}>
                                                                {{ $service->heading }}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>
                                                @endif
                                            </select>
                                            <button type="button" class="contact-appt__input contact-appt__select-trigger" id="contact-service-trigger" aria-haspopup="listbox" aria-expanded="false" aria-labelledby="contact-service-label">
                                                <span class="contact-appt__select-label" data-select-label>Select a service</span>
                                                <span class="contact-appt__select-chevron" aria-hidden="true">
                                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="6 9 12 15 18 9"></polyline>
                                                    </svg>
                                                </span>
                                            </button>
                                            <div class="contact-appt__select-panel" role="listbox" aria-labelledby="contact-service-label" hidden>
                                                <div class="contact-appt__select-scroll"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="contact-appt__field">
                                        <label class="contact-appt__label" for="contact-date">Preferred date</label>
                                        <div class="contact-appt__input-wrap">
                                            <input class="contact-appt__input contact-appt__input--date" id="contact-date"
                                                name="preferred_date" type="date" value="{{ old('preferred_date') }}"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="contact-appt__field">
                                    <label class="contact-appt__label" for="contact-message">Anything we should know?</label>
                                    <textarea class="contact-appt__textarea" id="contact-message" name="message" rows="4"
                                        maxlength="2000" placeholder="Health goals, medical concerns, questions...">{{ old('message') }}</textarea>
                                </div>
                            </div>

                            <button class="contact-appt__submit" type="submit">
                                <svg class="contact-appt__submit-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    aria-hidden="true">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span>Submit Request</span>
                            </button>

                            <p class="contact-appt__fine-print">All visits require medical clearance. Payment is collected in
                                person at your appointment.</p>
                        </form>
                    </div>
                </div>

                <aside class="contact-appt__aside" aria-label="Studio and hours">
                    <div class="contact-appt__card contact-appt__card--studio">
                        <h2 class="contact-appt__studio-title">Visit the studio</h2>
                        <p class="contact-appt__studio-lede">By appointment only.</p>
                        <ul class="contact-appt__studio-list">
                            <li class="contact-appt__studio-item">
                                <span class="contact-appt__studio-icon" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </span>
                                <span class="contact-appt__studio-text">
                                    <span class="contact-appt__studio-line">{{ $rawAddress }}</span>
                                </span>
                            </li>
                            <li class="contact-appt__studio-item">
                                <span class="contact-appt__studio-icon" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <path
                                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.86.35 1.7.7 2.48a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.78.35 1.62.58 2.48.7A2 2 0 0 1 22 16.92z">
                                        </path>
                                    </svg>
                                </span>
                                <a class="contact-appt__studio-link" href="tel:{{ $contactPhoneTel }}">{{ $contactPhoneDisplay }}</a>
                            </li>
                            <li class="contact-appt__studio-item">
                                <span class="contact-appt__studio-icon" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                        </path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                </span>
                                <a class="contact-appt__studio-link"
                                    href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
                            </li>
                            <li class="contact-appt__studio-item">
                                <span class="contact-appt__studio-icon" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                    </svg>
                                </span>
                                <a class="contact-appt__studio-link" href="{{ $contactInstagramUrl }}" target="_blank"
                                    rel="noopener noreferrer">{{ $contactInstagramHandle }}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="contact-appt__card contact-appt__card--hours">
                        <h2 class="contact-appt__hours-title">
                            <span class="contact-appt__hours-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            </span>
                            Hours
                        </h2>
                        <ul class="contact-appt__hours-list">
                            <li><span class="contact-appt__hours-day">Monday &ndash; Friday</span> <span class="contact-appt__hours-time">9:00 AM
                                    &ndash; 7:00 PM</span></li>
                            <li><span class="contact-appt__hours-day">Sunday</span> <span class="contact-appt__hours-time">10:00 AM
                                    &ndash; 4:00 PM</span></li> 
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    @include('website.partials.page-faqs', [
        'pageKey' => 'contact',
        'sectionTitle' => 'Booking & contact questions',
    ])
@endsection
