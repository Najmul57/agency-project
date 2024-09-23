@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Pay Fees List <span
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
                            {{-- <th>TXT Photo</th> --}}
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{ $data }} --}}
                        @foreach ($data as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $row->user->system_id ?? '' }}</td>
                                <td>{{ ucfirst($row->user->name ?? '') }}</td>
                                <td>{{ $row->user->email ?? '' }}</td>
                                <td>{{ $row->user->phone ?? '' }}</td>
                                {{-- <td>
                                    <a href="{{ asset('upload/payment/bank_txt_upload/' . $row->bank_txt_upload) }}"
                                        download="">
                                        <img src="{{ asset('upload/payment/bank_txt_upload/' . $row->bank_txt_upload) }}"
                                            width="50px" alt="">
                                    </a>
                                </td> --}}
                                <td>{{ $row->created_at->format('d/m/Y') }}</td>
                                <td>
                                    @if ($row->status == 1)
                                        <a class="btn btn-sm btn-success" id="active"
                                            href="{{ route('admin.invoice.inactive', $row->id) }}">Active</a>
                                    @else
                                        <a class="btn btn-sm btn-warning" id="inactive"
                                            href="{{ route('admin.invoice.active', $row->id) }}">Inactive</a>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('admin.payfees.download', $row->id) }}">Download</a>
                                    <a class="btn btn-sm btn-danger" id="delete"
                                        href="{{ route('admin.payfees.destroy', $row->id) }}">Reject</a>

                                <td>
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
                            {{-- <th>TXT Photo</th> --}}
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
