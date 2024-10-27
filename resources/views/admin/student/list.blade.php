@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Student List
                        <span class="total_count">{{ $list->count() }}</span>
                    </li>
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
                            <th>Access</th>
                            <th>Status</th>
                            <th>Referance By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $row->system_id }}</td> <!-- Fixed typo here -->
                                <td>{{ ucfirst($row->name) }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->phone }}</td>
                                <td>
                                    @if ($row->is_primium == 'is_primium')
                                        <a href="javascript:void(0)"
                                            class=" disabled text-white btn btn-sm btn-success">Primium
                                            Student</a>
                                    @else
                                        @if (auth()->user()->can('Student-Primium'))
                                            <a href="{{ route('free.student.active.admin', $row->id) }}"
                                                class="btn btn-sm btn-info" id="active">Free Student</a>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if ($row->status == 1)
                                        @if (auth()->user()->can('Student-Approved'))
                                            <a href="{{ route('student.toggle', $row->id) }}" id="inactive"
                                                class="btn btn-sm btn-primary">Approved</a>
                                        @endif
                                    @else
                                        @if (auth()->user()->can('Student-Waiting'))
                                            <a href="{{ route('student.toggle', $row->id) }}"
                                                onclick="return confirm('Do you want to approved?')"
                                                title="Do you want to approved?" class="btn btn-sm btn-danger">Waiting</a>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if ($row->referance)
                                        {{ $row->referance }}
                                    @else
                                        Self Student
                                    @endif
                                </td>
                                <td>
                                    @if ($row->is_primium == 'is_primium')
                                    @else
                                        @if (auth()->user()->can('Student-Delete'))
                                            <a href="{{ route('student.delete.admin', $row->id) }}" id="delete"
                                                class="btn btn-sm btn-danger">Delete</a>
                                        @endif
                                    @endif
                                    @if (auth()->user()->can('Student-View'))
                                        <a href="{{ route('single.student.admin', $row->id) }}"
                                            class="btn btn-sm btn-info">View</a>
                                    @endif
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
                            <th>Access</th>
                            <th>Status</th>
                            <th>Referance By</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
