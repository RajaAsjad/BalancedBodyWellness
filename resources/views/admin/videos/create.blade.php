@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
<style>
	.page-admin { --pg-pink: #ec4899; --pg-pink-deep: #be185d; --pg-orange: #fb923c; --pg-cream: #f5f3f0; --pg-text: #1c1917; }

	.video-form-container {
		background: #fff;
		border-radius: 12px;
		box-shadow: 0 4px 24px rgba(236, 72, 153, 0.1);
		border: 1px solid rgba(236, 72, 153, 0.12);
		overflow: hidden;
		margin: 20px 0;
	}

	.video-form-body {
		padding: 0 30px 40px;
		background: var(--pg-cream);
	}

	.video-form-container .section-banner {
		background: linear-gradient(135deg, var(--pg-pink) 0%, #f472b6 45%, var(--pg-orange) 100%) !important;
		padding: 15px 20px;
		margin: 0 -40px 25px -40px;
		text-align: center;
		border-bottom: 2px solid rgba(190, 24, 93, 0.35);
		box-shadow: 0 4px 20px rgba(236, 72, 153, 0.18);
	}

	.video-form-container .section-banner h3 {
		margin: 0;
		font-size: 18px;
		font-weight: 600;
		color: #fff;
		letter-spacing: 0.5px;
		text-transform: uppercase;
		text-shadow: 0 1px 2px rgba(0, 0, 0, 0.12);
	}

	.video-form-container .form-group {
		margin-bottom: 25px;
	}

	.video-form-container .form-group label {
		font-weight: 600;
		color: #374151;
		margin-bottom: 10px;
		font-size: 14px;
		display: block;
	}

	.video-form-container .form-control {
		border: 2px solid #e7e5e4;
		border-radius: 8px;
		padding: 12px 14px;
		font-size: 14px;
		line-height: 1.6;
		transition: all 0.3s ease;
		background: #fff;
		box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
		width: 100%;
	}

	.video-form-container .form-control:focus {
		border-color: rgba(236, 72, 153, 0.55);
		box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.12);
		outline: none;
	}

	.video-form-container .form-control:hover {
		border-color: #d6d3d1;
	}

	.video-form-container .form-control.error {
		border-color: #dc2626;
	}

	.video-form-container .text-danger {
		font-size: 13px;
		margin-top: 6px;
		display: block;
	}

	.video-form-container .action-section {
		text-align: center;
		padding-top: 30px;
		margin-top: 30px;
		border-top: 1px solid rgba(236, 72, 153, 0.12);
	}

	.video-form-container .btn-submit {
		background: linear-gradient(135deg, var(--pg-pink) 0%, var(--pg-orange) 100%);
		border: none;
		border-radius: 8px;
		padding: 12px 40px;
		font-size: 16px;
		font-weight: 600;
		color: #fff;
		box-shadow: 0 4px 16px rgba(236, 72, 153, 0.3);
		transition: all 0.3s ease;
		cursor: pointer;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}

	.video-form-container .btn-submit:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 22px rgba(236, 72, 153, 0.4);
		background: linear-gradient(135deg, #db2777 0%, #ea580c 100%);
		color: #fff;
	}

	.video-form-container .btn-submit:active {
		transform: translateY(0);
	}

	.video-form-container label .required {
		color: #dc2626;
	}

	.video-featured-row {
		display: flex;
		align-items: center;
		gap: 12px;
		flex-wrap: wrap;
	}

	.video-toggle-switch {
		position: relative;
		display: inline-block;
		width: 52px;
		height: 28px;
		flex-shrink: 0;
	}

	.video-toggle-switch input[type="checkbox"] {
		opacity: 0;
		width: 0;
		height: 0;
		position: absolute;
	}

	.video-toggle-slider {
		position: absolute;
		cursor: pointer;
		inset: 0;
		background: #d6d3d1;
		border-radius: 34px;
		transition: 0.25s;
	}

	.video-toggle-slider:before {
		content: "";
		position: absolute;
		height: 22px;
		width: 22px;
		left: 3px;
		bottom: 3px;
		background: #fff;
		border-radius: 50%;
		transition: 0.25s;
		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
	}

	.video-toggle-switch input:checked + .video-toggle-slider {
		background: linear-gradient(135deg, var(--pg-pink) 0%, var(--pg-orange) 100%);
	}

	.video-toggle-switch input:checked + .video-toggle-slider:before {
		transform: translateX(24px);
	}

	.video-toggle-switch input:focus + .video-toggle-slider {
		box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.2);
	}

	.video-featured-hint {
		font-size: 14px;
		color: #6b7280;
		font-weight: 500;
	}

	.video-form-container .video-featured-title {
		font-weight: 600;
		color: #374151;
		margin-bottom: 10px;
		font-size: 14px;
		display: block;
	}

	@media (max-width: 768px) {
		.video-form-body { padding: 20px; }
		.video-form-container .section-banner { margin: 0 -20px 20px -20px; padding: 12px 15px; }
		.video-form-container .section-banner h3 { font-size: 16px; }
	}
