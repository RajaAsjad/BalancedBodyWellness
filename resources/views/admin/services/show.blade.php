@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@include('admin.partials.wellness_crud_theme')

<section class="content bbw-crud-theme" style="margin-bottom: 0;">
	<div class="bbw-form-card">
		<div class="bbw-form-header">
			<h1>{{ $page_title }}</h1>
			<a href="{{ route('service.index') }}" class="bbw-form-back"><i class="fa fa-list"></i> View all</a>
		</div>
		<div class="bbw-form-body">
			<table class="table table-bordered" style="margin:0;background:#fff;">
				<tr>
					<th width="180">Heading</th>
					<td>{{ $model->heading }}</td>
				</tr>
				<tr>
					<th>Description</th>
					<td style="white-space:pre-wrap;">{{ $model->description }}</td>
				</tr>
				<tr>
					<th>Description image</th>
					<td>
						<img src="{{ $model->imageUrl('description_image') }}" alt="Description" style="max-width:280px;border-radius:8px;">
					</td>
				</tr>
				<tr>
					<th>Benefits</th>
					<td>
						<ul style="margin:0;padding-left:1.2rem;">
							@foreach ($model->displayList('benefits') as $benefit)
								<li>{{ $benefit }}</li>
							@endforeach
						</ul>
					</td>
				</tr>
				<tr>
					<th>Benefit image</th>
					<td>
						<img src="{{ $model->imageUrl('benefit_image') }}" alt="Benefits" style="max-width:280px;border-radius:8px;">
					</td>
				</tr>
				<tr>
					<th>Questions</th>
					<td>
						<ul style="margin:0;padding-left:1.2rem;">
							@foreach ($model->displayList('questions') as $question)
								<li>{{ $question }}</li>
							@endforeach
						</ul>
					</td>
				</tr>
				<tr>
					<th>Question image</th>
					<td>
						<img src="{{ $model->imageUrl('question_image') }}" alt="Questions" style="max-width:280px;border-radius:8px;">
					</td>
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
			</table>
			<div class="bbw-form-actions" style="margin-top:1.25rem;">
				@can('service-edit')
				<a href="{{ route('service.edit', $model->id) }}" class="btn bbw-btn-submit"><i class="fa fa-edit"></i> Edit</a>
				@endcan
			</div>
		</div>
	</div>
</section>
@endsection
