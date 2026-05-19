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
	.current-image-wrap {
		margin-top: 12px;
	}
	.current-image-wrap img {
		max-width: 180px;
		height: auto;
		border-radius: 8px;
		border: 2px solid #e0e0e0;
		object-fit: cover;
		display: block;
	}
	.current-image-wrap img.tiff-loading {
		background: #e9ecef;
	}
	.current-image-wrap.tiff-loading-wrap .tiff-preview-box {
		position: relative;
		width: 180px;
		height: 180px;
		border-radius: 8px;
		border: 2px solid #e0e0e0;
		overflow: hidden;
		background: #e9ecef;
	}
	.current-image-wrap.tiff-loading-wrap .tiff-preview-box img {
		width: 100%;
		height: 100%;
		object-fit: contain;
		max-width: none;
	}
	.current-image-wrap .tiff-preview-box .tiff-loader {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		display: flex;
		align-items: center;
		justify-content: center;
		background: rgba(233,236,239,0.9);
		border-radius: 6px;
	}
	.current-image-wrap .tiff-loader::after {
		content: '';
		width: 36px;
		height: 36px;
		border: 3px solid #e0e0e0;
		border-top-color: #EEB72D;
		border-radius: 50%;
		animation: tiff-spin 0.8s linear infinite;
	}
	.current-image-wrap .tiff-loader.hide { display: none !important; }
	@keyframes tiff-spin {
		to { transform: rotate(360deg); }
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
			<form action="{{ route('photogallery.update', $model->id) }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				{{ method_field('PATCH') }}
				<div class="video-form-container">
					<div class="video-form-body">
						<div class="section-banner">
							<h3>Edit Photo</h3>
						</div>

						<div class="form-group">
							<label for="image">Replace image <span class="text-muted">(optional)</span></label>
							<input type="file" id="image" class="form-control" name="image" accept="image/jpeg,image/webp,image/png,image/jpg,image/gif,image/svg+xml,image/tiff">
							<div class="current-image-wrap {{ ($model->image && in_array(strtolower(pathinfo($model->image ?? '', PATHINFO_EXTENSION)), ['tif','tiff'])) ? 'tiff-loading-wrap' : '' }}" id="preview_wrap" style="{{ $model->image ? '' : 'display:none;' }}">
								<p class="text-muted mb-1" style="font-size: 13px;">{{ $model->image ? 'Current photo:' : 'Preview:' }}</p>
								@php
									$currentImgUrl = $model->image ? asset('admin/assets/website/photo_gallery/' . $model->image) : '';
									$ext = strtolower(pathinfo($model->image ?? '', PATHINFO_EXTENSION));
									$currentIsTiff = ($ext === 'tif' || $ext === 'tiff');
								@endphp
								@if($model->image && $currentIsTiff)
								<div class="tiff-preview-box">
									<span class="tiff-loader"></span>
									<img id="photo_gallery_preview" class="tiff-thumb tiff-loading" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-tiff-src="{{ $currentImgUrl }}" alt="Current">
								</div>
								@else
								<img id="photo_gallery_preview" src="{{ $currentImgUrl }}" alt="Current">
								@endif
							</div>
							@error('image')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group">
							<label for="status">Status <span class="required">*</span></label>
							<select name="status" id="status" class="form-control">
								<option value="1" {{ ($model->status == 1 || $model->status === '1') ? 'selected' : '' }}>Active</option>
								<option value="0" {{ ($model->status == 0 || $model->status === '0') ? 'selected' : '' }}>Inactive</option>
							</select>
						</div>

						<div class="action-section">
							<button type="submit" class="btn-submit" name="submit">
								<i class="fa fa-save"></i> Update Photo
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
function setPreviewFromTiffBuffer(buffer, imgEl) {
	if (typeof UTIF === 'undefined') return;
	try {
		var ifds = UTIF.decode(buffer);
		if (!ifds || !ifds[0]) return;
		UTIF.decodeImage(buffer, ifds[0]);
		var rgba = UTIF.toRGBA8(ifds[0]);
		var w = ifds[0].width, h = ifds[0].height;
		var canvas = document.createElement('canvas');
		canvas.width = w; canvas.height = h;
		var ctx = canvas.getContext('2d');
		var imageData = ctx.createImageData(w, h);
		imageData.data.set(rgba);
		ctx.putImageData(imageData, 0, 0);
		imgEl.src = canvas.toDataURL('image/png');
		imgEl.classList.remove('tiff-loading');
		var loader = imgEl.closest('.current-image-wrap') && imgEl.closest('.current-image-wrap').querySelector('.tiff-loader');
		if (loader) loader.classList.add('hide');
	} catch (e) {}
}

$(document).ready(function() {
	$("#regform").validate({
		rules: { status: "required" },
		errorClass: "error",
		validClass: "valid",
		errorElement: "span",
		errorPlacement: function(error, element) {
			error.addClass("text-danger");
			error.insertAfter(element);
		}
	});

	// Decode current photo if it's a TIFF (run on ready and on load so UTIF is available)
	function decodeCurrentTiff() {
		var currentTiff = document.querySelector('#photo_gallery_preview.tiff-thumb[data-tiff-src]');
		if (!currentTiff || typeof UTIF === 'undefined') return;
		var url = currentTiff.getAttribute('data-tiff-src');
		if (!url) return;
		fetch(url).then(function(r) { return r.arrayBuffer(); }).then(function(buffer) {
			setPreviewFromTiffBuffer(buffer, currentTiff);
			currentTiff.removeAttribute('data-tiff-src');
			var loader = document.querySelector('.current-image-wrap .tiff-loader');
			if (loader) loader.classList.add('hide');
		}).catch(function() {
			currentTiff.classList.remove('tiff-loading');
			var loader = document.querySelector('.current-image-wrap .tiff-loader');
			if (loader) loader.classList.add('hide');
		});
	}
	decodeCurrentTiff();
	$(window).on('load', decodeCurrentTiff);

	document.getElementById('image').addEventListener('change', function(e) {
		var preview = document.getElementById('photo_gallery_preview');
		var wrap = document.getElementById('preview_wrap');
		if (!preview || !wrap) return;
		var file = e.target.files[0];
		if (!file) return;
		wrap.style.display = 'block';
		var isTiff = file.type === 'image/tiff' || file.type === 'image/tif' ||
			/file\.(tif|tiff)$/i.test(file.name || '');
		if (isTiff) {
			var reader = new FileReader();
			reader.onload = function(ev) { setPreviewFromTiffBuffer(ev.target.result, preview); };
			reader.readAsArrayBuffer(file);
		} else {
			preview.src = URL.createObjectURL(file);
		}
	});
});
</script>
@endpush
