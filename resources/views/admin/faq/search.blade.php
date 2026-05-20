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
