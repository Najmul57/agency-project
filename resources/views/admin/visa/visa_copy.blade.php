@extends('admin.admin_master')

@section('admin_content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Visa Copy List<span
                            class="total_count">{{ $data->count() }}</span></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered example2">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>System Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            use Carbon\Carbon;
                        @endphp
                        @foreach ($data as $key => $data)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $data->user->system_id ?? '' }}</td>
                                <td>{{ ucfirst($data->user->name ?? '') }}</td>
                                <td>{{ ucfirst($data->user->email ?? '') }}</td>
                                <td>{{ ucfirst($data->user->phone ?? '') }}</td>
                                <td>{{ Carbon::parse($data->created_at)->format('F d, Y') }}</td>
                                <td>
                                        <a class="btn btn-sm btn-success"
                                            href="{{ route('visa.copy.download', ['id' => $data->id]) }}">Download</a>
                                  
                                    <a class="btn btn-sm btn-danger" id="delete"
                                        href="{{ route('visa.copy.delete', ['id' => $data->id]) }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>System Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
