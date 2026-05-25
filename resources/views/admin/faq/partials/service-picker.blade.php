@php
    $landingPages = \App\Models\Faq::serviceLandingPagesForPicker();
    $selectedSlug = old('service_slug', $selectedServiceSlug ?? '');
@endphp
<div class="bbw-form-group" id="faq_service_wrap" style="display: none; max-width: 420px;">
    <label for="faq_service_slug">Select service <span class="text-danger">*</span></label>
    <select id="faq_service_slug" name="service_slug" class="form-control">
        <option value="">— Select service —</option>
        @foreach ($landingPages as $item)
            <option value="{{ $item['slug'] }}" {{ (string) $selectedSlug === (string) $item['slug'] ? 'selected' : '' }}>
                {{ $item['label'] }}
            </option>
        @endforeach
        @if (!empty($services) && $services->isNotEmpty())
            <optgroup label="Other services (admin catalog)">
                @foreach ($services as $svc)
                    @php $svcSlug = \Illuminate\Support\Str::slug($svc->heading); @endphp
                    @if (!collect($landingPages)->contains('slug', $svcSlug))
                        <option value="{{ $svcSlug }}" {{ (string) $selectedSlug === (string) $svcSlug ? 'selected' : '' }}>
                            {{ $svc->heading }}
                        </option>
                    @endif
                @endforeach
            </optgroup>
        @endif
    </select>
    <p class="help-block" style="margin:0.35rem 0 0;font-size:12px;color:#5f6f68;">FAQs will show only on that service&rsquo;s page (e.g. Methylene Blue, NAD, Peptide Therapy).</p>
    @error('service_slug')
    <span class="bbw-field-error">{{ $message }}</span>
    @enderror
</div>
