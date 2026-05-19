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

	.video-form-body {
		padding: 0px 30px 40px;
		background: #f8f9fa;
	}

	.video-form-container .section-banner {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
		padding: 15px 20px;
		margin: 0 -40px 25px -40px;
		text-align: center;
		border-bottom: 3px solid #242424;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
	}

	.video-form-container .section-banner h3 {
		margin: 0;
		font-size: 18px;
		font-weight: 600;
		color: #EEB72D;
		letter-spacing: 0.5px;
		text-transform: uppercase;
	}

	.video-form-container .form-group {
		margin-bottom: 25px;
	}

	.video-form-container .form-group label {
		font-weight: 600;
		color: #2c3e50;
		margin-bottom: 10px;
		font-size: 14px;
		display: block;
	}

	.video-form-container .form-control {
		border: 2px solid #e0e0e0;
		border-radius: 8px; 
		font-size: 14px;
		line-height: 1.6;
		transition: all 0.3s ease;
		background: #ffffff;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
		width: 100%;
	}

	.video-form-container .form-control:focus {
		border-color: #EEB72D;
		box-shadow: 0 0 0 3px rgba(238, 183, 45, 0.2);
		outline: none;
	}

	.video-form-container .form-control:hover {
		border-color: #bdbdbd;
	}

	.video-form-container .form-control.error {
		border-color: #dc3545;
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
		border-top: 2px solid #e0e0e0;
	}

	.video-form-container .btn-submit {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
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

	.video-form-container .btn-submit:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 20px rgba(238, 183, 45, 0.45);
		background: linear-gradient(135deg, #d4a020 0%, #EEB72D 100%);
		color: #1a1a1a;
	}

	.video-form-container .btn-submit:active {
		transform: translateY(0);
	}

	.video-form-container label .required {
		color: #dc3545;
	}

	.video-form-container .current-file {
		font-size: 13px;
		color: #6c757d;
		margin-top: 8px;
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
	@can('audio-list')
	<div class="content-header-right">
		<a href="{{ route('audio.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
	@endcan
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('audio.update', $model->id) }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				{{ method_field('PATCH') }}
				<div class="video-form-container">
					<div class="video-form-body">
						<div class="section-banner">
							<h3>Edit Audio</h3>
						</div>

						<div class="form-group">
							<label for="title">Title <span class="required">*</span></label>
							<input type="text" id="title" autocomplete="off" class="form-control" name="title" value="{{ old('title', $model->title) }}" placeholder="Enter audio title">
							@error('title')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group">
							<label for="file">Replace audio file <span class="text-muted">(optional)</span></label>
							<input type="file" id="file" class="form-control" name="file" accept="audio/*">
							@if($model->file)
								<p class="current-file mb-0">Current file: <strong>{{ $model->file }}</strong></p>
							@endif
							@error('file')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group">
							<label for="status">Status</label>
							<select name="status" id="status" class="form-control">
								<option value="1" {{ ($model->status == 1 || $model->status === '1') ? 'selected' : '' }}>Active</option>
								<option value="0" {{ ($model->status == 0 || $model->status === '0') ? 'selected' : '' }}>Inactive</option>
							</select>
						</div>

						<div class="action-section">
							<button type="submit" class="btn-submit" name="submit">
								<i class="fa fa-save"></i> Update Audio
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
		$("#regform").validate({
			rules: {
				title: "required",
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
