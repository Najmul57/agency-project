@extends('partner.layouts.partner_master')

@section('partner__content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($singleStudent->name) }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="student__info">
        <div class="row">
            <div class="col-12 col-md-6">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>System Id: </th>
                        <td>{{ $singleStudent->system_id }}</td>
                    </tr>
                    <tr>
                        <th>Name: </th>
                        <td>{{ ucfirst($singleStudent->name) }}</td>
                    </tr>
                    <tr>
                        <th>Father's Name: </th>
                        <td>{{ ucfirst($singleStudent->f_name) }}</td>
                    </tr>
                    <tr>
                        <th>Mother's Name: </th>
                        <td>{{ ucfirst($singleStudent->m_name) }}</td>
                    </tr>
                    <tr>
                        <th>Email: </th>
                        <td>{{ $singleStudent->email }}</td>
                    </tr>
                    <tr>
                        <th>Date of Birth: </th>
                        <td>{{ $singleStudent->dob }}</td>
                    </tr>
                    <tr>
                        <th>Phone: </th>
                        <td>{{ $singleStudent->phone }}</td>
                    </tr>
                    <tr>
                        <th>City: </th>
                        <td>{{ ucfirst($singleStudent->city) }}</td>
                    </tr>
                    <tr>
                        <th>Address: </th>
                        <td>{{ ucfirst($singleStudent->address) }}</td>
                    </tr>
                    <tr>
                        <th>CGPA: </th>
                        <td>{{ $singleStudent->cgpa }}</td>
                    </tr>
                    <tr>
                        <th>Country: </th>
                        <td>{{ ucfirst(optional($singleStudent->premiumCountry)->name) }}</td>
                    </tr>
                    <tr>
                        <th>University: </th>
                        <td>{{ ucfirst(optional($singleStudent->premiumUniversity)->name) }}</td>
                    </tr>
                    <tr>
                        <th>Program: </th>
                        <td>{{ ucfirst(optional($singleStudent->programType)->name) }}</td>
                    </tr>
                    <tr>
                        <th>Department: </th>
                        <td>{{ ucfirst(optional($singleStudent->department)->name) }}</td>
                    </tr>
                    <tr>
                        <th>Course: </th>
                        <td>{{ ucfirst(optional($singleStudent->course)->name) }}</td>
                    </tr>
                </table>
            </div>

            <div class="col-12 col-md-6">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Photo: </th>
                        <td>
                            @if ($singleStudent->photo && file_exists(public_path('upload/student/' . $singleStudent->photo)))
                                <a href="{{ asset('upload/student/' . $singleStudent->photo) }}" download>
                                    <img src="{{ asset('upload/student/' . $singleStudent->photo) }}"
                                        alt="{{ $singleStudent->name }}" style="width:100px; height:100px">
                                </a>
                            @else
                                <span>No photo available</span>
                            @endif
                        </td>
                        <th>NID: </th>
                        <td>
                            @if ($singleStudent->nid && file_exists(public_path('upload/student/' . $singleStudent->nid)))
                                <a href="{{ asset('upload/student/' . $singleStudent->nid) }}" download>
                                    <img src="{{ asset('upload/student/' . $singleStudent->nid) }}"
                                        alt="{{ $singleStudent->name }}" style="width:100px; height:100px">
                                </a>
                            @else
                                <span>No photo available</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Signature: </th>
                        <td>
                            @if ($singleStudent->signature && file_exists(public_path('upload/student/' . $singleStudent->signature)))
                                <a href="{{ asset('upload/student/' . $singleStudent->signature) }}" download>
                                    <img src="{{ asset('upload/student/' . $singleStudent->signature) }}"
                                        alt="{{ $singleStudent->name }}" style="width:100px; height:100px">
                                </a>
                            @else
                                <span>No photo available</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>A Lebel: </th>
                        <td>
                            @if ($singleStudent->a_level && file_exists(public_path('upload/student/' . $singleStudent->a_level)))
                                <a href="{{ asset('upload/student/' . $singleStudent->a_level) }}" download>
                                    <img src="{{ asset('upload/student/' . $singleStudent->a_level) }}"
                                        alt="{{ $singleStudent->name }}" style="width:100px; height:100px">
                                </a>
                            @else
                                <span>No photo available</span>
                            @endif
                        </td>
                        <th>Graduate: </th>
                        <td>
                            @if ($singleStudent->graduate && file_exists(public_path('upload/student/' . $singleStudent->graduate)))
                                <a href="{{ asset('upload/student/' . $singleStudent->graduate) }}" download>
                                    <img src="{{ asset('upload/student/' . $singleStudent->graduate) }}"
                                        alt="{{ $singleStudent->name }}" style="width:100px; height:100px">
                                </a>
                            @else
                                <span>No photo available</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Post Graduate: </th>
                        <td>
                            @if ($singleStudent->post_graduate && file_exists(public_path('upload/student/' . $singleStudent->post_graduate)))
                                <a href="{{ asset('upload/student/' . $singleStudent->post_graduate) }}" download>
                                    <img src="{{ asset('upload/student/' . $singleStudent->post_graduate) }}"
                                        alt="{{ $singleStudent->name }}" style="width:100px; height:100px">
                                </a>
                            @else
                                <span>No photo available</span>
                            @endif
                        </td>
                        <th>Others: </th>
                        <td>
                            @if ($singleStudent->others && file_exists(public_path('upload/student/' . $singleStudent->others)))
                                <a href="{{ asset('upload/student/' . $singleStudent->others) }}" download>
                                    <img src="{{ asset('upload/student/' . $singleStudent->others) }}"
                                        alt="{{ $singleStudent->name }}" style="width:100px; height:100px">
                                </a>
                            @else
                                <span>No photo available</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
