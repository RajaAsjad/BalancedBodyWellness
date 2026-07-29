@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<section class="content-header">
	<div class="content-header-left">
		<h1>{{ $page_title }}</h1>
	</div>
	<div class="content-header-right">
		<a href="{{ route('blogcategory.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('blogcategory.store') }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				<div class="box box-info">
					<div class="box-body"> 
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Blog Category<span style='color:red'>*</span></label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter category name">
								<span style="color: red" class="error-message">{{ $errors->first('name') }}</span>
							</div>
						</div> 
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
@endsection
@push('css')
<style>
	.form-control.error {
		border: 1px solid #dc3545 !important;
		box-shadow: none !important;
		padding-left: 10px !important;
	}
	.form-control.error:focus {
		border: 1px solid #dc3545 !important;
		box-shadow: 0 0 0 0.1rem rgba(220, 53, 69, 0.15) !important;
		outline: none !important;
	}
	.error-message {
		color: #dc3545;
		font-size: 12px;
		margin-top: 5px;
		display: block;
	}
</style>
@endpush
@push('js')
<script>
	$(document).ready(function() {
		$("#regform").validate({
			rules: {
				name: {
					required: true
				}
			},
			messages: {
				name: {
					required: "This field is required."
				}
			},
			errorPlacement: function(error, element) {
				error.addClass('error-message');
				error.insertAfter(element);
			},
			highlight: function(element) {
				$(element).addClass('error');
			},
			unhighlight: function(element) {
				$(element).removeClass('error');
			}
		});
	});
</script>
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
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

			});
		}
        image.onchange = evt => {
			const [file] = image.files
			if (file) {
				banner_preview.src = URL.createObjectURL(file)
			}
		}

	});
</script>
@endpush
