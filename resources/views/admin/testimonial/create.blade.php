@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
<style>
	.testimonial-form-container {
		background: #ffffff;
		border-radius: 12px;
		box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
		overflow: hidden;
		margin: 20px 0;
	}

	.testimonial-form-body {
		padding: 0px 30px 40px;
		background: #f8f9fa;
	}

	.testimonial-form-container .section-banner {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
		padding: 15px 20px;
		margin: 0 -40px 25px -40px;
		border-bottom: 3px solid #242424;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
		display: flex;
		justify-content: center;
		align-items: center;
		position: relative;
	}

	.testimonial-form-container .section-banner h3 {
		margin: 0;
		font-size: 18px;
		font-weight: 600;
		color: #242424;
		letter-spacing: 0.5px;
		text-transform: uppercase;
	}

	.testimonial-form-container .section-banner .btn {
		background: #000000;
		color: #242424;
		border: 2px solid #242424;
		padding: 8px 24px;
		border-radius: 25px;
		font-size: 13px;
		font-weight: 700;
		text-decoration: none;
		transition: all 0.3s ease;
		position: absolute;
		right: 20px;
		display: inline-flex;
		align-items: center;
		gap: 6px;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
	}

	.testimonial-form-container .section-banner .btn:hover {
		background: #242424;
		color: #fff;
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
	}

	.testimonial-form-container .section-banner .btn i {
		font-size: 12px;
	}

	.testimonial-form-container .form-group {
		margin-bottom: 25px;
	}

	.testimonial-form-container .form-group label {
		display: block;
		margin-bottom: 8px;
		font-weight: 600;
		color: #333;
		font-size: 14px;
	}

	.testimonial-form-container .required {
		color: #dc3545;
		margin-left: 3px;
	}

	.testimonial-form-container .form-control {
		border: 1px solid #ddd;
		border-radius: 6px; 
		font-size: 14px;
		padding: 5px;
		transition: all 0.3s ease;
	}

	.testimonial-form-container .form-control:focus {
		border-color: #EEB72D;
		box-shadow: 0 0 0 0.2rem rgba(238, 183, 45, 0.15);
		outline: none;
	}

	.testimonial-form-container .text-danger {
		color: #dc3545;
		font-size: 13px;
		margin-top: 5px;
		display: block;
	}

	.testimonial-form-container .image-preview-section {
		margin-top: 15px; 
	}

	.testimonial-form-container .image-preview-section img {
		max-width: 150px;
		height: auto;
		border-radius: 8px;
		border: 2px solid #ddd;
		padding: 5px;
		background: #fff;
	}

	.testimonial-form-container .action-section {
		margin-top: 30px;
		padding-top: 20px;
		border-top: 1px solid #e0e0e0;
	}

	.testimonial-form-container .btn-submit {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%);
		color: #242424;
		border: none;
		padding: 12px 30px;
		border-radius: 6px;
		font-weight: 600;
		font-size: 14px;
		cursor: pointer;
		transition: all 0.3s ease;
		box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
	}

	.testimonial-form-container .btn-submit:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 10px rgba(238, 183, 45, 0.3);
	}

	.testimonial-form-container .btn-submit i {
		margin-right: 8px;
	}
</style>
@endpush


<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('testimonial.store') }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				<div class="testimonial-form-container">
					<div class="testimonial-form-body">
						<div class="section-banner">
							<h3>Add Testimonial</h3>
							<a href="{{ route('testimonial.index') }}" class="btn btn-primary btn-sm">
								<i class="fa fa-arrow-left"></i> Back
							</a>
						</div>

						<div class="form-group">
							<label for="image">Image <span class="required">*</span></label>
							<input type="file" name="image" class="form-control" accept="image/*" id="image">
							@error('image')
								<span class="text-danger">{{ $message }}</span>
							@enderror
							<div class="image-preview-section">
								<img id="banner_preview" src="{{ asset('admin/assets/images/default.jpg') }}" alt="Image Preview">
							</div>
						</div>

						<div class="form-group">
							<label for="name">Name <span class="required">*</span></label>
							<input type="text" id="name" autocomplete="off" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter name">
							@error('name')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						{{-- <div class="form-group">
							<label for="designation">Designation</label>
							<input type="text" id="designation" autocomplete="off" class="form-control" name="designation" value="{{ old('designation') }}" placeholder="Enter designation">
							@error('designation')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div> --}}

						<div class="form-group">
							<label for="comment">Comment <span class="required">*</span></label>
							<textarea id="comment" class="form-control texteditor" name="comment" style="height:200px;" placeholder="Enter comment">{{ old('comment') }}</textarea>
							@error('comment')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="action-section">
							<button type="submit" class="btn-submit" name="form1">
								<i class="fa fa-plus"></i> Add Testimonial
							</button>
						</div>
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
		if ($(".texteditor").length > 0) {
			tinymce.init({
				selector: "textarea.texteditor",
				theme: "modern",
				height: 150,
				plugins: [
					"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
					"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
					"save table contextmenu directionality emoticons template paste textcolor"
				],
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
			});
		}

		$("#regform").validate({
			rules: {
				image: "required",
				name: "required",
				comment: "required",
			},
			errorClass: "error",
			validClass: "valid",
			errorElement: "span",
			errorPlacement: function(error, element) {
				error.addClass("text-danger");
				error.insertAfter(element);
			}
		});

		image.onchange = evt => {
			const [file] = image.files
			if (file) {
				banner_preview.src = URL.createObjectURL(file)
			}
		}
	});
</script>
@endpush
