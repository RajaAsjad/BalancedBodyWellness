@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<input type="hidden" id="page_url" value="{{ route('weblinks.index') }}">
<section class="content-header">
    <div class="content-header-left">
        <h1>All Web Links</h1>
    </div>
    @can('weblinks-create')
    <div class="content-header-right">
        <a href="{{ route('weblinks.create') }}" class="btn btn-primary btn-sm">Add New Web Link</a>
    </div>
    @endcan
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
            <div class="callout callout-success">
                {{ session('status') }}
            </div>
            @endif

            <div class="box box-info">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="d-flex col-sm-8" style="margin-bottom:10px">
                            <input type="text" id="search" class="form-control"
                                placeholder="Search by: Project Name">
                        </div>
                        <div class="d-flex col-sm-2">
                            <select name="" id="status" class="form-control status" style="margin-bottom:5px">
                                <option value="All" selected>Search by status</option>
                                <option value="1">Active</option>
                                <option value="0">In-Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table id="" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>UI DESIGN</th>
                                    <th>Project Name</th>
                                    <th>Brand Name</th>
                                    <th>Description</th> 
                                    <th>Status</th>
                                    <th width="220">Action</th>
                                </tr>
                            </thead>
                            <tbody id="body">
                                @foreach ($models as $key => $model)
                                <tr id="id-{{ $model->slug }}">
                                    <td>{{ $models->firstItem() + $key }}.</td>
                                    <td>
										@if($model->image)
										<img src="{{ asset('admin/assets/images/weblinks/'.$model->image) }}" alt="" style="width:60px;">
										@else
										<img src="{{ asset('admin/assets/images/default.jpg') }}" style="width:60px;">
										@endif
									</td>
                                    <td>{!! \Illuminate\Support\Str::limit($model->name ?? 'N/A', 50) !!}</td>
                                    <td>{!! \Illuminate\Support\Str::limit($model->brand_name ?? 'N/A', 50) !!}</td>
                                    <td>{{\Illuminate\Support\Str::limit($model->description,40)}}</td>
                                
                                    <td>
                                        @if ($model->status)
                                        <span class="label label-success">Active</span>
                                        @else
                                        <span class="label label-danger">In-Active</span>
                                        @endif
                                    </td>
                                    <td> 
                                        <a href="{{ route('show', ['brand' => $model->hasBrand->slug, 'weblink' => $model->slug]) }}" class="btn btn-info btn-xs" target="_blank">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        @can('weblinks-edit')
                                        <a href="{{ route('weblinks.edit', $model->slug) }}"
                                            data-toggle="tooltip" data-placement="top" title="Edit project"
                                            class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                        @endcan
                                        @can('weblinks-delete')
                                        <button class="btn btn-danger btn-xs delete"
                                            data-slug="{{ $model->slug }}"
                                            data-del-url="{{ url('weblinks', $model->slug) }}">
                                            <i class="fa fa-trash"></i> Delete</button>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="13">
                                        Displying {{ $models->firstItem() }} to {{ $models->lastItem() }} of
                                        {{ $models->total() }} records
                                        <div class="d-flex justify-content-center">
                                            {!! $models->links('pagination::bootstrap-4') !!}
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')

@endpush