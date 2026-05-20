@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@include('admin.partials.wellness_crud_theme')

<section class="content bbw-crud-theme" style="margin-bottom: 0;">
	<div class="bbw-form-card">
		<div class="bbw-form-header">
			<h1>{{ $page_title }}</h1>
			<a href="{{ route('faq.index') }}" class="bbw-form-back"><i class="fa fa-list"></i> View all</a>
		</div>
		<div class="bbw-form-body">
			<table class="table table-bordered" style="margin:0;background:#fff;">
				<tr>
					<th width="180">Website page</th>
					<td><span class="bbw-badge-on" style="background:#1a3f3c;">{{ $model->displayPageLabel() }}</span> <code>{{ $model->page_key }}</code></td>
				</tr>
				@if ($model->service_id)
				<tr>
					<th>Service</th>
					<td>{{ $model->service?->heading ?? 'Service #' . $model->service_id }}</td>
				</tr>
				@endif
				<tr>
					<th>Display order</th>
					<td>{{ $model->sort_order ?? 0 }}</td>
				</tr>
				<tr>
					<th>Question</th>
					<td>{{ $model->question }}</td>
				</tr>
				<tr>
					<th>Answer</th>
					<td style="white-space:pre-wrap;">{{ $model->answer }}</td>
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
					<th>Created by</th>
					<td>{{ $model->hasCreatedBy->name ?? 'N/A' }}</td>
				</tr>
				<tr>
					<th>Created</th>
					<td>{{ $model->created_at?->format('M j, Y g:i A') }}</td>
				</tr>
			</table>
			<div class="bbw-form-actions" style="margin-top:1.25rem;">
				@can('faq-edit')
				<a href="{{ route('faq.edit', $model->id) }}" class="btn bbw-btn-submit"><i class="fa fa-edit"></i> Edit</a>
				@endcan
			</div>
		</div>
	</div>
</section>
@endsection
