@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@include('admin.partials.wellness_crud_theme')

<section class="content bbw-crud-theme" style="margin-bottom: 0;">
	<div class="bbw-form-card">
		<div class="bbw-form-header">
			<h1>{{ $page_title }}</h1>
			<div>
				<a href="{{ $model->publicUrl() }}" class="btn btn-default btn-sm" target="_blank" rel="noopener"><i class="fa fa-external-link"></i> Live page</a>
				@can('servicepage-edit')
				<a href="{{ route('servicePage.edit', $model->id) }}" class="bbw-form-back"><i class="fa fa-pencil"></i> Edit</a>
				@endcan
				<a href="{{ route('servicePage.index') }}" class="bbw-form-back"><i class="fa fa-list"></i> View all</a>
			</div>
		</div>
		<div class="bbw-form-body">
			<div class="bbw-form-inner">
				<table class="table table-bordered">
					<tr><th width="200">Name</th><td>{{ $model->name }}</td></tr>
					<tr><th>Nav label</th><td>{{ $model->nav_label ?: '—' }}</td></tr>
					<tr><th>Slug</th><td><code>{{ $model->slug }}</code> — <a href="{{ $model->publicUrl() }}" target="_blank" rel="noopener">{{ $model->publicUrl() }}</a></td></tr>
					<tr><th>Meta title</th><td>{{ $model->meta_title ?: '—' }}</td></tr>
					<tr><th>Meta description</th><td>{{ $model->meta_description ?: '—' }}</td></tr>
					<tr><th>Sort order</th><td>{{ $model->sort_order }}</td></tr>
					<tr><th>Show in nav</th><td>{{ $model->show_in_nav ? 'Yes' : 'No' }}</td></tr>
					<tr><th>Type</th><td>{{ $model->is_legacy ? 'Legacy (imported from config)' : 'Admin-created' }}</td></tr>
					<tr><th>Status</th><td>{{ $model->status ? 'Active' : 'Inactive' }}</td></tr>
				</table>

				@php $hero = $model->hero ?? []; @endphp
				@if(!empty($hero))
				<h4 class="mt-4">Hero</h4>
				<ul>
					@if(!empty($hero['eyebrow']))<li><strong>Eyebrow:</strong> {{ $hero['eyebrow'] }}</li>@endif
					@if(!empty($hero['title_main']))<li><strong>Title main:</strong> {{ $hero['title_main'] }}</li>@endif
					@if(!empty($hero['title_accent']))<li><strong>Title accent:</strong> {{ $hero['title_accent'] }}</li>@endif
					@if(!empty($hero['lead']))<li><strong>Lead:</strong> {{ $hero['lead'] }}</li>@endif
				</ul>
				@endif

				@php $overview = $model->overview ?? []; @endphp
				@if(!empty($overview))
				<h4 class="mt-4">Overview</h4>
				<p><strong>{{ $overview['title'] ?? '' }}</strong></p>
				<p class="text-muted">{{ count($overview['paragraphs'] ?? []) }} paragraph(s), {{ count($overview['features'] ?? []) }} feature card(s)</p>
				@endif

				@php $drip = $model->drip_menu ?? []; @endphp
				@if(!empty($drip))
				<h4 class="mt-4">Drip menu</h4>
				<p>{{ $drip['title'] ?? '' }} — {{ count($drip['items'] ?? []) }} item(s)</p>
				@endif

				@php $supports = $model->supports ?? []; @endphp
				@if(!empty($supports))
				<h4 class="mt-4">Supports section</h4>
				<p><strong>{{ $supports['title'] ?? '' }}</strong></p>
				<p class="text-muted">{{ count($supports['items'] ?? []) }} item(s), {{ count($supports['stats'] ?? []) }} stat(s)</p>
				@endif
			</div>
		</div>
	</div>
</section>
@endsection
