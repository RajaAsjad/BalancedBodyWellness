<div id="body" class="photos-grid">
@foreach($photoGalleries as $photoGallery)
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
@endforeach
@if($photoGalleries->isEmpty())
<div class="empty-gallery" style="grid-column: 1 / -1;">
	<i class="fa fa-images"></i>
	<h4>No photos found</h4>
	<p>Try changing the filter.</p>
</div>
@endif
</div>

@if($photoGalleries->hasPages())
<div class="gallery-pagination">
	<div class="d-flex flex-column align-items-center">
		<div class="text-muted small mb-2">Displaying {{ $photoGalleries->firstItem() }} to {{ $photoGalleries->lastItem() }} of {{ $photoGalleries->total() }} records</div>
		{!! $photoGalleries->appends(request()->query())->links('pagination::bootstrap-4') !!}
	</div>
</div>
@endif

<script>
$(document).ready(function() {
	$('.delete').off('click').on('click', function() {
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
});
</script>
