@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
<style>
	.audio-card {
		background: #ffffff;
		border-radius: 12px;
		box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
		border: 2px solid #e0e0e0;
		overflow: hidden;
	}
	.audio-header {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
		color: #1a1a1a;
		padding: 18px 30px;
		border-radius: 12px 12px 0 0;
		border-bottom: 3px solid #242424;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
		text-align: center;
	}
	.audio-header h1 { margin: 0; font-size: 22px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
	.audio-stats {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
		gap: 20px;
		padding: 25px 30px 0;
		background: #f8f9fa;
		margin-bottom: 20px;
	}
	.audio-stats .stat-box {
		background: #fff;
		padding: 18px;
		border-radius: 12px;
		box-shadow: 0 2px 8px rgba(0,0,0,0.06);
		border: 2px solid #e0e0e0;
		text-align: center;
		margin-bottom: 20px;
	}
	.audio-stats .stat-box .num { font-size: 22px; font-weight: 700; color: #2c3e50; }
	.audio-stats .stat-box .lbl { font-size: 13px; color: #6b7280; font-weight: 500; margin-top: 4px; }
	.audio-stats .stat-box .btn-add-audio {
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
	.audio-stats .stat-box .btn-add-audio:hover {
		background: linear-gradient(135deg, #d4a020 0%, #EEB72D 100%) !important;
		color: #1a1a1a !important;
		box-shadow: 0 2px 8px rgba(238,183,45,0.4);
		transform: translateY(-1px);
	}
	.audio-search {
		background: #f8f9fa;
		padding: 20px 30px;
		border-bottom: 2px solid #e0e0e0;
		margin: 0 30px 20px;
		border-radius: 8px;
	}
	.audio-search .form-control {
		border: 2px solid #e0e0e0;
		border-radius: 8px; 
		font-size: 14px;
		transition: all 0.3s ease;
		background: #fff;
	}
	.audio-search .form-control:focus {
		border-color: #EEB72D;
		box-shadow: 0 0 0 3px rgba(238,183,45,0.2);
		outline: none;
	}
	.audio-search .btn-filter {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
		color: #1a1a1a !important;
		border: 1px solid #242424;
		padding: 10px 24px;
		border-radius: 8px;
		font-weight: 600;
		transition: all 0.3s ease;
	}
	.audio-search .btn-filter:hover {
		background: linear-gradient(135deg, #d4a020 0%, #EEB72D 100%) !important;
		color: #1a1a1a !important;
		box-shadow: 0 2px 8px rgba(238,183,45,0.4);
	}
	.audio-search .btn-clear {
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
	.audio-search .btn-clear:hover { background: #5a6268; color: #fff !important; }
	.audio-body { padding: 15px 30px 25px; background: #f8f9fa; }
	.audio-list-container .table-wrap {
		background: #ffffff;
		border-radius: 8px;
		border: 2px solid #e0e0e0;
		overflow: hidden;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
	}
	.audio-list-container .audio-list-table { margin: 0; }
	.audio-list-container .audio-list-table thead tr {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
		border-bottom: 2px solid #242424;
	}
	.audio-list-container .audio-list-table thead th {
		font-weight: 600;
		color: #1a1a1a;
		font-size: 13px;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		padding: 14px 12px;
		border: none;
	}
	.audio-list-container .audio-list-table tbody tr { transition: background 0.2s ease; }
	.audio-list-container .audio-list-table tbody tr:hover {
		background: rgba(238, 183, 45, 0.08);
	}
	.audio-list-container .audio-list-table tbody td {
		padding: 12px;
		vertical-align: middle;
		font-size: 14px;
		color: #2c3e50;
		border-color: #e0e0e0;
	}
	.audio-list-container .label-success {
		background: #28a745 !important;
		padding: 4px 10px;
		border-radius: 6px;
		font-size: 12px;
		font-weight: 600;
	}
	.audio-list-container .label-danger {
		background: #dc3545 !important;
		padding: 4px 10px;
		border-radius: 6px;
		font-size: 12px;
		font-weight: 600;
	}
	.audio-action-btns {
		display: flex;
		flex-direction: row;
		flex-wrap: nowrap;
		gap: 6px;
		align-items: center;
	}
	.audio-list-container .btn-edit {
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
	.audio-list-container .btn-edit:hover {
		background: linear-gradient(135deg, #d4a020 0%, #EEB72D 100%) !important;
		color: #1a1a1a !important;
		box-shadow: 0 2px 8px rgba(238,183,45,0.4);
		transform: translateY(-1px);
	}
	.audio-list-container .btn-delete {
		padding: 5px 12px;
		border-radius: 6px;
		font-size: 12px;
		font-weight: 600;
		transition: all 0.3s ease;
		white-space: nowrap;
	}
	.audio-list-container .btn-delete:hover {
		transform: translateY(-1px);
		box-shadow: 0 2px 8px rgba(220, 53, 69, 0.35);
	}
	.audio-list-container .pagination-wrap {
		padding: 16px;
		background: #f8f9fa;
		border-top: 2px solid #e0e0e0;
		display: flex; 
	}
	.audio-list-container .callout-success-custom {
		background: #d4edda;
		border: 2px solid #28a745;
		border-radius: 8px;
		padding: 12px 16px;
		color: #155724;
		font-weight: 500;
		margin-bottom: 20px;
	}
	@media (max-width: 768px) {
		.audio-search .form-control { max-width: 100%; }
		.audio-search .status { max-width: 100%; }
	}
</style>
@endpush

<input type="hidden" id="page_url" value="{{ route('audio.index') }}">
<section class="content-header" style="margin-bottom: 0;">
	<div class="audio-card">
		<div class="audio-header">
			<h1>{{ $page_title }}</h1>
		</div>

		<div class="audio-stats">
			<div class="stat-box">
				<div class="num">{{ $totalAudios ?? 0 }}</div>
				<div class="lbl">Total Audios</div>
			</div>
			<div class="stat-box">
				<div class="num">{{ $activeAudios ?? 0 }}</div>
				<div class="lbl">Active</div>
			</div>
			<div class="stat-box">
				<div class="num">{{ $inactiveAudios ?? 0 }}</div>
				<div class="lbl">Inactive</div>
			</div>
			@can('audio-create')
			<div class="stat-box" style="display: flex; align-items: center; justify-content: center;">
				<a href="{{ route('audio.create') }}" class="btn-add-audio"><i class="fa fa-plus"></i> Add Audio</a>
			</div>
			@endcan
		</div>

		<div class="audio-search">
			<div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
				<input type="text" id="search" class="form-control" placeholder="Search by title..." style="max-width: 280px;">
				<select id="status" class="form-control status" name="status" style="max-width: 180px;">
					<option value="All" selected>All status</option>
					<option value="1">Active</option>
					<option value="2">In-Active</option>
				</select>
				<button type="button" class="btn btn-filter" id="btn-filter"><i class="fa fa-filter"></i> Filter</button>
				@if(request('search') || (request('status') && request('status') != 'All'))
				<a href="{{ route('audio.index') }}" class="btn-clear"><i class="fa fa-times"></i> Clear</a>
				@endif
			</div>
		</div>

		<div class="audio-body">
			@if (session('status') || session('message'))
			<div class="audio-list-container">
				<div class="callout-success-custom">{{ session('message') ?? session('status') }}</div>
			</div>
			@endif

			<div class="audio-list-container">
				<div class="table-wrap">
					<div class="table-responsive p-0">
						<table class="table table-hover audio-list-table">
							<thead>
								<tr>
									<th>SL</th>
									<th>Title</th>
									<th>Audio File</th>
									<th>Status</th>
									<th width="180">Action</th>
								</tr>
							</thead>
							<tbody id="body">
								@foreach($audios as $key=>$audio)
								<tr id="id-{{ $audio->id }}">
									<td>{{ $audios->firstItem()+$key }}.</td>
									<td>{{ $audio->title }}</td>
									<td>{{ $audio->file }}</td>
									<td>
										@if($audio->status)
										<span class="label label-success">Active</span>
										@else
										<span class="label label-danger">In-Active</span>
										@endif
									</td>
									<td>
										<div class="audio-action-btns">
											@can('audio-edit')
											<a href="{{ route('audio.edit', $audio->id) }}" data-toggle="tooltip" data-placement="top" title="Edit Audio" class="btn btn-edit btn-xs"><i class="fa fa-edit"></i> Edit</a>
											@endcan
											@can('audio-delete')
											<button type="button" class="btn btn-danger btn-xs btn-delete delete-audio" data-slug="{{ $audio->id }}" data-del-url="{{ url('audio', $audio->id) }}"><i class="fa fa-trash"></i> Delete</button>
											@endcan
										</div>
									</td>
								</tr>
								@endforeach
								@if($audios->hasPages())
								<tr>
									<td colspan="5">
										<div class="d-flex flex-column align-items-center">
											<div class="text-muted small mb-2">Displaying {{ $audios->firstItem() }} to {{ $audios->lastItem() }} of {{ $audios->total() }} records</div>
											{!! $audios->appends(request()->query())->links('pagination::bootstrap-4') !!}
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

	$(document).on('click', '#body .delete-audio', function() {
		var slug = $(this).attr('data-slug');
		var delete_url = $(this).attr('data-del-url');
		Swal.fire({
			title: 'Are you sure?',
			text: "This audio will be deleted.",
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
							Swal.fire('Deleted!', 'Audio has been deleted.', 'success');
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
