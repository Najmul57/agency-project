@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Success List
                        <span class="total_count">{{ $data->count() }}</span>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                    <a href="{{ route('success.create') }}" class="btn btn-info">Add Success</a>
              
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
                            <th>Title</th>
                            <th>Count</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ ucwords($row->title) }}</td>
                                <td>{{ $row->count }}</td>
                                <td>
                                    <img src="{{ !empty($row->image) ? url('/upload/success/' . $row->image) : url('upload/admin_images/no_image.jpg') }}"
                                        width="100px" height="100px" style="object-fit: cover" alt="Admin">
                                </td>
                                <td>
                                    @if ($row->status == 1)
                                            <a href="{{ route('success.inactive', $row->id) }}" id="inactive"
                                                class="btn btn-sm btn-success">Active</a>
                                       f
                                    @else
                                            <a href="{{ route('success.active', $row->id) }}" id="active"
                                                class="btn btn-sm btn-danger">Inactive</a>
                                       
                                    @endif
                                </td>

                                <td>
                                        <a href="{{ route('success.edit', $row->id) }}" class="btn btn-sm btn-info"><i
                                                class='bx bx-edit'></i></a>
                                        <a href="{{ route('success.destroy', $row->id) }}" id="delete"
                                            class="btn btn-sm btn-danger"><i class='bx bx-trash'></i></a>
                                   
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Title</th>
                            <th>Count</th>
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
