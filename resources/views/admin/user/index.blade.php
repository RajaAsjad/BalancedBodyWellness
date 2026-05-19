@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<input type="hidden" id="page_url" value="{{ route('user.index') }}">
<section class="content-header">
    <div class="content-header-left">
        <h1>All Agents</h1>
    </div>
    {{-- @can('user-create')
    <div class="content-header-right">
        <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">Add New</a>
    </div>
    @endcan --}}
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            @if (session('success'))
                <div class="callout callout-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="box box-info">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-1">Search:</div>
                        <div class="d-flex col-sm-6">
                            <input type="text" id="search" class="form-control" placeholder="Search">
                        </div>
                        <div class="d-flex col-sm-5">
                            <select name="" id="status" class="form-control status" style="margin-bottom:5px">
                                <option value="All" selected>Search by status</option>
                                <option value="1">Active</option>
                                <option value="2">In-Active</option>
                            </select>
                        </div>
                    </div>
                    <table id="" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Image</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone</th>
                                <th>E-mail</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Top Rated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="body">
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</section>
@endsection

@push('js')
@endpush
