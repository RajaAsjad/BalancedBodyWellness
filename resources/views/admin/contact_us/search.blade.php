@forelse($models as $key=>$model)
<tr id="id-{{ $model->id }}">
	<td>{{ $models->firstItem()+$key }}.</td>
	<td>{{ $model->first_name }} {{ $model->last_name }}</td>
	<td>{{ $model->email }}</td>
	<td>{{ $model->phone }}</td>
	<td>{{ $model->address ?? '—' }}</td>
	<td>{{ \Illuminate\Support\Str::limit($model->message, 50) }}</td>
	<td>
		<div class="contact-action-btns">
			<a href="{{ route('contactus.show', $model->id) }}" data-toggle="tooltip" data-placement="top" title="Show Contact" class="btn btn-show btn-xs"><i class="fa fa-eye"></i> Show</a>
			<button type="button" class="btn btn-danger btn-xs btn-delete delete-contact" data-slug="{{ $model->id }}" data-del-url="{{ url('contactus', $model->id) }}"><i class="fa fa-trash"></i> Delete</button>
		</div>
	</td>
</tr>
@empty
<tr>
	<td colspan="7" class="text-center text-muted py-4">No contacts found.</td>
</tr>
@endforelse
@if($models->hasPages())
<tr>
	<td colspan="7">
		<div class="d-flex flex-column align-items-center">
			<div class="text-muted small mb-2">Displaying {{ $models->firstItem() }} to {{ $models->lastItem() }} of {{ $models->total() }} records</div>
			{!! $models->appends(request()->query())->links('pagination::bootstrap-4') !!}
		</div>
	</td>
</tr>
@endif