</style>
@endpush

<section class="content-header">
	<div class="content-header-left">
		<h1>{{ $page_title }}</h1>
	</div>
	@can('video-list')
	<div class="content-header-right">
		<a href="{{ route('video.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
	@endcan
</section>

<section class="content page-admin">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('video.store') }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				<div class="video-form-container">
					<div class="video-form-body">
						<div class="section-banner">
							<h3>Add Video</h3>
						</div>
						<div class="form-group">
							<label for="heading">Heading <span class="required">*</span></label>
							<input type="text" id="heading" autocomplete="off" class="form-control" name="heading" value="{{ old('heading') }}" placeholder="Enter heading">
						</div>
						<div class="form-group">
							<label for="title">Title <span class="required">*</span></label>
							<input type="text" id="title" autocomplete="off" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter video title">
						</div>

						<div class="form-group">
							<label for="video_url">Video URL <span class="required">*</span></label>
							<input type="text" id="video_url" autocomplete="off" class="form-control" name="video_url" value="{{ old('video_url') }}" required placeholder="e.g. https://www.youtube.com/watch?v=...">
							@error('video_url')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
						@php
							$featuredOn = old('featured', '0');
							$featuredOn = ($featuredOn == 1 || $featuredOn === '1');
						@endphp
						<div class="form-group">
							<div id="featured_field_label" class="video-featured-title">Featured <span class="required">*</span></div>
							<div class="video-featured-row">
								<label class="video-toggle-switch">
									<input type="checkbox" id="featured_toggle" role="switch" aria-labelledby="featured_field_label" {{ $featuredOn ? 'checked' : '' }}>
									<span class="video-toggle-slider" aria-hidden="true"></span>
								</label>
								<input type="hidden" name="featured" id="featured" value="{{ $featuredOn ? '1' : '0' }}">
								<span class="video-featured-hint" id="featured_hint">{{ $featuredOn ? 'Yes' : 'No' }}</span>
							</div>
						</div>

						<div class="action-section">
							<button type="submit" class="btn-submit" name="submit">
								<i class="fa fa-plus"></i> Add Video
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
		(function () {
			var cb = document.getElementById('featured_toggle');
			var hidden = document.getElementById('featured');
			var hint = document.getElementById('featured_hint');
			if (!cb || !hidden) return;
			function syncFeaturedToggle() {
				hidden.value = cb.checked ? '1' : '0';
				if (hint) hint.textContent = cb.checked ? 'Yes' : 'No';
				cb.setAttribute('aria-checked', cb.checked ? 'true' : 'false');
			}
			cb.addEventListener('change', syncFeaturedToggle);
			syncFeaturedToggle();
		})();

		$("#regform").validate({
			rules: {
				heading: "required",
				title: "required",
				video_url: "required",
			},
			errorClass: "error",
			validClass: "valid",
			errorElement: "span",
			errorPlacement: function(error, element) {
				error.addClass("text-danger");
				error.insertAfter(element);
			}
		});
	});
</script>
@endpush
