@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@include('admin.partials.wellness_crud_theme')

@php
    $questionItems = \App\Models\Services::listItemsForForm($model->questions, old('questions'));
    $benefitItems = \App\Models\Services::listItemsForForm($model->benefits, old('benefits'));
@endphp

<section class="content bbw-crud-theme" style="margin-bottom: 0;">
	<div class="bbw-form-card">
		<div class="bbw-form-header">
			<h1>{{ $page_title }}</h1>
			<a href="{{ route('service.index') }}" class="bbw-form-back"><i class="fa fa-list"></i> View all</a>
		</div>
		<div class="bbw-form-body">
			<form action="{{ route('service.update', $model->id) }}" id="regform" method="post" accept-charset="utf-8">
				@csrf
				{{ method_field('PATCH') }}
				<div class="bbw-form-inner">
					<div class="bbw-form-group">
						<label for="service_heading">Heading <span class="text-danger">*</span></label>
						<textarea id="service_heading" class="form-control" name="heading" rows="3" required>{{ old('heading', $model->heading) }}</textarea>
						@error('heading')
						<span class="bbw-field-error">{{ $message }}</span>
						@enderror
					</div>

					@include('admin.partials.bbw-list-repeater', [
						'name' => 'questions',
						'label' => 'Questions',
						'items' => $questionItems,
						'placeholder' => 'Enter a question',
					])

					<div class="bbw-form-group">
						<label for="service_description">Description <span class="text-danger">*</span></label>
						<textarea id="service_description" class="form-control" name="description" rows="6" required>{{ old('description', $model->description) }}</textarea>
						@error('description')
						<span class="bbw-field-error">{{ $message }}</span>
						@enderror
					</div>

					@include('admin.partials.bbw-list-repeater', [
						'name' => 'benefits',
						'label' => 'Benefits',
						'items' => $benefitItems,
						'placeholder' => 'Enter a benefit',
						'fieldType' => 'textarea',
						'rows' => 4,
					])

					<div class="bbw-form-group">
						<label for="service_status">Status</label>
						<select id="service_status" name="status" class="form-control" style="max-width: 280px;">
							<option value="1" {{ (int) old('status', $model->status) === 1 ? 'selected' : '' }}>Active</option>
							<option value="0" {{ (int) old('status', $model->status) === 0 ? 'selected' : '' }}>Inactive</option>
						</select>
					</div>

					<div class="bbw-form-actions">
						<button type="submit" class="btn bbw-btn-submit"><i class="fa fa-save"></i> Update Service</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

@include('admin.partials.bbw-list-repeater-script')
@endsection
