@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@include('admin.partials.wellness_crud_theme')

@php
    $questionItems = \App\Models\Services::listItemsForForm(null, old('questions'));
    $benefitItems = \App\Models\Services::listItemsForForm(null, old('benefits'));
    $placeholder = \App\Models\Services::imagePlaceholderUrl();
@endphp

<section class="content bbw-crud-theme" style="margin-bottom: 0;">
	<div class="bbw-form-card">
		<div class="bbw-form-header">
			<h1>{{ $page_title }}</h1>
			<a href="{{ route('service.index') }}" class="bbw-form-back"><i class="fa fa-list"></i> View all</a>
		</div>
		<div class="bbw-form-body">
			<form action="{{ route('service.store') }}" id="regform" method="post" enctype="multipart/form-data" accept-charset="utf-8">
				@csrf
				<div class="bbw-form-inner">
					<div class="bbw-form-group">
						<label for="service_heading">Heading <span class="text-danger">*</span></label>
						<textarea id="service_heading" class="form-control" name="heading" rows="3" placeholder="Enter the heading" required>{{ old('heading') }}</textarea>
						@error('heading')
						<span class="bbw-field-error">{{ $message }}</span>
						@enderror
					</div>

					@include('admin.services.partials.image-field', [
						'inputId' => 'service_description_image',
						'previewId' => 'description_image_preview',
						'name' => 'description_image',
						'label' => 'Description Image',
						'required' => true,
						'currentUrl' => $placeholder,
					])

					<div class="bbw-form-group">
						<label for="service_description">Description <span class="text-danger">*</span></label>
						<textarea id="service_description" class="form-control" name="description" rows="6" placeholder="Enter the description" required>{{ old('description') }}</textarea>
						@error('description')
						<span class="bbw-field-error">{{ $message }}</span>
						@enderror
					</div>

					@include('admin.services.partials.image-field', [
						'inputId' => 'service_benefit_image',
						'previewId' => 'benefit_image_preview',
						'name' => 'benefit_image',
						'label' => 'Benefit Image',
						'required' => true,
						'currentUrl' => $placeholder,
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
						'required' => true,
						'currentUrl' => $placeholder,
					])

					@include('admin.partials.bbw-list-repeater', [
						'name' => 'questions',
						'label' => 'Questions',
						'items' => $questionItems,
						'placeholder' => 'Enter a question',
					])

					<div class="bbw-form-actions">
						<button type="submit" class="btn bbw-btn-submit"><i class="fa fa-save"></i> Save Service</button>
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
