@push('css')
<style>
.bbw-pair-repeater__row {
	display: grid;
	grid-template-columns: 1fr 2fr auto;
	gap: 10px;
	align-items: start;
	margin-bottom: 12px;
	padding: 12px;
	background: #fff;
	border: 1px solid rgba(45, 106, 98, 0.12);
	border-radius: 10px;
}
.bbw-pair-repeater__row .bbw-repeater__remove {
	margin-top: 4px;
}
@media (max-width: 768px) {
	.bbw-pair-repeater__row {
		grid-template-columns: 1fr;
	}
}
</style>
@endpush

@push('js')
<script>
(function () {
	function reindexPairRepeater($repeater) {
		var name = $repeater.data('bbw-pair-repeater');
		$repeater.find('.bbw-pair-repeater__row').each(function (index) {
			$(this).find('.bbw-pair-repeater__title').attr('name', name + '[' + index + '][title]');
			$(this).find('.bbw-pair-repeater__text').attr('name', name + '[' + index + '][text]');
		});
	}

	function updatePairRemoveButtons($repeater) {
		var $rows = $repeater.find('.bbw-pair-repeater__row');
		$rows.find('[data-bbw-pair-remove]').prop('disabled', $rows.length <= 1);
	}

	$(document).on('click', '[data-bbw-pair-add]', function () {
		var $repeater = $(this).closest('[data-bbw-pair-repeater]');
		var name = $repeater.data('bbw-pair-repeater');
		var index = $repeater.find('.bbw-pair-repeater__row').length;
		var $row = $(
			'<div class="bbw-pair-repeater__row">' +
				'<input type="text" class="form-control bbw-pair-repeater__title" name="' + name + '[' + index + '][title]" placeholder="Title">' +
				'<textarea class="form-control bbw-pair-repeater__text" name="' + name + '[' + index + '][text]" rows="3" placeholder="Description"></textarea>' +
				'<button type="button" class="bbw-repeater__remove" data-bbw-pair-remove title="Remove" aria-label="Remove item"><i class="fa fa-times"></i></button>' +
			'</div>'
		);
		$repeater.find('.bbw-pair-repeater__list').append($row);
		$row.find('.bbw-pair-repeater__title').focus();
		updatePairRemoveButtons($repeater);
	});

	$(document).on('click', '[data-bbw-pair-remove]', function () {
		var $repeater = $(this).closest('[data-bbw-pair-repeater]');
		var $rows = $repeater.find('.bbw-pair-repeater__row');
		if ($rows.length <= 1) {
			$rows.find('.bbw-pair-repeater__title, .bbw-pair-repeater__text').val('');
			return;
		}
		$(this).closest('.bbw-pair-repeater__row').remove();
		reindexPairRepeater($repeater);
		updatePairRemoveButtons($repeater);
	});

	$(function () {
		$('[data-bbw-pair-repeater]').each(function () {
			updatePairRemoveButtons($(this));
		});
	});
})();
</script>
@endpush
