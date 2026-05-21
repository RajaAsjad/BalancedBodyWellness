{{-- View / Edit / Delete — single row, wellness theme. Pass showUrl, editUrl, deleteUrl, itemId --}}
<div class="bbw-action-cell">
	@if (!empty($showUrl))
		<a href="{{ $showUrl }}" class="bbw-btn-view" title="{{ $showTitle ?? 'View details' }}">
			<i class="fa fa-eye" aria-hidden="true"></i><span>View</span>
		</a>
	@endif
	@if (!empty($editUrl))
		<a href="{{ $editUrl }}" class="bbw-btn-edit" title="{{ $editTitle ?? 'Edit' }}">
			<i class="fa fa-edit" aria-hidden="true"></i><span>Edit</span>
		</a>
	@endif
	@if (!empty($deleteUrl))
		<button type="button" class="btn btn-danger btn-xs delete bbw-btn-delete" data-slug="{{ $itemId }}" data-del-url="{{ $deleteUrl }}" title="{{ $deleteTitle ?? 'Delete' }}">
			<i class="fa fa-trash" aria-hidden="true"></i><span>Delete</span>
		</button>
	@endif
</div>
