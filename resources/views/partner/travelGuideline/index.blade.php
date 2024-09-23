@extends('partner.layouts.partner_master')

@section('partner__content')
    <div class="card">
        <div class="card-body">
            {{-- @dd($travelGuideline); --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered example2">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>System ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->system_id }}</td>
                                <td>{{ ucfirst($item->name) }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>
                                    @if ($item->travelguideline)
                                        <a href="{{ route('partner.travel.single', $item->id) }}"
                                            class="bg-primary text-white"
                                            style="padding: 5px 15px;border-radius: 5px;">Show</a>
                                    @else
                                        <button class="bg-danger text-white" style="padding: 5px 15px;border-radius: 5px;"
                                            onclick="alert('Please wait while the file is being uploaded.'); this.disabled = true;">
                                            Waiting
                                        </button>
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
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
