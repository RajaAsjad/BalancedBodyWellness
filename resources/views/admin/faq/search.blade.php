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
	<td class="bbw-action-td">
		@php $faqActions = ['itemId' => $model->id]; @endphp
		@can('faq-list')
			@php $faqActions['showUrl'] = route('faq.show', $model->id); @endphp
		@endcan
		@can('faq-edit')
			@php $faqActions['editUrl'] = route('faq.edit', $model->id); @endphp
		@endcan
		@can('faq-delete')
			@php $faqActions['deleteUrl'] = url('faq', $model->id); @endphp
		@endcan
		@include('admin.partials.bbw-table-actions', $faqActions)
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
