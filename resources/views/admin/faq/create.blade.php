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
			<form action="{{ route('faq.store') }}" id="regform" method="post" accept-charset="utf-8">
				@csrf
				<div class="bbw-form-inner">
					<div class="bbw-form-group">
						<label for="faq_question">Question <span class="text-danger">*</span></label>
						<textarea id="faq_question" class="form-control" name="question" rows="6" placeholder="Enter the question" required>{{ old('question') }}</textarea>
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
