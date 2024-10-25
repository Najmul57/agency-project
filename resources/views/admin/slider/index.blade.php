@extends('admin.admin_master')

@section('admin_content')
    <style>
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
                    <li class="breadcrumb-item active" aria-current="page">Slider List
                        <span class="total_count">{{ $data->count() }}</span>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('slider.create') }}" class="btn btn-info">Add
                    Slider</a>
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
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ !empty($row->banner) ? url('/upload/banner/' . $row->banner) : url('upload/admin_images/no_image.jpg') }}"
                                        width="200px" height="100px" style="object-fit: cover" alt="banner"
                                        class="p-1 bg-primary">
                                </td>
                                <td>
                                    @if ($row->status == 1)
                                        <a href="{{ route('slider.inactive', $row->id) }}" id="inactive"
                                            class="btn btn-sm btn-success">Active</a>
                                    @else
                                        <a href="{{ route('slider.active', $row->id) }}" id="active"
                                            class="btn btn-sm btn-danger">Inactive</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('slider.edit', $row->id) }}" class="btn btn-sm btn-info"><i
                                            class='bx bx-edit'></i></a>
                                    <a href="{{ route('slider.destroy', $row->id) }}" id="delete"
                                        class="btn btn-sm btn-danger"><i class='bx bx-trash'></i></a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
