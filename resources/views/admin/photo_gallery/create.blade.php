@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
<style>
	.video-form-container {
		background: #ffffff;
		border-radius: 12px;
		box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
		overflow: hidden;
		margin: 20px 0;
	}
	.video-form-body { padding: 0px 30px 40px; background: #f8f9fa; }
	.video-form-container .section-banner {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
		padding: 15px 20px;
		margin: 0 -40px 25px -40px;
		text-align: center;
		border-bottom: 3px solid #242424;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
	}
	.video-form-container .section-banner h3 {
		margin: 0; font-size: 18px; font-weight: 600; color: #EEB72D;
		letter-spacing: 0.5px; text-transform: uppercase;
	}
	.video-form-container .form-group { margin-bottom: 25px; }
	.video-form-container .form-group label {
		font-weight: 600; color: #2c3e50; margin-bottom: 10px; font-size: 14px; display: block;
	}
	.video-form-container .form-control {
		border: 2px solid #e0e0e0; border-radius: 8px;
		font-size: 14px; background: #fff; width: 100%;
	}
	.video-form-container .form-control:focus {
		border-color: #EEB72D; box-shadow: 0 0 0 3px rgba(238, 183, 45, 0.2); outline: none;
	}
	.video-form-container .text-danger { font-size: 13px; margin-top: 6px; display: block; }
	.video-form-container .action-section {
		text-align: center; padding-top: 30px; margin-top: 30px; border-top: 2px solid #e0e0e0;
	}
	.video-form-container .btn-submit {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
		border: none; border-radius: 8px; padding: 12px 40px; font-size: 16px; font-weight: 600;
		color: #1a1a1a; cursor: pointer; text-transform: uppercase; letter-spacing: 0.5px;
	}
	.video-form-container .btn-submit:hover {
		transform: translateY(-2px);
		background: linear-gradient(135deg, #d4a020 0%, #EEB72D 100%) !important;
		color: #1a1a1a;
	}
	.video-form-container label .required { color: #dc3545; }
	.preview-grid {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
		gap: 12px;
		margin-top: 12px;
	}
	.preview-grid .preview-item {
		position: relative;
		border-radius: 8px;
		overflow: hidden;
		box-shadow: 0 2px 8px rgba(0,0,0,0.1);
		aspect-ratio: 1;
	}
	.preview-grid .preview-item img {
		width: 100%; height: 100%; object-fit: cover; display: block;
	}
	.preview-grid .preview-item .remove-preview {
		position: absolute;
		top: 4px; right: 4px;
		width: 24px; height: 24px;
		background: #dc3545;
		color: #fff;
		border: none;
		border-radius: 50%;
		cursor: pointer;
		font-size: 14px;
		line-height: 1;
		padding: 0;
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.preview-grid .preview-item .preview-placeholder {
		position: absolute;
		inset: 0;
		background: #e9ecef;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		padding: 8px;
		text-align: center;
		font-size: 11px;
		color: #495057;
		word-break: break-all;
	}
	.preview-grid .preview-item .preview-placeholder i {
		font-size: 24px;
		margin-bottom: 6px;
		opacity: 0.7;
	}
	@media (max-width: 768px) {
		.video-form-body { padding: 20px; }
		.video-form-container .section-banner { margin: 0 -20px 20px -20px; padding: 12px 15px; }
	}
</style>
@endpush

<section class="content-header">
	<div class="content-header-left">
		<h1>{{ $page_title }}</h1>
	</div>
	@can('photogallery-list')
	<div class="content-header-right">
		<a href="{{ route('photogallery.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
	@endcan
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('photogallery.store') }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				<div class="video-form-container">
					<div class="video-form-body">
						<div class="section-banner">
							<h3>Add Photos (Multiple)</h3>
						</div>

						<div class="form-group">
							<label for="images">Images <span class="required">*</span></label>
							<input type="file" id="images" class="form-control" name="images[]" accept="image/jpeg,image/webp,image/png,image/jpg,image/gif,image/svg+xml,image/tiff,image/tif" multiple>
							<small class="text-muted">Select one or more images. Supported: JPEG, PNG, GIF, WebP, SVG, TIF, TIFF.</small>
							<div id="preview-grid" class="preview-grid"></div>
							@error('images')
								<span class="text-danger">{{ $message }}</span>
							@enderror
							@error('images.*')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="action-section">
							<button type="submit" class="btn-submit" name="submit">
								<i class="fa fa-plus"></i> Add Photos
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
<script src="https://cdn.jsdelivr.net/npm/utif@3.1.0/UTIF.js" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
	$("#regform").validate({
		rules: {
			"images[]": "required",
		},
		messages: {
			"images[]": "Please select at least one image.",
		},
		errorClass: "error",
		validClass: "valid",
		errorElement: "span",
		errorPlacement: function(error, element) {
			error.addClass("text-danger");
			error.insertAfter(element);
		}
	});

	// Multiple image preview (JPEG/PNG/etc. via data URL; TIF/TIFF via UTIF decode -> canvas)
	var previewGrid = document.getElementById('preview-grid');
	document.getElementById('images').addEventListener('change', function(e) {
		previewGrid.innerHTML = '';
		var files = e.target.files;
		function isTiff(type, name) {
			if (type === 'image/tiff' || type === 'image/tif') return true;
			var n = (name || '').toLowerCase();
			return n.indexOf('.tif') === n.length - 4 || n.indexOf('.tiff') === n.length - 5;
		}
		function canShowThumbDirect(type) {
			return type && type.indexOf('image/') === 0 && !isTiff(type);
		}
		function showPlaceholder(placeholder, img) {
			if (img) img.style.display = 'none';
			placeholder.style.display = 'flex';
		}
		function showTiffPreview(file, img, placeholder) {
			if (typeof UTIF === 'undefined') { showPlaceholder(placeholder, img); return; }
			var reader = new FileReader();
			reader.onload = function(ev) {
				try {
					var buffer = ev.target.result;
					var ifds = UTIF.decode(buffer);
					if (!ifds || !ifds[0]) { showPlaceholder(placeholder, img); return; }
					UTIF.decodeImage(buffer, ifds[0]);
					var rgba = UTIF.toRGBA8(ifds[0]);
					var w = ifds[0].width, h = ifds[0].height;
					var canvas = document.createElement('canvas');
					canvas.width = w; canvas.height = h;
					var ctx = canvas.getContext('2d');
					var imageData = ctx.createImageData(w, h);
					imageData.data.set(rgba);
					ctx.putImageData(imageData, 0, 0);
					img.src = canvas.toDataURL('image/png');
					img.style.display = 'block';
				} catch (err) {
					showPlaceholder(placeholder, img);
				}
			};
			reader.onerror = function() { showPlaceholder(placeholder, img); };
			reader.readAsArrayBuffer(file);
		}
		for (var i = 0; i < files.length; i++) {
			(function(idx) {
				var file = files[idx];
				var div = document.createElement('div');
				div.className = 'preview-item';
				div.dataset.index = idx;
				var name = file.name || ('File ' + (idx + 1));
				var placeholderHtml = '<span class="preview-placeholder" style="display:none;"><i class="fa fa-image"></i> ' + name + '</span>';
				div.innerHTML = '<img src="" alt="" style="display:none;">' + placeholderHtml +
					'<button type="button" class="remove-preview" title="Remove">&times;</button>';
				previewGrid.appendChild(div);
				var img = div.querySelector('img');
				var placeholder = div.querySelector('.preview-placeholder');

				if (canShowThumbDirect(file.type)) {
					var reader = new FileReader();
					reader.onload = function(ev) {
						img.src = ev.target.result;
						img.style.display = 'block';
						img.onerror = function() { showPlaceholder(placeholder, img); };
					};
					reader.readAsDataURL(file);
				} else if (isTiff(file.type, file.name)) {
					showTiffPreview(file, img, placeholder);
				} else {
					showPlaceholder(placeholder, img);
				}

				div.querySelector('.remove-preview').addEventListener('click', function() {
					removeFileByIndex(idx);
					div.remove();
				});
			})(i);
		}
	});

	function removeFileByIndex(index) {
		var input = document.getElementById('images');
		var dt = new DataTransfer();
		for (var i = 0; i < input.files.length; i++) {
			if (i !== index) dt.items.add(input.files[i]);
		}
		input.files = dt.files;
	}
});
</script>
@endpush
