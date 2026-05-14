@foreach($models as $key=>$model)
<tr id="id-{{ $model->id }}">
	<td>{{ $models->firstItem()+$key }}.</td>
	<td>{{ \Illuminate\Support\Str::limit($model->title, 40) }}</td>
	<td>{{ \Illuminate\Support\Str::limit(strip_tags($model->description), 60) }}</td>
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
			@can('policy-edit')
			<a href="{{ route('policy.edit', $model->id) }}" data-toggle="tooltip" data-placement="top" title="Edit policy" class="btn btn-xs bbw-btn-edit"><i class="fa fa-edit"></i> Edit</a>
			@endcan
			@can('policy-delete')
			<button type="button" class="btn btn-danger btn-xs delete" data-slug="{{ $model->id }}" data-del-url="{{ url('policy', $model->id) }}"><i class="fa fa-trash"></i> Delete</button>
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
