@extends('admin.admin_master')

@section('admin_content')
    <style>
        .modal-body {
            overflow-wrap: break-word;
            word-wrap: break-word;
            white-space: normal;
        }

        tr td {
            vertical-align: middle
        }
    </style>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Service List
                        <span class="total_count">{{ $data->count() }}</span>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                @if (auth()->user()->can('Services-Add'))
                    <a href="{{ route('service.create') }}" class="btn btn-info">Add
                        Service</a>
                @endif
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered example2">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Short Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ !empty($row->image) ? url('/upload/service/' . $row->image) : url('upload/admin_images/no_image.jpg') }}"
                                        width="68px" height="68px" style="object-fit: cover" alt="Admin"
                                        class="p-1 bg-primary">
                                </td>
                                <td>{{ ucfirst($row->title) }}</td>
                                <td>{{ Str::words($row->short_description, 5, '...') }} </td>
                                <td>
                                    @if ($row->status == 1)
                                        @if (auth()->user()->can('Services-Inactive'))
                                            <a href="{{ route('service.inactive', $row->id) }}" id="inactive"
                                                class="btn btn-sm btn-success">Active</a>
                                                @endif
                                        @else
                                        @if (auth()->user()->can('Services-Active'))
                                            <a href="{{ route('service.active', $row->id) }}" id="active"
                                                class="btn btn-sm btn-danger">Inactive</a>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if (auth()->user()->can('Services-Show'))
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#modal{{ $row->id }}" class="btn btn-sm btn-primary"><i
                                                class='bx bx-show'></i></a>
                                    @endif
                                    @if (auth()->user()->can('Services-Update'))
                                        <a href="{{ route('service.edit', $row->id) }}" class="btn btn-sm btn-info"><i
                                                class='bx bx-edit'></i></a>
                                    @endif
                                    @if (auth()->user()->can('Services-Delete'))
                                        <a href="{{ route('service.destroy', $row->id) }}" id="delete"
                                            class="btn btn-sm btn-danger"><i class='bx bx-trash'></i></a>
                                    @endif
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="modal{{ $row->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ ucfirst($row->title) }}
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {!! $row->long_description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Short Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
