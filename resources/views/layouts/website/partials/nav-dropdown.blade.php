@php
    $dropdownActive = ($navActiveKey ?? null) === $menuKey;
    $panelId = 'nav-dropdown-' . $menuKey;
    $currentSlug = request()->route('slug');

    $isAllActive = match ($menuKey) {
        'services' => request()->routeIs('services'),
        'locations' => request()->routeIs('locations'),
        default => false,
    };
@endphp
<div class="nav__dropdown" data-nav-dropdown>
    <span
        class="nav__link nav__dropdown-trigger{{ $dropdownActive ? ' nav__link--active' : '' }}"
        role="presentation"
        data-nav-key="{{ $menuKey }}"
        @if ($dropdownActive) aria-current="true" @endif>
        <span class="nav__dropdown-label">{{ $label }}</span>
        <svg class="nav__dropdown-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="m6 9 6 6 6-6" />
        </svg>
    </span>
    <div class="nav__dropdown-panel" id="{{ $panelId }}" role="menu" aria-label="{{ $label }}">
        @foreach ($items as $entry)
            @php
                $isItemActive = match ($menuKey) {
                    'services' => request()->routeIs('service.detail') && $currentSlug === ($entry['slug'] ?? null),
                    'locations' => request()->routeIs('location.page', 'location.detail') && $currentSlug === ($entry['slug'] ?? null),
                    default => false,
                };
            @endphp
            <a href="{{ $entry['href'] }}"
                class="nav__dropdown-link{{ $isItemActive ? ' nav__dropdown-link--active' : '' }}"
                role="menuitem"
                @if ($isItemActive) aria-current="page" @endif>{{ $entry['label'] }}</a>
        @endforeach
        @if (!empty($allHref))
            <a href="{{ $allHref }}"
                class="nav__dropdown-link nav__dropdown-link--all{{ $isAllActive ? ' nav__dropdown-link--active' : '' }}"
                role="menuitem"
                @if ($isAllActive) aria-current="page" @endif>{{ $allLabel }}</a>
        @endif
    </div>
</div>
