@foreach($models as $key=>$model)
<tr id="id-{{ $model->id }}">
	<td>{{ $models->firstItem()+$key }}.</td>
	<td>{{ $model->name }}</td>
	<td><code>{{ $model->slug }}</code></td>
	<td>{{ $model->sort_order }}</td>
	<td>
		@if($model->show_in_nav)
		<span class="bbw-badge-on">Yes</span>
		@else
		<span class="bbw-badge-off">No</span>
		@endif
	</td>
	<td>
		@if($model->is_legacy)
		<span class="text-muted small">Legacy</span>
		@else
		<span class="text-muted small">New</span>
		@endif
	</td>
	<td>
		@if($model->status)
		<span class="bbw-badge-on">Active</span>
		@else
		<span class="bbw-badge-off">Inactive</span>
		@endif
	</td>
	<td class="bbw-action-td">
		@php $actions = ['itemId' => $model->id]; @endphp
		@can('servicepage-list')
			@php $actions['showUrl'] = route('servicePage.show', $model->id); @endphp
		@endcan
		@can('servicepage-edit')
			@php $actions['editUrl'] = route('servicePage.edit', $model->id); @endphp
		@endcan
		@can('servicepage-delete')
			@php $actions['deleteUrl'] = url('servicePage', $model->id); @endphp
		@endcan
		@include('admin.partials.bbw-table-actions', $actions)
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
