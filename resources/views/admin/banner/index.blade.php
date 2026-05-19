@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
<style>
	.banner-card {
		background: #ffffff;
		border-radius: 12px;
		box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
		border: 2px solid #e0e0e0;
		overflow: hidden;
	}
	.banner-header {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
		color: #1a1a1a;
		padding: 18px 30px;
		border-radius: 12px 12px 0 0;
		border-bottom: 3px solid #242424;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
		text-align: center;
	}
	.banner-header h1 { margin: 0; font-size: 22px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
	.banner-stats {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
		gap: 20px;
		padding: 25px 30px 0;
		background: #f8f9fa;
		margin-bottom: 20px;
	}
	.banner-stats .stat-box {
		background: #fff;
		padding: 18px;
		border-radius: 12px;
		box-shadow: 0 2px 8px rgba(0,0,0,0.06);
		border: 2px solid #e0e0e0;
		text-align: center;
		margin-bottom: 20px;
	}
	.banner-stats .stat-box .num { font-size: 22px; font-weight: 700; color: #2c3e50; }
	.banner-stats .stat-box .lbl { font-size: 13px; color: #6b7280; font-weight: 500; margin-top: 4px; }
	.banner-stats .stat-box .btn-add-banner {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
		color: #1a1a1a !important;
		border: 1px solid #242424;
		border-radius: 8px;
		padding: 10px 20px;
		font-weight: 600;
		text-decoration: none !important;
		display: inline-block;
		transition: all 0.3s ease;
	}
	.banner-stats .stat-box .btn-add-banner:hover {
		background: linear-gradient(135deg, #d4a020 0%, #EEB72D 100%) !important;
		color: #1a1a1a !important;
		box-shadow: 0 2px 8px rgba(238,183,45,0.4);
		transform: translateY(-1px);
	}
	.banner-search {
		background: #f8f9fa;
		padding: 20px 30px;
		border-bottom: 2px solid #e0e0e0;
		margin: 0 30px 20px;
		border-radius: 8px;
	}
	.banner-search .form-control {
		border: 2px solid #e0e0e0;
		border-radius: 8px;
		font-size: 14px;
		transition: all 0.3s ease;
		background: #fff;
	}
	.banner-search .form-control:focus {
		border-color: #EEB72D;
		box-shadow: 0 0 0 3px rgba(238,183,45,0.2);
		outline: none;
	}
	.banner-search .btn-filter {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
		color: #1a1a1a !important;
		border: 1px solid #242424;
		padding: 10px 24px;
		border-radius: 8px;
		font-weight: 600;
		transition: all 0.3s ease;
	}
	.banner-search .btn-filter:hover {
		background: linear-gradient(135deg, #d4a020 0%, #EEB72D 100%) !important;
		color: #1a1a1a !important;
		box-shadow: 0 2px 8px rgba(238,183,45,0.4);
	}
	.banner-search .btn-clear {
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
	.banner-search .btn-clear:hover { background: #5a6268; color: #fff !important; }
	.banner-body { padding: 15px 30px 25px; background: #f8f9fa; }
	.banner-list-container .table-wrap {
		background: #ffffff;
		border-radius: 8px;
		border: 2px solid #e0e0e0;
		overflow: hidden;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
	}
	.banner-list-container .banner-list-table { margin: 0; }
	.banner-list-container .banner-list-table thead tr {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
		border-bottom: 2px solid #242424;
	}
	.banner-list-container .banner-list-table thead th {
		font-weight: 600;
		color: #1a1a1a;
		font-size: 13px;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		padding: 14px 12px;
		border: none;
	}
	.banner-list-container .banner-list-table tbody tr { transition: background 0.2s ease; }
	.banner-list-container .banner-list-table tbody tr:hover {
		background: rgba(238, 183, 45, 0.08);
	}
	.banner-list-container .banner-list-table tbody td {
		padding: 12px;
		vertical-align: middle;
		font-size: 14px;
		color: #2c3e50;
		border-color: #e0e0e0;
	}
	.banner-list-container .banner-list-table tbody td img {
		width: 80px;
		height: 60px;
		object-fit: cover;
		border-radius: 8px;
		border: 2px solid #e0e0e0;
	}
	.banner-list-container .label-success {
		background: #28a745 !important;
		padding: 4px 10px;
		border-radius: 6px;
		font-size: 12px;
		font-weight: 600;
	}
	.banner-list-container .label-danger {
		background: #dc3545 !important;
		padding: 4px 10px;
		border-radius: 6px;
		font-size: 12px;
		font-weight: 600;
	}
	.banner-action-btns {
		display: flex;
		flex-direction: row;
		flex-wrap: nowrap;
		gap: 6px;
		align-items: center;
	}
	.banner-list-container .btn-edit {
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
	.banner-list-container .btn-edit:hover {
		background: linear-gradient(135deg, #d4a020 0%, #EEB72D 100%) !important;
		color: #1a1a1a !important;
		box-shadow: 0 2px 8px rgba(238,183,45,0.4);
		transform: translateY(-1px);
	}
	.banner-list-container .btn-delete {
		padding: 5px 12px;
		border-radius: 6px;
		font-size: 12px;
		font-weight: 600;
		transition: all 0.3s ease;
		white-space: nowrap;
	}
	.banner-list-container .btn-delete:hover {
		transform: translateY(-1px);
		box-shadow: 0 2px 8px rgba(220, 53, 69, 0.35);
	}
	.banner-list-container .callout-success-custom {
		background: #d4edda;
		border: 2px solid #28a745;
		border-radius: 8px;
		padding: 12px 16px;
		color: #155724;
		font-weight: 500;
		margin-bottom: 20px;
	}
	@media (max-width: 768px) {
		.banner-search .form-control { max-width: 100%; }
		.banner-search .status { max-width: 100%; }
	}
</style>
@endpush


<input type="hidden" id="page_url" value="{{ route('banner.index') }}">
<section class="content-header" style="margin-bottom: 0;">
	<div class="banner-card">
		<div class="banner-header">
			<h1>All Banners</h1>
		</div>

		<div class="banner-stats">
			<div class="stat-box">
				<div class="num">{{ $totalBanners ?? 0 }}</div>
				<div class="lbl">Total Banners</div>
			</div>
			<div class="stat-box">
				<div class="num">{{ $activeBanners ?? 0 }}</div>
				<div class="lbl">Active</div>
			</div>
			<div class="stat-box">
				<div class="num">{{ $inactiveBanners ?? 0 }}</div>
				<div class="lbl">Inactive</div>
			</div>
			@can('banner-create')
			<div class="stat-box" style="display: flex; align-items: center; justify-content: center;">
				<a href="{{ route('banner.create') }}" class="btn-add-banner"><i class="fa fa-plus"></i> Add Banner</a>
			</div>
			@endcan
		</div>

		<div class="banner-search">
			<div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
				<input type="text" id="search" class="form-control" placeholder="Search by title or heading..." style="max-width: 280px;">
				<select id="status" class="form-control status" name="status" style="max-width: 180px;">
					<option value="All" selected>All status</option>
					<option value="1">Active</option>
					<option value="2">In-Active</option>
				</select>
				<button type="button" class="btn btn-filter" id="btn-filter"><i class="fa fa-filter"></i> Filter</button>
				@if(request('search') || (request('status') && request('status') != 'All'))
				<a href="{{ route('banner.index') }}" class="btn-clear"><i class="fa fa-times"></i> Clear</a>
				@endif
			</div>
		</div>

		<div class="banner-body">
			@if (session('status') || session('message'))
			<div class="banner-list-container">
				<div class="callout-success-custom">{{ session('message') ?? session('status') }}</div>
			</div>
			@endif

			<div class="banner-list-container">
				<div class="table-wrap">
					<div class="table-responsive p-0">
						<table class="table table-hover banner-list-table">
							<thead>
								<tr>
									<th width="50">SL</th>
									<th width="100">Image</th>
									<th width="150">Page</th>
									<th>Title</th>
									<th>Heading</th>
									<th width="80">Status</th>
									<th width="180">Action</th>
								</tr>
							</thead>
							<tbody id="body">
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
	$('#btn-filter').on('click', function() {
		var pageurl = $('#page_url').val();
		var search = $('#search').val();
		var status = $('#status').val();
		var container = $('#ajax_container').length && $('#ajax_container').val() ? ('#' + $('#ajax_container').val()) : '#body';
		$.get(pageurl + '?page=1&search=' + encodeURIComponent(search) + '&status=' + encodeURIComponent(status), function(response) {
			$(container).html(response);
		});
	});

	$(document).on('click', '#body .delete-banner', function() {
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
@endpush