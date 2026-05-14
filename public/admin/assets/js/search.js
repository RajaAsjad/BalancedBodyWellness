$(document).on('change','#status',function(e) {
    select = $(this);
    selectedOption = select.find( "option[value=" + select.val() + "]" );
    var status =  selectedOption.val();
    var search = $('#search').val();
    var pageurl = $('#page_url').val();
    var page = 1;
    fetchAll(pageurl, page, search, status);
});
$('#search').keyup((function(e) {
    var search = $(this).val();
    var status = $('#status').val();
    var pageurl = $('#page_url').val();
    var page = 1;
    fetchAll(pageurl, page, search, status);
}));

$(document).on('click', '.pagination a', function(event){
    event.preventDefault();
    var search = $('#search').val();
    var status = $('#status').val();
    var pageurl = $('#page_url').val();
    var page = $(this).attr('href').split('page=')[1];
    fetchAll(pageurl, page, search, status);
});

function fetchAll(pageurl, page, search, status){
    var container = ($('#ajax_container').length && $('#ajax_container').val()) ? ('#' + $('#ajax_container').val()) : '#body';
    $.ajax({
        url:pageurl+'?page='+page+'&search='+search+'&status='+status,
        type: 'get',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        success: function(response){
            $(container).html(response);
            if (typeof window.initGalleryTiffPreviews === 'function') window.initGalleryTiffPreviews();
        }
    });
}

// Delete (delegated so rows replaced via AJAX still work)
$(document).on('click', '.delete', function(){
    var id = $(this).attr('data-slug');
    var delete_url = $(this).attr('data-del-url');
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2d6a62',
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
                url : delete_url,
                type : 'DELETE',
                success : function(response){
                    // console.log(response);
                    if(response){
                        $('#id-'+id).hide();
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
