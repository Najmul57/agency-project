@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"> NOC List <span
                            class="total_count">{{ $data->count() }}</span></li>
                </ol>
            </nav>
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
                            <th>System ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $row->system_id }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->number }}</td>
                                <td>
                                    @if ($row->status == 1)
                                        <a class="btn btn-sm btn-primary" id="active" title="show"
                                            href="{{ route('admin.noc.inactive', ['id' => $row->id]) }}">Active</a>
                                    @else
                                        <a class="btn btn-sm btn-warning" id="inactive" title="show"
                                            href="{{ route('admin.noc.active', ['id' => $row->id]) }}">Inactive</a>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary" title="show"
                                        href="{{ route('noc.form.single', ['id' => $row->id]) }}"><i
                                            class="bx bx-show"></i></a>
                                    <a class="btn btn-sm btn-success" title="Download"
                                        href="{{ route('noc.form.single.pdf', ['id' => $row->id]) }}"><i
                                            class="bx bx-download"></i></a>
                                    <a class="btn btn-sm btn-danger" title="Delete"
                                        href="{{ route('noc.destroy.student.destroy', ['id' => $row->id]) }}"><i
                                            class="bx bx-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>System ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
