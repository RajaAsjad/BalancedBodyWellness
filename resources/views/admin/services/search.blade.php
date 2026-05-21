@foreach($models as $key=>$model)
<tr id="id-{{ $model->id }}">
	<td>{{ $models->firstItem()+$key }}.</td>
	<td>{{ \Illuminate\Support\Str::limit($model->heading, 40) }}</td> 
	<td>{{ \Illuminate\Support\Str::limit(strip_tags($model->description), 60) }}</td> 
	<td>{{ $model->listPreview('benefits') }}</td>
	<td>{{ $model->listPreview('questions') }}</td> 
	<td> 
		@if($model->status)
		<span class="bbw-badge-on">Active</span>
		@else
		<span class="bbw-badge-off">Inactive</span>
		@endif
	</td>
	<td>{{ isset($model->hasCreatedBy) ? $model->hasCreatedBy->name : 'N/A' }}</td>
	<td class="bbw-action-td">
		@php $serviceActions = ['itemId' => $model->id]; @endphp
		@can('service-list')
			@php $serviceActions['showUrl'] = route('service.show', $model->id); @endphp
		@endcan
		@can('service-edit')
			@php $serviceActions['editUrl'] = route('service.edit', $model->id); @endphp
		@endcan
		@can('service-delete')
			@php $serviceActions['deleteUrl'] = url('service', $model->id); @endphp
		@endcan
		@include('admin.partials.bbw-table-actions', $serviceActions)
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