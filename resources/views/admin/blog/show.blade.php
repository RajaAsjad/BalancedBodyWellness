@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@include('admin.partials.wellness_crud_theme')

<section class="content bbw-crud-theme" style="margin-bottom: 0;">
	<div class="bbw-form-card">
		<div class="bbw-form-header">
			<h1>{{ $page_title }}</h1>
			<a href="{{ route('blog.index') }}" class="bbw-form-back"><i class="fa fa-list"></i> View all</a>
		</div>
		<div class="bbw-form-body">
			<table class="table table-bordered bbw-show-table" style="margin:0;background:#fff;">
				<tr>
					<th width="180">Image</th>
					<td>
						@if($blog->image)
							<img src="{{ $blog->imageUrl() }}" alt="{{ $blog->name }}" style="max-width:280px;border-radius:8px;">
						@else
							<img src="{{ \App\Models\Services::imagePlaceholderUrl() }}" alt="No image" style="max-width:180px;border-radius:8px;">
						@endif
					</td>
				</tr>
				<tr>
					<th>Title</th>
					<td>{{ $blog->name }}</td>
				</tr>
				<tr>
					<th>Slug</th>
					<td><code>{{ $blog->slug ?: 'N/A' }}</code></td>
				</tr>
				<tr>
					<th>Meta title</th>
					<td>{{ $blog->meta_title ?: 'N/A' }}</td>
				</tr>
				<tr>
					<th>Meta description</th>
					<td>{{ $blog->meta_description ?: 'N/A' }}</td>
				</tr>
				<tr>
					<th>Short description</th>
					<td>{!! $blog->short_description !!}</td>
				</tr>
				<tr>
					<th>Full description</th>
					<td>{!! $blog->description !!}</td>
				</tr>
				<tr>
					<th>Status</th>
					<td>@include('admin.blog.partials.status-badge', ['model' => $blog])</td>
				</tr>
				<tr>
					<th>Publish on</th>
					<td>{{ $blog->published_at ? $blog->published_at->format('d M Y, h:i A') : 'Immediately when active' }}</td>
				</tr>
				<tr>
					<th>Created by</th>
					<td>{{ isset($blog->hasCreatedBy) ? $blog->hasCreatedBy->name : 'N/A' }}</td>
				</tr>
				<tr>
					<th>Created</th>
					<td>{{ $blog->created_at ? $blog->created_at->format('M j, Y g:i A') : 'N/A' }}</td>
				</tr>
			</table>

			<div class="bbw-form-actions" style="margin-top:1.25rem;">
				@can('blog-edit')
				<a href="{{ route('blog.edit', $blog->id) }}" class="btn bbw-btn-submit"><i class="fa fa-edit"></i> Edit</a>
				@endcan
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
</style>
@endpush
