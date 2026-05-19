@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
<style>
	.video-admin { --v-pink: #ec4899; --v-pink-deep: #be185d; --v-orange: #fb923c; --v-cream: #f5f3f0; --v-text: #1c1917; }
	.video-admin .video-shell {
		background: #fff;
		border-radius: 12px;
		box-shadow: 0 4px 24px rgba(236, 72, 153, 0.1);
		border: 1px solid rgba(236, 72, 153, 0.15);
		overflow: hidden;
	}
	.video-admin .video-page-header {
		background: linear-gradient(135deg, var(--v-pink) 0%, #f472b6 45%, var(--v-orange) 100%) !important;
		color: #fff;
		padding: 18px 30px;
		border-radius: 12px 12px 0 0;
		border-bottom: 2px solid rgba(190, 24, 93, 0.35);
		box-shadow: 0 4px 20px rgba(236, 72, 153, 0.2);
		text-align: center;
	}
	.video-admin .video-page-header h1 { margin: 0; font-size: 22px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; text-shadow: 0 1px 2px rgba(0,0,0,0.12); }
	.video-stats {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
		gap: 20px;
		padding: 25px 30px 0;
		background: var(--v-cream);
		margin-bottom: 20px;
	}
	.video-stats .stat-box {
		background: #fff;
		padding: 18px;
		border-radius: 12px;
		box-shadow: 0 2px 12px rgba(236, 72, 153, 0.08);
		border: 1px solid rgba(236, 72, 153, 0.12);
		text-align: center;
		margin-bottom: 20px;
	}
	.video-stats .stat-box .num { font-size: 22px; font-weight: 700; color: var(--v-text); }
	.video-stats .stat-box .lbl { font-size: 13px; color: #6b7280; font-weight: 500; margin-top: 4px; }
	.video-stats .stat-box .btn-add-video {
		background: linear-gradient(135deg, var(--v-pink) 0%, var(--v-orange) 100%) !important;
		color: #fff !important;
		border: 1px solid rgba(255, 255, 255, 0.35);
		border-radius: 8px;
		padding: 10px 20px;
		font-weight: 600;
		text-decoration: none !important;
		display: inline-block;
		transition: all 0.3s ease;
	}
	.video-stats .stat-box .btn-add-video:hover {
		background: linear-gradient(135deg, #db2777 0%, #ea580c 100%) !important;
		color: #fff !important;
		box-shadow: 0 4px 16px rgba(236, 72, 153, 0.35);
		transform: translateY(-1px);
	}
	.video-search {
		background: var(--v-cream);
		padding: 20px 30px;
		border: 1px solid rgba(236, 72, 153, 0.12);
		margin: 0 30px 20px;
		border-radius: 8px;
	}
	.video-search .form-control {
		border: 2px solid #e7e5e4;
		border-radius: 8px;
		font-size: 14px;
		transition: all 0.3s ease;
		background: #fff;
	}
	.video-search .form-control:focus {
		border-color: rgba(236, 72, 153, 0.55);
		box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.15);
		outline: none;
	}
	.video-search .btn-filter {
		background: linear-gradient(135deg, var(--v-pink) 0%, var(--v-orange) 100%) !important;
		color: #fff !important;
		border: none;
		padding: 10px 24px;
		border-radius: 8px;
		font-weight: 600;
		transition: all 0.3s ease;
	}
	.video-search .btn-filter:hover {
		background: linear-gradient(135deg, #db2777 0%, #ea580c 100%) !important;
		color: #fff !important;
		box-shadow: 0 4px 14px rgba(236, 72, 153, 0.3);
	}
	.video-search .btn-clear {
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
	.video-search .btn-clear:hover { background: #44403c; color: #fff !important; }
	.video-body { padding: 15px 30px 28px; background: var(--v-cream); }
	.video-list-container .video-cards-wrap {
		background: transparent;
		border: none;
		box-shadow: none;
	}
	.video-cards-grid {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(min(100%, 340px), 1fr));
		gap: 22px;
		align-items: stretch;
	}
	.video-item-card {
		background: #fff;
		border-radius: 14px;
		overflow: hidden;
		border: 1px solid rgba(236, 72, 153, 0.14);
		box-shadow: 0 6px 24px rgba(15, 23, 42, 0.08), 0 2px 8px rgba(236, 72, 153, 0.08);
		display: flex;
		flex-direction: column;
		transition: transform 0.2s ease, box-shadow 0.2s ease;
	}
	.video-item-card:hover {
		transform: translateY(-3px);
		box-shadow: 0 12px 32px rgba(15, 23, 42, 0.12), 0 4px 14px rgba(236, 72, 153, 0.14);
	}
	.video-item-card__hero {
		position: relative;
		min-height: 118px;
		padding: 16px 16px 18px 16px;
		background: linear-gradient(125deg, #1e1b4b 0%, #4c1d95 32%, #a21caf 62%, #c2410c 100%);
		isolation: isolate;
		overflow: hidden;
	}
	.video-item-card__hero--has-thumb {
		background: #1e1b4b;
		min-height: 140px;
	}
	.video-item-card__hero-thumb {
		position: absolute;
		inset: 0;
		width: 100%;
		height: 100%;
		object-fit: cover;
		z-index: 0;
		pointer-events: none;
	}
	.video-item-card__hero:has(.video-item-card__fab) {
		padding-right: 56px;
	}
	.video-item-card__hero::after {
		content: "";
		position: absolute;
		inset: 0;
		background: linear-gradient(180deg, rgba(15, 23, 42, 0.15) 0%, rgba(15, 23, 42, 0.55) 100%);
		z-index: 1;
		pointer-events: none;
	}
	.video-item-card__hero-inner {
		position: relative;
		z-index: 2;
		display: flex;
		flex-direction: column;
		gap: 8px;
		align-items: flex-start;
		max-width: calc(100% - 8px);
	}
	.video-item-card__sl {
		font-size: 11px;
		font-weight: 700;
		letter-spacing: 0.08em;
		text-transform: uppercase;
		color: rgba(255, 255, 255, 0.75);
	}
	.video-item-card__heading {
		margin: 0;
		font-size: 1.05rem;
		font-weight: 700;
		line-height: 1.35;
		color: #fff;
		text-shadow: 0 1px 3px rgba(0, 0, 0, 0.35);
		display: -webkit-box;
		-webkit-line-clamp: 3;
		-webkit-box-orient: vertical;
		overflow: hidden;
	}
	.video-item-card__fab {
		position: absolute;
		top: 12px;
		right: 12px;
		z-index: 3;
		display: flex;
		flex-direction: column;
		align-items: center;
		gap: 6px;
		padding: 8px 6px;
		background: rgba(15, 23, 42, 0.78);
		backdrop-filter: blur(8px);
		border-radius: 999px;
		box-shadow: 0 4px 16px rgba(0, 0, 0, 0.28);
		border: 1px solid rgba(255, 255, 255, 0.1);
	}
	.video-item-card__fab-btn {
		width: 36px;
		height: 36px;
		border-radius: 50%;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		padding: 0;
		border: none;
		background: rgba(255, 255, 255, 0.1);
		color: #fff !important;
		cursor: pointer;
		text-decoration: none !important;
		transition: background 0.2s ease, transform 0.15s ease;
		font-size: 14px;
	}
	.video-item-card__fab-btn:hover {
		background: rgba(255, 255, 255, 0.22);
		color: #fff !important;
		transform: scale(1.06);
	}
	.video-item-card__fab-btn--danger:hover {
		background: rgba(220, 38, 38, 0.85);
	}
	.video-item-card__body {
		flex: 1;
		display: flex;
		flex-direction: column;
		gap: 12px;
		padding: 16px 18px 18px;
		background: #fff;
	}
	.video-item-card__title {
		margin: 0;
		font-size: 14px;
		font-weight: 600;
		color: #374151;
		line-height: 1.45;
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		overflow: hidden;
	}
	.video-item-card__url {
		font-size: 12px;
		line-height: 1.45;
		word-break: break-all;
		color: var(--v-pink-deep) !important;
		text-decoration: none !important;
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		overflow: hidden;
	}
	.video-item-card__url:hover {
		color: #9d174d !important;
		text-decoration: underline !important;
	}
	.video-item-card__badges {
		display: flex;
		flex-wrap: wrap;
		align-items: center;
		justify-content: space-between;
		gap: 10px;
		margin-top: auto;
		padding-top: 4px;
	}
	.video-item-card__badges-left,
	.video-item-card__badges-right {
		display: flex;
		flex-wrap: wrap;
		gap: 8px;
		align-items: center;
	}
	.video-badge-featured {
		display: inline-block;
		padding: 5px 16px;
		border-radius: 50px;
		font-size: 11px;
		font-weight: 700;
		letter-spacing: 0.06em;
		text-transform: uppercase;
		color: #fff;
		line-height: 1.35;
		background: linear-gradient(to right, #f83a7b, #f17b37);
		box-shadow: 0 1px 4px rgba(248, 58, 123, 0.35);
		white-space: nowrap;
	}
	.video-badge-not-featured {
		display: inline-block;
		padding: 5px 14px;
		border-radius: 50px;
		font-size: 11px;
		font-weight: 600;
		letter-spacing: 0.02em;
		color: #78716c;
		line-height: 1.35;
		background: #e7e5e4;
		border: 1px solid #d6d3d1;
		white-space: nowrap;
	}
	.video-badge-active {
		display: inline-block;
		padding: 5px 16px;
		border-radius: 50px;
		font-size: 11px;
		font-weight: 700;
		letter-spacing: 0.06em;
		text-transform: uppercase;
		color: #14532d;
		line-height: 1.35;
		background: #d1fae5;
		border: 1px solid #6ee7b7;
		white-space: nowrap;
	}
	.video-badge-inactive {
		display: inline-block;
		padding: 5px 14px;
		border-radius: 50px;
		font-size: 11px;
		font-weight: 700;
		letter-spacing: 0.06em;
		text-transform: uppercase;
		color: #1e3a5f;
		line-height: 1.35;
		background: #e0f2fe;
		border: 1px solid #7dd3fc;
		white-space: nowrap;
	}
	.video-cards-pagination {
		grid-column: 1 / -1;
		background: #fff;
		border-radius: 12px;
		border: 1px solid rgba(236, 72, 153, 0.12);
		padding: 18px 16px;
		margin-top: 4px;
		box-shadow: 0 2px 12px rgba(236, 72, 153, 0.06);
	}
	@media (max-width: 768px) {
		.video-search .form-control { max-width: 100%; }
		.video-search .status { max-width: 100%; }
		.video-item-card__hero { min-height: 108px; }
		.video-item-card__hero:has(.video-item-card__fab) { padding-right: 52px; }
	}
</style>
@endpush

<input type="hidden" id="page_url" value="{{ route('video.index') }}">
<section class="content-header video-admin" style="margin-bottom: 0;">
	<div class="video-shell">
		<div class="video-page-header">
			<h1>{{ $page_title }}</h1>
		</div>

		<div class="video-stats">
			<div class="stat-box">
				<div class="num">{{ $totalVideos ?? 0 }}</div>
				<div class="lbl">Total Videos</div>
			</div>
			<div class="stat-box">
				<div class="num">{{ $activeVideos ?? 0 }}</div>
				<div class="lbl">Publish</div>
			</div>
			<div class="stat-box">
				<div class="num">{{ $inactiveVideos ?? 0 }}</div>
				<div class="lbl">Draft</div>
			</div>
			@can('video-create')
			<div class="stat-box" style="display: flex; align-items: center; justify-content: center;">
				<a href="{{ route('video.create') }}" class="btn-add-video"><i class="fa fa-plus"></i> Add Video</a>
			</div>
			@endcan
		</div>

		<div class="video-search">
			<div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
				<input type="text" id="search" class="form-control" placeholder="Search by title" style="max-width: 280px;">
				<select id="status" class="form-control status" name="status" style="max-width: 180px;">
					<option value="All" selected>All status</option>
					<option value="1">Publish</option>
					<option value="2">Draft</option>
				</select>
				<button type="button" class="btn btn-filter" id="btn-filter"><i class="fa fa-filter"></i> Filter</button>
				@if(request('search') || (request('status') && request('status') != 'All'))
				<a href="{{ route('video.index') }}" class="btn-clear"><i class="fa fa-times"></i> Clear</a>
				@endif
			</div>
		</div>

		<div class="video-body">
			<div class="video-list-container">
				<div class="video-cards-wrap">
					<div class="video-cards-grid" id="body">
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
	if ($.fn.tooltip) {
		$('[data-toggle="tooltip"]').tooltip();
	}
	$('#btn-filter').on('click', function() {
		var pageurl = $('#page_url').val();
		var search = $('#search').val();
		var status = $('#status').val();
		var container = $('#ajax_container').length && $('#ajax_container').val() ? ('#' + $('#ajax_container').val()) : '#body';
		$.get(pageurl + '?page=1&search=' + encodeURIComponent(search) + '&status=' + encodeURIComponent(status), function(response) {
			$(container).html(response);
			$('[data-toggle="tooltip"]').tooltip();
		});
	});

	$(document).on('click', '.video-item-card .delete', function() {
		var $btn = $(this);
		var slug = $btn.attr('data-slug');
		var delete_url = $btn.attr('data-del-url');
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#ec4899',
			cancelButtonColor: '#6b7280',
			confirmButtonText: 'Yes, delete it!'
		}).then(function(result) {
			if (!result.isConfirmed) return;
			$.ajaxSetup({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
			});
			$.ajax({
				url: delete_url,
				type: 'DELETE',
				success: function(response) {
					if (response) {
						$('#id-' + slug).fadeOut(200, function() { $(this).remove(); });
						Swal.fire('Deleted!', 'Video removed.', 'success');
					} else {
						Swal.fire('Not deleted', 'Something went wrong.', 'error');
					}
				}
			});
		});
	});
});
</script>
@endpush
