{{--
  Yes/No toggle switch for admin forms.
  @param string $name       Form field name
  @param string $id         Input id (defaults to name)
  @param string $label      Field label
  @param bool   $checked     Initial state
  @param string|null $help   Optional help text below label
  @param string $yesLabel    Badge text when on (default: Yes)
  @param string $noLabel     Badge text when off (default: No)
--}}
@php
    $id = $id ?? $name;
    $checked = (bool) ($checked ?? false);
    $yesLabel = $yesLabel ?? 'Yes';
    $noLabel = $noLabel ?? 'No';
    $statusId = $id . '_status';
@endphp

<div class="bbw-form-group bbw-yes-no-toggle">
    <label class="bbw-yes-no-toggle__label" for="{{ $id }}">{{ $label }}</label>
    @if (!empty($help))
        <p class="text-muted small mb-2">{{ $help }}</p>
    @endif
    <div class="bbw-yes-no-toggle__row">
        <label class="bbw-yes-no-toggle__switch" for="{{ $id }}">
            <input
                type="checkbox"
                id="{{ $id }}"
                name="{{ $name }}"
                value="1"
                role="switch"
                aria-labelledby="{{ $id }}_label"
                {{ $checked ? 'checked' : '' }}
            >
            <span class="bbw-yes-no-toggle__slider" aria-hidden="true"></span>
        </label>
        <span
            class="bbw-yes-no-toggle__badge {{ $checked ? 'bbw-yes-no-toggle__badge--yes' : 'bbw-yes-no-toggle__badge--no' }}"
            id="{{ $statusId }}"
            data-yes-label="{{ $yesLabel }}"
            data-no-label="{{ $noLabel }}"
            aria-live="polite"
        >{{ $checked ? $yesLabel : $noLabel }}</span>
    </div>
</div>

@once
@push('css')
<style>
.bbw-yes-no-toggle__label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
    color: #1a3f3c;
}
.bbw-yes-no-toggle__row {
    display: flex;
    align-items: center;
    gap: 14px;
}
.bbw-yes-no-toggle__switch {
    position: relative;
    display: inline-block;
    width: 52px;
    height: 28px;
    margin: 0;
    flex-shrink: 0;
}
.bbw-yes-no-toggle__switch input {
    opacity: 0;
    width: 0;
    height: 0;
    position: absolute;
}
.bbw-yes-no-toggle__slider {
    position: absolute;
    cursor: pointer;
    inset: 0;
    background: #c5cecb;
    border-radius: 28px;
    transition: background 0.25s ease, box-shadow 0.25s ease;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
}
.bbw-yes-no-toggle__slider:before {
    content: "";
    position: absolute;
    height: 22px;
    width: 22px;
    left: 3px;
    bottom: 3px;
    background: #fff;
    border-radius: 50%;
    transition: transform 0.25s ease;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
}
.bbw-yes-no-toggle__switch input:checked + .bbw-yes-no-toggle__slider {
    background: linear-gradient(135deg, #2d6a62 0%, #1a4f48 100%);
}
.bbw-yes-no-toggle__switch input:checked + .bbw-yes-no-toggle__slider:before {
    transform: translateX(24px);
}
.bbw-yes-no-toggle__switch input:focus-visible + .bbw-yes-no-toggle__slider {
    box-shadow: 0 0 0 3px rgba(45, 106, 98, 0.35);
}
.bbw-yes-no-toggle__badge {
    display: inline-block;
    min-width: 44px;
    text-align: center;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.3px;
    transition: background 0.25s ease, color 0.25s ease;
}
.bbw-yes-no-toggle__badge--yes {
    background: rgba(45, 106, 98, 0.15);
    color: #1a4f48;
}
.bbw-yes-no-toggle__badge--no {
    background: rgba(180, 60, 60, 0.12);
    color: #8b2e2e;
}
.bbw-form-callout {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-top: 12px;
    padding: 12px 14px;
    background: rgba(45, 106, 98, 0.08);
    border: 1px solid rgba(45, 106, 98, 0.18);
    border-radius: 10px;
    color: #3d5c56;
    font-size: 13px;
    line-height: 1.5;
}
.bbw-form-callout i {
    color: #2d6a62;
    margin-top: 2px;
    flex-shrink: 0;
}
</style>
@endpush

@push('js')
<script>
(function () {
    function syncBbwYesNoToggle($input) {
        var $badge = $input.closest('.bbw-yes-no-toggle').find('.bbw-yes-no-toggle__badge');
        var on = $input.is(':checked');

        $badge
            .toggleClass('bbw-yes-no-toggle__badge--yes', on)
            .toggleClass('bbw-yes-no-toggle__badge--no', !on)
            .text(on ? ($badge.data('yes-label') || 'Yes') : ($badge.data('no-label') || 'No'));
    }

    $(document).on('change', '.bbw-yes-no-toggle input[type="checkbox"]', function () {
        syncBbwYesNoToggle($(this));
    });
})();
</script>
@endpush
@endonce
