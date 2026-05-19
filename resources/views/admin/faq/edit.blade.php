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
			<form action="{{ route('faq.update', $model->id) }}" id="regform" method="post" accept-charset="utf-8">
				@csrf
				{{ method_field('PATCH') }}
				<div class="bbw-form-inner">
					<div class="bbw-form-group">
						<label for="faq_question">Question <span class="text-danger">*</span></label>
						<textarea id="faq_question" class="form-control" name="question" rows="6" required>{{ old('question', $model->question) }}</textarea>
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
							<option value="1" {{ (int) $model->status === 1 ? 'selected' : '' }}>Active</option>
							<option value="0" {{ (int) $model->status === 0 ? 'selected' : '' }}>Inactive</option>
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
<script>
$(document).ready(function() {
	$('#regform').validate({
		rules: {
			question: 'required',
			answer: 'required'
		}
	});
});
</script>
@endpush
