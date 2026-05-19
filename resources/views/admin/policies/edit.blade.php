@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@include('admin.partials.wellness_crud_theme')

<section class="content bbw-crud-theme" style="margin-bottom: 0;">
	<div class="bbw-form-card">
		<div class="bbw-form-header">
			<h1>{{ $page_title }}</h1>
			<a href="{{ route('policy.index') }}" class="bbw-form-back"><i class="fa fa-list"></i> View all</a>
		</div>
		<div class="bbw-form-body">
			<form action="{{ route('policy.update', $model->id) }}" id="regform" method="post" accept-charset="utf-8">
				@csrf
				{{ method_field('PATCH') }}
				<div class="bbw-form-inner">
					<div class="bbw-form-group">
						<label for="policy_title">Title <span class="text-danger">*</span></label>
						<textarea id="policy_title" class="form-control" name="title" rows="6" required>{{ old('title', $model->title) }}</textarea>
						@error('title')
						<span class="bbw-field-error">{{ $message }}</span>
						@enderror
					</div>
					<div class="bbw-form-group">
						<label for="policy_description">Description <span class="text-danger">*</span></label>
						<textarea id="policy_description" class="form-control" name="description" rows="6" required>{{ old('description', $model->description) }}</textarea>
						@error('description')
						<span class="bbw-field-error">{{ $message }}</span>
						@enderror
					</div>
					<div class="bbw-form-group">
						<label for="policy_status">Status</label>
						<select id="policy_status" name="status" class="form-control" style="max-width: 280px;">
							<option value="1" {{ (int) $model->status === 1 ? 'selected' : '' }}>Active</option>
							<option value="0" {{ (int) $model->status === 0 ? 'selected' : '' }}>Inactive</option>
						</select>
					</div>
					<div class="bbw-form-actions">
						<button type="submit" class="btn bbw-btn-submit"><i class="fa fa-save"></i> Update policy</button>
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
			title: 'required',
			description: 'required'
		}
	});
});
</script>
@endpush
