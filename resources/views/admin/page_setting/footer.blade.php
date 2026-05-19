@extends('layouts.admin.app')
@section('content')
<section class="content-header">
	<div class="content-header-left">
		<h1>@if(!empty($model)) Edit @else Add @endif Page Setting of <strong>{{ $model->title }}</strong></h1>
	</div>
	<div class="content-header-right">
		<a href="{{ route('page.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('page_setting.store') }}" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				<input type="hidden" name="parent_slug" id="" value="{{ $model->slug }}">
				<div class="box box-info">
					<div class="box-body">
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Footer Image </label>
							<div class="col-sm-6">
								<input type="file" name="footer_image" class="form-control">
							</div>
                            @if(isset($page_data['footer_image']))
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <img src="{{ asset('/public/admin/assets/images/page/'.$page_data['footer_image']) }}" class="existing-photo">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Address</label>
							<div class="col-sm-9">
								<input type="text" name="footer_address" class="form-control" value="{{ isset($page_data['footer_address'])?$page_data['footer_address']:'' }}" placeholder="Enter Address">
							</div>
						</div>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Copy Rights: right side </label>
							<div class="col-sm-9">
								<input type="text" name="footer_copy_right_right_side" class="form-control" value="{{ isset($page_data['footer_copy_right_right_side'])?$page_data['footer_copy_right_right_side']:'' }}" placeholder="Enter copy rights right side">
							</div>
						</div>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Copy Rights: left side</label>
							<div class="col-sm-9">
								<input type="text" name="footer_copy_right_left_side" class="form-control" value="{{ isset($page_data['footer_copy_right_left_side'])?$page_data['footer_copy_right_left_side']:'' }}" placeholder="Enter copy rights left side">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form_blog">Submit</button>
							</div>
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
				height: 100,
				plugins: [
					"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
					"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
					"save table contextmenu directionality emoticons template paste textcolor"
				],
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

			});
		}
	});
</script>
@endpush
