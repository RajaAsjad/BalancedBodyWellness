@foreach ($models as $key => $model)
<tr id="id-{{ $model->slug }}">
    <td>{{ $models->firstItem() + $key }}.</td>
    <td>
        @if($model->image)
        <img src="{{ asset('admin/assets/images/brands/'.$model->image) }}" alt="" style="width:60px;">
        @else
        <img src="{{ asset('admin/assets/images/default.jpg') }}" style="width:60px;">
        @endif
    </td>
    <td>{!! \Illuminate\Support\Str::limit($model->name ?? 'N/A', 50) !!}</td>
    <td>
        @if($model->url)
            <a href="{{ $model->url }}" target="_blank" class="url-link">
                {!! \Illuminate\Support\Str::limit($model->url, 50) !!}
            </a>
        @else
            N/A
        @endif
    </td>
    <td>{{\Illuminate\Support\Str::limit($model->email,40)}}</td>

    <td>
        @if ($model->status)
        <span class="label label-success">Active</span>
        @else
        <span class="label label-danger">In-Active</span>
        @endif
    </td>


    <td>
        <!-- <a href="{{ route('brands.show', $model->slug) }}" class="btn btn-info btn-xs" target="_blank">
            <i class="fa fa-eye"></i> View
        </a> -->

        @can('brands-edit')
        <a href="{{ route('brands.edit', $model->slug) }}"
            data-toggle="tooltip" data-placement="top" title="Edit brand"
            class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
        @endcan
        @can('brands-delete')
        <button class="btn btn-danger btn-xs delete"
            data-slug="{{ $model->slug }}"
            data-del-url="{{ url('brands', $model->slug) }}">
            <i class="fa fa-trash"></i> Delete</button>
        @endcan
    </td>
</tr>
@endforeach
<tr>
    <td colspan="13">
        Displying {{ $models->firstItem() }} to {{ $models->lastItem() }} of
        {{ $models->total() }} records
        <div class="d-flex justify-content-center">
            {!! $models->links('pagination::bootstrap-4') !!}
        </div>
    </td>
</tr>
<script>
    //delete record
    $('.delete').on('click', function() {
        var slug = $(this).attr('data-slug');
        var delete_url = $(this).attr('data-del-url');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
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
                    success: function(response) {
                        if (response) {
                            $('#id-' + slug).hide();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Not Deleted!',
                                'Sorry! Something went wrong.',
                                'danger'
                            )
                        }
                    }
                });
            }
        })
    });
</script>
