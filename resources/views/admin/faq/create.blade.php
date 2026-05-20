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
			<form action="{{ route('faq.store') }}" id="regform" method="post">
				@csrf
				<div class="bbw-form-inner">
					<div class="bbw-form-group">
						<label for="faq_page_key">Website page <span class="text-danger">*</span></label>
						<select id="faq_page_key" name="page_key" class="form-control" required style="max-width: 420px;">
							<option value="">— Select page —</option>
							@foreach ($faqPages as $key => $label)
								<option value="{{ $key }}" {{ old('page_key') === $key ? 'selected' : '' }}>{{ $label }}</option>
							@endforeach
						</select>
						<p class="help-block" style="margin:0.35rem 0 0;font-size:12px;color:#5f6f68;">This FAQ will appear only on the selected page.</p>
						@error('page_key')
						<span class="bbw-field-error">{{ $message }}</span>
						@enderror
					</div>
					@include('admin.faq.partials.service-picker', ['selectedServiceId' => old('service_id')])
					<div class="bbw-form-group">
						<label for="faq_sort_order">Display order</label>
						<input type="number" id="faq_sort_order" name="sort_order" class="form-control" min="0" max="9999" value="{{ old('sort_order', 0) }}" style="max-width: 120px;">
						<p class="help-block" style="margin:0.35rem 0 0;font-size:12px;color:#5f6f68;">Lower numbers appear first.</p>
					</div>
					<div class="bbw-form-group">
						<label for="faq_question">Question <span class="text-danger">*</span></label>
						<textarea id="faq_question" class="form-control" name="question" rows="3" placeholder="Enter the question" required>{{ old('question') }}</textarea>
						@error('question')
						<span class="bbw-field-error">{{ $message }}</span>
						@enderror
					</div>
					<div class="bbw-form-group">
						<label for="faq_answer">Answer <span class="text-danger">*</span></label>
						<textarea id="faq_answer" class="form-control" name="answer" rows="6" placeholder="Enter the answer" required>{{ old('answer') }}</textarea>
						@error('answer')
						<span class="bbw-field-error">{{ $message }}</span>
						@enderror
					</div>
					<div class="bbw-form-group">
						<label for="faq_status">Status</label>
						<select id="faq_status" name="status" class="form-control" style="max-width: 280px;">
							<option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
							<option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Inactive</option>
						</select>
					</div>
					<div class="bbw-form-actions">
						<button type="submit" class="btn bbw-btn-submit"><i class="fa fa-save"></i> Save FAQ</button>
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
			service_id: {
				required: function() {
					return $('#faq_page_key').val() === 'service-detail';
				}
			},
			question: 'required',
			answer: 'required'
		}
	});
});
</script>
@endpush
