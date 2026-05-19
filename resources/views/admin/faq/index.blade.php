@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@include('admin.partials.wellness_crud_theme')
<input type="hidden" id="page_url" value="{{ route('faq.index') }}">

<section class="content-header bbw-crud-theme" style="margin-bottom: 0;">
	<div class="bbw-crud-card">
		<div class="bbw-crud-header">
			<h1>{{ $page_title }}</h1>
			@can('faq-create')
			<a href="{{ route('faq.create') }}" class="bbw-crud-add"><i class="fa fa-plus"></i> Add FAQ</a>
			@endcan
		</div>

		<div class="bbw-crud-toolbar">
			<input type="text" id="search" class="form-control" placeholder="Search by question…" aria-label="Search FAQs">
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
								<th>Question</th>
								<th>Answer</th>
								<th width="100">Status</th>
								<th width="120">Created by</th>
								<th width="200">Action</th>
							</tr>
						</thead>
						<tbody id="body">
							@foreach($models as $key=>$model)
							<tr id="id-{{ $model->id }}">
								<td>{{ $models->firstItem()+$key }}.</td>
								<td>{{ \Illuminate\Support\Str::limit($model->question, 40) }}</td>
								<td>{{ \Illuminate\Support\Str::limit(strip_tags($model->answer), 60) }}</td>
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
										@can('faq-edit')
										<a href="{{ route('faq.edit', $model->id) }}" data-toggle="tooltip" data-placement="top" title="Edit FAQ" class="btn btn-xs bbw-btn-edit"><i class="fa fa-edit"></i> Edit</a>
										@endcan
										@can('faq-delete')
										<button type="button" class="btn btn-danger btn-xs delete" data-slug="{{ $model->id }}" data-del-url="{{ url('faq', $model->id) }}"><i class="fa fa-trash"></i> Delete</button>
										@endcan
									</div>
								</td>
							</tr>
							@endforeach
							<tr class="bbw-pagination-row">
								<td colspan="6">
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
