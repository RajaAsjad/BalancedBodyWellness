@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@include('admin.partials.wellness_crud_theme')

<section class="content bbw-crud-theme" style="margin-bottom: 0;">
	<div class="bbw-form-card">
		<div class="bbw-form-header">
			<h1>{{ $page_title }}</h1>
			<a href="{{ route('blog.index') }}" class="bbw-form-back"><i class="fa fa-list"></i> View all</a>
		</div>
		<div class="bbw-form-body">
			<form action="{{ route('blog.store') }}" id="regform" method="post" enctype="multipart/form-data" accept-charset="utf-8">
				@csrf
				<div class="bbw-form-inner">
					<div class="bbw-form-group">
						<label for="slug">Slug <span class="text-danger">*</span></label>
						<input type="text" autocomplete="off" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Slug" required>
						@error('slug')
						<span class="bbw-field-error">{{ $message }}</span>
						@enderror
					</div>

					<div class="bbw-form-group">
						<label for="meta_title">Meta title <span class="text-danger">*</span></label>
						<input type="text" autocomplete="off" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" placeholder="Meta Title" required>
						@error('meta_title')
						<span class="bbw-field-error">{{ $message }}</span>
						@enderror
					</div>

					<div class="bbw-form-group">
						<label for="meta_description">Meta description <span class="text-danger">*</span></label>
						<textarea class="form-control" name="meta_description" id="meta_description" maxlength="200" rows="3" placeholder="Enter Meta Description" required>{{ old('meta_description') }}</textarea>
						@error('meta_description')
						<span class="bbw-field-error">{{ $message }}</span>
						@enderror
					</div>

					<div class="bbw-form-group">
						<label for="name">Blog title <span class="text-danger">*</span></label>
						<input type="text" autocomplete="off" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Blog Title" required>
						@error('name')
						<span class="bbw-field-error">{{ $message }}</span>
						@enderror
					</div>

					<div class="bbw-form-group">
						<label for="short_description">Short description <span class="text-danger">*</span></label>
						<textarea class="form-control texteditor" name="short_description" id="short_description" style="height:140px;" placeholder="Enter Short Description">{{ old('short_description') }}</textarea>
						@error('short_description')
						<span class="bbw-field-error">{{ $message }}</span>
						@enderror
					</div>

					<div class="bbw-form-group">
						<label for="description">Description <span class="text-danger">*</span></label>
						<textarea class="form-control texteditor" name="description" id="description" style="height:140px;" placeholder="Enter Description">{{ old('description') }}</textarea>
						@error('description')
						<span class="bbw-field-error">{{ $message }}</span>
						@enderror
					</div>

					@include('admin.services.partials.image-field', [
						'inputId' => 'blog_image',
						'previewId' => 'blog_preview',
						'name' => 'image',
						'label' => 'Image',
						'required' => true,
						'hasExisting' => false,
						'currentUrl' => \App\Models\Services::imagePlaceholderUrl(),
					])

					@include('admin.blog.partials.publish-fields')

					<div class="bbw-form-actions">
						<button type="submit" class="btn bbw-btn-submit"><i class="fa fa-save"></i> Save Blog</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
@endsection

@include('admin.services.partials.image-preview-script')

@push('js')
<script>
$(document).ready(function() {
	tinymce.init({
		selector: "textarea.texteditor",
		theme: "modern",
		height: 150,
		plugins: [
			"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
			"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
			"save table contextmenu directionality emoticons template paste textcolor"
		],
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons"
	});

	$('#regform').validate({
		rules: {
			slug: 'required',
			meta_title: 'required',
			meta_description: 'required',
			name: 'required',
			image: 'required'
		},
		errorClass: 'error',
		validClass: 'valid',
		errorElement: 'span',
		errorPlacement: function(error, element) {
			error.addClass('bbw-field-error');
			error.insertAfter(element);
		}
	});

	function togglePublishFields() {
		var mode = $('#publish_mode').val();
		if (mode === 'scheduled') {
			$('#published_at_group').show();
			$('#published_at').prop('required', true);
		} else {
			$('#published_at_group').hide();
			$('#published_at').prop('required', false);
		}
	}

	$('#publish_mode').on('change', togglePublishFields);
	togglePublishFields();
});
</script>
@endpush
