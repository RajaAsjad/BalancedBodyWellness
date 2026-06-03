@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@include('admin.partials.wellness_crud_theme')

@php $page = $model->toPageArray(); @endphp

<section class="content bbw-crud-theme" style="margin-bottom: 0;">
	<div class="bbw-form-card">
		<div class="bbw-form-header">
			<h1>{{ $page_title }}</h1>
			<div style="position:absolute;right:20px;top:50%;transform:translateY(-50%);display:flex;gap:8px;">
				<a href="{{ $model->publicUrl() }}" class="bbw-form-back" target="_blank" rel="noopener"><i class="fa fa-external-link"></i> Live page</a>
				<a href="{{ route('location.index') }}" class="bbw-form-back"><i class="fa fa-list"></i> View all</a>
			</div>
		</div>
		<div class="bbw-form-body">
			<div class="bbw-form-inner">
				<div class="bbw-form-section">
					<h3 class="bbw-form-section__title">Overview</h3>
					<p><strong>Name:</strong> {{ $model->name }}</p>
					<p><strong>Slug:</strong> <code>{{ $model->slug }}</code></p>
					<p><strong>Status:</strong> {{ $model->status ? 'Active' : 'Inactive' }}</p>
					<p><strong>Sort order:</strong> {{ $model->sort_order }}</p>
				</div>

				@if($model->image)
				<div class="bbw-form-section">
					<h3 class="bbw-form-section__title">Image</h3>
					<img src="{{ $model->cardImageUrl() }}" alt="{{ $model->name }}" style="max-width:200px;border-radius:8px;">
				</div>
				@endif

				<div class="bbw-form-section">
					<h3 class="bbw-form-section__title">Hero preview</h3>
					<p class="text-muted small">{{ $page['hero']['eyebrow'] ?? '—' }}</p>
					<h4>{{ $page['hero']['title_main'] ?? '—' }}</h4>
					<p>{{ $page['hero']['lead'] ?? '—' }}</p>
				</div>

				<div class="bbw-form-actions">
					@can('location-edit')
					<a href="{{ route('location.edit', $model->id) }}" class="bbw-btn-submit"><i class="fa fa-edit"></i> Edit location</a>
					@endcan
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@push('css')
<style>
.bbw-form-section { margin-bottom: 28px; padding-bottom: 8px; border-bottom: 1px solid rgba(45,106,98,0.1); }
.bbw-form-section__title { font-size: 15px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.4px; color: #2d6a62; margin: 0 0 16px; }
</style>
@endpush
