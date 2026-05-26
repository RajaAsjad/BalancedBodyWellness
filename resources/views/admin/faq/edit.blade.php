@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@include('admin.partials.wellness_crud_theme')

<section class="content bbw-crud-theme" style="margin-bottom: 0;">
	<div class="bbw-form-card">
		<div class="bbw-form-header">
			<h1>{{ $page_title }}</h1>
			<a href="{{ route('faq.index') }}" class="bbw-form-back"><i class="fa fa-list"></i> View all</a>
		</div>
		<div class="bbw-form-body">
			<form action="{{ route('faq.update', $model->id) }}" id="regform" method="post">
				@csrf
				{{ method_field('PATCH') }}
				<div class="bbw-form-inner">
					<div class="bbw-form-group">
						<label for="faq_page_key">Website page <span class="text-danger">*</span></label>
						<select id="faq_page_key" name="page_key" class="form-control" required style="max-width: 420px;">
							@foreach ($faqPages as $key => $label)
								<option value="{{ $key }}" {{ old('page_key', $model->page_key) === $key ? 'selected' : '' }}>{{ $label }}</option>
							@endforeach
						</select>
						@error('page_key')
						<span class="bbw-field-error">{{ $message }}</span>
						@enderror
					</div>
					@include('admin.faq.partials.service-picker', ['selectedServiceSlug' => old('service_slug', $selectedServiceSlug ?? $model->service_slug)])
					@include('admin.faq.partials.location-picker', ['selectedLocationSlug' => old('location_slug', $selectedLocationSlug ?? $model->location_slug)])
					<div class="bbw-form-group">
						<label for="faq_sort_order">Display order</label>
						<input type="number" id="faq_sort_order" name="sort_order" class="form-control" min="0" max="9999" value="{{ old('sort_order', $model->sort_order ?? 0) }}" style="max-width: 120px;">
					</div>
					<div class="bbw-form-group">
						<label for="faq_question">Question <span class="text-danger">*</span></label>
						<textarea id="faq_question" class="form-control" name="question" rows="3" required>{{ old('question', $model->question) }}</textarea>
						@error('question')
						<span class="bbw-field-error">{{ $message }}</span>
						@enderror
					</div>
					<div class="bbw-form-group">
						<label for="faq_answer">Answer <span class="text-danger">*</span></label>
						<textarea id="faq_answer" class="form-control" name="answer" rows="6" required>{{ old('answer', $model->answer) }}</textarea>
						@error('answer')
						<span class="bbw-field-error">{{ $message }}</span>
						@enderror
					</div>
					<div class="bbw-form-group">
						<label for="faq_status">Status</label>
						<select id="faq_status" name="status" class="form-control" style="max-width: 280px;">
							<option value="1" {{ (int) old('status', $model->status) === 1 ? 'selected' : '' }}>Active</option>
							<option value="0" {{ (int) old('status', $model->status) === 0 ? 'selected' : '' }}>Inactive</option>
						</select>
					</div>
					<div class="bbw-form-actions">
						<button type="submit" class="btn bbw-btn-submit"><i class="fa fa-save"></i> Update FAQ</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
@endsection

@push('js')
@include('admin.faq.partials.form-scripts')
<script>
$(document).ready(function() {
	$('#regform').validate({
		rules: {
			page_key: 'required',
			service_slug: {
				required: function() {
					return $('#faq_page_key').val() === 'service-detail';
				}
			},
			location_slug: {
				required: function() {
					return $('#faq_page_key').val() === 'location-detail';
				}
			},
			question: 'required',
			answer: 'required'
		}
	});
});
</script>
@endpush
