@extends('admin.admin_master')

@section('admin_content')
<style>
    tr td{
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
                    <li class="breadcrumb-item active" aria-current="page">Course List <span
                            class="total_count">{{ $data->count() }}</span></li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('courselist.index') }}" style="margin-right: 10px" class="btn btn-success">Course</a>
                <a href="{{ route('primium.unicourse.create') }}" class="btn btn-info">Add Course</a>
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
                            <th>Department</th>
                            <th>Program Type</th>
                            <th>University</th>
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
                                <td>{{ ucwords($row->course->name ?? '') }}</td>
                                <td>{{ ucwords($row->program->name ?? '') }}</td>
                                <td>{{ ucwords($row->university->name ?? '') }}</td>
                                <td>{{ ucwords($row->country->name ?? '') }}</td>
                                <td>
                                    @if ($row->status == 1)
                                        <a href="{{ route('primium.unicourse.inactive', $row->id) }}" id="inactive"
                                            class="btn btn-sm btn-success">Active</a>
                                    @else
                                        <a href="{{ route('primium.unicourse.active', $row->id) }}" id="active"
                                            class="btn btn-sm btn-danger">Inactive</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('primium.unicourse.edit', $row->id) }}"
                                        class="btn btn-sm btn-info"><i class='bx bx-edit'></i></a>
                                    <a href="{{ route('primium.unicourse.destroy', $row->id) }}" id="delete"
                                        class="btn btn-sm btn-danger"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Program Type</th>
                            <th>University</th>
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
