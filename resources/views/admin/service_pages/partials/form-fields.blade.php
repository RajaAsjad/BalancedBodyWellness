@php
    $model = $model ?? null;
    $hero = $model?->hero ?? [];
    $overview = $model?->overview ?? [];
    $dripMenu = $model?->drip_menu ?? [];
    $supports = $model?->supports ?? [];

    $paragraphItems = \App\Models\ServicePage::listItemsForForm(
        $overview['paragraphs'] ?? [],
        old('overview_paragraphs')
    );
    $featureItems = \App\Models\ServicePage::pairsForForm(
        $overview['features'] ?? [],
        old('overview_features')
    );
    $dripItems = \App\Models\ServicePage::pairsForForm(
        $dripMenu['items'] ?? [],
        old('drip_menu_items')
    );
    $supportItems = \App\Models\ServicePage::pairsForForm(
        $supports['items'] ?? [],
        old('supports_items')
    );
    $statItems = \App\Models\ServicePage::statsForForm(
        $supports['stats'] ?? [],
        old('supports_stats')
    );
@endphp

<div class="bbw-form-section">
    <h3 class="bbw-form-section__title">Basic info</h3>

    <div class="bbw-form-group">
        <label for="service_page_name">Page name <span class="text-danger">*</span></label>
        <input type="text" id="service_page_name" class="form-control" name="name" value="{{ old('name', $model?->name) }}" placeholder="e.g. NAD Therapy" required>
        @error('name')
        <span class="bbw-field-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="bbw-form-group">
        <label for="service_page_nav_label">Dropdown label</label>
        <input type="text" id="service_page_nav_label" class="form-control" name="nav_label" value="{{ old('nav_label', $model?->nav_label) }}" placeholder="Short label for navigation menu (optional)">
        <p class="text-muted small mb-0">Used in the Services dropdown when DB navigation is enabled.</p>
        @error('nav_label')
        <span class="bbw-field-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="bbw-form-group">
        <label for="service_page_slug">URL slug @if(!$model)<span class="text-danger">*</span>@endif</label>
        <input type="text" id="service_page_slug" class="form-control" name="slug" value="{{ old('slug', $model?->slug) }}" placeholder="nad-therapy-nyc" @if(!$model) required @endif>
        @if($model)
        <p class="text-muted small mb-0">Public page: {{ url('/') }}/<span id="slug-preview">{{ old('slug', $model->slug) }}</span></p>
        @endif
        @error('slug')
        <span class="bbw-field-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="bbw-form-group">
        <label for="service_page_sort">Sort order</label>
        <input type="number" id="service_page_sort" class="form-control" name="sort_order" min="0" max="9999" value="{{ old('sort_order', $model?->sort_order ?? 0) }}">
        @error('sort_order')
        <span class="bbw-field-error">{{ $message }}</span>
        @enderror
    </div>

    @php
        $showInNav = (bool) old('show_in_nav', $model?->show_in_nav ?? true);
    @endphp
    @include('admin.partials.bbw-yes-no-toggle', [
        'name' => 'show_in_nav',
        'id' => 'show_in_nav',
        'label' => 'Show in Services dropdown',
        'checked' => $showInNav,
        'help' => 'Uncheck to hide from the Services dropdown only — the page URL still works when active.',
        'yesLabel' => 'Yes',
        'noLabel' => 'No',
    ])
    @error('show_in_nav')
    <span class="bbw-field-error">{{ $message }}</span>
    @enderror

    @if($model)
    @php
        $isActive = in_array(old('status', $model->status), [1, '1'], true);
    @endphp
    @include('admin.partials.bbw-yes-no-toggle', [
        'name' => 'status',
        'id' => 'service_page_status',
        'label' => 'Page status',
        'checked' => $isActive,
        'help' => 'Inactive pages are hidden from the dropdown and return 404 on the public site.',
        'yesLabel' => 'Active',
        'noLabel' => 'Inactive',
    ])
    @error('status')
    <span class="bbw-field-error">{{ $message }}</span>
    @enderror
    @if($model->is_legacy)
    <div class="bbw-form-callout">
        <i class="fa fa-info-circle" aria-hidden="true"></i>
        <span>Legacy NYC page imported from the original site config. Manage visibility with the toggles above.</span>
    </div>
    @endif
    @endif
