@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@include('admin.partials.wellness_crud_theme')

<section class="content bbw-crud-theme" style="margin-bottom: 0;">
	<div class="bbw-form-card">
		<div class="bbw-form-header">
			<h1>{{ $page_title }}</h1>
			<a href="{{ route('location.index') }}" class="bbw-form-back"><i class="fa fa-list"></i> View all</a>
		</div>
		<div class="bbw-form-body">
			<form action="{{ route('location.update', $model->id) }}" id="regform" method="post" enctype="multipart/form-data" accept-charset="utf-8" novalidate>
				@csrf
				@method('PATCH')
				<div class="bbw-form-inner">
					@include('admin.locations.partials.form-fields', ['model' => $model])

					<div class="bbw-form-actions">
						<button type="submit" class="bbw-btn-submit"><i class="fa fa-save"></i> Update Location</button>
						<a href="{{ $model->publicUrl() }}" class="btn bbw-btn-outline" target="_blank" rel="noopener"><i class="fa fa-external-link"></i> View live page</a>
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
.bbw-btn-outline {
	background: #fff !important;
	color: #2d6a62 !important;
	border: 2px solid #2d6a62 !important;
	font-weight: 600;
	padding: 10px 22px !important;
	border-radius: 9999px !important;
	text-decoration: none !important;
	transition: all 0.2s ease;
}
.bbw-btn-outline:hover {
	background: #2d6a62 !important;
	color: #fff !important;
}
</style>
@endpush

@include('admin.partials.bbw-list-repeater-script')
@include('admin.partials.bbw-pair-repeater-script')

@push('js')
<script>
$(function () {
	$('#location_image').on('change', function () {
		var file = this.files && this.files[0];
		if (file) {
			$('#location_image_preview').attr('src', URL.createObjectURL(file));
		}
	});

	$('#location_slug').on('input', function () {
		$('#slug-preview').text($(this).val());
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
