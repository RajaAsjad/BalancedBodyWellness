@php
    $locationPages = \App\Models\Faq::locationLandingPagesForPicker();
    $selectedSlug = old('location_slug', $selectedLocationSlug ?? '');
@endphp
<div class="bbw-form-group" id="faq_location_wrap" style="display: none; max-width: 420px;">
    <label for="faq_location_slug">Select location <span class="text-danger">*</span></label>
    <select id="faq_location_slug" name="location_slug" class="form-control">
        <option value="">— Select location —</option>
        @foreach ($locationPages as $item)
            <option value="{{ $item['slug'] }}" {{ (string) $selectedSlug === (string) $item['slug'] ? 'selected' : '' }}>
                {{ $item['label'] }}
            </option>
        @endforeach
    </select>
    <p class="help-block" style="margin:0.35rem 0 0;font-size:12px;color:#5f6f68;">FAQs will show only on that location&rsquo;s page (e.g. Rockland County, Westchester).</p>
    @error('location_slug')
    <span class="bbw-field-error">{{ $message }}</span>
    @enderror
</div>
