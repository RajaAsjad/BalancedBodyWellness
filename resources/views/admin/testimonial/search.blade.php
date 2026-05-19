@foreach($testimonials as $key=>$testimonial)
<tr id="id-{{ $testimonial->slug }}">
    <td>{{ $testimonials->firstItem()+$key }}.</td>
    <td>
        @if($testimonial->image)
        <img src="{{ asset('admin/assets/images/testimonials/'.$testimonial->image) }}" alt="{{ $testimonial->name }}">
        @else
        <img src="{{ asset('admin/assets/images/testimonials/no-photo1.jpg') }}" alt="No Image">
        @endif
    </td>
    <td>{!! $testimonial->name !!}</td>
    <td>{!! \Illuminate\Support\Str::limit(strip_tags($testimonial->comment), 60) !!}</td>
    <td>
        @if($testimonial->status)
        <span class="label label-success">Active</span>
        @else
        <span class="label label-danger">In-Active</span>
        @endif
    </td>
    <td>
        <div class="testimonial-action-btns">
            @can('testimonial-edit')
            <a href="{{route('testimonial.edit', $testimonial->slug)}}" data-toggle="tooltip" data-placement="top" title="Edit testimonial" class="btn btn-edit btn-xs"><i class="fa fa-edit"></i> Edit</a>
            @endcan
            @can('testimonial-delete')
            <button type="button" class="btn btn-danger btn-xs btn-delete delete-testimonial" data-slug="{{ $testimonial->slug }}" data-del-url="{{ url('testimonial', $testimonial->slug) }}"><i class="fa fa-trash"></i> Delete</button>
            @endcan
        </div>
    </td>
</tr>
@endforeach
@if($testimonials->hasPages())
<tr>
    <td colspan="6">
        <div class="d-flex flex-column align-items-center">
            <div class="text-muted small mb-2">Displaying {{ $testimonials->firstItem() }} to {{ $testimonials->lastItem() }} of {{ $testimonials->total() }} records</div>
            {!! $testimonials->appends(request()->query())->links('pagination::bootstrap-4') !!}
        </div>
    </td>
</tr>
@endif

<script>
$(document).ready(function() {
    $('.delete-testimonial').on('click', function(){
        var slug = $(this).attr('data-slug');
        var delete_url = $(this).attr('data-del-url');
        Swal.fire({
            title: 'Are you sure?',
            text: "This testimonial will be deleted.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#EEB72D',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: delete_url,
                    type: 'DELETE',
                    success: function(response){
                        if(response){
                            $('#id-'+slug).fadeOut(300, function() { $(this).remove(); });
                            Swal.fire(
                                'Deleted!',
                                'Testimonial has been deleted.',
                                'success'
                            )
                        }else{
                            Swal.fire(
                                'Error',
                                'Something went wrong.',
                                'error'
                            )
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Failed to delete.', 'error');
                    }
                });
            }
        })
    });
});
</script>