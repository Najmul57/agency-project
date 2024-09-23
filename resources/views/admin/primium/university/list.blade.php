@extends('admin.admin_master')

@section('admin_content')
    <style>
        .modal-body {
            overflow-wrap: break-word;
            word-wrap: break-word;
            white-space: normal;
        }
    </style>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"> University List <span
                            class="total_count">{{ $data->count() }}</span></li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('primium.university.create') }}" class="btn btn-info">Add University</a>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Photo</th>
                            <th>INT Number</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ ucwords($row->name) }}</td>
                                <td>{{ $row->email }}</td>
                                <td><img src="{{ asset('upload/university/' . $row->thumbnail) }}" alt=""
                                        width="100px"></td>
                                <td>{{ $row->university_id }}</td>
                                <td>{{ ucfirst($row->country->name ?? '') }}</td>
                                <td>
                                    @if ($row->status == 1)
                                        <a href="{{ route('primium.university.inactive', $row->id) }}" id="inactive"
                                            class="btn btn-sm btn-success">Active</a>
                                    @else
                                        <a href="{{ route('primium.university.active', $row->id) }}" id="active"
                                            class="btn btn-sm btn-danger">Inactive</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                        data-bs-target="#modal{{ $row->id }}" class="btn btn-sm btn-primary"><i
                                            class='bx bx-show'></i></a>
                                    <a href="{{ route('primium.university.edit', $row->id) }}"
                                        class="btn btn-sm btn-info"><i class='bx bx-edit'></i></a>
                                    <a href="{{ route('primium.university.destroy', $row->id) }}" id="delete"
                                        class="btn btn-sm btn-danger"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>


                            <!-- Modal -->
                            <div class="modal fade" id="modal{{ $row->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title fs-5" id="exampleModalLabel">{{ ucwords($row->name) }}
                                            </h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {!! $row->about !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Photo</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
