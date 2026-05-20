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
			<input type="text" id="search" class="form-control" placeholder="Search question or answer…" aria-label="Search FAQs">
			<select id="page_key" class="form-control" aria-label="Filter by page">
				<option value="All" selected>All pages</option>
				@foreach ($faqPages as $key => $label)
					<option value="{{ $key }}">{{ $label }}</option>
				@endforeach
			</select>
			<select id="status" class="form-control status" aria-label="Filter by status">
				<option value="All" selected>All statuses</option>
				<option value="1">Active</option>
				<option value="2">Inactive</option>
			</select>
			<button type="button" class="btn btn-primary btn-sm" id="btn-filter" style="white-space:nowrap;"><i class="fa fa-filter"></i> Filter</button>
		</div>

		<div class="bbw-crud-body"> 
			<div class="bbw-crud-table-wrap">
				<div class="table-responsive p-0">
					<table class="table table-hover bbw-crud-table mb-0">
						<thead>
							<tr>
								<th width="56">SL</th>
								<th {{-- width="140" --}}>Page</th>
								<th>Question</th>
								<th>Answer</th>
								<th width="72">Order</th>
								<th width="90">Status</th>
								<th width="110">Created by</th>
								<th width="220">Action</th>
							</tr>
						</thead>
						<tbody id="body">
							@foreach($models as $key=>$model)
							<tr id="id-{{ $model->id }}">
								<td>{{ $models->firstItem()+$key }}.</td>
								<td><span class="bbw-badge-on" style="background:#1a3f3c;">{{ $model->displayPageLabel() }}</span></td>
								<td>{{ \Illuminate\Support\Str::limit($model->question, 40) }}</td>
								<td>{{ \Illuminate\Support\Str::limit(strip_tags($model->answer), 50) }}</td>
								<td>{{ $model->sort_order ?? 0 }}</td>
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
										@can('faq-list')
										<a href="{{ route('faq.show', $model->id) }}" class="btn btn-default btn-xs" title="View"><i class="fa fa-eye"></i></a>
										@endcan
										@can('faq-edit')
										<a href="{{ route('faq.edit', $model->id) }}" class="btn btn-xs bbw-btn-edit"><i class="fa fa-edit"></i> Edit</a>
										@endcan
										@can('faq-delete')
										<button type="button" class="btn btn-danger btn-xs delete" data-slug="{{ $model->id }}" data-del-url="{{ url('faq', $model->id) }}"><i class="fa fa-trash"></i></button>
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
<script>
$(document).ready(function() {
	function loadFaqs() {
		var pageurl = $('#page_url').val();
		var search = $('#search').val();
		var status = $('#status').val();
		var page_key = $('#page_key').val();
		$.get(pageurl, {
			page: 1,
			search: search,
			status: status,
			page_key: page_key
		}, function(response) {
			$('#body').html(response);
		});
	}
	$('#btn-filter').on('click', loadFaqs);
	$('#search').on('keypress', function(e) {
		if (e.which === 13) {
			e.preventDefault();
			loadFaqs();
		}
	});
});
</script>
@endpush
