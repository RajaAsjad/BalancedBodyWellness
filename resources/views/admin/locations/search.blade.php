@foreach($models as $key=>$model)
<tr id="id-{{ $model->id }}">
	<td>{{ $models->firstItem()+$key }}.</td>
	<td>
		<img src="{{ $model->cardImageUrl() }}" alt="{{ $model->name }}" width="56" height="56" style="object-fit:cover;border-radius:8px;">
	</td>
	<td>{{ $model->name }}</td>
	<td><code>{{ $model->slug }}</code></td>
	<td>{{ $model->sort_order }}</td>
	<td>
		@if($model->status)
		<span class="bbw-badge-on">Active</span>
		@else
		<span class="bbw-badge-off">Inactive</span>
		@endif
	</td>
	<td class="bbw-action-td">
		@php $locationActions = ['itemId' => $model->id]; @endphp
		@can('location-list')
			@php $locationActions['showUrl'] = route('location.show', $model->id); @endphp
		@endcan
		@can('location-edit')
			@php $locationActions['editUrl'] = route('location.edit', $model->id); @endphp
		@endcan
		@can('location-delete')
			@php $locationActions['deleteUrl'] = url('location', $model->id); @endphp
		@endcan
		@include('admin.partials.bbw-table-actions', $locationActions)
	</td>
</tr>
@endforeach
<tr class="bbw-pagination-row">
	<td colspan="7">
		<div class="d-flex justify-content-center flex-wrap">
			{!! $models->links('pagination::bootstrap-4') !!}
		</div>
	</td>
</tr>