</div>

<div class="bbw-form-section">
    <h3 class="bbw-form-section__title">SEO</h3>

    <div class="bbw-form-group">
        <label for="meta_title">Meta title</label>
        <input type="text" id="meta_title" class="form-control" name="meta_title" value="{{ old('meta_title', $model?->meta_title) }}" placeholder="Page title for search engines">
        @error('meta_title')
        <span class="bbw-field-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="bbw-form-group">
        <label for="meta_description">Meta description</label>
        <textarea id="meta_description" class="form-control" name="meta_description" rows="3" placeholder="Short description for search results">{{ old('meta_description', $model?->meta_description) }}</textarea>
        @error('meta_description')
        <span class="bbw-field-error">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="bbw-form-section">
    <h3 class="bbw-form-section__title">Hero section</h3>

    <div class="bbw-form-group">
        <label for="hero_eyebrow">Eyebrow text</label>
        <input type="text" id="hero_eyebrow" class="form-control" name="hero_eyebrow" value="{{ old('hero_eyebrow', $hero['eyebrow'] ?? '') }}" placeholder="CELLULAR LONGEVITY · COGNITIVE SUPPORT · NYC">
    </div>

    <div class="bbw-form-group">
        <label for="hero_title_style">Title style</label>
        <select id="hero_title_style" class="form-control" name="hero_title_style">
            @php $titleStyle = old('hero_title_style', $hero['title_style'] ?? 'standard'); @endphp
            <option value="standard" {{ $titleStyle === 'standard' ? 'selected' : '' }}>Standard (title main + accent lines)</option>
            <option value="iv_vitamin" {{ $titleStyle === 'iv_vitamin' ? 'selected' : '' }}>IV Vitamin style (prefix + main + suffix)</option>
            <option value="gold_first" {{ $titleStyle === 'gold_first' ? 'selected' : '' }}>Gold first</option>
            <option value="white_first" {{ $titleStyle === 'white_first' ? 'selected' : '' }}>White first</option>
        </select>
    </div>

    <div class="bbw-form-group">
        <label for="hero_title_prefix">Title prefix</label>
        <input type="text" id="hero_title_prefix" class="form-control" name="hero_title_prefix" value="{{ old('hero_title_prefix', $hero['title_prefix'] ?? '') }}" placeholder="IV (for IV Vitamin style)">
    </div>

    <div class="bbw-form-group">
        <label for="hero_title_main">Title main</label>
        <input type="text" id="hero_title_main" class="form-control" name="hero_title_main" value="{{ old('hero_title_main', $hero['title_main'] ?? '') }}" placeholder="Methylene Blue">
    </div>

    <div class="bbw-form-group">
        <label for="hero_title_accent">Title accent (second line)</label>
        <input type="text" id="hero_title_accent" class="form-control" name="hero_title_accent" value="{{ old('hero_title_accent', $hero['title_accent'] ?? '') }}" placeholder="IV Therapy NYC">
    </div>

    <div class="bbw-form-group">
        <label for="hero_title_suffix">Title suffix</label>
        <input type="text" id="hero_title_suffix" class="form-control" name="hero_title_suffix" value="{{ old('hero_title_suffix', $hero['title_suffix'] ?? '') }}" placeholder="NYC">
    </div>

    <div class="bbw-form-group">
        <label for="hero_lead">Lead paragraph</label>
        <textarea id="hero_lead" class="form-control" name="hero_lead" rows="3" placeholder="Short intro under the hero title">{{ old('hero_lead', $hero['lead'] ?? '') }}</textarea>
    </div>
</div>

