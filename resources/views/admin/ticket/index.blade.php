@extends('admin.admin_master')
<style>
    span.select2.select2-container.select2-container--default.select2-container--focus {
        width: 100% !important;
    }
</style>

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Ticket Request List <span
                            class="total_count">{{ $data->count() }}</li>
                </ol>
            </nav>
        </div>
    </div>

    @php
        $admission = \App\Models\AdmissionLetter::with('user')->latest()->get();
    @endphp
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
                            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->user->system_id ?? '' }}</td>
                                <td>{{ optional($item->user)->name ?? '' }}</td>
                                <td>{{ optional($item->user)->email ?? '' }}</td>
                                <td>{{ optional($item->user)->phone ?? '' }}</td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('ticket.request.single', ['id' => $item->id]) }}"
                                        class="btn btn-sm btn-primary">View</a>
                                    <a href="{{ route('ticket.request.destroy', ['id' => $item->id]) }}"
                                        class=" btn btn-sm  btn-danger" id="delete">Delete</a>
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
                            <th style="text-align: center">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
