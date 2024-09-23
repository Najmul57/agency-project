@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Partner List
                        <span class="total_count">{{ $partnets->count() }}</span>
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
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partnets as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $row->system_id }}</td>
                                <td>{{ ucfirst($row->name) }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->phone }}</td>
                                <td>
                                    @if ($row->status == 1)
                                        <a href="{{ route('partner.toggle', $row->id) }}" id="inactive"
                                            class="btn btn-sm btn-primary">Approved</a>
                                    @else
                                        <a href="{{ route('partner.toggle', $row->id) }}"
                                            onclick="return confirm('Do you want to approved?')"
                                            title="Do you want to approved?" class="btn btn-sm btn-danger">Waiting</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                        data-bs-target="#modal{{ $row->id }}" class="btn btn-sm btn-success">View</a>
                                    @if ($row->status == 1)
                                    @else
                                        <a href="{{ route('partner.delete.admin', $row->id) }}" id="delete"
                                            class="btn btn-sm btn-danger">Delete</a>
                                    @endif
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="modal{{ $row->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ ucwords($row->name) }}
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Name</strong> : {{ ucwords($row->name) }}</p>
                                            <p><strong>Email</strong> : {{ $row->email }}</p>
                                            <p><strong>Phone</strong> : {{ $row->phone }}</p>
                                            <p><strong>System ID</strong> : {{ $row->system_id }}</p>
                                            <p><strong>Amount</strong> : {{ $row->amount }}</p>
                                            <p><strong>Method</strong> : {{ $row->method }}</p>
                                            <p><strong>TXT Number</strong> : {{ $row->txt_number }}</p>
                                            <p><strong>City</strong> : {{ ucwords($row->city) }}</p>
                                            @if ($row->photo)
                                                <p><strong>Photo</strong> :
                                                    <a href="{{ asset('upload/student/' . $row->photo) }}" download> <img
                                                            src="{{ asset('upload/student/' . $row->photo) }}"
                                                            width="100px" alt=""></a>
                                                </p>
                                            @endif
                                            @if ($row->signature)
                                                <p><strong>Signature</strong> :
                                                    <a href="{{ asset('upload/student/' . $row->signature) }}"
                                                        download=""><img
                                                            src="{{ asset('upload/student/' . $row->signature) }}"
                                                            width="100px" alt="">
                                                    </a>
                                                </p>
                                            @endif
                                            @if ($row->nid)
                                                <p><strong>NID</strong> :
                                                    <a href="{{ asset('upload/student/' . $row->nid) }}"
                                                        download=""><img
                                                            src="{{ asset('upload/student/' . $row->nid) }}" width="100px"
                                                            alt=""></a>
                                                </p>
                                            @endif
                                            @if ($row->o_level)
                                                <p><strong>O Level</strong> :
                                                    <a href="{{ asset('upload/student/' . $row->o_level) }}"
                                                        download=""> <img
                                                            src="{{ asset('upload/student/' . $row->o_level) }}"
                                                            width="100px" alt=""></a>
                                                </p>
                                            @endif
                                            @if ($row->a_level)
                                                <p><strong>A Level</strong> :
                                                    <a href="{{ asset('upload/student/' . $row->a_level) }}"
                                                        download=""><img
                                                            src="{{ asset('upload/student/' . $row->a_level) }}"
                                                            width="100px" alt=""></a>
                                                </p>
                                            @endif
                                            @if ($row->graduate)
                                                <p><strong>Graduate</strong> :
                                                    <a href="{{ asset('upload/student/' . $row->graduate) }}"
                                                        download=""> <img
                                                            src="{{ asset('upload/student/' . $row->graduate) }}"
                                                            width="100px" alt=""></a>
                                                </p>
                                            @endif
                                            @if ($row->post_graduate)
                                                <p><strong>Post Graduate</strong> :
                                                    <a href="{{ asset('upload/student/' . $row->post_graduate) }}"
                                                        download=""> <img
                                                            src="{{ asset('upload/student/' . $row->post_graduate) }}"
                                                            width="100px" alt=""></a>
                                                </p>
                                            @endif
                                            @if ($row->others)
                                                <p><strong>Others</strong> :
                                                    <a href="{{ asset('upload/student/' . $row->others) }}"
                                                        download=""><img
                                                            src="{{ asset('upload/student/' . $row->others) }}"
                                                            width="100px" alt=""></a>
                                                </p>
                                            @endif

                                        </div>

                                    </div>
                                </div>
                            </div>
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
