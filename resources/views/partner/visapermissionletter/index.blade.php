@extends('partner.layouts.partner_master')

@section('partner__content')
    @php
        $visaPermissionLetter = \App\Models\Visaletter::whereHas('user', function ($query) {
            $query->where('referance', auth()->user()->email);
        })->get();
    @endphp
    <div class="card">
        <h4
            style="padding-bottom: 0;
                                margin-bottom: 0;
                                padding-left: 15px;
                                padding-top: 15px;">
            Visa Permission Letter</h4>
        <div class="card-body">
            <div class="table-responsive">
                <table class="example2 table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>System Id</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($visaPermissionLetter as $key => $data)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $data->user->system_id }}</td>
                                <td>{{ ucfirst($data->user->name) }}</td>
                                <td>{{ $data->created_at->format('d M Y') }}</td>
                                <td><a class="btn btn-primary btn-sm"
                                        href="{{ route('partner.visa.permission.letter.download', ['id' => $data->id]) }}">Download</a>
                                </td>
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
