@extends('admin.admin_master')
<style>
    .visa_email.najmul_email button {
        display: block;
        margin-bottom: 5px;
        padding: 5px;
        border: 1px solid #ddd;
        background: transparent;
        border-radius: 3px;
    }

    .visa_email.najmul_email {
        border: 1px solid #ddd;
        padding: 5px;
    }

    .visa_email.najmul_email button a {
        color: #000;
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
                    <li class="breadcrumb-item active" aria-current="page">{{ ucwords($data->user->name) }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <h4 class="p-3 mb-0">Ticket Request Information</h4>
        <div class="card-body">
            <div class="student__info">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>System Id: </th>
                                <td>{{ $data->user->system_id }}</td>
                            </tr>
                            <tr>
                                <th>Name: </th>
                                <td>{{ ucwords($data->user->name) }}</td>
                            </tr>
                            <tr>
                                <th>Email: </th>
                                <td>{{ $data->user->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone: </th>
                                <td>{{ $data->user->phone }}</td>
                            </tr>
                            <tr>
                                <th>Travel Date: </th>
                                <td>{{ \Carbon\Carbon::parse($data->travel_date)->format('d, M, Y') }}</td>
                            </tr>
                            <tr>
                                <th>Travel By: </th>
                                <td>{{ ucfirst($data->travelby) }}</td>
                            </tr>
                            <tr>
                                <th>Travel Form: </th>
                                <td>{{ ucfirst($data->from) }}</td>
                            </tr>
                            <tr>
                                <th>Travel To: </th>
                                <td>{{ ucfirst($data->to) }}</td>
                            </tr>
                            <tr>
                                <th>Travel Person: </th>
                                <td>{{ ucfirst($data->person) }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-12 col-md-6">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Passport: </th>
                                <td>
                                    @if ($data->passport && file_exists(public_path('upload/ticket/passport/' . $data->passport)))
                                        @php
                                            $extension = pathinfo(
                                                public_path('upload/ticket/passport/' . $data->passport),
                                                PATHINFO_EXTENSION,
                                            );
                                        @endphp
                                        @if ($extension == 'pdf')
                                            <a href="{{ asset('upload/ticket/passport/' . $data->passport) }}"
                                                download>{{ $data->passport }}</a>
                                        @else
                                            <a href="{{ asset('upload/ticket/passport/' . $data->passport) }}" download>
                                                <img src="{{ asset('upload/ticket/passport/' . $data->passport) }}"
                                                    alt="{{ $data->name }}" style="width:100px; height:100px">
                                            </a>
                                        @endif
                                    @else
                                        <span>No photo available</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Visa: </th>
                                <td>
                                    @if ($data->visa && file_exists(public_path('upload/ticket/visa/' . $data->visa)))
                                        @php
                                            $extension = pathinfo(
                                                public_path('upload/ticket/visa/' . $data->visa),
                                                PATHINFO_EXTENSION,
                                            );
                                        @endphp
                                        @if ($extension == 'pdf')
                                            <a href="{{ asset('upload/ticket/visa/' . $data->visa) }}"
                                                download>{{ $data->visa }}</a>
                                        @else
                                            <a href="{{ asset('upload/ticket/visa/' . $data->visa) }}" download>
                                                <img src="{{ asset('upload/ticket/visa/' . $data->visa) }}"
                                                    alt="{{ $data->name }}" style="width:100px; height:100px">
                                            </a>
                                        @endif
                                    @else
                                        <span>No photo available</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
