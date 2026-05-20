<div class="bbw-form-group" id="faq_service_wrap" style="display: none; max-width: 420px;">
    <label for="faq_service_id">Select service <span class="text-danger">*</span></label>
    <select id="faq_service_id" name="service_id" class="form-control">
        <option value="">— Select service —</option>
        @foreach ($services as $svc)
            <option value="{{ $svc->id }}" {{ (string) old('service_id', $selectedServiceId ?? '') === (string) $svc->id ? 'selected' : '' }}>
                {{ $svc->heading }}
            </option>
        @endforeach
    </select>
    <p class="help-block" style="margin:0.35rem 0 0;font-size:12px;color:#5f6f68;">FAQs will show only on that service&rsquo;s detail page.</p>
    @error('service_id')
    <span class="bbw-field-error">{{ $message }}</span>
    @enderror
</div>
