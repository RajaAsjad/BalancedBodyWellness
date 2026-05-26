@php
    $navMenus = config('nav_menus');

    $serviceDropdownItems = collect($navMenus['services']['items'] ?? [])->map(fn ($item) => [
        'label' => $item['label'],
        'slug' => $item['slug'],
        'href' => route('service.detail', $item['slug']),
    ])->all();

    $locationDropdownItems = collect($navMenus['locations']['items'] ?? [])->map(fn ($item) => [
        'label' => $item['label'],
        'slug' => $item['slug'],
        'href' => config("location_pages.{$item['slug']}")
            ? route('location.page', ['slug' => $item['slug']])
            : route('location.detail', $item['slug']),
    ])->all();

    $navSections = [
        ['key' => 'home', 'type' => 'link', 'href' => url('/'), 'label' => 'Home'],
        [
            'key' => 'services',
            'type' => 'dropdown',
            'label' => 'Services',
            'items' => $serviceDropdownItems,
            'allHref' => route('services'),
            'allLabel' => $navMenus['services']['all_label'] ?? 'All Services',
        ],
        [
            'key' => 'locations',
            'type' => 'dropdown',
            'label' => 'Locations',
            'items' => $locationDropdownItems,
        ],
        ['key' => 'about', 'type' => 'link', 'href' => url('/about-us'), 'label' => 'About'],
        ['key' => 'faq', 'type' => 'link', 'href' => url('/faqs'), 'label' => 'FAQ'],
        ['key' => 'policies', 'type' => 'link', 'href' => url('/policies'), 'label' => 'Policies'],
        ['key' => 'contact', 'type' => 'link', 'href' => url('/contact'), 'label' => 'Contact'],
    ];

    $navActiveKey = match (true) {
        request()->routeIs('index') => 'home',
        request()->routeIs('services', 'service.detail') => 'services',
        request()->routeIs('locations', 'location.detail', 'location.page') => 'locations',
        request()->routeIs('about-us') => 'about',
        request()->routeIs('faqs') => 'faq',
        request()->routeIs('policies') => 'policies',
        request()->routeIs('contact') => 'contact',
        default => null,
    };
@endphp
<header class="nav" id="nav" role="banner">
    <div class="nav__inner">
        <a href="{{ url('/') }}" class="nav__logo" aria-label="Balanced Body IV Wellness home">
            @if (!empty($home_page_data['header_logo']))
                <img class="nav__logo-img"
                    src="{{ asset('admin/assets/images/page/' . $home_page_data['header_logo']) }}"
                    alt="Balanced Body IV Wellness">
            @else
                <span class="nav__logo-icon" aria-hidden="true">
                    <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" width="40" height="40">
                        <circle cx="20" cy="20" r="19" stroke="rgba(90, 125, 108, 0.35)" stroke-width="1" />
                        <circle cx="20" cy="20" r="14" fill="url(#nav-logo-g)" />
                        <path d="M12 26c4-6 8-10 16-12" stroke="#c9a227" stroke-width="2" stroke-linecap="round" opacity="0.9" />
                        <circle cx="14" cy="16" r="3" fill="#5a7d6c" opacity="0.85" />
                        <defs>
                            <linearGradient id="nav-logo-g" x1="8" y1="10" x2="32" y2="30" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#e8f0ec" />
                                <stop offset="1" stop-color="#c5d9cc" />
                            </linearGradient>
                        </defs>
                    </svg>
                </span>
            @endif
            <span class="nav__logo-wordmark">
                <span class="nav__logo-title">Balanced Body</span>
                <span class="nav__logo-tagline">IV WELLNESS</span>
            </span>
        </a>

        <div class="nav__right">
            <nav class="nav__links" role="navigation" aria-label="Primary navigation">
                @foreach ($navSections as $item)
                    @if (($item['type'] ?? 'link') === 'dropdown')
                        @include('layouts.website.partials.nav-dropdown', [
                            'menuKey' => $item['key'],
                            'label' => $item['label'],
                            'items' => $item['items'],
                            'allHref' => $item['allHref'] ?? null,
                            'allLabel' => $item['allLabel'] ?? null,
                        ])
                    @else
                        @php
                            $navLinkActive = $navActiveKey === $item['key'];
                        @endphp
                        <a href="{{ $item['href'] }}"
                            class="nav__link{{ $navLinkActive ? ' nav__link--active' : '' }}"
                            data-nav-key="{{ $item['key'] }}"
                            @if ($navLinkActive) aria-current="page" @endif>{{ $item['label'] }}</a>
                    @endif
                @endforeach
                @auth
                    <a href="{{ route('dashboard') }}" class="nav__link" rel="nofollow">Dashboard</a>
                    <a href="{{ route('logout') }}" class="nav__link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                @endauth
            </nav>

            <a href="{{ url('/contact') }}" class="nav__cta">
                <svg class="nav__cta-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                Book Now
            </a>

            <button type="button" class="nav__hamburger" aria-label="Toggle mobile menu" aria-expanded="false"
                aria-controls="mobile-menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>

<div class="mobile-menu" id="mobile-menu" role="dialog" aria-label="Mobile navigation" aria-hidden="true">
    <div class="mobile-menu__inner">
        <nav class="mobile-menu__links" role="navigation">
            @foreach ($navSections as $item)
                @if (($item['type'] ?? 'link') === 'dropdown')
                    @include('layouts.website.partials.mobile-nav-dropdown', [
                        'menuKey' => $item['key'],
                        'label' => $item['label'],
                        'items' => $item['items'],
                        'allHref' => $item['allHref'] ?? null,
                        'allLabel' => $item['allLabel'] ?? null,
                    ])
                @else
                    @php
                        $navLinkActive = $navActiveKey === $item['key'];
                    @endphp
                    <a href="{{ $item['href'] }}"
                        class="mobile-menu__link{{ $navLinkActive ? ' mobile-menu__link--active' : '' }}"
                        data-nav-key="{{ $item['key'] }}"
                        @if ($navLinkActive) aria-current="page" @endif>{{ $item['label'] }}</a>
                @endif
            @endforeach
            @auth
                <a href="{{ route('dashboard') }}" class="mobile-menu__link" rel="nofollow">Dashboard</a>
                <a href="{{ route('logout') }}" class="mobile-menu__link"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            @endauth
        </nav>
        <a href="{{ url('/contact') }}" class="mobile-menu__cta">
            <svg class="nav__cta-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            Book Now
        </a>
    </div>
</div>

@auth
    <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
        @csrf
    </form>
@endauth
