@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<input type="hidden" id="page_url" value="{{ route('photogallery.index') }}">
<input type="hidden" id="ajax_container" value="gallery-body-content">
@push('css')
<style>
	.gallery-card {
		background: #ffffff;
		border-radius: 12px;
		box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
		border: 2px solid #e0e0e0;
		overflow: hidden;
	}
	.gallery-header {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
		color: #1a1a1a;
		padding: 18px 30px;
		border-radius: 12px 12px 0 0;
		border-bottom: 3px solid #242424;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
		text-align: center;
	}
	.gallery-header h1 { margin: 0; font-size: 22px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
	.gallery-stats {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
		gap: 20px;
		padding: 25px 30px 0;
		background: #f8f9fa;
		margin-bottom: 20px;
	}
	.gallery-stats .stat-box {
		background: #fff;
		padding: 18px;
		border-radius: 12px;
		box-shadow: 0 2px 8px rgba(0,0,0,0.06);
		border: 2px solid #e0e0e0;
		text-align: center;
		margin-bottom: 20px;
	}
	.gallery-stats .stat-box .num { font-size: 22px; font-weight: 700; color: #2c3e50; }
	.gallery-stats .stat-box .lbl { font-size: 13px; color: #6b7280; font-weight: 500; margin-top: 4px; }
	.gallery-stats .stat-box .btn-add-photos {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
		color: #1a1a1a !important;
		border: 1px solid #242424;
		border-radius: 8px;
		padding: 10px 20px;
		font-weight: 600;
		text-decoration: none !important;
		display: inline-block;
		transition: all 0.3s ease;
	}
	.gallery-stats .stat-box .btn-add-photos:hover {
		background: linear-gradient(135deg, #d4a020 0%, #EEB72D 100%) !important;
		color: #1a1a1a !important;
		box-shadow: 0 2px 8px rgba(238,183,45,0.4);
		transform: translateY(-1px);
	}
	.gallery-search {
		background: #f8f9fa;
		padding: 20px 30px;
		border-bottom: 2px solid #e0e0e0;
		margin: 0 30px 20px;
		border-radius: 8px;
	}
	.gallery-search .form-control {
		border: 2px solid #e0e0e0;
		border-radius: 8px; 
		font-size: 14px;
		transition: all 0.3s ease;
		background: #fff;
	}
	.gallery-search .form-control:focus {
		border-color: #EEB72D;
		box-shadow: 0 0 0 3px rgba(238,183,45,0.2);
		outline: none;
	}
	.gallery-search .btn-filter {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
		color: #1a1a1a !important;
		border: 1px solid #242424;
		padding: 10px 24px;
		border-radius: 8px;
		font-weight: 600;
		transition: all 0.3s ease;
	}
	.gallery-search .btn-filter:hover {
		background: linear-gradient(135deg, #d4a020 0%, #EEB72D 100%) !important;
		color: #1a1a1a !important;
		box-shadow: 0 2px 8px rgba(238,183,45,0.4);
	}
	.gallery-search .btn-clear {
		background: #6c757d;
		color: #fff !important;
		padding: 10px 24px;
		border-radius: 8px;
		font-weight: 600;
		text-decoration: none;
		display: inline-block;
		border: none;
		transition: all 0.3s ease;
	}
	.gallery-search .btn-clear:hover { background: #5a6268; color: #fff !important; }
	.gallery-body { padding: 15px 30px 25px; background: #f8f9fa; }
	.photos-grid {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
		gap: 20px;
	}
	.photo-card {
		background: #fff;
		border-radius: 12px;
		overflow: hidden;
		box-shadow: 0 2px 10px rgba(0,0,0,0.08);
		border: 2px solid #e0e0e0;
		transition: all 0.3s ease;
	}
	.photo-card:hover {
		box-shadow: 0 6px 20px rgba(238,183,45,0.2);
		transform: translateY(-2px);
	}
	.photo-card img {
		width: 100%;
		height: 180px;
		object-fit: cover;
		display: block;
	}
	.photo-card-img-wrap {
		position: relative;
		width: 100%;
		height: 180px;
		background: #e9ecef;
		overflow: hidden;
	}
	.photo-card-img-wrap .tiff-loader {
		position: absolute;
		inset: 0;
		display: flex;
		align-items: center;
		justify-content: center;
		background: #e9ecef;
	}
	.photo-card-img-wrap .tiff-loader::after {
		content: '';
		width: 36px;
		height: 36px;
		border: 3px solid #e0e0e0;
		border-top-color: #EEB72D;
		border-radius: 50%;
		animation: tiff-spin 0.8s linear infinite;
	}
	.photo-card-img-wrap .tiff-loader.hide { display: none !important; }
	@keyframes tiff-spin {
		to { transform: rotate(360deg); }
	}
	.photo-card img.tiff-thumb.tiff-loading {
		background: #e9ecef;
	}
	.photo-card-body {
		padding: 12px 14px;
		display: flex;
		align-items: center;
		justify-content: space-between;
		flex-wrap: wrap;
		gap: 8px;
	}
	.photo-card-body .badge {
		font-size: 11px;
		padding: 4px 10px;
		border-radius: 20px;
		font-weight: 600;
	}
	.photo-card-actions { display: flex; gap: 6px; flex-wrap: wrap; }
	.photo-card-actions .btn {
		padding: 6px 12px;
		font-size: 12px;
		border-radius: 6px;
		text-decoration: none;
		border: none;
		cursor: pointer;
		font-weight: 600;
	}
	.btn-edit-gal { background: #EEB72D; color: #1a1a1a; }
	.btn-edit-gal:hover { background: #d4a020; color: #1a1a1a; }
	.btn-del-gal { background: #dc3545; color: #fff; }
	.btn-del-gal:hover { background: #c82333; color: #fff; }
	.gallery-pagination {
		padding: 20px 30px;
		background: #f8f9fa;
		border-top: 2px solid #e0e0e0;
		margin-top: 20px;
	}
	.alert-gallery {
		background: linear-gradient(135deg, #fef3c7, #fde68a);
		border: 2px solid #EEB72D;
		color: #92400e;
		padding: 14px 20px;
		border-radius: 12px;
		margin: 0 30px 25px;
		font-weight: 500;
	}
	.empty-gallery {
		text-align: center;
		padding: 50px 20px;
		color: #6b7280;
	}
	.empty-gallery i { font-size: 48px; opacity: 0.4; margin-bottom: 15px; display: block; }
	@media (max-width: 768px) {
		.gallery-search .form-control { max-width: 100%; }
		.gallery-search .status { max-width: 100%; }
	}
</style>
@endpush

<section class="content-header" style="margin-bottom: 0;">
	<div class="gallery-card">
		<div class="gallery-header">
			<h1>{{ $page_title }}</h1>
		</div> 

		<div class="gallery-stats">
			<div class="stat-box">
				<div class="num">{{ $totalPhotos ?? 0 }}</div>
				<div class="lbl">Total Photos</div>
			</div>
			<div class="stat-box">
				<div class="num">{{ $activePhotos ?? 0 }}</div>
				<div class="lbl">Active</div>
			</div>
			<div class="stat-box">
				<div class="num">{{ $inactivePhotos ?? 0 }}</div>
				<div class="lbl">Inactive</div>
			</div>
			@can('photogallery-create')
			<div class="stat-box" style="display: flex; align-items: center; justify-content: center;">
				<a href="{{ route('photogallery.create') }}" class="btn-add-photos"><i class="fa fa-plus"></i> Add Photos</a>
			</div>
			@endcan
		</div>

		<div class="gallery-search">
			<form method="GET" action="{{ route('photogallery.index') }}" id="gallery-filter-form">
				<div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
					<select name="status" id="status" class="form-control status" style="max-width: 220px;">
						<option value="All" {{ request('status') == 'All' || !request('status') ? 'selected' : '' }}>All statuses</option>
						<option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
						<option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
					</select>
					<button type="submit" class="btn btn-filter"><i class="fa fa-filter"></i> Filter</button>
					@if(request('status'))
					<a href="{{ route('photogallery.index') }}" class="btn-clear"><i class="fa fa-times"></i> Clear</a>
					@endif
				</div>
			</form>
		</div>

		<div class="gallery-body">
			<div id="gallery-body-content">
				<div id="body" class="photos-grid">
				@forelse($photoGalleries as $photoGallery)
				@php
					$imgUrl = $photoGallery->image ? asset('admin/assets/website/photo_gallery/' . $photoGallery->image) : asset('admin/assets/images/default.jpg');
					$ext = strtolower(pathinfo($photoGallery->image ?? '', PATHINFO_EXTENSION));
					$isTiff = ($ext === 'tif' || $ext === 'tiff');
				@endphp
				<div class="photo-card" id="id-{{ $photoGallery->id }}">
					@if($isTiff && $photoGallery->image)
					<div class="photo-card-img-wrap">
						<span class="tiff-loader"></span>
						<img class="tiff-thumb tiff-loading" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-tiff-src="{{ $imgUrl }}" alt="Gallery">
					</div>
					@else
					<img src="{{ $imgUrl }}" alt="Gallery">
					@endif
					<div class="photo-card-body">
						@if($photoGallery->status == 1 || $photoGallery->status === '1')
							<span class="label label-success">Active</span>
						@else
							<span class="label label-danger">Inactive</span>
						@endif
						<div class="photo-card-actions">
							@can('photogallery-edit')
							<a href="{{ route('photogallery.edit', $photoGallery->id) }}" class="btn btn-edit-gal" title="Edit"><i class="fa fa-edit"></i> Edit</a>
							@endcan
							@can('photogallery-delete')
							<button type="button" class="btn btn-del-gal delete" data-slug="{{ $photoGallery->id }}" data-del-url="{{ url('photogallery', $photoGallery->id) }}" title="Delete"><i class="fa fa-trash"></i> Delete</button>
							@endcan
						</div>
					</div>
				</div>
				@empty
				<div class="empty-gallery" style="grid-column: 1 / -1;">
					<i class="fa fa-images"></i>
					<h4>No photos yet</h4>
					<p>Add photos using the button above.</p>
					@can('photogallery-create')
					<a href="{{ route('photogallery.create') }}" class="btn btn-primary mt-2"><i class="fa fa-plus"></i> Add Photos</a>
					@endcan
				</div>
				@endforelse
				</div>

				@if($photoGalleries->hasPages())
				<div class="gallery-pagination">
					<div class="d-flex flex-column align-items-center">
						<div class="text-muted small mb-2">Displaying {{ $photoGalleries->firstItem() }} to {{ $photoGalleries->lastItem() }} of {{ $photoGalleries->total() }} records</div>
						{!! $photoGalleries->appends(request()->query())->links('pagination::bootstrap-4') !!}
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</section>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/utif@3.1.0/UTIF.js" crossorigin="anonymous"></script>
<script>
window.initGalleryTiffPreviews = function() {
	if (typeof UTIF === 'undefined') return;
	document.querySelectorAll('.photo-card img.tiff-thumb[data-tiff-src]').forEach(function(img) {
		var url = img.getAttribute('data-tiff-src');
		if (!url) return;
		fetch(url).then(function(r) { return r.arrayBuffer(); }).then(function(buffer) {
			try {
				var ifds = UTIF.decode(buffer);
				if (!ifds || !ifds[0]) return;
				UTIF.decodeImage(buffer, ifds[0]);
				var rgba = UTIF.toRGBA8(ifds[0]);
				var w = ifds[0].width, h = ifds[0].height;
				var canvas = document.createElement('canvas');
				canvas.width = w; canvas.height = h;
				var ctx = canvas.getContext('2d');
				var imageData = ctx.createImageData(w, h);
				imageData.data.set(rgba);
				ctx.putImageData(imageData, 0, 0);
				img.src = canvas.toDataURL('image/png');
				img.removeAttribute('data-tiff-src');
				img.classList.remove('tiff-loading');
				var wrap = img.closest('.photo-card-img-wrap');
				if (wrap) { var l = wrap.querySelector('.tiff-loader'); if (l) l.classList.add('hide'); }
			} catch (e) {}
		}).catch(function() {
			img.classList.remove('tiff-loading');
			var wrap = img.closest('.photo-card-img-wrap');
			if (wrap) { var l = wrap.querySelector('.tiff-loader'); if (l) l.classList.add('hide'); }
		});
	});
};

$(document).ready(function() {
	initGalleryTiffPreviews();

	$('#status').on('change', function() {
		$('#gallery-filter-form').submit();
	});

	$('.delete').on('click', function() {
		var slug = $(this).attr('data-slug');
		var delete_url = $(this).attr('data-del-url');
		Swal.fire({
			title: 'Are you sure?',
			text: "This photo will be deleted.",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#EEB72D',
			cancelButtonColor: '#6c757d',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
				$.ajax({
					url: delete_url,
					type: 'DELETE',
					success: function(response) {
						if (response) {
							$('#id-' + slug).fadeOut(300, function() { $(this).remove(); });
							Swal.fire('Deleted!', 'Photo has been deleted.', 'success');
						} else {
							Swal.fire('Error', 'Something went wrong.', 'error');
						}
					},
					error: function() {
						Swal.fire('Error', 'Failed to delete.', 'error');
					}
				});
			}
		});
	});
	// Run again when all resources (including UTIF.js) are loaded, so TIFFs decode reliably on first load
	$(window).on('load', function() { initGalleryTiffPreviews(); });
});
</script>
@endpush
