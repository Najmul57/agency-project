@extends('partner.layouts.partner_master')

@section('partner__content')
    @php
        $users = \App\Models\User::where('role_id', 2)
            ->where('referance', auth()->user()->email)
            ->get();
    @endphp
    <div class="card">
        <h4
            style="padding-bottom: 0;
                                margin-bottom: 0;
                                padding-left: 15px;
                                padding-top: 15px;">
            Partner Payment List</h4>
        <div class="card-body">
            <div class="table-responsive">
                <table class="example2 table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>System Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $data)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $data->system_id }}</td>
                                <td>{{ ucfirst($data->name) }}</td>
                                <td><a href="mailto:{{ $data->email }}">{{ $data->email }}</a></td>
                                <td><a class="btn btn-success btn-sm"
                                        href="{{ route('partner.payment.single', $data->id) }}">Payment</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>System Id</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
