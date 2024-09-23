@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Payment List <span
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
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $row->user->system_id ?? '' }}</td>
                                <td>{{ ucfirst($row->user->name ?? '') }}</td>
                                <td>{{ $row->user->email ?? '' }}</td>
                                <td>{{ $row->user->phone ?? '' }}</td>
                                <td>
                                    @if ($row->status == 1)
                                        <a href="{{ route('admin.payment.toggle', $row->id) }}" id="active"
                                            class="btn btn-sm btn-primary">Approved</a>
                                    @else
                                        <a href="{{ route('admin.payment.toggle', $row->id) }}"
                                            onclick="return confirm('Do you want to approved?')"
                                            title="Do you want to approved?" class="btn btn-sm btn-danger">Waiting</a>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-success"
                                        href="{{ route('admin.paymentreceipt.download', ['id' => $row->id]) }}">Download</a>
                                    @if ($row->status == 1)
                                    @else
                                        <a class="btn btn-sm btn-danger" id="delete"
                                            href="{{ route('admin.paymentreceipt.delete', ['id' => $row->id]) }}">Delete</a>
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
                            <th>Status</th>
                            <th>Download</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
