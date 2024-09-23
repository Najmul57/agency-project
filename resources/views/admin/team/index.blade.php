@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Team List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.team.create') }}" class="btn btn-info">Add Team</a>
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
                            <th>Photo</th>
                            <th>Facebook</th>
                            <th>Youtube</th>
                            <th>Instagram</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ ucfirst($row->name) }}</td>
                                <td>
                                    <img src="{{ !empty($row->image) ? url('/upload/team/' . $row->image) : url('upload/admin_images/no_image.jpg') }}"
                                        width="100px" height="100px" style="object-fit: cover" alt="Admin"
                                        class="p-1 bg-primary">
                                </td>
                                <td>{{ $row->facebook }}</td>
                                <td>{{ $row->youtube }}</td>
                                <td>{{ $row->instagram }}</td>

                                <td>
                                    <a href="{{ route('admin.team.edit', $row->id) }}" class="btn btn-sm btn-info"><i
                                            class='bx bx-edit'></i></a>
                                    <a href="{{ route('admin.team.destroy', $row->id) }}" id="delete"
                                        class="btn btn-sm btn-danger"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Facebook</th>
                            <th>Youtube</th>
                            <th>Instagram</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
