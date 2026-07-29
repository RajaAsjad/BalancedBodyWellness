@if(!$model->status)
	<span class="bbw-badge-off">Inactive</span>
@elseif($model->isScheduled())
	<span class="bbw-badge-on" style="background:#c9a157;">Scheduled</span>
	@if($model->published_at)
		<br><small class="text-muted">{{ $model->published_at->format('d-m-Y h:i A') }}</small>
	@endif
@else
	<span class="bbw-badge-on">Active</span>
@endif
