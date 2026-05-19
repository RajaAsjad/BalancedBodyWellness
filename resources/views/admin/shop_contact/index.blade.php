@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
<style>
	.shop-contact-card {
		background: #ffffff;
		border-radius: 12px;
		box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
		border: 2px solid #e0e0e0;
		overflow: hidden;
	}
	.shop-contact-header {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
		color: #1a1a1a;
		padding: 18px 30px;
		border-radius: 12px 12px 0 0;
		border-bottom: 3px solid #242424;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
		text-align: center;
	}
	.shop-contact-header h1 { margin: 0; font-size: 22px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
	.shop-contact-stats {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
		gap: 20px;
		padding: 25px 30px 0;
		background: #f8f9fa;
		margin-bottom: 20px;
	}
	.shop-contact-stats .stat-box {
		background: #fff;
		padding: 18px;
		border-radius: 12px;
		box-shadow: 0 2px 8px rgba(0,0,0,0.06);
		border: 2px solid #e0e0e0;
		text-align: center;
		margin-bottom: 20px;
	}
	.shop-contact-stats .stat-box .num { font-size: 22px; font-weight: 700; color: #2c3e50; }
	.shop-contact-stats .stat-box .lbl { font-size: 13px; color: #6b7280; font-weight: 500; margin-top: 4px; }
	.shop-contact-search {
		background: #f8f9fa;
		padding: 20px 30px;
		border-bottom: 2px solid #e0e0e0;
		margin: 0 30px 20px;
		border-radius: 8px;
	}
	.shop-contact-search .form-control {
		border: 2px solid #e0e0e0;
		border-radius: 8px;
		padding: 10px 14px;
		font-size: 14px;
		transition: all 0.3s ease;
		background: #fff;
	}
	.shop-contact-search .form-control:focus {
		border-color: #EEB72D;
		box-shadow: 0 0 0 3px rgba(238,183,45,0.2);
		outline: none;
	}
	.shop-contact-search .btn-filter {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
		color: #1a1a1a !important;
		border: 1px solid #242424;
		padding: 10px 24px;
		border-radius: 8px;
		font-weight: 600;
		transition: all 0.3s ease;
	}
	.shop-contact-search .btn-filter:hover {
		background: linear-gradient(135deg, #d4a020 0%, #EEB72D 100%) !important;
		color: #1a1a1a !important;
		box-shadow: 0 2px 8px rgba(238,183,45,0.4);
	}
	.shop-contact-search .btn-clear {
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
	.shop-contact-search .btn-clear:hover { background: #5a6268; color: #fff !important; }
	.shop-contact-body { padding: 15px 30px 25px; background: #f8f9fa; }
	.shop-contact-list-container .table-wrap {
		background: #ffffff;
		border-radius: 8px;
		border: 2px solid #e0e0e0;
		overflow: hidden;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
	}
	.shop-contact-list-container .shop-contact-list-table { margin: 0; }
	.shop-contact-list-container .shop-contact-list-table thead tr {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
		border-bottom: 2px solid #242424;
	}
	.shop-contact-list-container .shop-contact-list-table thead th {
		font-weight: 600;
		color: #1a1a1a;
		font-size: 13px;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		padding: 14px 12px;
		border: none;
	}
	.shop-contact-list-container .shop-contact-list-table tbody tr { transition: background 0.2s ease; }
	.shop-contact-list-container .shop-contact-list-table tbody tr:hover {
		background: rgba(238, 183, 45, 0.08);
	}
	.shop-contact-list-container .shop-contact-list-table tbody td {
		padding: 12px;
		vertical-align: middle;
		font-size: 14px;
		color: #2c3e50;
		border-color: #e0e0e0;
	}
	.shop-contact-action-btns {
		display: flex;
		flex-direction: row;
		flex-wrap: nowrap;
		gap: 6px;
		align-items: center;
	}
	.shop-contact-list-container .btn-show {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
		border: 1px solid #242424;
		color: #1a1a1a !important;
		font-weight: 600;
		padding: 5px 12px;
		border-radius: 6px;
		font-size: 12px;
		transition: all 0.3s ease;
		text-decoration: none !important;
		display: inline-block;
		white-space: nowrap;
	}
	.shop-contact-list-container .btn-show:hover {
		background: linear-gradient(135deg, #d4a020 0%, #EEB72D 100%) !important;
		color: #1a1a1a !important;
		box-shadow: 0 2px 8px rgba(238,183,45,0.4);
		transform: translateY(-1px);
	}
	.shop-contact-list-container .btn-delete {
		padding: 5px 12px;
		border-radius: 6px;
		font-size: 12px;
		font-weight: 600;
		transition: all 0.3s ease;
		white-space: nowrap;
	}
	.shop-contact-list-container .btn-delete:hover {
		transform: translateY(-1px);
		box-shadow: 0 2px 8px rgba(220, 53, 69, 0.35);
	}
	.shop-contact-list-container .pagination-wrap {
		padding: 16px;
		background: #f8f9fa;
		border-top: 2px solid #e0e0e0;
		display: flex; 
	}
	.shop-contact-list-container .callout-success-custom {
		background: #d4edda;
		border: 2px solid #28a745;
		border-radius: 8px;
		padding: 12px 16px;
		color: #155724;
		font-weight: 500;
		margin-bottom: 20px;
	}
	@media (max-width: 768px) {
		.shop-contact-search .form-control { max-width: 100%; }
	}
</style>
@endpush

<input type="hidden" id="page_url" value="{{ route('shopcontact.index') }}">
<input type="hidden" id="status" value="All">
<section class="content-header" style="margin-bottom: 0;">
	<div class="shop-contact-card">
		<div class="shop-contact-header">
			<h1>{{ $page_title }}</h1>
		</div>

		<div class="shop-contact-stats">
			<div class="stat-box">
				<div class="num">{{ $totalShopContacts ?? 0 }}</div>
				<div class="lbl">Total Contacts</div>
			</div>
		</div>

		<div class="shop-contact-search">
			<div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
				<input type="text" id="shop_contact_search" class="form-control" placeholder="Search by name, email or phone..." style="max-width: 280px;">
				<button type="button" class="btn btn-filter" id="btn-filter"><i class="fa fa-filter"></i> Filter</button>
				@if(request('search'))
				<a href="{{ route('shopcontact.index') }}" class="btn-clear"><i class="fa fa-times"></i> Clear</a>
				@endif
			</div>
		</div>

		<div class="shop-contact-body">
			@if (session('status') || session('message'))
			<div class="shop-contact-list-container">
				<div class="callout-success-custom">{{ session('message') ?? session('status') }}</div>
			</div>
			@endif

			<div class="shop-contact-list-container">
				<div class="table-wrap">
					<div class="table-responsive p-0">
						<table class="table table-hover shop-contact-list-table">
							<thead>
								<tr>
									<th>SL</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Message</th>
									<th width="160">Action</th>
								</tr>
							</thead>
							<tbody id="body">
								@foreach($models as $key=>$model)
								<tr id="id-{{ $model->id }}">
									<td>{{ $models->firstItem()+$key }}.</td>
									<td>{{ $model->name }}</td>
									<td>{{ $model->email }}</td>
									<td>{{ $model->phone }}</td>
									<td>{{ \Illuminate\Support\Str::limit($model->message, 50) }}</td>
									<td>
										<div class="shop-contact-action-btns">
											<a href="{{ route('shopcontact.show', $model->id) }}" data-toggle="tooltip" data-placement="top" title="Show" class="btn btn-show btn-xs"><i class="fa fa-eye"></i> Show</a>
											<button type="button" class="btn btn-danger btn-xs btn-delete delete-shop-contact" data-slug="{{ $model->id }}" data-del-url="{{ url('shopcontact', $model->id) }}"><i class="fa fa-trash"></i> Delete</button>
										</div>
									</td>
								</tr>
								@endforeach
								@if($models->hasPages())
								<tr>
									<td colspan="6">
										<div class="d-flex flex-column align-items-center">
											<div class="text-muted small mb-2">Displaying {{ $models->firstItem() }} to {{ $models->lastItem() }} of {{ $models->total() }} records</div>
											{!! $models->appends(request()->query())->links('pagination::bootstrap-4') !!}
										</div>
									</td>
								</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@push('js')
<script>
$(document).ready(function() {
	function doShopContactSearch(page) {
		page = page || 1;
		var pageurl = $('#page_url').val();
		var search = (($('#shop_contact_search').length ? $('#shop_contact_search').val() : $('#search').val()) || '').trim();
		var status = ($('#status').length ? $('#status').val() : 'All') || 'All';
		var container = ($('#ajax_container').length && $('#ajax_container').val()) ? ('#' + $('#ajax_container').val()) : '#body';
		var url = pageurl + '?page=' + page + '&search=' + encodeURIComponent(search) + '&status=' + encodeURIComponent(status);
		$.ajax({
			url: url,
			type: 'GET',
			headers: { 'X-Requested-With': 'XMLHttpRequest' },
			success: function(response) {
				$(container).html(response);
			},
			error: function(xhr) {
				if (xhr.status === 500) console.error('Shop contact search failed');
			}
		});
	}

	$('#btn-filter').on('click', function() {
		doShopContactSearch(1);
	});

	$('#shop_contact_search').on('keyup', function() {
		clearTimeout($(this).data('shopContactSearchTimer'));
		$(this).data('shopContactSearchTimer', setTimeout(function() {
			doShopContactSearch(1);
		}, 350));
	});

	$(document).on('click', '#body .pagination a', function(e) {
		e.preventDefault();
		var href = $(this).attr('href');
		if (!href) return;
		var match = href.match(/[?&]page=(\d+)/);
		var page = match ? match[1] : 1;
		doShopContactSearch(page);
	});

	$(document).on('click', '#body .delete-shop-contact', function() {
		var slug = $(this).attr('data-slug');
		var delete_url = $(this).attr('data-del-url');
		Swal.fire({
			title: 'Are you sure?',
			text: "This contact will be deleted.",
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
							Swal.fire('Deleted!', 'Contact has been deleted.', 'success');
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
@endpush
