@foreach($banners as $key=>$banner)
<tr id="id-{{ $banner->id }}">
	<td>{{ $banners->firstItem()+$key }}.</td>
	<td>
		@if($banner->image)
		<img src="{{ asset('admin/assets/images/banner/'.$banner->image) }}" alt="{{ $banner->heading }}">
		@else
		<img src="{{ asset('admin/assets/images/default.jpg') }}" alt="No Image">
		@endif
	</td>
	<td>{{ $banner->slug ? ucfirst(str_replace('-', ' ', $banner->slug)) : '—' }}</td>
	<td>{{ $banner->title ?? '—' }}</td>
	<td>{{ $banner->heading }}</td>
	<td>
		@if($banner->status)
		<span class="label label-success">Active</span>
		@else
		<span class="label label-danger">In-Active</span>
		@endif
	</td>
	<td>
		<div class="banner-action-btns">
			@can('banner-edit')
			<a href="{{route('banner.edit', $banner->id)}}" data-toggle="tooltip" data-placement="top" title="Edit banner" class="btn btn-edit btn-xs"><i class="fa fa-edit"></i> Edit</a>
			@endcan
			@can('banner-delete')
			<button type="button" class="btn btn-danger btn-xs btn-delete delete-banner" data-slug="{{ $banner->id }}" data-del-url="{{ url('banner', $banner->id) }}"><i class="fa fa-trash"></i> Delete</button>
			@endcan
		</div>
	</td>
</tr>
@endforeach
@if($banners->hasPages())
<tr>
	<td colspan="7">
		<div class="d-flex flex-column align-items-center">
			<div class="text-muted small mb-2">Displaying {{ $banners->firstItem() }} to {{ $banners->lastItem() }} of {{ $banners->total() }} records</div>
			{!! $banners->appends(request()->query())->links('pagination::bootstrap-4') !!}
		</div>
	</td>
</tr>
@endif
<script>
$(document).ready(function() {
	$(document).on('click', '.delete-banner', function() {
		var slug = $(this).attr('data-slug');
		var delete_url = $(this).attr('data-del-url');
		Swal.fire({
			title: 'Are you sure?',
			text: "This banner will be deleted.",
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
							Swal.fire('Deleted!', 'Banner has been deleted.', 'success');
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