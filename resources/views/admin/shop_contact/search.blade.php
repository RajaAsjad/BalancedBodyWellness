@forelse($models as $key=>$model)
<tr id="id-{{ $model->id }}">
	<td>{{ $models->firstItem()+$key }}.</td>
	<td>{{ $model->name }}</td>
	<td>{{ $model->email }}</td>
	<td>{{ $model->phone }}</td>
	<td>{{ \Illuminate\Support\Str::limit($model->message, 50) }}</td>
	<td>
		<div class="shop-contact-action-btns">
			<a href="{{ route('shopcontact.show', $model->id) }}" data-toggle="tooltip" data-placement="top" title="Show" class="btn btn-show btn-xs"><i class="fa fa-eye"></i> Show</a>
			<button type="button" class="btn btn-danger btn-xs btn-delete delete-shop-contact" data-slug="{{ $model->id }}" data-del-url="{{ url('shopcontact', $model->id) }}"><i class="fa fa-trash"></i> Delete</button>
		</div>
	</td>
</tr>
@empty
<tr>
	<td colspan="6" class="text-center text-muted py-4">No contacts found.</td>
</tr>
@endforelse
@if($models->hasPages())
<tr>
	<td colspan="6">
		<div class="d-flex flex-column align-items-center">
			<div class="text-muted small mb-2">Displaying {{ $models->firstItem() }} to {{ $models->lastItem() }} of {{ $models->total() }} records</div>
			{!! $models->appends(request()->query())->links('pagination::bootstrap-4') !!}
		</div>
	</td>
</tr>
@endif
