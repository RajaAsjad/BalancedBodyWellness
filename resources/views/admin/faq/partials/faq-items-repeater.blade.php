@php
    $faqItems = $items ?? [['question' => '', 'answer' => '']];
    if (! is_array($faqItems) || $faqItems === []) {
        $faqItems = [['question' => '', 'answer' => '']];
    }
    $helpText = $helpText ?? 'Add one or more FAQs. They will share the same page, service/location, and status.';
    $editMode = $editMode ?? false;
@endphp

<div class="bbw-form-group bbw-faq-repeater" data-bbw-faq-repeater @if($editMode) data-bbw-faq-edit-mode @endif>
    <div class="bbw-repeater__head">
        <label class="bbw-repeater__label">Questions &amp; answers <span class="text-danger">*</span></label>
        <p class="help-block" style="margin:0.35rem 0 0;font-size:12px;color:#5f6f68;">{{ $helpText }}</p>
    </div>

    <div class="bbw-faq-repeater__list">
        @foreach ($faqItems as $index => $item)
            <div class="bbw-faq-repeater__row">
                <div class="bbw-faq-repeater__fields">
                    @if ($editMode && $index === 0)
                        <span class="bbw-faq-repeater__badge">Current FAQ</span>
                    @endif                    <div class="bbw-faq-repeater__field">
                        <label class="bbw-faq-repeater__field-label">Question</label>
                        <textarea
                            class="form-control bbw-faq-repeater__question"
                            name="faqs[{{ $index }}][question]"
                            rows="2"
                            placeholder="Enter the question"
                        >{{ $item['question'] ?? '' }}</textarea>
                        @error('faqs.' . $index . '.question')
                            <span class="bbw-field-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="bbw-faq-repeater__field">
                        <label class="bbw-faq-repeater__field-label">Answer</label>
                        <textarea
                            class="form-control bbw-faq-repeater__answer"
                            name="faqs[{{ $index }}][answer]"
                            rows="4"
                            placeholder="Enter the answer"
                        >{{ $item['answer'] ?? '' }}</textarea>
                        @error('faqs.' . $index . '.answer')
                            <span class="bbw-field-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="button" class="bbw-repeater__remove" data-bbw-faq-remove title="Remove" aria-label="Remove FAQ" @if($editMode && $index === 0) hidden @endif>                    <i class="fa fa-times"></i>
                </button>
            </div>
        @endforeach
    </div>

    <div class="bbw-repeater__foot">
        <button type="button" class="bbw-repeater__add" data-bbw-faq-add aria-label="Add another FAQ">
            <i class="fa fa-plus"></i> Add more
        </button>
    </div>

    @error('faqs')
        <span class="bbw-field-error">{{ $message }}</span>
    @enderror
</div>
