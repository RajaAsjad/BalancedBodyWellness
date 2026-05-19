@foreach($homesliders as $key=>$homeSlider)
<tr id="id-{{ $homeSlider->id }}">
	<td>{{ $homesliders->firstItem()+$key }}.</td>
	<td>
		@if($homeSlider->image)
		<img src="{{ asset('admin/assets/images/HomeSlider/'.$homeSlider->image) }}" alt="{{ $homeSlider->heading }}">
		@else
		<img src="{{ asset('admin/assets/images/HomeSlider/no-photo1.jpg') }}" alt="No Image">
		@endif
	</td>
	<td>{!! $homeSlider->heading !!}</td>
	<td>{!! \Illuminate\Support\Str::limit(strip_tags($homeSlider->description), 60) !!}</td>
	<td>
		@if($homeSlider->status)
		<span class="label label-success">Active</span>
		@else
		<span class="label label-danger">In-Active</span>
		@endif
	</td>
	<td>
		<div class="slider-action-btns">
			@can('homeslider-edit')
			<a href="{{route('homeslider.edit', $homeSlider->id)}}" data-toggle="tooltip" data-placement="top" title="Edit slider" class="btn btn-edit btn-xs"><i class="fa fa-edit"></i> Edit</a>
			@endcan
			@can('homeslider-delete')
			<button type="button" class="btn btn-danger btn-xs btn-delete delete-slider" data-slug="{{ $homeSlider->id }}" data-del-url="{{ url('homeslider', $homeSlider->id) }}"><i class="fa fa-trash"></i> Delete</button>
			@endcan
		</div>
	</td>
</tr>
@endforeach
@if($homesliders->hasPages())
<tr>
	<td colspan="6">
		<div class="d-flex flex-column align-items-center">
			<div class="text-muted small mb-2">Displaying {{ $homesliders->firstItem() }} to {{ $homesliders->lastItem() }} of {{ $homesliders->total() }} records</div>
			{!! $homesliders->appends(request()->query())->links('pagination::bootstrap-4') !!}
		</div>
	</td>
</tr>
@endif
<script>
$(document).ready(function() {
	$(document).on('click', '.delete-slider', function() {
		var slug = $(this).attr('data-slug');
		var delete_url = $(this).attr('data-del-url');
		Swal.fire({
			title: 'Are you sure?',
			text: "This slider will be deleted.",
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
							Swal.fire('Deleted!', 'Slider has been deleted.', 'success');
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