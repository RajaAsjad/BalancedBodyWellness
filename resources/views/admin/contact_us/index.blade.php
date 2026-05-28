@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
<style>
	/* Balanced Body IV Wellness — teal / sage / cream */
	.contact-card {
		background: #ffffff;
		border-radius: 16px;
		box-shadow: 0 8px 24px rgba(45, 106, 98, 0.1);
		border: 1px solid rgba(45, 106, 98, 0.15);
		overflow: hidden;
	}
	.contact-header {
		background: linear-gradient(135deg, #1a3f3c 0%, #2d6a62 38%, #3d9a8e 72%, #4a9a8e 100%) !important;
		color: #fff;
		padding: 18px 30px;
		border-radius: 16px 16px 0 0;
		border-bottom: 1px solid rgba(255, 255, 255, 0.2);
		box-shadow: 0 4px 16px rgba(45, 106, 98, 0.25);
		text-align: center;
	}
	.contact-header h1 {
		margin: 0;
		font-size: 22px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		color: #fff !important;
		text-shadow: 0 1px 2px rgba(0, 0, 0, 0.12);
	}
	.contact-stats {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
		gap: 20px;
		padding: 25px 30px 0;
		background: #eef2f0;
		margin-bottom: 20px;
	}
	.contact-stats .stat-box {
		background: #fff;
		padding: 18px;
		border-radius: 12px;
		box-shadow: 0 2px 8px rgba(45, 106, 98, 0.08);
		border: 1px solid rgba(45, 106, 98, 0.12);
		text-align: center;
		margin-bottom: 20px;
	}
	.contact-stats .stat-box .num {
		font-size: 22px;
		font-weight: 700;
		background: linear-gradient(135deg, #1a3f3c, #4a9a8e);
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
		background-clip: text;
	}
	.contact-stats .stat-box .lbl { font-size: 13px; color: #5f6f68; font-weight: 500; margin-top: 4px; }
	.contact-search {
		background: #fafaf8;
		padding: 20px 30px;
		border: 1px solid rgba(45, 106, 98, 0.1);
		margin: 0 30px 20px;
		border-radius: 12px;
	}
	.contact-search .form-control {
		border: 1px solid rgba(45, 106, 98, 0.2);
		border-radius: 10px;
		font-size: 14px;
		transition: border-color 0.2s ease, box-shadow 0.2s ease;
		background: #fff;
	}
	.contact-search .form-control:focus {
		border-color: #2d6a62;
		box-shadow: 0 0 0 3px rgba(45, 106, 98, 0.18);
		outline: none;
	}
	.contact-search .btn-filter {
		background: linear-gradient(135deg, #2d6a62 0%, #4a9a8e 100%) !important;
		color: #fff !important;
		border: none;
		padding: 10px 24px;
		border-radius: 9999px;
		font-weight: 600;
		transition: background 0.2s ease, box-shadow 0.2s ease, transform 0.15s ease;
		box-shadow: 0 4px 14px rgba(45, 106, 98, 0.35);
	}
	.contact-search .btn-filter:hover {
		background: linear-gradient(135deg, #1a5c54 0%, #3d9a8e 100%) !important;
		color: #fff !important;
		box-shadow: 0 6px 20px rgba(45, 106, 98, 0.4);
		transform: translateY(-1px);
	}
	.contact-search .btn-clear {
		background: #6b7280;
		color: #fff !important;
		padding: 10px 24px;
		border-radius: 9999px;
		font-weight: 600;
		text-decoration: none;
		display: inline-block;
		border: none;
		transition: background 0.2s ease;
	}
	.contact-search .btn-clear:hover { background: #4b5563; color: #fff !important; }
	.contact-body { padding: 15px 30px 25px; background: #eef2f0; }
	.contact-list-container .table-wrap {
		background: #ffffff;
		border-radius: 12px;
		border: 1px solid rgba(45, 106, 98, 0.12);
		overflow: hidden;
		box-shadow: 0 2px 8px rgba(45, 106, 98, 0.06);
	}
	.contact-list-container .contact-list-table { margin: 0; }
	.contact-list-container .contact-list-table thead tr {
		background: linear-gradient(135deg, #eef6f4 0%, #f5faf9 100%) !important;
		border-bottom: 1px solid rgba(45, 106, 98, 0.2);
	}
	.contact-list-container .contact-list-table thead th {
		font-weight: 600;
		color: #1d2b33;
		font-size: 13px;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		padding: 14px 12px;
		border: none;
	}
	.contact-list-container .contact-list-table tbody tr { transition: background 0.2s ease; }
	.contact-list-container .contact-list-table tbody tr:hover {
		background: rgba(45, 106, 98, 0.06);
	}
	.contact-list-container .contact-list-table tbody td {
		padding: 12px;
		vertical-align: middle;
		font-size: 14px;
		color: #374151;
		border-color: rgba(45, 106, 98, 0.1);
	}
	.contact-action-btns {
		display: flex;
		flex-direction: row;
		flex-wrap: nowrap;
		gap: 6px;
		align-items: center;
	}
	.contact-list-container .btn-show {
		background: linear-gradient(135deg, #2d6a62 0%, #4a9a8e 100%) !important;
		border: none;
		color: #fff !important;
		font-weight: 600;
		padding: 5px 14px;
		border-radius: 9999px;
		font-size: 12px;
		transition: all 0.2s ease;
		text-decoration: none !important;
		display: inline-block;
		white-space: nowrap;
		box-shadow: 0 2px 8px rgba(45, 106, 98, 0.3);
	}
	.contact-list-container .btn-show:hover {
		background: linear-gradient(135deg, #1a5c54 0%, #3d9a8e 100%) !important;
		color: #fff !important;
		box-shadow: 0 4px 12px rgba(45, 106, 98, 0.4);
		transform: translateY(-1px);
	}
	.contact-list-container .btn-delete {
		padding: 5px 12px;
		border-radius: 9999px;
		font-size: 12px;
		font-weight: 600;
		transition: all 0.2s ease;
		white-space: nowrap;
	}
	.contact-list-container .btn-delete:hover {
		transform: translateY(-1px);
		box-shadow: 0 2px 8px rgba(220, 53, 69, 0.35);
	}
	.contact-list-container .pagination-wrap {
		padding: 16px;
		background: #fafaf8;
		border-top: 1px solid rgba(45, 106, 98, 0.12);
		display: flex;
		flex-direction: column;
		gap: 8px;
	}
	.contact-list-container .callout-success-custom {
		background: #ecfdf5;
		border: 1px solid #10b981;
		border-radius: 10px;
		padding: 12px 16px;
		color: #047857;
		font-weight: 500;
		margin-bottom: 20px;
	}
	@media (max-width: 768px) {
		.contact-search .form-control { max-width: 100%; }
	}
</style>
@endpush

<input type="hidden" id="page_url" value="{{ route('contactus.index') }}">
<input type="hidden" id="status" value="All">
<section class="content-header" style="margin-bottom: 0;">
	<div class="contact-card">
		<div class="contact-header">
			<h1>{{ $page_title }}</h1>
		</div>

		<div class="contact-stats">
			<div class="stat-box">
				<div class="num">{{ $totalContacts ?? 0 }}</div>
				<div class="lbl">Total Contact Me</div>
			</div>
		</div>

		<div class="contact-search">
			<div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
				<input type="text" id="contact_search" class="form-control" placeholder="Search by name or email..." style="max-width: 280px;">
				<button type="button" class="btn btn-filter" id="btn-filter"><i class="fa fa-filter"></i> Filter</button>
				@if(request('search'))
				<a href="{{ route('contactus.index') }}" class="btn-clear"><i class="fa fa-times"></i> Clear</a>
				@endif
			</div>
		</div>

		<div class="contact-body">
			@if (session('status') || session('message'))
			<div class="contact-list-container">
				<div class="callout-success-custom">{{ session('message') ?? session('status') }}</div>
			</div>
			@endif

			<div class="contact-list-container">
				<div class="table-wrap">
					<div class="table-responsive p-0">
						<table class="table table-hover contact-list-table">
							<thead>
								<tr>
									<th>SL</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Venue/Event</th>
									<th>Message</th>
									<th width="160">Action</th>
								</tr>
							</thead>
							<tbody id="body">
								@foreach($models as $key=>$model)
								<tr id="id-{{ $model->id }}">
									<td>{{ $models->firstItem()+$key }}.</td>
									<td>{{ $model->first_name }} {{ $model->last_name }}</td>
									<td>{{ $model->email }}</td>
									<td>{{ $model->phone }}</td>
									<td>{{ $model->address ?? '—' }}</td>
									<td>{{ \Illuminate\Support\Str::limit($model->message, 50) }}</td>
									<td>
										<div class="contact-action-btns">
											<a href="{{ route('contactus.show', $model->id) }}" data-toggle="tooltip" data-placement="top" title="Show Contact" class="btn btn-show btn-xs"><i class="fa fa-eye"></i> Show</a>
											<button type="button" class="btn btn-danger btn-xs btn-delete delete-contact" data-slug="{{ $model->id }}" data-del-url="{{ url('contactus', $model->id) }}"><i class="fa fa-trash"></i> Delete</button>
										</div>
									</td>
								</tr>
								@endforeach
								@if($models->hasPages())
								<tr>
									<td colspan="7">
										<div class="pagination-wrap" style="margin: 0; border-top: none;">
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
	function doContactSearch(page) {
		page = page || 1;
		var pageurl = $('#page_url').val();
		var search = (($('#contact_search').length ? $('#contact_search').val() : $('#search').val()) || '').trim();
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
				if (xhr.status === 500) console.error('Contact search failed');
			}
		});
	}

	$('#btn-filter').on('click', function() {
		doContactSearch(1);
	});

	$('#contact_search').on('keyup', function() {
		clearTimeout($(this).data('contactSearchTimer'));
		$(this).data('contactSearchTimer', setTimeout(function() {
			doContactSearch(1);
		}, 350));
	});

	$(document).on('click', '#body .pagination a', function(e) {
		e.preventDefault();
		var href = $(this).attr('href');
		if (!href) return;
		var match = href.match(/[?&]page=(\d+)/);
		var page = match ? match[1] : 1;
		doContactSearch(page);
	});

	$(document).on('click', '#body .delete-contact', function() {
		var slug = $(this).attr('data-slug');
		var delete_url = $(this).attr('data-del-url');
		Swal.fire({
			title: 'Are you sure?',
			text: "This contact will be deleted.",
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
