@foreach($models as $key=>$model)
@include('admin.videos.partials.video-card', ['model' => $model, 'key' => $key, 'models' => $models])
@endforeach
@if($models->hasPages())
<div class="video-cards-pagination">
	<div class="d-flex flex-column align-items-center">
		<div class="text-muted small mb-2">Displaying {{ $models->firstItem() }} to {{ $models->lastItem() }} of {{ $models->total() }} records</div>
		{!! $models->appends(request()->query())->links('pagination::bootstrap-4') !!}
	</div>
</div>
@endif
<script>
    $('.delete').on('click', function(){
        var slug = $(this).attr('data-slug');
        var delete_url = $(this).attr('data-del-url');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ec4899',
            cancelButtonColor: '#6b7280',
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
                        // console.log(response);
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