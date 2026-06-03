@php
    $model = $model ?? null;
    $paragraphItems = \App\Models\Location::listItemsForForm(
        $model?->welcome_paragraphs,
        old('welcome_paragraphs')
    );
    $highlightItems = \App\Models\Location::listItemsForForm(
        $model?->welcome_highlights,
        old('welcome_highlights')
    );
    $serviceItems = \App\Models\Location::pairsForForm(
        $model?->welcome_services,
        old('welcome_services')
    );
    $processItems = \App\Models\Location::pairsForForm(
        $model?->process_items,
        old('process_items')
    );
    $imagePreview = $model?->image
        ? asset('admin/assets/images/locations/' . $model->image)
        : asset('assets/website/images/hero-wellness.jpg');
@endphp

<div class="bbw-form-section">
    <h3 class="bbw-form-section__title">Basic info</h3>

    <div class="bbw-form-group">
        <label for="location_name">Location name <span class="text-danger">*</span></label>
        <input type="text" id="location_name" class="form-control" name="name" value="{{ old('name', $model?->name) }}" placeholder="e.g. Rockland County" required>
        @error('name')
        <span class="bbw-field-error">{{ $message }}</span>
        @enderror
    </div>

    @if($model)
    <div class="bbw-form-group">
        <label for="location_slug">URL slug</label>
        <input type="text" id="location_slug" class="form-control" name="slug" value="{{ old('slug', $model->slug) }}" placeholder="iv-therapy-rockland-county">
        <p class="text-muted small mb-0">Public page: {{ url('/') }}/<span id="slug-preview">{{ old('slug', $model->slug) }}</span></p>
        @error('slug')
        <span class="bbw-field-error">{{ $message }}</span>
        @enderror
    </div>
    @endif

    <div class="bbw-form-group">
        <label for="location_sort">Sort order</label>
        <input type="number" id="location_sort" class="form-control" name="sort_order" min="0" max="9999" value="{{ old('sort_order', $model?->sort_order ?? 0) }}">
        @error('sort_order')
        <span class="bbw-field-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="bbw-form-group">
        <label for="location_image">Card / hero image @if(!$model)<span class="text-danger">*</span>@else<span class="text-muted">(optional)</span>@endif</label>
        <input type="file" name="image" accept="image/*" id="location_image" class="form-control" @if(!$model) required @endif>
        @if($model?->image)
        <p class="text-muted small mb-0">Current: {{ $model->image }}</p>
        @endif
        @error('image')
        <span class="bbw-field-error">{{ $message }}</span>
        @enderror
        <div class="bbw-image-preview mt-2">
            <img id="location_image_preview" src="{{ $imagePreview }}" alt="Location image preview" style="max-width:180px;border-radius:8px;">
        </div>
    </div>

    @if($model)
    <div class="bbw-form-group">
        <label for="location_status">Status</label>
        <select name="status" id="location_status" class="form-control">
            <option value="1" {{ old('status', $model->status) == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('status', $model->status) == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
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
        <label for="hero_eyebrow">Banner Title</label>
        <input type="text" id="hero_eyebrow" class="form-control" name="hero_eyebrow" value="{{ old('hero_eyebrow', $model?->hero_eyebrow) }}" placeholder="Rockland County · IV Wellness Studio">
        @error('hero_eyebrow')
        <span class="bbw-field-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="bbw-form-group">
        <label for="hero_title">Banner Heading</label>
        <input type="text" id="hero_title" class="form-control" name="hero_title" value="{{ old('hero_title', $model?->hero_title) }}" placeholder="IV Therapy Rockland County">
        @error('hero_title')
        <span class="bbw-field-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="bbw-form-group">
        <label for="hero_lead">Banner Description</label>
        <textarea id="hero_lead" class="form-control" name="hero_lead" rows="3" placeholder="Short intro under the hero title">{{ old('hero_lead', $model?->hero_lead) }}</textarea>
        @error('hero_lead')
        <span class="bbw-field-error">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="bbw-form-section">
    <h3 class="bbw-form-section__title">Welcome section</h3>

    <div class="bbw-form-group">
        <label for="welcome_label">Section label</label>
        <input type="text" id="welcome_label" class="form-control" name="welcome_label" value="{{ old('welcome_label', $model?->welcome_label) }}" placeholder="WELCOME">
    </div>

    <div class="bbw-form-group">
        <label for="welcome_title">Section title</label>
        <input type="text" id="welcome_title" class="form-control" name="welcome_title" value="{{ old('welcome_title', $model?->welcome_title) }}" placeholder="IV Wellness Studio in Rockland County">
    </div>

    @include('admin.partials.bbw-list-repeater', [
        'name' => 'welcome_paragraphs',
        'label' => 'Paragraphs',
        'items' => $paragraphItems,
        'placeholder' => 'Enter a paragraph (HTML allowed)',
        'fieldType' => 'textarea',
        'rows' => 4,
        'required' => false,
    ])

    @include('admin.partials.bbw-list-repeater', [
        'name' => 'welcome_highlights',
        'label' => 'Highlights',
        'items' => $highlightItems,
        'placeholder' => 'e.g. Medical clearance included',
        'required' => false,
    ])

    @include('admin.partials.bbw-pair-repeater', [
        'name' => 'welcome_services',
        'label' => 'Service cards',
        'items' => $serviceItems,
        'titlePlaceholder' => 'Card title',
        'textPlaceholder' => 'Card description',
    ])
</div>

<div class="bbw-form-section">
    <h3 class="bbw-form-section__title">Process section</h3>

    <div class="bbw-form-group">
        <label for="process_label">Section label</label>
        <input type="text" id="process_label" class="form-control" name="process_label" value="{{ old('process_label', $model?->process_label) }}" placeholder="HOW IT WORKS">
    </div>

    <div class="bbw-form-group">
        <label for="process_title">Section title</label>
        <input type="text" id="process_title" class="form-control" name="process_title" value="{{ old('process_title', $model?->process_title) }}" placeholder="The Process at Our Studio">
    </div>

    @include('admin.partials.bbw-pair-repeater', [
        'name' => 'process_items',
        'label' => 'Process steps',
        'items' => $processItems,
        'titlePlaceholder' => 'Step title',
        'textPlaceholder' => 'Step description',
    ])
</div>
