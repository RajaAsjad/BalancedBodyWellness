@php
    $blogPages = \App\Models\Faq::blogPagesForPicker();
    $selectedSlug = old('blog_slug', $selectedBlogSlug ?? '');
@endphp
<div class="bbw-form-group" id="faq_blog_wrap" style="display: none; max-width: 420px;">
    <label for="faq_blog_slug">Select blog <span class="text-danger">*</span></label>
    <select id="faq_blog_slug" name="blog_slug" class="form-control">
        <option value="">— Select blog —</option>
        @foreach ($blogPages as $item)
            <option value="{{ $item['slug'] }}" {{ (string) $selectedSlug === (string) $item['slug'] ? 'selected' : '' }}>
                {{ $item['label'] }}
            </option>
        @endforeach
    </select>
    <p class="help-block" style="margin:0.35rem 0 0;font-size:12px;color:#5f6f68;">FAQs will show only on that blog&rsquo;s detail page.</p>
    @error('blog_slug')
    <span class="bbw-field-error">{{ $message }}</span>
    @enderror
</div>
