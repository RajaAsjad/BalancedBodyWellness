{{--
  Repeatable fields (single-line input or textarea).
  @param string $name
  @param string $label
  @param array  $items
  @param string $placeholder
  @param bool   $required
  @param string $fieldType   'input' (default) or 'textarea'
  @param int    $rows        Textarea rows (default 4)
--}}
@php
    $items = $items ?? [''];
    if (!is_array($items)) {
        $items = [''];
    }
    $items = array_values($items);
    if (count($items) === 0) {
        $items = [''];
    }
    $placeholder = $placeholder ?? 'Enter item';
    $required = $required ?? true;
    $fieldType = $fieldType ?? 'input';
    $rows = $rows ?? 4;
    $isTextarea = $fieldType === 'textarea';
@endphp
<div
    class="bbw-form-group bbw-repeater{{ $isTextarea ? ' bbw-repeater--textarea' : '' }}"
    data-bbw-repeater="{{ $name }}"
    data-bbw-repeater-field="{{ $fieldType }}"
    data-bbw-repeater-rows="{{ $rows }}"
    data-bbw-repeater-required="{{ $required ? '1' : '0' }}"
>
    <div class="bbw-repeater__head">
        <label class="bbw-repeater__label">{{ $label }} @if($required)<span class="text-danger">*</span>@endif</label>
    </div>
    <div class="bbw-repeater__list">
        @foreach ($items as $index => $item)
        <div class="bbw-repeater__row">
            @if ($isTextarea)
            <textarea
                class="form-control bbw-repeater__input"
                name="{{ $name }}[]"
                rows="{{ $rows }}"
                placeholder="{{ $placeholder }}"
                @if($required && $index === 0) required @endif
            >{{ $item }}</textarea>
            @else
            <input
                type="text"
                class="form-control bbw-repeater__input"
                name="{{ $name }}[]"
                value="{{ $item }}"
                placeholder="{{ $placeholder }}"
                @if($required && $index === 0) required @endif
            >
            @endif
            <button type="button" class="bbw-repeater__remove" data-bbw-repeater-remove title="Remove" aria-label="Remove item">
                <i class="fa fa-times"></i>
            </button>
        </div>
        @endforeach
    </div>
    <div class="bbw-repeater__foot">
        <button type="button" class="bbw-repeater__add" data-bbw-repeater-add aria-label="Add {{ strtolower($label) }}">
            <i class="fa fa-plus"></i> Add
        </button>
    </div>
    @error($name)
    <span class="bbw-field-error">{{ $message }}</span>
    @enderror
    @error($name . '.*')
    <span class="bbw-field-error">{{ $message }}</span>
    @enderror
</div>
