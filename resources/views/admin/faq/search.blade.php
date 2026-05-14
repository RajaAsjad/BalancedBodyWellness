@foreach($models as $key=>$model)
    <tr id="id-{{ $model->id }}">
        <td>{{ $models->firstItem()+$key }}.</td>

        <td>{{\Illuminate\Support\Str::limit($model->question,40)}}</td>
        <td>{{\Illuminate\Support\Str::limit($model->answer,60)}}</td>
        <td>
            @if($model->status)
                <span class="badge label-success">Active</span>
            @else
                <span class="badge label-danger">In-Active</span>
            @endif
        </td>
        <td>{{isset($model->hasCreatedBy)?$model->hasCreatedBy->name:'N/A'}}</td>
        <td width="250px">
            @can('faq-edit')
                <a href="{{route('faq.edit', $model->id)}}" data-toggle="tooltip" data-placement="top" title="Edit faq" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
            @endcan
            @can('faq-delete')
                <button class="btn btn-danger btn-xs delete" data-slug="{{ $model->id }}" data-del-url="{{ url('faq', $model->id) }}"><i class="fa fa-trash"></i> Delete</button>
            @endcan
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="6">
        <div class="d-flex justify-content-center">
            {!! $models->links('pagination::bootstrap-4') !!}
        </div>
    </td>
</tr>
<script>
    //delete record
$('.delete').on('click', function(){
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
                url : delete_url,
                type : 'DELETE',
                success : function(response){
                    if(response){
                        $('#id-'+slug).hide();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }else{
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