<div class="bbw-form-section">
    <h3 class="bbw-form-section__title">Overview (What it is)</h3>

    <div class="bbw-form-group">
        <label for="overview_label">Section label</label>
        <input type="text" id="overview_label" class="form-control" name="overview_label" value="{{ old('overview_label', $overview['label'] ?? '') }}" placeholder="WHAT IT IS">
    </div>

    <div class="bbw-form-group">
        <label for="overview_title">Section title</label>
        <input type="text" id="overview_title" class="form-control" name="overview_title" value="{{ old('overview_title', $overview['title'] ?? '') }}" placeholder="IV Methylene Blue Therapy NYC">
    </div>

    @include('admin.partials.bbw-list-repeater', [
        'name' => 'overview_paragraphs',
        'label' => 'Paragraphs',
        'items' => $paragraphItems,
        'placeholder' => 'Enter a paragraph (HTML allowed)',
        'fieldType' => 'textarea',
        'rows' => 4,
        'required' => false,
    ])

    @include('admin.partials.bbw-pair-repeater', [
        'name' => 'overview_features',
        'label' => 'Feature cards',
        'items' => $featureItems,
        'titlePlaceholder' => 'Feature title',
        'textPlaceholder' => 'Feature description',
    ])
</div>

<div class="bbw-form-section">
    <h3 class="bbw-form-section__title">IV Drip menu (optional)</h3>

    <div class="bbw-form-group">
        <label for="drip_menu_title">Section title</label>
        <input type="text" id="drip_menu_title" class="form-control" name="drip_menu_title" value="{{ old('drip_menu_title', $dripMenu['title'] ?? '') }}" placeholder="The IV Drip Menu — 11 Formulations">
    </div>

    @include('admin.partials.bbw-pair-repeater', [
        'name' => 'drip_menu_items',
        'label' => 'Drip items',
        'items' => $dripItems,
        'titlePlaceholder' => 'Drip name',
        'textPlaceholder' => 'Drip description',
    ])
</div>

<div class="bbw-form-section">
    <h3 class="bbw-form-section__title">Clinical nutrient support</h3>

    <div class="bbw-form-group">
        <label for="supports_label">Section label</label>
        <input type="text" id="supports_label" class="form-control" name="supports_label" value="{{ old('supports_label', $supports['label'] ?? '') }}" placeholder="CLINICAL NUTRIENT SUPPORT">
    </div>

    <div class="bbw-form-group">
        <label for="supports_title">Section title</label>
        <input type="text" id="supports_title" class="form-control" name="supports_title" value="{{ old('supports_title', $supports['title'] ?? '') }}" placeholder="What Supports Methylene Blue Therapy">
    </div>

    <div class="bbw-form-group">
        <label for="supports_lead">Lead paragraph</label>
        <textarea id="supports_lead" class="form-control" name="supports_lead" rows="3" placeholder="Intro text for the support section">{{ old('supports_lead', $supports['lead'] ?? '') }}</textarea>
    </div>

    @include('admin.partials.bbw-pair-repeater', [
        'name' => 'supports_items',
        'label' => 'Support items',
        'items' => $supportItems,
        'titlePlaceholder' => 'Nutrient title',
        'textPlaceholder' => 'Nutrient description',
    ])

    <div class="bbw-form-group" data-bbw-stat-repeater="supports_stats">
        <div class="bbw-repeater__head">
            <label class="bbw-repeater__label">Stats row (optional)</label>
        </div>
        <div class="bbw-stat-repeater__list">
            @foreach ($statItems as $index => $stat)
            <div class="bbw-stat-repeater__row">
                <input type="text" class="form-control" name="supports_stats[{{ $index }}][value]" value="{{ $stat['value'] }}" placeholder="Value (e.g. 100%)">
                <input type="text" class="form-control" name="supports_stats[{{ $index }}][label]" value="{{ $stat['label'] }}" placeholder="Label">
                <label class="checkbox-inline mb-0">
                    <input type="checkbox" name="supports_stats[{{ $index }}][serif]" value="1" {{ !empty($stat['serif']) ? 'checked' : '' }}> Serif
                </label>
                <button type="button" class="bbw-repeater__remove" data-bbw-stat-remove title="Remove"><i class="fa fa-times"></i></button>
            </div>
            @endforeach
        </div>
        <div class="bbw-repeater__foot">
            <button type="button" class="bbw-repeater__add" data-bbw-stat-add><i class="fa fa-plus"></i> Add stat</button>
        </div>
    </div>
</div>
