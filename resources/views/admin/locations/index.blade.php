@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@include('admin.partials.wellness_crud_theme')
<input type="hidden" id="page_url" value="{{ route('location.index') }}">

<section class="content-header bbw-crud-theme" style="margin-bottom: 0;">
	<div class="bbw-crud-card">
		<div class="bbw-crud-header">
			<h1>{{ $page_title }}</h1>
			@can('location-create')
			<a href="{{ route('location.create') }}" class="bbw-crud-add"><i class="fa fa-plus"></i> Add Location</a>
			@endcan
		</div>

		<div class="bbw-crud-stats" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:16px;padding:20px 24px;background:#fafaf8;border-bottom:1px solid rgba(45,106,98,0.1);">
			<div class="text-center"><strong style="font-size:22px;">{{ $totalLocations ?? 0 }}</strong><div class="text-muted small">Total</div></div>
			<div class="text-center"><strong style="font-size:22px;">{{ $activeLocations ?? 0 }}</strong><div class="text-muted small">Active</div></div>
			<div class="text-center"><strong style="font-size:22px;">{{ $inactiveLocations ?? 0 }}</strong><div class="text-muted small">Inactive</div></div>
		</div>

		<div class="bbw-crud-toolbar">
			<input type="text" id="search" class="form-control" placeholder="Search by name or slug…" aria-label="Search locations">
			<select id="status" class="form-control status" aria-label="Filter by status">
				<option value="All" selected>All statuses</option>
				<option value="1">Active</option>
				<option value="2">Inactive</option>
			</select>
		</div>

		<div class="bbw-crud-body">
			@if (session('status') || session('message'))
			<div class="bbw-callout">{{ session('message') ?? session('status') }}</div>
			@endif

			<div class="bbw-crud-table-wrap">
				<div class="table-responsive p-0">
					<table class="table table-hover bbw-crud-table mb-0">
						<thead>
							<tr>
								<th width="56">SL</th>
								<th width="80">Image</th>
								<th>Name</th>
								<th>Slug</th>
								<th width="70">Order</th>
								<th width="100">Status</th>
								<th class="bbw-action-td">Action</th>
							</tr>
						</thead>
						<tbody id="body">
							@foreach($models as $key=>$model)
							<tr id="id-{{ $model->id }}">
								<td>{{ $models->firstItem()+$key }}.</td>
								<td>
									<img src="{{ $model->cardImageUrl() }}" alt="{{ $model->name }}" width="56" height="56" style="object-fit:cover;border-radius:8px;">
								</td>
								<td>{{ $model->name }}</td>
								<td><code>{{ $model->slug }}</code></td>
								<td>{{ $model->sort_order }}</td>
								<td>
									@if($model->status)
									<span class="bbw-badge-on">Active</span>
									@else
									<span class="bbw-badge-off">Inactive</span>
									@endif
								</td>
								<td class="bbw-action-td">
									@php $locationActions = ['itemId' => $model->id]; @endphp
									@can('location-list')
										@php $locationActions['showUrl'] = route('location.show', $model->id); @endphp
									@endcan
									@can('location-edit')
										@php $locationActions['editUrl'] = route('location.edit', $model->id); @endphp
									@endcan
									@can('location-delete')
										@php $locationActions['deleteUrl'] = url('location', $model->id); @endphp
									@endcan
									@include('admin.partials.bbw-table-actions', $locationActions)
								</td>
							</tr>
							@endforeach
							<tr class="bbw-pagination-row">
								<td colspan="7">
									<div class="d-flex justify-content-center flex-wrap">
										{!! $models->links('pagination::bootstrap-4') !!}
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@push('js')
@endpush
