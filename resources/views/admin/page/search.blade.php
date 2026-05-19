@foreach($models as $key=>$model)
<tr id="id-{{ $model->slug }}">
	<td>{{ $models->firstItem()+$key }}.</td>
	<td>{!! $model->title ?? 'N/A' !!}</td>
	<td>{!! \Illuminate\Support\Str::limit(strip_tags($model->description ?? 'N/A'), 60) !!}</td>
	<td>
		@if($model->status == 1 || $model->status === true)
		<span class="badge badge-success">Active</span>
		@else
		<span class="badge badge-danger">Inactive</span>
		@endif
	</td>
	<td>
		<div class="page-action-btns">
			@can('page-edit')
			<a href="{{route('page.edit', $model->slug)}}" data-toggle="tooltip" data-placement="top" title="Edit page" class="btn btn-edit btn-xs"><i class="fa fa-edit"></i> Edit</a>
			@endcan
			@can('page-delete')
			<button type="button" class="btn btn-danger btn-xs btn-delete delete-page" data-slug="{{ $model->slug }}" data-del-url="{{ url('page', $model->slug) }}"><i class="fa fa-trash"></i> Delete</button>
			@endcan
			<a href="{{route('page_setting.show', $model->slug)}}" data-toggle="tooltip" data-placement="top" title="Page Setting" class="btn btn-setting btn-xs"><i class="fa fa-cog"></i> Setting</a>
		</div>
	</td>
</tr>
@endforeach
@if($models->hasPages())
<tr>
	<td colspan="5">
		<div class="d-flex flex-column align-items-center">
			<div class="text-muted small mb-2">Displaying {{ $models->firstItem() }} to {{ $models->lastItem() }} of {{ $models->total() }} records</div>
			{!! $models->appends(request()->query())->links('pagination::bootstrap-4') !!}
		</div>
	</td>
</tr>
@endif
<script>
$(document).ready(function() {
	$(document).on('click', '.delete-page', function() {
		var slug = $(this).attr('data-slug');
		var delete_url = $(this).attr('data-del-url');
		Swal.fire({
			title: 'Are you sure?',
			text: "This page will be deleted.",
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
							Swal.fire('Deleted!', 'Page has been deleted.', 'success');
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
