@extends('layouts.admin.app')
@section('content')
@section('title', $page_title)
@push('css')
<style>
	.home-about-container {
		background: #ffffff;
		border-radius: 12px;
		box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
		overflow: hidden;
		margin: 20px 0;
	}

	.home-about-body {
		padding: 0px 30px 40px;
		background: #f8f9fa;
	}

	.section-banner {
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

	.section-banner h3 {
		margin: 0;
		font-size: 18px;
		font-weight: 600;
		color: #242424;
		letter-spacing: 0.5px;
		text-transform: uppercase;
	}

	.section-banner .btn {
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

	.section-banner .btn:hover {
		background: #242424;
		color: #fff;
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
	}

	.section-banner .btn i {
		font-size: 12px;
	}

	.section-block {
		margin-bottom: 40px;
		padding-bottom: 30px;
		border-bottom: 2px solid #e0e0e0;
	}

	.section-block:last-of-type {
		border-bottom: none;
		margin-bottom: 30px;
	}

	.home-about-container .form-group {
		margin-bottom: 25px;
	}

	.home-about-container .form-group label {
		font-weight: 600;
		color: #2c3e50;
		margin-bottom: 10px;
		font-size: 14px;
		display: block;
	}

	.home-about-container .form-control {
		border: 2px solid #e0e0e0;
		border-radius: 8px; 
		font-size: 14px;
		line-height: 1.6;
		transition: all 0.3s ease;
		background: #ffffff;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
		width: 100%;
	}

	.home-about-container textarea.form-control {
		resize: vertical;
		min-height: 120px;
	}

	.home-about-container .form-control:focus {
		border-color: #EEB72D;
		box-shadow: 0 0 0 3px rgba(238, 183, 45, 0.2);
		outline: none;
	}

	.home-about-container .form-control:hover {
		border-color: #bdbdbd;
	}

	.settings-section {
		background: #ffffff;
		padding: 25px;
		border-radius: 8px;
		margin-top: 20px;
		border: 1px solid #e0e0e0;
	}

	.toggle-switch-container {
		display: flex;
		align-items: center;
		gap: 15px;
		flex-wrap: wrap;
	}

	.toggle-switch {
		position: relative;
		display: inline-block;
		width: 60px;
		height: 32px;
	}

	.toggle-switch input {
		opacity: 0;
		width: 0;
		height: 0;
	}

	.toggle-slider {
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #ccc;
		transition: 0.4s;
		border-radius: 34px;
		box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
	}

	.toggle-slider:before {
		position: absolute;
		content: "";
		height: 24px;
		width: 24px;
		left: 4px;
		bottom: 4px;
		background-color: white;
		transition: 0.4s;
		border-radius: 50%;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
	}

	.toggle-switch input:checked + .toggle-slider {
		background: linear-gradient(135deg, #EEB72D 0%, #d4a020 100%);
		box-shadow: 0 0 0 3px rgba(238, 183, 45, 0.25);
	}

	.toggle-switch input:checked + .toggle-slider:before {
		transform: translateX(28px);
	}

	.toggle-switch input:focus + .toggle-slider {
		box-shadow: 0 0 0 3px rgba(238, 183, 45, 0.3);
	}

	.toggle-switch:hover .toggle-slider {
		box-shadow: 0 0 0 3px rgba(238, 183, 45, 0.15);
	}

	.toggle-status {
		display: inline-block;
		padding: 4px 12px;
		border-radius: 12px;
		font-size: 12px;
		font-weight: 600;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		transition: all 0.3s ease;
	}

	.toggle-status.active {
		background: #d4edda;
		color: #155724;
	}

	.toggle-status.inactive {
		background: #f8d7da;
		color: #721c24;
	}

	.action-section {
		text-align: center;
		padding-top: 30px;
		margin-top: 30px;
		border-top: 2px solid #e0e0e0;
	}

	.btn-update {
		background: linear-gradient(135deg, #EEB72D 0%, #d4a020 100%);
		border: none;
		border-radius: 8px;
		padding: 12px 40px;
		font-size: 16px;
		font-weight: 600;
		color: #1a1a1a;
		box-shadow: 0 4px 15px rgba(238, 183, 45, 0.35);
		transition: all 0.3s ease;
		cursor: pointer;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}

	.btn-update:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 20px rgba(238, 183, 45, 0.45);
		background: linear-gradient(135deg, #d4a020 0%, #EEB72D 100%);
		color: #1a1a1a;
	}

	.btn-update:active {
		transform: translateY(0);
	}

	.bullet-point-row {
		display: flex;
		gap: 8px;
		margin-bottom: 8px;
		align-items: center;
	}
	.bullet-point-row .form-control { flex: 1; }
	.bullet-point-row .btn-remove-bullet { flex-shrink: 0; }
	#btn-add-bullet {
		margin-top: 10px;
		background: #2a0a1e;
		color: #EEB72D;
		border: 2px solid #EEB72D;
		border-radius: 8px;
		padding: 8px 16px;
		font-weight: 600;
		transition: all 0.3s ease;
	}
	#btn-add-bullet:hover {
		background: #EEB72D;
		color: #2a0a1e;
	}
	.existing-photo {
		border-radius: 8px;
		border: 2px solid #e0e0e0;
		object-fit: cover;
	}

	@media (max-width: 768px) {
		.home-about-body { padding: 20px; }
		.section-banner { margin: 0 -20px 20px -20px; padding: 12px 15px; }
		.section-banner h3 { font-size: 16px; }
	}
</style>
@endpush


<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('page_setting.store') }}" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				<input type="hidden" name="parent_slug" value="{{ $model->slug }}">
				<div class="home-about-container">
					<div class="home-about-body">
						<div class="section-banner" style="margin-top: 0;">
							<h3>Home About Settings</h3>
							<a href="{{ route('page.index') }}" class="btn btn-sm">
								<i class="fa fa-arrow-left"></i> Back
							</a>
						</div>

						@if (session('message'))
						<div style="background: #d4edda; border: 2px solid #28a745; border-radius: 8px; padding: 12px 16px; color: #155724; font-weight: 500; margin-bottom: 20px;">
							{{ session('message') }}
						</div>
						@endif

						<div class="section-block">
							 
							<div class="form-group">
								<label for="home_about_title">About Title</label>
								<input type="text" id="home_about_title" name="home_about_title" class="form-control" value="{{ isset($page_data['home_about_title']) ? $page_data['home_about_title'] : '' }}" placeholder="Enter title">
							</div>
							<div class="form-group">
								<label for="home_about_description">Description</label>
								<textarea id="home_about_description" name="home_about_description" class="form-control texteditor" cols="30" rows="10" placeholder="Enter description">{!! isset($page_data['home_about_description']) ? $page_data['home_about_description'] : '' !!}</textarea>
							</div> 
						</div>

						<div class="section-block"> 
							<div class="form-group">
								<label>Bullet points</label>
								<div id="bullet-points-wrap">
									@php
										$bullets = isset($page_data['home_about_bullets']) && is_array($page_data['home_about_bullets']) ? $page_data['home_about_bullets'] : [];
										if (empty($bullets)) { $bullets = ['']; }
									@endphp
									@foreach($bullets as $idx => $bullet)
									<div class="bullet-point-row">
										<input type="text" name="home_about_bullets[]" class="form-control" value="{{ is_string($bullet) ? e($bullet) : '' }}" placeholder="e.g. 45 years of professional performance">
										<button type="button" class="btn btn-danger btn-remove-bullet" title="Remove"><i class="fa fa-minus"></i></button>
									</div>
									@endforeach
								</div>
								<button type="button" id="btn-add-bullet" class="btn btn-sm"><i class="fa fa-plus"></i> Add bullet point</button>
							</div>
						</div>

						<div class="section-block">
							 
							<div class="form-group">
								<label for="home_about_image">About section image</label>
								<input type="file" id="home_about_image" name="home_about_image" class="form-control" accept="image/*">
								@if(isset($page_data['home_about_image']) && $page_data['home_about_image'])
									<div style="margin-top: 12px;">
										<img src="{{ asset('admin/assets/images/page/' . $page_data['home_about_image']) }}" class="existing-photo" alt="Current" style="height: 100px;">
									</div>
								@endif
							</div>
						</div>

						<div class="settings-section">
							<div class="form-group">
								<label for="home_about_status_toggle">Show on Home Page?</label>
								<div class="toggle-switch-container">
									<label class="toggle-switch">
										@php
											$activeStatus = isset($page_data['home_about_active_status']) ? $page_data['home_about_active_status'] : '1';
											$isActive = $activeStatus == '1' || $activeStatus === 1;
										@endphp
										<input type="checkbox" id="home_about_status_toggle" {{ $isActive ? 'checked' : '' }}>
										<span class="toggle-slider"></span>
									</label>
									<span class="toggle-label-text">Toggle to show or hide Home About section</span>
									<span class="toggle-status {{ $isActive ? 'active' : 'inactive' }}" id="home-about-toggle-status">{{ $isActive ? 'Show' : 'Hide' }}</span>
									<input type="hidden" name="home_about_active_status" id="home_about_active_status" value="{{ $isActive ? '1' : '0' }}">
								</div>
							</div>
						</div>

						<div class="action-section">
							<button type="submit" class="btn-update" name="form_about">
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
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons"
			});
		}

		$('#home_about_status_toggle').on('change', function() {
			var isChecked = $(this).is(':checked');
			$('#home_about_active_status').val(isChecked ? '1' : '0');
			var $statusBadge = $('#home-about-toggle-status');
			if (isChecked) {
				$statusBadge.removeClass('inactive').addClass('active').text('Show');
			} else {
				$statusBadge.removeClass('active').addClass('inactive').text('Hide');
			}
		});

		$('#btn-add-bullet').on('click', function() {
			var row = '<div class="bullet-point-row">' +
				'<input type="text" name="home_about_bullets[]" class="form-control" value="" placeholder="e.g. 45 years of professional performance">' +
				'<button type="button" class="btn btn-danger btn-remove-bullet" title="Remove"><i class="fa fa-minus"></i></button></div>';
			$('#bullet-points-wrap').append(row);
		});

		$(document).on('click', '.btn-remove-bullet', function() {
			var rows = $('#bullet-points-wrap .bullet-point-row');
			if (rows.length > 1) {
				$(this).closest('.bullet-point-row').remove();
			}
		});
	});
</script>
@endpush
