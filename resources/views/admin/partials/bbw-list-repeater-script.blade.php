@push('js')
<script>
(function () {
	function repeaterIsRequired($repeater) {
		return String($repeater.data('bbw-repeater-required')) === '1';
	}

	function syncRepeaterRequired($repeater) {
		var $inputs = $repeater.find('.bbw-repeater__input');
		$inputs.prop('required', false);
		if (repeaterIsRequired($repeater) && $inputs.length) {
			$inputs.first().prop('required', true);
		}
	}

	function updateRemoveButtons($repeater) {
		var $rows = $repeater.find('.bbw-repeater__row');
		$rows.find('[data-bbw-repeater-remove]').prop('disabled', $rows.length <= 1);
	}

	function buildRepeaterField($repeater) {
		var name = $repeater.data('bbw-repeater');
		var fieldType = $repeater.data('bbw-repeater-field') || 'input';
		var rows = $repeater.data('bbw-repeater-rows') || 4;
		var $first = $repeater.find('.bbw-repeater__input').first();
		var placeholder = $first.attr('placeholder') || '';

		if (fieldType === 'textarea') {
			return $(
				'<textarea class="form-control bbw-repeater__input" name="' + name + '[]" rows="' + rows + '" placeholder="' + placeholder.replace(/"/g, '&quot;') + '"></textarea>'
			);
		}

		return $(
			'<input type="text" class="form-control bbw-repeater__input" name="' + name + '[]" value="" placeholder="' + placeholder.replace(/"/g, '&quot;') + '">'
		);
	}

	$(document).on('click', '[data-bbw-repeater-add]', function () {
		var $repeater = $(this).closest('[data-bbw-repeater]');
		var $field = buildRepeaterField($repeater);
		var $row = $('<div class="bbw-repeater__row"></div>');
		$row.append($field);
		$row.append(
			'<button type="button" class="bbw-repeater__remove" data-bbw-repeater-remove title="Remove" aria-label="Remove item"><i class="fa fa-times"></i></button>'
		);
		$repeater.find('.bbw-repeater__list').append($row);
		$field.focus();
		syncRepeaterRequired($repeater);
		updateRemoveButtons($repeater);
	});

	$(document).on('click', '[data-bbw-repeater-remove]', function () {
		var $repeater = $(this).closest('[data-bbw-repeater]');
		var $rows = $repeater.find('.bbw-repeater__row');
		if ($rows.length <= 1) {
			$rows.find('.bbw-repeater__input').val('');
			return;
		}
		$(this).closest('.bbw-repeater__row').remove();
		syncRepeaterRequired($repeater);
		updateRemoveButtons($repeater);
	});

	$(function () {
		$('[data-bbw-repeater]').each(function () {
			syncRepeaterRequired($(this));
			updateRemoveButtons($(this));
		});
	});
})();
</script>
@endpush
