@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Coupon List <span
                            class="total_count">{{ $data->count() }}</span></li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                    <a href="{{ route('create.coupon') }}" class="btn btn-info">Add Coupon</a>
              
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
                            <th>Code</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $row->code }}</td>
                                <td>{{ date('d M Y', strtotime($row->date)) }}</td>
                                <td>{{ ucfirst($row->type) }}</td>
                                <td>{{ $row->amount }}</td>
                                <td>
                                    @if ($row->status == 1)
                                            <a href="{{ route('coupon.inactive', $row->id) }}" id="inactive"
                                                class="btn btn-sm btn-success">Active</a>
                                        
                                    @else
                                            <a href="{{ route('coupon.active', $row->id) }}" id="active"
                                                class="btn btn-sm btn-danger">Inactive</a>
                                        @endif
                                   
                                </td>
                                <td>
                                        <a href="{{ route('edit.coupon', $row->id) }}" class="btn btn-sm btn-info"><i
                                                class='bx bx-edit'></i></a>
                                        <a href="{{ route('destroy.coupon', $row->id) }}" id="delete"
                                            class="btn btn-sm btn-danger"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Code</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
