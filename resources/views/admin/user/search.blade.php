
    @foreach($users as $key=>$user)
        @if($user->hasRole('Admin'))
            @continue;
        @endif
        <tr id="id-{{ $user->id }}">
            <td>{{  $users->firstItem()+$key }}.</td>
            <td>
                @if($user->image)
                    <img src="{{ asset('admin/assets/images/UserImage') }}/{{ $user->image }}" style="width:60px;" alt="">
                @else
                    <img src="{{ asset('admin/assets/images/default.jpg') }}" style="width:60px;">
                @endif
            </td>
            <td>{{$user->name}}</td>
            <td>{{$user->last_name??'N/A'}}</td>
            <td>{{$user->phone??'N/A'}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->address}}</td>
            <td>
                @if($user->status)
                    <span class="badge badge-success">Active</span>
                @else
                    <span class="badge badge-danger">In-Active</span>
                @endif
            </td>
            <td>
                @if($user->top_rated)
                    <span class="badge badge-success">YES</span>
                @else
                    <span class="badge badge-danger">NOT</span>
                @endif
            </td>
            <td>
                @can('user-edit')
                    <a href="{{ route('user.edit', $user->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                @endcan
                @can('user-delete')
                    <a class="btn btn-danger btn-xs delete-btn" data-user-id="{{ $user->id }}"><i class="fa fa-trash"></i> Delete</a>
                @endcan
            </td>
        </tr>
    @endforeach
    <tr>
        <td colspan="10">
            {{-- Displying {{$users->firstItem()}} to {{$users->lastItem()}} of {{$users->total()}} records --}}
            <div class="d-flex justify-content-center">
                {!! $users->links('pagination::bootstrap-4') !!}
            </div>
        </td>
    </tr>
