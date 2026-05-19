@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
<style>
	.banner-form-container {
		background: #ffffff;
		border-radius: 12px;
		box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
		overflow: hidden;
		margin: 20px 0;
	}

	.banner-form-body {
		padding: 0px 30px 40px;
		background: #f8f9fa;
	}

	.banner-form-container .section-banner {
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

	.banner-form-container .section-banner h3 {
		margin: 0;
		font-size: 18px;
		font-weight: 600;
		color: #242424;
		letter-spacing: 0.5px;
		text-transform: uppercase;
	}

	.banner-form-container .section-banner .btn {
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

	.banner-form-container .section-banner .btn:hover {
		background: #242424;
		color: #fff;
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
	}

	.banner-form-container .section-banner .btn i {
		font-size: 12px;
	}

	.banner-form-container .form-group {
		margin-bottom: 25px;
	}

	.banner-form-container .form-group label {
		display: block;
		margin-bottom: 8px;
		font-weight: 600;
		color: #333;
		font-size: 14px;
	}

	.banner-form-container .required {
		color: #dc3545;
		margin-left: 3px;
	}

	.banner-form-container .form-control {
		border: 1px solid #ddd;
		border-radius: 6px;
		padding: 5px;
		font-size: 14px;
		transition: all 0.3s ease;
	}

	.banner-form-container .form-control:focus {
		border-color: #EEB72D;
		box-shadow: 0 0 0 0.2rem rgba(238, 183, 45, 0.15);
		outline: none;
	}

	.banner-form-container .text-danger {
		color: #dc3545;
		font-size: 13px;
		margin-top: 5px;
		display: block;
	}

	.banner-form-container .image-preview-section {
		margin-top: 15px;
	}

	.banner-form-container .image-preview-section img {
		max-width: 150px;
		height: auto;
		border-radius: 8px;
		border: 2px solid #ddd;
		padding: 5px;
		background: #fff;
	}

	.banner-form-container .action-section {
		margin-top: 30px;
		padding-top: 20px;
		border-top: 1px solid #e0e0e0;
	}

	.banner-form-container .btn-submit {
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

	.banner-form-container .btn-submit:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 10px rgba(238, 183, 45, 0.3);
	}

	.banner-form-container .btn-submit i {
		margin-right: 8px;
	}

	.banner-form-container .text-muted {
		color: #6c757d;
		font-size: 12px;
		font-weight: 400;
	}
</style>
@endpush

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{route('banner.update', $banners->id)}}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				{{ method_field('PATCH') }}
				<div class="banner-form-container">
					<div class="banner-form-body">
						<div class="section-banner">
							<h3>Edit Banner</h3>
							<a href="{{ route('banner.index') }}" class="btn btn-primary btn-sm">
								<i class="fa fa-arrow-left"></i> Back
							</a>
						</div>

						<div class="form-group">
							<label for="image">Image <span class="text-muted">(leave empty to keep current)</span></label>
							<input type="file" name="image" class="form-control" accept="image/*" id="image">
							@error('image')
								<span class="text-danger">{{ $message }}</span>
							@enderror
							<div class="image-preview-section">
								<img id="banner_preview" src="{{ asset('admin/assets/images/banner/'.$banners->image) }}" alt="Current Image">
							</div>
						</div>

						<div class="form-group">
							<label for="slug">Page <span class="required">*</span></label>
							<select name="slug" id="slug" class="form-control" required>
								<option value="">Select Page</option>
								<option value="about-us" {{ old('slug', $banners->slug) == 'about-us' ? 'selected' : '' }}>About Us</option>
								<option value="resume" {{ old('slug', $banners->slug) == 'resume' ? 'selected' : '' }}>Resume</option>
								<option value="latest-news" {{ old('slug', $banners->slug) == 'latest-news' ? 'selected' : '' }}>Latest News</option>
								<option value="videos" {{ old('slug', $banners->slug) == 'videos' ? 'selected' : '' }}>Videos</option>
								<option value="testimonials" {{ old('slug', $banners->slug) == 'testimonials' ? 'selected' : '' }}>Testimonials</option>
								<option value="gallery" {{ old('slug', $banners->slug) == 'gallery' ? 'selected' : '' }}>Gallery</option>
								<option value="shop-and-contact" {{ old('slug', $banners->slug) == 'shop-and-contact' ? 'selected' : '' }}>Shop & Contact</option>
							</select>
							@error('slug')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group">
							<label for="title">Title</label>
							<input type="text" id="title" autocomplete="off" class="form-control" name="title" value="{{ old('title', $banners->title) }}" placeholder="Enter title (optional)">
							@error('title')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group">
							<label for="heading">Heading <span class="required">*</span></label>
							<input type="text" id="heading" autocomplete="off" class="form-control" name="heading" value="{{ old('heading', $banners->heading) }}" placeholder="Enter heading" required>
							@error('heading')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group">
							<label for="status">Status</label>
							<select name="status" class="form-control" id="status">
								<option value="1" {{ old('status', $banners->status) == 1 ? 'selected' : '' }}>Active</option>
								<option value="0" {{ old('status', $banners->status) == 0 ? 'selected' : '' }}>In-Active</option>
							</select>
						</div>

						<div class="action-section">
							<button type="submit" class="btn-submit" name="form1">
								<i class="fa fa-save"></i> Update Banner
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
		tinymce.init({
				selector: "textarea.texteditor",
				theme: "modern",
				height: 150,
				plugins: [
					"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
					"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
					"save table contextmenu directionality emoticons template paste textcolor"
				],
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

			});
		
		$("#regform").validate({
			rules: {
			/* 	title: "required"
                description: "required" */
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
