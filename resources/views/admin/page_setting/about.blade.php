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
                        <h3 class="sec_title">First About us Section</h3>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Heading</label>
							<div class="col-sm-9">
								<input type="text" name="aboutus_heading" class="form-control" value="{{ isset($page_data['aboutus_heading'])?$page_data['aboutus_heading']:'' }}" placeholder="Enter heading">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Description</label>
							<div class="col-sm-9">
								<textarea name="aboutus_description" class="form-control texteditor" cols="30" rows="10" placeholder="Enter description">{!! isset($page_data['aboutus_description'])?$page_data['aboutus_description']:'' !!}</textarea>
							</div>
						</div>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Title</label>
							<div class="col-sm-9">
								<input type="text" name="aboutus_title" class="form-control" value="{!! isset($page_data['aboutus_title'])?$page_data['aboutus_title']:'' !!}" placeholder="Enter title">
							</div>
						</div>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Image</label>
							<div class="col-sm-6">
								<input type="file" name="about_first_image" class="form-control">
							</div>
                            @if(isset($page_data['about_first_image']))
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <img src="{{ asset('/public/admin/assets/images/page/'.$page_data['about_first_image']) }}" class="existing-photo" style="height:150px;">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <h3 class="sec_title">Second About us Section</h3>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Heading</label>
							<div class="col-sm-9">
								<input type="text" name="heading_two" class="form-control" value="{{ isset($page_data['heading_two'])?$page_data['heading_two']:'' }}" placeholder="Enter heading">
							</div>
						</div>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Description</label>
							<div class="col-sm-9">
								<textarea name="about_description_two" class="form-control texteditor" cols="10" rows="5" placeholder="Enter description">{!! isset($page_data['about_description_two'])?$page_data['about_description_two']:'' !!}</textarea>
							</div>
						</div>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Image</label>
							<div class="col-sm-6">
								<input type="file" name="about_second_image" class="form-control">
							</div>
                            @if(isset($page_data['about_second_image']))
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <img src="{{ asset('/public/admin/assets/images/page/'.$page_data['about_second_image']) }}" class="existing-photo" style="height:150px;">
                                    </div>
                                </div>
                            @endif
                        </div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form_about">Update</button>
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
				height: 150,
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
