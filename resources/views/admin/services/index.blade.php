@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@include('admin.partials.wellness_crud_theme')
<input type="hidden" id="page_url" value="{{ route('service.index') }}">

<section class="content-header bbw-crud-theme" style="margin-bottom: 0;">
	<div class="bbw-crud-card">
		<div class="bbw-crud-header">
			<h1>{{ $page_title }}</h1>
			@can('service-create')
			<a href="{{ route('service.create') }}" class="bbw-crud-add"><i class="fa fa-plus"></i> Add Service</a>
			@endcan
		</div>

		<div class="bbw-crud-toolbar">
			<input type="text" id="search" class="form-control" placeholder="Search by heading…" aria-label="Search Services">
			<select id="status" class="form-control status" aria-label="Filter by status">
				<option value="All" selected>All statuses</option>
				<option value="1">Active</option>
				<option value="2">Inactive</option>
			</select>
		</div>

		<div class="bbw-crud-body"> 

			<div class="bbw-crud-table-wrap">
				<div class="table-responsive p-0">
					<table class="table table-hover bbw-crud-table mb-0">
						<thead>
							<tr>
								<th width="56">SL</th>
								<th>Heading</th>
								<th>Questions</th>
								<th>Description</th>
								<th>Benefits</th>
								<th width="100">Status</th>
								<th width="120">Created by</th>
								<th width="200">Action</th>
							</tr>
						</thead>
						<tbody id="body">
							@foreach($models as $key=>$model)
							<tr id="id-{{ $model->id }}">
								<td>{{ $models->firstItem()+$key }}.</td>
								<td>{{ \Illuminate\Support\Str::limit($model->heading, 40) }}</td>
								<td>{{ $model->listPreview('questions') }}</td>
								<td>{{ \Illuminate\Support\Str::limit(strip_tags($model->description), 60) }}</td>
								<td>{{ $model->listPreview('benefits') }}</td>
								<td>
									@if($model->status)
									<span class="bbw-badge-on">Active</span>
									@else
									<span class="bbw-badge-off">Inactive</span>
									@endif
								</td>
								<td>{{ isset($model->hasCreatedBy) ? $model->hasCreatedBy->name : 'N/A' }}</td>
								<td>
									<div class="bbw-action-cell">
										@can('service-edit')
										<a href="{{ route('service.edit', $model->id) }}" data-toggle="tooltip" data-placement="top" title="Edit Service" class="btn btn-xs bbw-btn-edit"><i class="fa fa-edit"></i> Edit</a>
										@endcan
										@can('service-delete')
										<button type="button" class="btn btn-danger btn-xs delete" data-slug="{{ $model->id }}" data-del-url="{{ url('service', $model->id) }}"><i class="fa fa-trash"></i> Delete</button>
										@endcan
									</div>
								</td>
							</tr>
							@endforeach
							<tr class="bbw-pagination-row">
								<td colspan="8">
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
