@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@include('admin.partials.wellness_crud_theme')

@php $page = $model->toPageArray(); @endphp

<section class="content bbw-crud-theme" style="margin-bottom: 0;">
	<div class="bbw-form-card">
		<div class="bbw-form-header">
			<h1>{{ $page_title }}</h1>
			<a href="{{ route('location.index') }}" class="bbw-form-back"><i class="fa fa-list"></i> View all</a>
		</div>
		<div class="bbw-form-body">
			<table class="table table-bordered bbw-show-table" style="margin:0;background:#fff;">
				<tr>
					<th width="180">Name</th>
					<td>{{ $model->name }}</td>
				</tr>
				<tr>
					<th>Slug</th>
					<td><code>{{ $model->slug }}</code></td>
				</tr>
				<tr>
					<th>Status</th>
					<td>
						@if ($model->status)
							<span class="bbw-badge-on">Active</span>
						@else
							<span class="bbw-badge-off">Inactive</span>
						@endif
					</td>
				</tr>
				<tr>
					<th>Sort order</th>
					<td>{{ $model->sort_order }}</td>
				</tr>
				@if ($model->image)
				<tr>
					<th>Image</th>
					<td>
						<img src="{{ $model->cardImageUrl() }}" alt="{{ $model->name }}" style="max-width:200px;border-radius:8px;">
					</td>
				</tr>
				@endif
				<tr>
					<th>Banner Title</th>
					<td>{{ $page['hero']['eyebrow'] ?? '—' }}</td>
				</tr>
				<tr>
					<th>Banner Heading</th>
					<td>{{ $page['hero']['title_main'] ?? '—' }}</td>
				</tr>
				<tr>
					<th>Banner Description</th>
					<td style="white-space:pre-wrap;">{{ $page['hero']['lead'] ?? '—' }}</td>
				</tr>
			</table>

			<div class="bbw-form-actions bbw-show-actions">
				@can('location-edit')
				<a href="{{ route('location.edit', $model->id) }}" class="btn bbw-btn-submit"><i class="fa fa-edit"></i> Edit</a>
				@endcan
				<a href="{{ $model->publicUrl() }}" class="btn bbw-btn-outline" target="_blank" rel="noopener"><i class="fa fa-external-link"></i> View live page</a>
			</div>
		</div>
	</div>
</section>
@endsection

@push('css')
<style>
.bbw-show-table th {
	background: #fafaf8;
	font-weight: 600;
	color: #1d2b33;
	vertical-align: middle;
}
.bbw-show-actions {
	margin-top: 1.25rem;
	padding-top: 1.25rem;
	border-top: 1px solid rgba(45, 106, 98, 0.12);
}
.bbw-btn-outline {
	background: #fff !important;
	color: #2d6a62 !important;
	border: 2px solid #2d6a62 !important;
	font-weight: 600;
	padding: 10px 22px !important;
	border-radius: 9999px !important;
	text-decoration: none !important;
	transition: all 0.2s ease;
}
.bbw-btn-outline:hover {
	background: #2d6a62 !important;
	color: #fff !important;
}
</style>
@endpush
