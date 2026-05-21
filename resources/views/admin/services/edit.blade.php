@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@include('admin.partials.wellness_crud_theme')

@php
    $questionItems = \App\Models\Services::listItemsForForm($model->questions, old('questions'));
    $benefitItems = \App\Models\Services::listItemsForForm($model->benefits, old('benefits'));
    $placeholder = \App\Models\Services::imagePlaceholderUrl();
@endphp

<section class="content bbw-crud-theme" style="margin-bottom: 0;">
	<div class="bbw-form-card">
		<div class="bbw-form-header">
			<h1>{{ $page_title }}</h1>
			<a href="{{ route('service.index') }}" class="bbw-form-back"><i class="fa fa-list"></i> View all</a>
		</div>
		<div class="bbw-form-body">
			<form action="{{ route('service.update', $model->id) }}" id="regform" method="post" enctype="multipart/form-data" accept-charset="utf-8">
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

					@include('admin.services.partials.image-field', [
						'inputId' => 'service_description_image',
						'previewId' => 'description_image_preview',
						'name' => 'description_image',
						'label' => 'Description Image',
						'required' => false,
						'hasExisting' => filled($model->description_image),
						'currentUrl' => $model->imageUrl('description_image'),
					])

					<div class="bbw-form-group">
						<label for="service_description">Description <span class="text-danger">*</span></label>
						<textarea id="service_description" class="form-control" name="description" rows="6" required>{{ old('description', $model->description) }}</textarea>
						@error('description')
						<span class="bbw-field-error">{{ $message }}</span>
						@enderror
					</div>

					@include('admin.services.partials.image-field', [
						'inputId' => 'service_benefit_image',
						'previewId' => 'benefit_image_preview',
						'name' => 'benefit_image',
						'label' => 'Benefit Image',
						'required' => false,
						'hasExisting' => filled($model->benefit_image),
						'currentUrl' => $model->imageUrl('benefit_image'),
					])

					@include('admin.partials.bbw-list-repeater', [
						'name' => 'benefits',
						'label' => 'Benefits',
						'items' => $benefitItems,
						'placeholder' => 'Enter a benefit',
						'fieldType' => 'textarea',
						'rows' => 4,
					])

					@include('admin.services.partials.image-field', [
						'inputId' => 'service_question_image',
						'previewId' => 'question_image_preview',
						'name' => 'question_image',
						'label' => 'Question Image',
						'required' => false,
						'hasExisting' => filled($model->question_image),
						'currentUrl' => $model->imageUrl('question_image'),
					])

					@include('admin.partials.bbw-list-repeater', [
						'name' => 'questions',
						'label' => 'Questions',
						'items' => $questionItems,
						'placeholder' => 'Enter a question',
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

@push('js')
@include('admin.services.partials.image-preview-script')
@endpush
