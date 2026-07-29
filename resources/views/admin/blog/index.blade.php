@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@include('admin.partials.wellness_crud_theme')
<input type="hidden" id="page_url" value="{{ route('blog.index') }}">

<section class="content-header bbw-crud-theme" style="margin-bottom: 0;">
	<div class="bbw-crud-card">
		<div class="bbw-crud-header">
			<h1>{{ $page_title }}</h1>
			@can('blog-create')
			<a href="{{ route('blog.create') }}" class="bbw-crud-add"><i class="fa fa-plus"></i> Add Blog</a>
			@endcan
		</div>

		<div class="bbw-crud-toolbar">
			<input type="text" id="search" class="form-control" placeholder="Search by title, slug, or meta…" aria-label="Search blogs">
			<select id="status" class="form-control status" aria-label="Filter by status">
				<option value="All" selected>All statuses</option>
				<option value="1">Active</option>
				<option value="3">Scheduled</option>
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
								<th>Blog Title</th>
								<th>Short Description</th>
								<th width="110">Status</th>
								<th width="110">Created at</th>
								<th width="110">Created by</th>
								<th class="bbw-action-td">Action</th>
							</tr>
						</thead>
						<tbody id="body">
							@foreach($models as $key=>$model)
							<tr id="id-{{ $model->id }}">
								<td>{{ $models->firstItem()+$key }}.</td>
								<td>
									@if($model->image)
									<img src="{{ asset('admin/assets/images/blog') }}/{{ $model->image }}" alt="{{ $model->name }}" width="56" height="56" style="object-fit:cover;border-radius:8px;">
									@else
									<img src="{{ \App\Models\Services::imagePlaceholderUrl() }}" alt="No image" width="56" height="56" style="object-fit:cover;border-radius:8px;">
									@endif
								</td>
								<td>{{ $model->name }}</td>
								<td>{{ \Illuminate\Support\Str::limit(strip_tags($model->short_description), 50) }}</td>
								<td>@include('admin.blog.partials.status-badge', ['model' => $model])</td>
								<td>{{ $model->created_at->format('d-m-Y') }}</td>
								<td>{{ isset($model->hasCreatedBy) ? $model->hasCreatedBy->name : 'N/A' }}</td>
								<td class="bbw-action-td">
									@php $blogActions = ['itemId' => $model->id]; @endphp
									@can('blog-list')
										@php $blogActions['showUrl'] = route('blog.show', $model->id); @endphp
									@endcan
									@can('blog-edit')
										@php $blogActions['editUrl'] = route('blog.edit', $model->id); @endphp
									@endcan
									@can('blog-delete')
										@php $blogActions['deleteUrl'] = url('blog', $model->id); @endphp
									@endcan
									@include('admin.partials.bbw-table-actions', $blogActions)
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
