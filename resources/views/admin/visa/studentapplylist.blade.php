@extends('admin.admin_master')

@section('admin_content')
    <div class="card">
        <h4 class="p-3 mb-0">Visa Application Lists <span class="total_count">{{ $visaList->count() }}</span></h4>
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
                        @foreach ($visaList as $key => $data)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $data->user->system_id ?? '' }}</td>
                                <td>{{ ucfirst($data->user->name ?? '') }}</td>
                                <td>{{ ucfirst($data->user->email ?? '') }}</td>
                                <td>{{ ucfirst($data->user->phone ?? '') }}</td>
                                <td>{{ Carbon::parse($data->created_at)->format('F d, Y') }}</td>
                                <td>
                                        <a href="{{ route('visa.apply.single', $data->id) }}"
                                            class="btn btn-sm btn-success">Show</a>
                                        <a href="{{ route('visa.reject.single', $data->id) }}" id="delete"
                                            class="btn btn-sm btn-danger">Reject</a>
                                   
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
