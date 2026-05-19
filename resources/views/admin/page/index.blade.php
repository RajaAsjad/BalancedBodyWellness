@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
<style>
	.page-admin {
		--pg-pink: #2d6a62;
		--pg-pink-deep: #1a3f3c;
		--pg-orange: #4a9a8e;
		--pg-mint: #3d9a8e;
		--pg-cream: #eef2f0;
		--pg-text: #1d2b33;
	}
	.page-card {
		background: #fff;
		border-radius: 12px;
		box-shadow: 0 4px 24px rgba(45, 106, 98, 0.1);
		border: 1px solid rgba(45, 106, 98, 0.15);
		overflow: hidden;
	}
	.page-header {
		background: linear-gradient(135deg, var(--pg-pink-deep) 0%, var(--pg-pink) 38%, var(--pg-mint) 72%, var(--pg-orange) 100%) !important;
		color: #fff;
		padding: 18px 30px;
		border-radius: 12px 12px 0 0;
		border-bottom: 2px solid rgba(26, 63, 60, 0.35);
		box-shadow: 0 4px 20px rgba(45, 106, 98, 0.2);
		text-align: center;
		margin: 0 0 20px 0 !important;
	}
	.page-header h1 {
		margin: 0;
		font-size: 22px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		text-shadow: 0 1px 2px rgba(0, 0, 0, 0.12);
	}
	.page-stats {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
		gap: 20px;
		padding: 25px 30px 0;
		background: var(--pg-cream);
		margin-bottom: 20px;
	}
	.page-stats .stat-box {
		background: #fff;
		padding: 18px;
		border-radius: 12px;
		box-shadow: 0 2px 12px rgba(45, 106, 98, 0.08);
		border: 1px solid rgba(45, 106, 98, 0.12);
		text-align: center;
		margin-bottom: 20px;
	}
	.page-stats .stat-box .num { font-size: 22px; font-weight: 700; color: var(--pg-text); }
	.page-stats .stat-box .lbl { font-size: 13px; color: #5f6f68; font-weight: 500; margin-top: 4px; }
	.page-stats .stat-box .btn-add-page {
		background: linear-gradient(135deg, var(--pg-pink) 0%, var(--pg-orange) 100%) !important;
		color: #fff !important;
		border: 1px solid rgba(255, 255, 255, 0.35);
		border-radius: 8px;
		padding: 10px 20px;
		font-weight: 600;
		text-decoration: none !important;
		display: inline-block;
		transition: all 0.3s ease;
	}
	.page-stats .stat-box .btn-add-page:hover {
		background: linear-gradient(135deg, #1a5c54 0%, #3d9a8e 100%) !important;
		color: #fff !important;
		box-shadow: 0 4px 16px rgba(45, 106, 98, 0.35);
		transform: translateY(-1px);
	}
	.page-search {
		background: var(--pg-cream);
		padding: 20px 30px;
		border: 1px solid rgba(45, 106, 98, 0.12);
		margin: 0 30px 20px;
		border-radius: 8px;
	}
	.page-search .form-control {
		border: 2px solid #e7e5e4;
		border-radius: 8px;
		font-size: 14px;
		transition: all 0.3s ease;
		background: #fff;
	}
	.page-search .form-control:focus {
		border-color: rgba(45, 106, 98, 0.55);
		box-shadow: 0 0 0 3px rgba(45, 106, 98, 0.15);
		outline: none;
	}
	.page-search .btn-filter {
		background: linear-gradient(135deg, var(--pg-pink) 0%, var(--pg-orange) 100%) !important;
		color: #fff !important;
		border: none;
		padding: 10px 24px;
		border-radius: 8px;
		font-weight: 600;
		transition: all 0.3s ease;
	}
	.page-search .btn-filter:hover {
		background: linear-gradient(135deg, #1a5c54 0%, #3d9a8e 100%) !important;
		color: #fff !important;
		box-shadow: 0 4px 14px rgba(45, 106, 98, 0.3);
	}
	.page-search .btn-clear {
		background: #57534e;
		color: #fff !important;
		padding: 10px 24px;
		border-radius: 8px;
		font-weight: 600;
		text-decoration: none;
		display: inline-block;
		border: none;
		transition: all 0.3s ease;
	}
	.page-search .btn-clear:hover { background: #44403c; color: #fff !important; }
	.page-body { padding: 15px 30px 25px; background: var(--pg-cream); }
	.page-list-container .table-wrap {
		background: #fff;
		border-radius: 8px;
		border: 1px solid rgba(45, 106, 98, 0.12);
		overflow: hidden;
		box-shadow: 0 2px 12px rgba(45, 106, 98, 0.06);
	}
	.page-list-container .page-list-table { margin: 0; }
	.page-list-container .page-list-table thead tr {
		background: linear-gradient(135deg, var(--pg-pink-deep) 0%, var(--pg-pink) 50%, var(--pg-orange) 100%) !important;
		border-bottom: 2px solid rgba(26, 63, 60, 0.4);
	}
	.page-list-container .page-list-table thead th {
		font-weight: 600;
		color: #fff;
		font-size: 13px;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		padding: 14px 12px;
		border: none;
	}
	.page-list-container .page-list-table tbody tr { transition: background 0.2s ease; }
	.page-list-container .page-list-table tbody tr:hover { background: rgba(45, 106, 98, 0.06); }
	.page-list-container .page-list-table tbody td {
		padding: 12px;
		vertical-align: middle;
		font-size: 14px;
		color: #374151;
		border-color: #e7e5e4;
	}
	.page-list-container .badge-success {
		background: #15803d !important;
		padding: 4px 10px;
		border-radius: 6px;
		font-size: 12px;
		font-weight: 600;
	}
	.page-list-container .badge-danger {
		background: #dc2626 !important;
		padding: 4px 10px;
		border-radius: 6px;
		font-size: 12px;
		font-weight: 600;
	}
	.page-action-btns {
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		gap: 6px;
		align-items: center;
	}
	.page-list-container .btn-edit {
		background: linear-gradient(135deg, var(--pg-pink) 0%, var(--pg-orange) 100%) !important;
		border: none;
		color: #fff !important;
		font-weight: 600;
		padding: 5px 12px;
		border-radius: 6px;
		font-size: 12px;
		transition: all 0.3s ease;
		text-decoration: none !important;
		display: inline-block;
		white-space: nowrap;
	}
	.page-list-container .btn-edit:hover {
		background: linear-gradient(135deg, #1a5c54 0%, #3d9a8e 100%) !important;
		color: #fff !important;
		box-shadow: 0 2px 10px rgba(45, 106, 98, 0.35);
		transform: translateY(-1px);
	}
	.page-list-container .btn-delete {
		padding: 5px 12px;
		border-radius: 6px;
		font-size: 12px;
		font-weight: 600;
		transition: all 0.3s ease;
		white-space: nowrap;
	}
	.page-list-container .btn-delete:hover {
		transform: translateY(-1px);
		box-shadow: 0 2px 8px rgba(220, 38, 38, 0.35);
	}
	.page-list-container .btn-setting {
		background: linear-gradient(135deg, #44403c 0%, #57534e 100%) !important;
		border: 1px solid #3f3f46;
		color: #fff !important;
		font-weight: 600;
		padding: 5px 12px;
		border-radius: 6px;
		font-size: 12px;
		transition: all 0.3s ease;
		text-decoration: none !important;
		display: inline-block;
		white-space: nowrap;
	}
	.page-list-container .btn-setting:hover {
		background: linear-gradient(135deg, #292524 0%, #44403c 100%) !important;
		color: #fff !important;
		box-shadow: 0 2px 10px rgba(28, 25, 23, 0.25);
		transform: translateY(-1px);
	}
	.page-list-container .callout-success-custom {
		background: #ecfdf5;
		border: 1px solid #6ee7b7;
		border-radius: 8px;
		padding: 12px 16px;
		color: #14532d;
		font-weight: 500;
		margin-bottom: 20px;
	}
	@media (max-width: 768px) {
		.page-search .form-control { max-width: 100%; }
		.page-search .status { max-width: 100%; }
	}
</style>
@endpush


<input type="hidden" id="page_url" value="{{ route('page.index') }}">
<section class="content-header page-admin" style="margin-bottom: 0;">
	<div class="page-card">
		<div class="page-header">
			<h1>All Pages</h1>
		</div>

		<div class="page-stats">
			<div class="stat-box">
				<div class="num">{{ $totalPages ?? 0 }}</div>
				<div class="lbl">Total Pages</div>
			</div>
			<div class="stat-box">
				<div class="num">{{ $activePages ?? 0 }}</div>
				<div class="lbl">Active</div>
			</div>
			<div class="stat-box">
				<div class="num">{{ $inactivePages ?? 0 }}</div>
				<div class="lbl">Inactive</div>
			</div>
			@can('page-create')
			<div class="stat-box" style="display: flex; align-items: center; justify-content: center;">
				<a href="{{ route('page.create') }}" class="btn-add-page"><i class="fa fa-plus"></i> Add Page</a>
			</div>
			@endcan
		</div>

		<div class="page-search">
			<div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
				<input type="text" id="search" class="form-control" placeholder="Search by title..." style="max-width: 280px;">
				<select id="status" class="form-control status" name="status" style="max-width: 180px;">
					<option value="All" selected>All status</option>
					<option value="1">Active</option>
					<option value="0">Inactive</option>
				</select>
				<button type="button" class="btn btn-filter" id="btn-filter"><i class="fa fa-filter"></i> Filter</button>
				@if(request('search') || (request('status') && request('status') != 'All'))
				<a href="{{ route('page.index') }}" class="btn-clear"><i class="fa fa-times"></i> Clear</a>
				@endif
			</div>
		</div>

		<div class="page-body">
			@if (session('status') || session('message'))
			<div class="page-list-container">
				<div class="callout-success-custom">{{ session('message') ?? session('status') }}</div>
			</div>
			@endif

			<div class="page-list-container">
				<div class="table-wrap">
					<div class="table-responsive p-0">
						<table class="table table-hover page-list-table">
							<thead>
								<tr>
									<th width="50">SL</th>
									<th>Title</th>
									<th>Description</th>
									<th width="80">Status</th>
									<th width="250">Action</th>
								</tr>
							</thead>
							<tbody id="body">
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

	$(document).on('click', '#body .delete-page', function() {
		var slug = $(this).attr('data-slug');
		var delete_url = $(this).attr('data-del-url');
		Swal.fire({
			title: 'Are you sure?',
			text: "This page will be deleted.",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#2d6a62',
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
@endpush
