@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
<style>
	.page-admin { --pg-pink: #ec4899; --pg-pink-deep: #be185d; --pg-orange: #fb923c; --pg-cream: #f5f3f0; --pg-text: #1c1917; }

	.header-settings-container {
		background: #fff;
		border-radius: 12px;
		box-shadow: 0 4px 24px rgba(236, 72, 153, 0.1);
		border: 1px solid rgba(236, 72, 153, 0.12);
		overflow: hidden;
		margin: 20px 0;
	}

	.header-settings-body {
		padding: 0 30px 40px;
		background: var(--pg-cream);
	}

	.section-banner {
		background: linear-gradient(135deg, var(--pg-pink) 0%, #f472b6 45%, var(--pg-orange) 100%) !important;
		padding: 15px 20px;
		margin: 0 -40px 25px -40px;
		border-bottom: 2px solid rgba(190, 24, 93, 0.35);
		box-shadow: 0 4px 20px rgba(236, 72, 153, 0.18);
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
		box-shadow: 0 4px 14px rgba(28, 25, 23, 0.2);
	}

	.section-banner .btn i {
		font-size: 12px;
	}

	.header-settings-alert {
		background: #ecfdf5;
		border: 1px solid #6ee7b7;
		border-radius: 8px;
		padding: 12px 16px;
		color: #14532d;
		font-weight: 500;
		margin-bottom: 20px;
	}

	.section-block {
		margin-bottom: 40px;
		padding-bottom: 30px;
		border-bottom: 1px solid rgba(236, 72, 153, 0.12);
	}

	.section-block:last-of-type {
		border-bottom: none;
		margin-bottom: 30px;
		padding-bottom: 0;
	}

	.section-heading {
		background: linear-gradient(90deg, #fce7f3 0%, #ffedd5 100%);
		padding: 12px 20px;
		margin: 0 0 25px 0;
		border-radius: 8px;
		border: 1px solid rgba(236, 72, 153, 0.2);
		box-shadow: 0 2px 8px rgba(236, 72, 153, 0.08);
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
		padding: 5px;
		font-size: 14px;
		line-height: 1.6;
		transition: all 0.3s ease;
		background: #fff;
		box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
		width: 100%;
	}

	.header-settings-container .form-control:focus {
		border-color: rgba(236, 72, 153, 0.55);
		box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.12);
		outline: none;
	}

	.header-settings-container .form-control:hover {
		border-color: #d6d3d1;
	}

	.header-settings-container .form-hint {
		color: #6b7280;
		display: block;
		margin-top: 5px;
		font-size: 13px;
	}

	.existing-photo {
		border-radius: 8px;
		border: 1px solid rgba(236, 72, 153, 0.15);
		object-fit: cover;
		margin-top: 12px;
		box-shadow: 0 2px 10px rgba(236, 72, 153, 0.1);
	}

	.image-preview-container {
		margin-top: 15px;
		padding: 15px;
		background: #fff;
		border-radius: 8px;
		border: 2px dashed rgba(236, 72, 153, 0.25);
		display: inline-block;
	}

	.action-section {
		text-align: center;
		padding-top: 30px;
		margin-top: 30px;
		border-top: 1px solid rgba(236, 72, 153, 0.12);
	}

	.btn-update {
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

	.btn-update:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 22px rgba(236, 72, 153, 0.4);
		background: linear-gradient(135deg, #db2777 0%, #ea580c 100%);
		color: #fff;
	}

	.btn-update:active {
		transform: translateY(0);
	}

	.social-links-grid {
		display: grid;
		grid-template-columns: 1fr;
		gap: 0;
	}

	.social-links-grid .form-group {
		margin-bottom: 20px;
	}

	.social-links-grid .form-group:last-child {
		margin-bottom: 0;
	}

	@media (max-width: 768px) {
		.header-settings-body { padding: 20px; }
		.section-banner { margin: 0 -20px 20px -20px; padding: 12px 15px; }
		.section-banner h3 { font-size: 16px; }
		.social-links-grid { grid-template-columns: 1fr; }
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
							<h3>Header Settings</h3>
							<a href="{{ route('page.index') }}" class="btn btn-sm">
								<i class="fa fa-arrow-left"></i> Back
							</a>
						</div> 
						 
						<div class="section-block">
							<div class="section-heading">
								<h4><i class="fa fa-image"></i> Branding Assets</h4>
							</div>

							<div class="form-group">
								<label for="header_favicon">Favicon</label>
								<input type="file" id="header_favicon" name="header_favicon" class="form-control" accept="image/*">
								<small class="form-hint">Recommended size: 32×32 or 16×16 pixels (PNG, ICO, or SVG)</small>
								@if (isset($page_data['header_favicon']))
								<div class="image-preview-container">
									<img src="{{ asset('admin/assets/images/page/' . $page_data['header_favicon']) }}" class="existing-photo" style="height:50px;" alt="Current Favicon">
								</div>
								@endif
							</div>

							<div class="form-group">
								<label for="header_logo">Logo</label>
								<input type="file" id="header_logo" name="header_logo" class="form-control" accept="image/*">
								<small class="form-hint">Recommended: PNG with transparent background</small>
								@if (isset($page_data['header_logo']))
								<div class="image-preview-container">
									<img src="{{ asset('admin/assets/images/page/' . $page_data['header_logo']) }}" class="existing-photo" style="height:100px;" alt="Current Logo">
								</div>
								@endif
							</div>
						</div>

						<div class="section-block">
							<div class="section-heading">
								<h4><i class="fa fa-share-alt"></i> Social Media Links</h4>
							</div>

						<div class="social-links-grid">
							<div class="form-group">
								<label for="footer_facebook"><i class="fa fa-instagram"></i> Instagram</label>
								<input type="url" id="footer_instagram" name="footer_instagram" class="form-control" value="{{ isset($page_data['footer_instagram']) ? $page_data['footer_instagram'] : '' }}" placeholder="https://instagram.com/yourpage">
							</div>

							<div class="form-group">
								<label for="footer_fieldlevel"><i class="fa fa-futbol-o"></i> Field Level</label>
								<input type="url" id="footer_fieldlevel" name="footer_fieldlevel" class="form-control" value="{{ isset($page_data['footer_fieldlevel']) ? $page_data['footer_fieldlevel'] : '' }}" placeholder="https://fieldlevel.com/yourprofile">
							</div>

							<div class="form-group">
								<label for="footer_twitter"><i class="fa fa-twitter"></i> X (Twitter) Link</label>
								<input type="url" id="footer_twitter" name="footer_twitter" class="form-control" value="{{ isset($page_data['footer_twitter']) ? $page_data['footer_twitter'] : '' }}" placeholder="https://twitter.com/yourhandle">
							</div>
						</div>
						</div>

						<div class="action-section">
							<button type="submit" class="btn-update" name="form_header">
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

@push('js')
<script>
$(document).ready(function() {
	// File input preview (optional enhancement)
	$('input[type="file"]').on('change', function() {
		var fileName = $(this).val().split('\\').pop();
		if (fileName) {
			console.log('Selected file: ' + fileName);
		}
	});
});
</script>
@endpush
