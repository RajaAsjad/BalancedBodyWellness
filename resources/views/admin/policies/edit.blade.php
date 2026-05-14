@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')

<section class="content-header">
	<div class="content-header-left">
		<h1>{{ $page_title }}</h1>
	</div>
	<div class="content-header-right">
		<a href="{{ route('policy.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{route('policy.update', $model->id)}}" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				{{ method_field('PATCH') }}
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
                            <label for="" class="col-sm-2 control-label">Title<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control" name="title" style="height:140px;">{!! $model->title !!}</textarea>
							</div>
						</div>
						<div class="form-group">
                            <label for="" class="col-sm-2 control-label">Description<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control" name="description" style="height:140px;">{!! $model->description !!}</textarea>
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
@push('js')
<script>
	$(document).ready(function() {
		$("#regform").validate({
			rules: {
				title: "required"
                description: "required"
			}
		});
	});
</script>
@endpush
