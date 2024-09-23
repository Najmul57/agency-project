@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Free Student List
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
                            <th>Referance By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{ $list }} --}}
                        @foreach ($list as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $row->system_id }}</td> <!-- Fixed typo here -->
                                <td>{{ ucfirst($row->name) }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->phone }}</td>
                                <td>
                                    @if ($row->referance)
                                        {{ $row->referance }}-({{ $row->system_id }})
                                    @else
                                        Self Student
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('free.student.active.admin', $row->id) }}" id="active"
                                        class="btn btn-sm btn-info">Active</a>
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
                            <th>Referance By</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection