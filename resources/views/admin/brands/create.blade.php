@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<section class="content-header">
    <div class="content-header-left">
        <h1>Add New Brand</h1>
    </div>
    <div class="content-header-right">
        <a href="{{ route('brands.index') }}" class="btn btn-primary btn-sm">View All</a>
    </div>
</section>

<section class="content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form action="{{ route('brands.store') }}" id="invoiceForm" class="form-horizontal" enctype="multipart/form-data" method="post">
                @csrf
                <div class="box box-info">
                    <div class="box-body">
                         <!-- Image -->
                         <div class="form-group">
							<label for="" class="col-sm-2 control-label">Brand Logo<span style='color:red'>*</span></label>
                            <div class="col-sm-6" style="padding-top:5px">
                                <input type="file" class="form-control" accept="image*"  name="image" id="image">
                                <span style="color: red">{{ $errors->first('image') }}</span>
                            </div>
                            <div class="col-sm-4" >
                                    <img style="width: 80px" id="banner_preview"  src="{{ asset('admin/assets/images/default.jpg') }}"  alt="Image Not Found ">
                            </div>
                        </div>
                        <!-- Project Name -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Brand Name<span style='color:red'>*</span></label>
                            <div class="col-sm-8">
                                <input type="text" autocomplete="off" class="form-control" name="name" value="" placeholder="Enter name of brand" required>
                                <span style="color: red">{{ $errors->first('name') }}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Brand URL<span style='color:red'>*</span></label>
                            <div class="col-sm-8">
                                <input type="text" autocomplete="off" class="form-control" name="url" value="" placeholder="Enter brand url" required>
                                <span style="color: red">{{ $errors->first('url') }}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Brand Email</label>
                            <div class="col-sm-8">
                                <input type="text" autocomplete="off" class="form-control" name="email" value="" placeholder="Enter brand email">
                                <span style="color: red">{{ $errors->first('email') }}</span>
                            </div>
                        </div>

                        <!-- Description -->
                        <!-- <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-8">
                                <textarea name="description" class="form-control" placeholder="Enter project description" style="height:140px;" required></textarea>
                                <span style="color: red">{{ $errors->first('description') }}</span>
                            </div>
                        </div> -->
                        <!-- Submit Button -->
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