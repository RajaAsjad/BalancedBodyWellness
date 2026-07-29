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
			<form action="{{ route('blogcategory.update', $model->id) }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				{{ method_field('PATCH') }}
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Blog Category <span style="color:red">*</span></label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" id="name" name="name" placeholder="Enter category name" value="{{$model->name}}">
								<span style="color: red" class="error-message">{{ $errors->first('name') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Status</label>
							<div class="col-sm-9">
								<select name="status" class="form-control" id="">
									<option value="1" {{ $model->status==1?'selected':'' }}>Active</option>
									<option value="0" {{ $model->status==0?'selected':'' }}>In-Active</option>
								</select>
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
@endpush
