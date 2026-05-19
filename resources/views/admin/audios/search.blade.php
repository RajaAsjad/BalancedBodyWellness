@foreach($audios as $key=>$audio)
<tr id="id-{{ $audio->id }}">
    <td>{{ $audios->firstItem()+$key }}.</td>
    <td>{{ $audio->title }}</td>
    <td>{{ $audio->file }}</td>
    <td>
        @if($audio->status)
        <span class="label label-success">Active</span>
        @else
        <span class="label label-danger">In-Active</span>
        @endif
    </td>
    <td>
        <div class="audio-action-btns">
            @can('audio-edit')
            <a href="{{ route('audio.edit', $audio->id) }}" data-toggle="tooltip" data-placement="top" title="Edit Audio" class="btn btn-edit btn-xs"><i class="fa fa-edit"></i> Edit</a>
            @endcan
            @can('audio-delete')
            <button type="button" class="btn btn-danger btn-xs btn-delete delete-audio" data-slug="{{ $audio->id }}" data-del-url="{{ url('audio', $audio->id) }}"><i class="fa fa-trash"></i> Delete</button>
            @endcan
        </div>
    </td>
</tr>
@endforeach
@if($audios->hasPages())
<tr>
    <td colspan="5">
        <div class="d-flex flex-column align-items-center">
            <div class="text-muted small mb-2">Displaying {{ $audios->firstItem() }} to {{ $audios->lastItem() }} of {{ $audios->total() }} records</div>
            {!! $audios->appends(request()->query())->links('pagination::bootstrap-4') !!}
        </div>
    </td>
</tr>
@endif
