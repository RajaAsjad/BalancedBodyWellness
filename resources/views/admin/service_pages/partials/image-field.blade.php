@php
    $inputId = $inputId ?? 'service_image';
    $previewId = $previewId ?? $inputId . '_preview';
    $name = $name ?? 'image';
    $label = $label ?? 'Image';
    $required = $required ?? true;
    $currentUrl = $currentUrl ?? \App\Models\Services::imagePlaceholderUrl();
    $hasExisting = $hasExisting ?? false;
@endphp
<div class="bbw-form-group">
    <label for="{{ $inputId }}">{{ $label }} @if ($required)<span class="text-danger">*</span>@else<span class="text-muted">(optional — leave empty to keep current)</span>@endif</label>
    <input type="file" id="{{ $inputId }}" class="form-control bbw-image-input" name="{{ $name }}" accept="image/jpeg,image/png,image/jpg,image/webp,image/gif"
        data-preview="{{ $previewId }}" @if ($required && ! $hasExisting) required @endif>
    @error($name)
    <span class="bbw-field-error">{{ $message }}</span>
    @enderror
    <div class="image-preview-section">
        <img id="{{ $previewId }}" class="bbw-image-preview{{ $hasExisting ? '' : ' is-placeholder' }}" src="{{ $currentUrl }}" alt="{{ $label }} preview">
        <p class="image-preview-hint">Preview updates when you choose a file (before saving).</p>
    </div>
</div>
