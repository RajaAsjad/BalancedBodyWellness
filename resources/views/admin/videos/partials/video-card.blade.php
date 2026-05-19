@php
	$thumbUrl = $model->thumbnailDisplayUrl();
@endphp
<article class="video-item-card" id="id-{{ $model->id }}">
	<div class="video-item-card__hero {{ $thumbUrl ? 'video-item-card__hero--has-thumb' : '' }}">
		@if ($thumbUrl)
			<img class="video-item-card__hero-thumb" src="{{ $thumbUrl }}" alt="" loading="lazy" decoding="async" width="640" height="360">
		@endif
		<div class="video-item-card__hero-inner">
			<span class="video-item-card__sl">#{{ $models->firstItem() + $key }}</span>
			<h3 class="video-item-card__heading">{{ $model->heading }}</h3>
		</div>
		@canany(['video-edit', 'video-delete'])
		<div class="video-item-card__fab">
			@can('video-edit')
			<a href="{{ route('video.edit', $model->id) }}" data-toggle="tooltip" data-placement="left" title="Edit" class="video-item-card__fab-btn" aria-label="Edit video"><i class="fa fa-pencil" aria-hidden="true"></i></a>
			@endcan
			@can('video-delete')
			<button type="button" class="video-item-card__fab-btn video-item-card__fab-btn--danger delete" data-slug="{{ $model->id }}" data-del-url="{{ url('video', $model->id) }}" title="Delete" aria-label="Delete video"><i class="fa fa-trash" aria-hidden="true"></i></button>
			@endcan
		</div>
		@endcanany
	</div>
	<div class="video-item-card__body">
		<p class="video-item-card__title">{{ $model->title }}</p>
		<a href="{{ $model->video_url }}" target="_blank" rel="noopener noreferrer" class="video-item-card__url">{{ $model->video_url }}</a>
		<div class="video-item-card__badges">
			<div class="video-item-card__badges-left">
				@if($model->featured == 1 || $model->featured === '1')
				<span class="video-badge-featured">Featured</span>
				@else
				<span class="video-badge-not-featured">Not featured</span>
				@endif
			</div>
			<div class="video-item-card__badges-right">
				@if($model->status == 1 || $model->status === '1')
				<span class="video-badge-active">Publish</span>
				@else
				<span class="video-badge-inactive">Draft</span>
				@endif
			</div>
		</div>
	</div>
</article>
