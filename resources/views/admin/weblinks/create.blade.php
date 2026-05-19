@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<section class="content-header">
    <div class="content-header-left">
        <h1>Add Web Link </h1>
    </div>
    <div class="content-header-right">
        <a href="{{ route('weblinks.index') }}" class="btn btn-primary btn-sm">View All</a>
    </div>
</section>

<section class="content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form action="{{ route('weblinks.store') }}" id="invoiceForm" class="form-horizontal" enctype="multipart/form-data" method="post">
                @csrf
                <div class="box box-info">
                    <div class="box-body">
                        
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Select Brand<span style="color:red">*</span></label>
                            <div class="col-sm-8">
                                <select name="brand_name" id="brand_name" class="form-control" required>
                                    <option value="" selected>Select Brand</option>
                                    @foreach ($brands as $brand) <!-- Fixed the foreach loop -->
                                        <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <span style="color: red">{{ $errors->first('brand_name') }}</span>
                            </div>
                        </div>
                     
                        <!-- Project Name -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Project Name<span style='color:red'>*</span></label>
                            <div class="col-sm-8">
                                <input type="text" autocomplete="off" class="form-control" name="name" value="" placeholder="Enter name of project" required>
                                <span style="color: red">{{ $errors->first('name') }}</span>
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-8">
                                <textarea name="description" class="form-control" placeholder="Enter project description" style="height:140px;" required></textarea>
                                <span style="color: red">{{ $errors->first('description') }}</span>
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">UI Design<span style='color:red'>*</span></label>
                            <div class="col-sm-6" style="padding-top:5px">
                                <input type="file" class="form-control" accept="image*"  name="image" id="image">
                                <span style="color: red">{{ $errors->first('image') }}</span>
                            </div>
                            <div class="col-sm-4" >
                                    <img style="width: 80px" id="banner_preview"  src="{{ asset('admin/assets/images/default.jpg') }}"  alt="Image Not Found ">
                            </div>
                        </div>
                     
                        
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