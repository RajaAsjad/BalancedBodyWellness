@php
    $dropdownActive = ($navActiveKey ?? null) === $menuKey;
    $panelId = 'mobile-nav-dropdown-' . $menuKey;
    $currentSlug = request()->route('slug');

    $isAllActive = match ($menuKey) {
        'services' => request()->routeIs('services'),
        'locations' => request()->routeIs('locations'),
        default => false,
    };
@endphp
<div class="mobile-menu__dropdown" data-mobile-nav-dropdown>
    <button type="button"
        class="mobile-menu__dropdown-trigger{{ $dropdownActive ? ' mobile-menu__link--active' : '' }}"
        aria-expanded="false"
        aria-controls="{{ $panelId }}"
        data-nav-key="{{ $menuKey }}">
        <span>{{ $label }}</span>
        <svg class="mobile-menu__dropdown-chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="m6 9 6 6 6-6" />
        </svg>
    </button>
    <div class="mobile-menu__dropdown-panel" id="{{ $panelId }}" hidden>
        @foreach ($items as $entry)
            @php
                $isItemActive = match ($menuKey) {
                    'services' => request()->routeIs('service.detail') && $currentSlug === ($entry['slug'] ?? null),
                    'locations' => request()->routeIs('location.detail') && $currentSlug === ($entry['slug'] ?? null),
                    default => false,
                };
            @endphp
            <a href="{{ $entry['href'] }}"
                class="mobile-menu__dropdown-link{{ $isItemActive ? ' mobile-menu__dropdown-link--active' : '' }}"
                @if ($isItemActive) aria-current="page" @endif>{{ $entry['label'] }}</a>
        @endforeach
        @if (!empty($allHref))
            <a href="{{ $allHref }}"
                class="mobile-menu__dropdown-link mobile-menu__dropdown-link--all{{ $isAllActive ? ' mobile-menu__dropdown-link--active' : '' }}"
                @if ($isAllActive) aria-current="page" @endif>{{ $allLabel }}</a>
        @endif
    </div>
</div>
