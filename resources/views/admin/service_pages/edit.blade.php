@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@include('admin.partials.wellness_crud_theme')

<section class="content bbw-crud-theme" style="margin-bottom: 0;">
	<div class="bbw-form-card">
		<div class="bbw-form-header">
			<h1>{{ $page_title }}</h1>
			<a href="{{ route('servicePage.index') }}" class="bbw-form-back"><i class="fa fa-list"></i> View all</a>
		</div>
		<div class="bbw-form-body">
			<form action="{{ route('servicePage.update', $model->id) }}" id="regform" method="post" accept-charset="utf-8">
				@csrf
				@method('PUT')
				<div class="bbw-form-inner">
					@include('admin.service_pages.partials.form-fields', ['model' => $model])

					<div class="bbw-form-actions">
						<button type="submit" class="bbw-btn-submit"><i class="fa fa-save"></i> Update Service Page</button>
						<a href="{{ $model->publicUrl() }}" class="btn btn-default" target="_blank" rel="noopener">View live page</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
@endsection

@push('css')
<style>
.bbw-form-section { margin-bottom: 28px; padding-bottom: 8px; border-bottom: 1px solid rgba(45,106,98,0.1); }
.bbw-form-section__title { font-size: 15px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.4px; color: #2d6a62; margin: 0 0 16px; }
.bbw-stat-repeater__row { display: grid; grid-template-columns: 1fr 1.5fr auto auto; gap: 10px; align-items: center; margin-bottom: 12px; padding: 12px; background: #fff; border: 1px solid rgba(45,106,98,0.12); border-radius: 10px; }
@media (max-width: 768px) { .bbw-stat-repeater__row { grid-template-columns: 1fr; } }
</style>
@endpush

@include('admin.partials.bbw-list-repeater-script')
@include('admin.partials.bbw-pair-repeater-script')

@push('js')
<script>
$(function () {
	$('#service_page_slug').on('input', function () {
		$('#slug-preview').text($(this).val());
	});

	function reindexStats() {
		$('[data-bbw-stat-repeater] .bbw-stat-repeater__row').each(function (index) {
			$(this).find('input[type="text"]').each(function () {
				var name = $(this).attr('name');
				if (name && name.indexOf('[value]') !== -1) {
					$(this).attr('name', 'supports_stats[' + index + '][value]');
				} else if (name && name.indexOf('[label]') !== -1) {
					$(this).attr('name', 'supports_stats[' + index + '][label]');
				}
			});
			$(this).find('input[type="checkbox"]').attr('name', 'supports_stats[' + index + '][serif]');
		});
	}

	$(document).on('click', '[data-bbw-stat-add]', function () {
		var index = $('[data-bbw-stat-repeater] .bbw-stat-repeater__row').length;
		var $row = $(
			'<div class="bbw-stat-repeater__row">' +
				'<input type="text" class="form-control" name="supports_stats[' + index + '][value]" placeholder="Value (e.g. 100%)">' +
				'<input type="text" class="form-control" name="supports_stats[' + index + '][label]" placeholder="Label">' +
				'<label class="checkbox-inline mb-0"><input type="checkbox" name="supports_stats[' + index + '][serif]" value="1"> Serif</label>' +
				'<button type="button" class="bbw-repeater__remove" data-bbw-stat-remove title="Remove"><i class="fa fa-times"></i></button>' +
			'</div>'
		);
		$('[data-bbw-stat-repeater] .bbw-stat-repeater__list').append($row);
	});

	$(document).on('click', '[data-bbw-stat-remove]', function () {
		var $rows = $('[data-bbw-stat-repeater] .bbw-stat-repeater__row');
		if ($rows.length <= 1) {
			$rows.find('input').val('');
			$rows.find('input[type="checkbox"]').prop('checked', false);
			return;
		}
		$(this).closest('.bbw-stat-repeater__row').remove();
		reindexStats();
	});

	$('#regform').validate({
		rules: { name: 'required' },
		errorClass: 'error',
		validClass: 'valid',
		errorElement: 'span',
		errorPlacement: function (error, element) {
			error.addClass('bbw-field-error');
			error.insertAfter(element);
		}
	});
});
</script>
@endpush
