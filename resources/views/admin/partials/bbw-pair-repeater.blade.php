{{--
  Repeatable title + text pairs (e.g. service cards, process steps).
  @param string $name
  @param string $label
  @param array  $items  [['title' => '', 'text' => ''], ...]
  @param string $titlePlaceholder
  @param string $textPlaceholder
  @param bool   $required
--}}
@php
    $items = $items ?? [['title' => '', 'text' => '']];
    if (! is_array($items) || $items === []) {
        $items = [['title' => '', 'text' => '']];
    }
    $titlePlaceholder = $titlePlaceholder ?? 'Title';
    $textPlaceholder = $textPlaceholder ?? 'Description';
    $required = $required ?? false;
@endphp
<div class="bbw-form-group bbw-pair-repeater" data-bbw-pair-repeater="{{ $name }}">
    <div class="bbw-repeater__head">
        <label class="bbw-repeater__label">{{ $label }} @if($required)<span class="text-danger">*</span>@endif</label>
    </div>
    <div class="bbw-pair-repeater__list">
        @foreach ($items as $index => $item)
        <div class="bbw-pair-repeater__row">
            <input
                type="text"
                class="form-control bbw-pair-repeater__title"
                name="{{ $name }}[{{ $index }}][title]"
                value="{{ $item['title'] ?? '' }}"
                placeholder="{{ $titlePlaceholder }}"
            >
            <textarea
                class="form-control bbw-pair-repeater__text"
                name="{{ $name }}[{{ $index }}][text]"
                rows="3"
                placeholder="{{ $textPlaceholder }}"
            >{{ $item['text'] ?? '' }}</textarea>
            <button type="button" class="bbw-repeater__remove" data-bbw-pair-remove title="Remove" aria-label="Remove item">
                <i class="fa fa-times"></i>
            </button>
        </div>
        @endforeach
    </div>
    <div class="bbw-repeater__foot">
        <button type="button" class="bbw-repeater__add" data-bbw-pair-add aria-label="Add {{ strtolower($label) }}">
            <i class="fa fa-plus"></i> Add
        </button>
    </div>
    @error($name)
    <span class="bbw-field-error">{{ $message }}</span>
    @enderror
</div>
