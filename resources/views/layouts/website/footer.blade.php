@php
    $primaryEmail = 'info@balancedbodyivwellness.com';
    $phoneDisplay = '914-745-6924';
    $phoneTel = '9147456924';
    $footerData = $home_page_data ?? [];
    $instagramUrl = ! empty($footerData['footer_instagram']) ? $footerData['footer_instagram'] : config('seo.business.instagram', '');
    $facebookUrl = ! empty($footerData['footer_facebook']) ? $footerData['footer_facebook'] : config('seo.business.facebook', '');
    $instagramPath = trim((string) parse_url($instagramUrl, PHP_URL_PATH), '/');
    $facebookPath = trim((string) parse_url($facebookUrl, PHP_URL_PATH), '/');
    $instagramHandle = ! empty($footerData['footer_instagram']) ? '@' . strtok($instagramPath, '/') : '@balancedbodyivwellness';
    $facebookHandle = 'Facebook';
    if (! empty($footerData['footer_facebook']) && $facebookPath !== '' && ! str_contains($facebookPath, 'profile.php')) {
        $facebookHandle = strtok($facebookPath, '/');
    }
    $footerNav = [
        ['href' => url('/'), 'label' => 'Home'],
        ['href' => url('/services'), 'label' => 'Services'],
        ['href' => url('/locations'), 'label' => 'Locations'],
        ['href' => url('/about-us'), 'label' => 'About'],
        ['href' => url('/faqs'), 'label' => 'FAQ'],
        ['href' => url('/policies'), 'label' => 'Policies'],
        ['href' => url('/contact'), 'label' => 'Contact'],
    ];
@endphp

<footer class="footer footer--wellness" role="contentinfo">
    <div class="footer__inner">
        <div class="footer__grid">
            <div class="footer__col footer__col--brand">
                <div class="footer__brand-row">
                    <a href="{{ url('/') }}" class="footer__brand-mark" aria-label="Balanced Body IV Wellness home">
                        @if (!empty($home_page_data['footer_image']))
                            <img class="footer__logo-custom"
                                src="{{ asset('admin/assets/images/page/' . $home_page_data['footer_image']) }}"
                                alt="Balanced Body IV Wellness">
                        @else
                            <span class="footer__logo-icon" aria-hidden="true">
                                <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" width="40"
                                    height="40">
                                    <rect x="1" y="1" width="38" height="38" rx="8" stroke="rgba(90, 125, 108, 0.35)"
                                        stroke-width="1" />
                                    <circle cx="20" cy="20" r="12" fill="url(#footer-logo-g)" />
                                    <path d="M12 26c4-6 8-10 16-12" stroke="#c9a227" stroke-width="1.5"
                                        stroke-linecap="round" opacity="0.9" />
                                    <circle cx="14" cy="16" r="2.5" fill="#5a7d6c" opacity="0.85" />
                                    <defs>
                                        <linearGradient id="footer-logo-g" x1="8" y1="10" x2="32" y2="30"
                                            gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#e8f0ec" />
                                            <stop offset="1" stop-color="#c5d9cc" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </span>
                        @endif
                    </a>
                    <div class="footer__brand-titles">
                        <p class="footer__brand-name">Balanced Body</p>
                        <p class="footer__brand-tag">IV WELLNESS</p>
                    </div>
                </div> 
                @if (!empty($home_page_data['footer_description']))
                    <p class="footer__about">{{ $home_page_data['footer_description'] }}</p>
                @endif
            </div>

            <div class="footer__col">
                <h3 class="footer__heading">Explore</h3>
                <nav class="footer__nav" aria-label="Footer">
                    <ul class="footer__nav-list">
                        @foreach ($footerNav as $item)
                            <li><a href="{{ $item['href'] }}">{{ $item['label'] }}</a></li>
                        @endforeach
                    </ul>
                </nav>
            </div>

            <div class="footer__col">
                <h3 class="footer__heading">Connect</h3>
                <ul class="footer__connect-list">
                    <li>
                        <a href="tel:{{ $phoneTel }}" class="footer__connect-link">
                            <span class="footer__connect-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                                    stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.86.35 1.7.7 2.48a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.78.35 1.62.58 2.48.7A2 2 0 0 1 22 16.92z">
                                    </path>
                                </svg>
                            </span>
                            <span class="footer__connect-text">{{ $phoneDisplay }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:{{ $primaryEmail }}" class="footer__connect-link">
                            <span class="footer__connect-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                                    stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                    </path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </span>
                            <span class="footer__connect-text">{{ $primaryEmail }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $instagramUrl }}" class="footer__connect-link" target="_blank"
                            rel="noopener noreferrer" title="Balanced Body IV Wellness on Instagram">
                            <span class="footer__connect-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                                    stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </span>
                            <span class="footer__connect-text">{{ $instagramHandle }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $facebookUrl }}" class="footer__connect-link" target="_blank"
                            rel="noopener noreferrer" title="Balanced Body IV Wellness on Facebook">
                            <span class="footer__connect-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                                    stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                            </span>
                            <span class="footer__connect-text">{{ $facebookHandle }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer__divider" aria-hidden="true"></div>

    <div class="footer__inner">
        <div class="footer__bar">
            <p class="footer__bar-text">&copy; {{ date('Y') }} Balanced Body IV Wellness. All rights reserved.
                In-person payment only.</p>
        </div>
    </div>
</footer>
