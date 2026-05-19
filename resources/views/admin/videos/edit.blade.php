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
		overflow: visible;
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

	.video-form-meta-row {
		display: flex;
		flex-direction: row;
		align-items: flex-start;
		justify-content: space-between;
		gap: 32px;
		flex-wrap: wrap;
		margin-bottom: 25px;
	}
	.video-form-meta-col {
		flex: 1 1 200px;
		min-width: 160px;
		max-width: 100%;
	}
	.video-form-meta-label {
		font-weight: 600;
		color: #111827;
		margin-bottom: 12px;
		font-size: 14px;
		display: block;
	}
	.video-status-eye-group {
		display: flex;
		flex-direction: row;
		align-items: center;
		gap: 14px;
		position: relative;
		z-index: 0;
	}
	.video-status-eye-btn {
		position: relative;
		z-index: 0;
		width: 44px;
		height: 44px;
		border-radius: 50%;
		border: 1.5px solid #e5e7eb;
		background: #fff;
		color: #1f2937;
		cursor: pointer;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		padding: 0;
		transition: background 0.2s ease, border-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
		font-size: 16px;
		line-height: 1;
	}
	/* Dark tooltip + caret (hover / keyboard focus) */
	.video-status-eye-btn[data-tooltip]::after {
		content: attr(data-tooltip);
		position: absolute;
		left: 50%;
		bottom: calc(100% + 10px);
		transform: translateX(-50%) translateY(6px);
		padding: 7px 14px;
		background: #171717;
		color: #fff;
		font-size: 12px;
		font-weight: 500;
		letter-spacing: 0.02em;
		border-radius: 8px;
		white-space: nowrap;
		opacity: 0;
		visibility: hidden;
		pointer-events: none;
		transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s;
		box-shadow: 0 6px 20px rgba(0, 0, 0, 0.22);
		line-height: 1.25;
	}
	.video-status-eye-btn[data-tooltip]::before {
		content: "";
		position: absolute;
		left: 50%;
		bottom: calc(100% + 4px);
		transform: translateX(-50%) translateY(6px);
		border-left: 6px solid transparent;
		border-right: 6px solid transparent;
		border-top: 7px solid #171717;
		width: 0;
		height: 0;
		opacity: 0;
		visibility: hidden;
		pointer-events: none;
		transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s;
	}
	.video-status-eye-btn[data-tooltip]:hover,
	.video-status-eye-btn[data-tooltip]:focus-visible {
		z-index: 20;
	}
	.video-status-eye-btn[data-tooltip]:hover::after,
	.video-status-eye-btn[data-tooltip]:focus-visible::after,
	.video-status-eye-btn[data-tooltip]:hover::before,
	.video-status-eye-btn[data-tooltip]:focus-visible::before {
		opacity: 1;
		visibility: visible;
		transform: translateX(-50%) translateY(0);
	}
	.video-status-eye-btn:hover {
		border-color: #d1d5db;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
	}
	.video-status-eye-btn:focus {
		outline: none;
		box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.25);
	}
	/* Publish (visible) selected — pink, white icon */
	.video-status-eye-btn.is-selected[data-status="1"] {
		background: var(--pg-pink);
		border-color: var(--pg-pink);
		color: #fff;
		box-shadow: 0 2px 10px rgba(236, 72, 153, 0.35);
	}
	/* Draft (hidden) selected — white, grey ring, dark icon */
	.video-status-eye-btn.is-selected[data-status="0"] {
		background: #fff;
		border-color: #9ca3af;
		color: #111827;
		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
	}
	.video-status-eye-btn:not(.is-selected) {
		background: #fff;
		color: #9ca3af;
		border-color: #e5e7eb;
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
	/* Featured: white track, pink border when on, pink knob */
	.video-toggle-switch--featured {
		width: 50px;
		height: 26px;
	}
	.video-toggle-switch--featured .video-toggle-slider {
		background: #fff;
		border: 2px solid #d1d5db;
		box-sizing: border-box;
	}
	.video-toggle-switch--featured .video-toggle-slider:before {
		height: 18px;
		width: 18px;
		left: 3px;
		bottom: 2px;
		background: #d1d5db;
		box-shadow: none;
	}
	.video-toggle-switch--featured input:checked + .video-toggle-slider {
		background: #fff;
		border-color: var(--pg-pink);
		box-shadow: none;
	}
	.video-toggle-switch--featured input:checked + .video-toggle-slider:before {
		background: var(--pg-pink);
		transform: translateX(22px);
	}
	.video-featured-row {
		display: flex;
		align-items: center;
		gap: 12px;
		flex-wrap: wrap;
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
		.video-form-meta-row { flex-direction: column; gap: 22px; }
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
			<form action="{{ route('video.update', $model->id) }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				{{ method_field('PATCH') }}
				<div class="video-form-container">
					<div class="video-form-body">
						<div class="section-banner">
							<h3>Edit Video</h3>
						</div>
						<div class="form-group">
							<label for="heading">Heading <span class="required">*</span></label>
							<input type="text" id="heading" autocomplete="off" class="form-control" name="heading" value="{{ old('heading', $model->heading) }}" placeholder="Enter heading">
							@error('heading')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-group">
							<label for="title">Title <span class="required">*</span></label>
							<input type="text" id="title" autocomplete="off" class="form-control" name="title" value="{{ old('title', $model->title) }}" placeholder="Enter video title">
							@error('title')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group">
							<label for="video_url">Video URL <span class="required">*</span></label>
							<input type="text" id="video_url" autocomplete="off" class="form-control" name="video_url" value="{{ old('video_url', $model->video_url) }}" required placeholder="e.g. https://www.youtube.com/watch?v=...">
							@error('video_url')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
						@php
							$featuredVal = old('featured', $model->featured);
							$featuredOn = ($featuredVal == 1 || $featuredVal === '1');
							$statusVal = old('status', $model->status);
							$statusActive = ($statusVal == 1 || $statusVal === '1');
						@endphp
						<div class="form-group" style="margin-bottom: 0;">
							<div class="video-form-meta-row">
								<div class="video-form-meta-col">
									<div id="status_field_label" class="video-form-meta-label">Status:</div>
									<div class="video-status-eye-group" role="radiogroup" aria-labelledby="status_field_label">
										<button type="button" class="video-status-eye-btn js-status-eye {{ $statusActive ? 'is-selected' : '' }}" data-status="1" data-tooltip="Publish" aria-pressed="{{ $statusActive ? 'true' : 'false' }}" aria-label="Set status to publish">
											<i class="fa fa-eye" aria-hidden="true"></i>
										</button>
										<button type="button" class="video-status-eye-btn js-status-eye {{ !$statusActive ? 'is-selected' : '' }}" data-status="0" data-tooltip="Draft" aria-pressed="{{ !$statusActive ? 'true' : 'false' }}" aria-label="Set status to draft">
											<i class="fa fa-eye-slash" aria-hidden="true"></i>
										</button>
									</div>
									<input type="hidden" name="status" id="status" value="{{ $statusActive ? '1' : '0' }}">
								</div>
								<div class="video-form-meta-col">
									<div id="featured_field_label" class="video-form-meta-label">Is Featured: <span class="required">*</span></div>
									<div class="video-featured-row">
										<label class="video-toggle-switch video-toggle-switch--featured">
											<input type="checkbox" id="featured_toggle" role="switch" aria-labelledby="featured_field_label" {{ $featuredOn ? 'checked' : '' }}>
											<span class="video-toggle-slider" aria-hidden="true"></span>
										</label>
										<input type="hidden" name="featured" id="featured" value="{{ $featuredOn ? '1' : '0' }}">
									</div>
								</div>
							</div>
						</div>

						<div class="action-section">
							<button type="submit" class="btn-submit" name="submit">
								<i class="fa fa-save"></i> Update Video
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
			if (!cb || !hidden) return;
			function syncFeaturedToggle() {
				hidden.value = cb.checked ? '1' : '0';
				cb.setAttribute('aria-checked', cb.checked ? 'true' : 'false');
			}
			cb.addEventListener('change', syncFeaturedToggle);
			syncFeaturedToggle();
		})();

		(function () {
			var hidden = document.getElementById('status');
			var btns = document.querySelectorAll('.js-status-eye');
			if (!hidden || !btns.length) return;
			function setStatus(val) {
				hidden.value = val === '1' || val === 1 ? '1' : '0';
				btns.forEach(function (btn) {
					var on = btn.getAttribute('data-status') === hidden.value;
					btn.classList.toggle('is-selected', on);
					btn.setAttribute('aria-pressed', on ? 'true' : 'false');
				});
			}
			btns.forEach(function (btn) {
				btn.addEventListener('click', function () {
					setStatus(btn.getAttribute('data-status'));
				});
			});
			setStatus(hidden.value);
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
