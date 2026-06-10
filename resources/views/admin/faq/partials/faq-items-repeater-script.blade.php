@push('css')
<style>
.bbw-faq-repeater__row {
	display: grid;
	grid-template-columns: 1fr auto;
	gap: 12px;
	align-items: start;
	margin-bottom: 14px;
	padding: 14px;
	background: #fff;
	border: 1px solid rgba(45, 106, 98, 0.12);
	border-radius: 10px;
}
.bbw-faq-repeater__fields {
	display: flex;
	flex-direction: column;
	gap: 12px;
	min-width: 0;
}
.bbw-faq-repeater__field-label {
	display: block;
	margin-bottom: 0.35rem;
	font-size: 12px;
	font-weight: 600;
	color: #3d5248;
}
.bbw-faq-repeater__badge {
	display: inline-block;
	margin-bottom: 0.5rem;
	padding: 0.2rem 0.55rem;
	font-size: 11px;
	font-weight: 600;
	letter-spacing: 0.02em;
	color: #3d5248;
	background: rgba(90, 125, 108, 0.12);
	border-radius: 999px;
}
.bbw-faq-repeater__row .bbw-repeater__remove {
	margin-top: 28px;
}
@media (max-width: 768px) {
	.bbw-faq-repeater__row {
		grid-template-columns: 1fr;
	}
	.bbw-faq-repeater__row .bbw-repeater__remove {
		margin-top: 0;
		justify-self: end;
	}
}
</style>
@endpush

@push('js')
<script>
(function () {
	function reindexFaqRepeater($repeater) {
		$repeater.find('.bbw-faq-repeater__row').each(function (index) {
			$(this).find('.bbw-faq-repeater__question').attr('name', 'faqs[' + index + '][question]');
			$(this).find('.bbw-faq-repeater__answer').attr('name', 'faqs[' + index + '][answer]');
		});
	}

	function updateFaqRemoveButtons($repeater) {
		var isEditMode = $repeater.is('[data-bbw-faq-edit-mode]');
		var $rows = $repeater.find('.bbw-faq-repeater__row');
		$rows.each(function (index) {
			var $remove = $(this).find('[data-bbw-faq-remove]');
			if (isEditMode && index === 0) {
				$remove.prop('hidden', true).prop('disabled', true);
				return;
			}
			$remove.prop('hidden', false).prop('disabled', $rows.length <= 1);
		});
	}

	function buildFaqRow(index, isEditMode) {
		var badge = (isEditMode && index === 0)
			? '<span class="bbw-faq-repeater__badge">Current FAQ</span>'
			: '';
		var removeBtn = (isEditMode && index === 0)
			? ''
			: '<button type="button" class="bbw-repeater__remove" data-bbw-faq-remove title="Remove" aria-label="Remove FAQ"><i class="fa fa-times"></i></button>';

		return $(
			'<div class="bbw-faq-repeater__row">' +
				'<div class="bbw-faq-repeater__fields">' +
					badge +
					'<div class="bbw-faq-repeater__field">' +
						'<label class="bbw-faq-repeater__field-label">Question</label>' +
						'<textarea class="form-control bbw-faq-repeater__question" name="faqs[' + index + '][question]" rows="2" placeholder="Enter the question"></textarea>' +
					'</div>' +
					'<div class="bbw-faq-repeater__field">' +
						'<label class="bbw-faq-repeater__field-label">Answer</label>' +
						'<textarea class="form-control bbw-faq-repeater__answer" name="faqs[' + index + '][answer]" rows="4" placeholder="Enter the answer"></textarea>' +
					'</div>' +
				'</div>' +
				removeBtn +
			'</div>'
		);
	}

	$(document).on('click', '[data-bbw-faq-add]', function () {
		var $repeater = $(this).closest('[data-bbw-faq-repeater]');
		var isEditMode = $repeater.is('[data-bbw-faq-edit-mode]');
		var index = $repeater.find('.bbw-faq-repeater__row').length;
		var $row = buildFaqRow(index, isEditMode);
		$repeater.find('.bbw-faq-repeater__list').append($row);
		$row.find('.bbw-faq-repeater__question').focus();
		updateFaqRemoveButtons($repeater);
	});

	$(document).on('click', '[data-bbw-faq-remove]', function () {
		var $repeater = $(this).closest('[data-bbw-faq-repeater]');
		var isEditMode = $repeater.is('[data-bbw-faq-edit-mode]');
		var $rows = $repeater.find('.bbw-faq-repeater__row');
		if ($rows.length <= 1) {
			if (!isEditMode) {
				$rows.find('.bbw-faq-repeater__question, .bbw-faq-repeater__answer').val('');
			}
			return;
		}
		$(this).closest('.bbw-faq-repeater__row').remove();
		reindexFaqRepeater($repeater);
		updateFaqRemoveButtons($repeater);
	});

	$(function () {
		$('[data-bbw-faq-repeater]').each(function () {
			updateFaqRemoveButtons($(this));
		});
	});
})();
</script>
@endpush
