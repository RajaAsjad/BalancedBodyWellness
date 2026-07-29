@foreach($models as $key=>$model)
<tr id="id-{{ $model->id }}">
	<td>{{ $models->firstItem()+$key }}.</td>
	<td>
		@if($model->image)
		<img src="{{ $model->imageUrl() }}" alt="{{ $model->name }}" width="56" height="56" style="object-fit:cover;border-radius:8px;">
		@else
		<img src="{{ \App\Models\Services::imagePlaceholderUrl() }}" alt="No image" width="56" height="56" style="object-fit:cover;border-radius:8px;">
		@endif
	</td>
	<td>{{ $model->name }}</td>
	<td>{{ \Illuminate\Support\Str::limit(strip_tags($model->short_description), 50) }}</td>
	<td>@include('admin.blog.partials.status-badge', ['model' => $model])</td>
	<td>{{ $model->created_at->format('d-m-Y') }}</td>
	<td>{{ isset($model->hasCreatedBy) ? $model->hasCreatedBy->name : 'N/A' }}</td>
	<td class="bbw-action-td">
		@php $blogActions = ['itemId' => $model->id]; @endphp
		@can('blog-list')
			@php $blogActions['showUrl'] = route('blog.show', $model->id); @endphp
		@endcan
		@can('blog-edit')
			@php $blogActions['editUrl'] = route('blog.edit', $model->id); @endphp
		@endcan
		@can('blog-delete')
			@php $blogActions['deleteUrl'] = url('blog', $model->id); @endphp
		@endcan
		@include('admin.partials.bbw-table-actions', $blogActions)
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
