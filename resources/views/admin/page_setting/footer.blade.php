@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
<style>
	/* Balanced Body IV Wellness — teal / sage / cream (vars keep legacy names for gradients) */
	.page-admin {
		--pg-pink: #2d6a62;
		--pg-pink-deep: #1a3f3c;
		--pg-orange: #4a9a8e;
		--pg-mint: #3d9a8e;
		--pg-cream: #eef2f0;
		--pg-text: #1d2b33;
	}

	.header-settings-container {
		background: #fff;
		border-radius: 12px;
		box-shadow: 0 4px 24px rgba(45, 106, 98, 0.1);
		border: 1px solid rgba(45, 106, 98, 0.12);
		overflow: hidden;
		margin: 20px 0;
	}

	.header-settings-body {
		padding: 0 30px 40px;
		background: var(--pg-cream);
	}

	.section-banner {
		background: linear-gradient(135deg, var(--pg-pink-deep) 0%, var(--pg-pink) 38%, var(--pg-mint) 72%, var(--pg-orange) 100%) !important;
		padding: 15px 20px;
		margin: 0 -40px 25px -40px;
		border-bottom: 2px solid rgba(26, 63, 60, 0.4);
		box-shadow: 0 4px 20px rgba(45, 106, 98, 0.18);
		display: flex;
		justify-content: center;
		align-items: center;
		position: relative;
	}

	.section-banner h3 {
		margin: 0;
		font-size: 18px;
		font-weight: 600;
		color: #fff;
		letter-spacing: 0.5px;
		text-transform: uppercase;
		text-shadow: 0 1px 2px rgba(0, 0, 0, 0.12);
	}

	.section-banner .btn {
		background: #fff;
		color: var(--pg-pink-deep);
		border: 2px solid rgba(255, 255, 255, 0.95);
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
		box-shadow: 0 2px 10px rgba(0, 0, 0, 0.12);
	}

	.section-banner .btn:hover {
		background: var(--pg-text);
		color: #fff;
		border-color: var(--pg-text);
		transform: translateY(-2px);
		box-shadow: 0 4px 14px rgba(29, 43, 51, 0.22);
	}

	.section-banner .btn i {
		font-size: 12px;
	}

	.section-block {
		margin-bottom: 40px;
		padding-bottom: 30px;
		border-bottom: 1px solid rgba(45, 106, 98, 0.12);
	}

	.section-block:last-of-type {
		border-bottom: none;
		margin-bottom: 30px;
		padding-bottom: 0;
	}

	.section-heading {
		background: linear-gradient(90deg, #eef6f4 0%, #f5faf9 100%);
		padding: 12px 20px;
		margin: 0 0 25px 0;
		border-radius: 8px;
		border: 1px solid rgba(45, 106, 98, 0.2);
		box-shadow: 0 2px 8px rgba(45, 106, 98, 0.08);
	}

	.section-heading h4 {
		margin: 0;
		font-size: 15px;
		font-weight: 700;
		color: var(--pg-text);
		letter-spacing: 0.5px;
		text-transform: uppercase;
		display: flex;
		align-items: center;
		gap: 8px;
	}

	.section-heading h4 i {
		font-size: 16px;
		color: var(--pg-pink-deep);
	}

	.header-settings-container .form-group {
		margin-bottom: 25px;
	}

	.header-settings-container .form-group label {
		font-weight: 600;
		color: #374151;
		margin-bottom: 10px;
		font-size: 14px;
		display: block;
	}

	.header-settings-container .form-control {
		border: 2px solid #e7e5e4;
		border-radius: 8px;
		padding: 10px 12px;
		font-size: 14px;
		line-height: 1.6;
		transition: all 0.3s ease;
		background: #fff;
		box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
		width: 100%;
	}

	.header-settings-container input[type="file"].form-control {
		padding: 5px;
	}

	.header-settings-container textarea.form-control {
		min-height: 90px;
		resize: vertical;
	}

	.header-settings-container .form-control:focus {
		border-color: #2d6a62;
		box-shadow: 0 0 0 3px rgba(45, 106, 98, 0.18);
		outline: none;
	}

	.header-settings-container .form-control:hover {
		border-color: #d6d3d1;
	}

	.header-settings-container .form-hint {
		color: #5f6f68;
		display: block;
		margin-top: 5px;
		font-size: 13px;
	}

	.existing-photo {
		border-radius: 8px;
		border: 1px solid rgba(45, 106, 98, 0.15);
		object-fit: cover;
		margin-top: 12px;
		box-shadow: 0 2px 10px rgba(45, 106, 98, 0.1);
	}

	.image-preview-container {
		margin-top: 15px;
		padding: 15px;
		background: #fff;
		border-radius: 8px;
		border: 2px dashed rgba(45, 106, 98, 0.25);
		display: inline-block;
	}

	.action-section {
		text-align: center;
		padding-top: 30px;
		margin-top: 30px;
		border-top: 1px solid rgba(45, 106, 98, 0.12);
	}

	.btn-update {
		background: linear-gradient(135deg, var(--pg-pink) 0%, var(--pg-orange) 100%);
		border: none;
		border-radius: 8px;
		padding: 12px 40px;
		font-size: 16px;
		font-weight: 600;
		color: #fff;
		box-shadow: 0 4px 16px rgba(45, 106, 98, 0.3);
		transition: all 0.3s ease;
		cursor: pointer;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}

	.btn-update:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 22px rgba(45, 106, 98, 0.4);
		background: linear-gradient(135deg, #1a5c54 0%, #3d9a8e 100%);
		color: #fff;
	}

	.btn-update:active {
		transform: translateY(0);
	}

	@media (max-width: 768px) {
		.header-settings-body { padding: 20px; }
		.section-banner { margin: 0 -20px 20px -20px; padding: 12px 15px; }
		.section-banner h3 { font-size: 16px; }
	}
</style>
@endpush

<section class="content page-admin">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('page_setting.store') }}" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				<input type="hidden" name="parent_slug" value="{{ $model->slug }}">
				<div class="header-settings-container">
					<div class="header-settings-body">
						<div class="section-banner">
							<h3>Footer Settings</h3>
							<a href="{{ route('page.index') }}" class="btn btn-sm">
								<i class="fa fa-arrow-left"></i> Back
							</a>
						</div>

						<div class="section-block">
							<div class="section-heading">
								<h4><i class="fa fa-image"></i> Footer Image</h4>
							</div>

							<div class="form-group">
								<label for="footer_image">Footer Logo / Image</label>
								<input type="file" id="footer_image" name="footer_image" class="form-control" accept="image/*">
								<small class="form-hint">Recommended: PNG with transparent background</small>
								@if (isset($page_data['footer_image']))
								<div class="image-preview-container">
									<img src="{{ asset('admin/assets/images/page/' . $page_data['footer_image']) }}" class="existing-photo" style="height:100px;" alt="Current Footer Image">
								</div>
								@endif
							</div> 
							<div class="form-group">
								<label for="footer_description">Footer Description</label>
								<textarea id="footer_description" name="footer_description" class="form-control" rows="3" placeholder="Enter footer description">{{ isset($page_data['footer_description']) ? $page_data['footer_description'] : '' }}</textarea>
								<small class="form-hint">Displayed in the website footer</small>
							</div>
						</div>

						<div class="section-block">
							<div class="section-heading">
								<h4><i class="fa fa-map-marker"></i> Social Media Links</h4>
							</div>

							<div class="form-group">
								<label for="footer_address">Instagram</label>
								<input type="url" id="footer_instagram" name="footer_instagram" class="form-control" value="{{ isset($page_data['footer_instagram']) ? $page_data['footer_instagram'] : '' }}" placeholder="https://instagram.com/yourpage">
								<small class="form-hint">Instagram URL</small>
							</div>
							<div class="form-group">
								<label for="footer_address">Facebook</label>
								<input type="url" id="footer_facebook" name="footer_facebook" class="form-control" value="{{ isset($page_data['footer_facebook']) ? $page_data['footer_facebook'] : '' }}" placeholder="https://facebook.com/yourpage">
								<small class="form-hint">Facebook URL</small>
							</div>
						</div>

						{{-- <div class="section-block">
							<div class="section-heading">
								<h4><i class="fa fa-copyright"></i> Copyright Text</h4>
							</div>

							<div class="form-group">
								<label for="footer_copy_right_left_side">Copyright — Left Side</label>
								<input type="text" id="footer_copy_right_left_side" name="footer_copy_right_left_side" class="form-control" value="{{ isset($page_data['footer_copy_right_left_side']) ? $page_data['footer_copy_right_left_side'] : '' }}" placeholder="e.g. © 2026 Balanced Body IV Wellness. All Rights Reserved">
								<small class="form-hint">Plain text shown on the left side of the footer bar</small>
							</div>

							<div class="form-group">
								<label for="footer_copy_right_right_side">Copyright — Right Side</label>
								<textarea id="footer_copy_right_right_side" name="footer_copy_right_right_side" class="form-control" rows="4" placeholder="e.g. Site design credit or additional footer text">{{ isset($page_data['footer_copy_right_right_side']) ? $page_data['footer_copy_right_right_side'] : '' }}</textarea>
								<small class="form-hint">HTML is supported (links, styling, etc.)</small>
							</div>
						</div> --}}

						<div class="action-section">
							<button type="submit" class="btn-update" name="form_footer">
								<i class="fa fa-save"></i> Update Settings
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
@endsection
