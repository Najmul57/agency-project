@extends('admin.admin_master')

@section('admin_content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($data->user->name) }}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('visa.apply.list') }}" class="btn btn-info">Visa Apply List</a>
            </div>
        </div>
    </div>
    @php
        use Carbon\Carbon;
    @endphp
    <div class="student__info">
        <div class="row">
            <div class="col-12 col-md-6">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>System Id: </th>
                        <td>{{ $data->user->system_id }}</td>
                    </tr>
                    <tr>
                        <th>Full Name: </th>
                        <td>{{ $data->full_name }}</td>
                    </tr>
                    <tr>
                        <th>Email: </th>
                        <td>{{ $data->email }}</td>
                    </tr>
                    <tr>
                        <th>Father Name: </th>
                        <td>{{ $data->f_name }}</td>
                    </tr>
                    <tr>
                        <th>Mother Name: </th>
                        <td>{{ $data->m_name }}</td>
                    </tr>
                    <tr>
                        <th>Date of Birth: </th>
                        <td>{{ Carbon::parse($data->dob)->format('F d, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Present Address: </th>
                        <td>{{ $data->present_address }}</td>
                    </tr>
                    <tr>
                        <th>Pernament Address: </th>
                        <td>{{ $data->permanent_address }}</td>
                    </tr>
                    <tr>
                        <th>Spouse Name: </th>
                        <td>{{ $data->spouse_name }}</td>
                    </tr>
                    <tr>
                        <th>Personal Mobile: </th>
                        <td>{{ $data->personal_mobile }}</td>
                    </tr>
                    <tr>
                        <th>Fathers Mobile: </th>
                        <td>{{ $data->father_mobile }}</td>
                    </tr>
                    <tr>
                        <th>Which Embassy You Want to Face?: </th>
                        <td>{{ $data->embassy }}</td>
                    </tr>
                    <tr>
                        <th>Embassy Date: </th>
                        <td>{{ Carbon::parse($data->embassy_date)->format('F d, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Expected Date: </th>
                        <td>{{ Carbon::parse($data->expected_date)->format('F d, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Previous india Travel History: </th>
                        <td>{{ $data->travel_history }}</td>
                    </tr>
                    <tr>
                        <th>Previous another country Travel History: </th>
                        <td>{{ $data->travel_amother_country }}</td>
                    </tr>
                    <tr>
                        <th>Father/Guardian Profession: </th>
                        <td>{{ $data->father_profession }}</td>
                    </tr>
                    <tr>
                        <th>Through which border do you want to come to india?: </th>
                        <td>{{ $data->through_border }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-12 col-md-6">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>NID: </th>
                        <td><a href="{{ asset('upload/visa/nid/' . $data->nid) }}" download=""><img
                                    src="{{ asset('upload/visa/nid/' . $data->nid) }}" width="100px" alt=""></a>
                        </td>
                    </tr>
                    <tr>
                        <th>Passport: </th>
                        <td>
                            <a href="{{ asset('upload/visa/passport/' . $data->passport) }}" download=""><img
                                    src="{{ asset('upload/visa/passport/' . $data->passport) }}" width="100px"
                                    alt=""></a>
                        </td>
                    </tr>
                    <tr>
                        <th>Admission Letter: </th>
                        <td><a href="{{ asset('upload/visa/admission_letter/' . $data->admission_letter) }}"
                                download=""><img
                                    src="{{ asset('upload/visa/admission_letter/' . $data->admission_letter) }}"
                                    width="100px" alt=""></a></td>
                    </tr>
                    <tr>
                        <th>Pre Travel History: </th>
                        <td>
                            <a href="{{ asset('upload/visa/previous_travel_history/' . $data->pre_travel_history) }}"
                                download=""><img
                                    src="{{ asset('upload/visa/previous_travel_history/' . $data->pre_travel_history) }}"
                                    width="100px" alt="">
                        </td></a>
                    </tr>
                    <tr>
                        <th>Fathers Profession Proof: </th>
                        <td>
                            <a href="{{ asset('upload/visa/father_profession_proof/' . $data->f_profession_proof) }}"
                                download=""><img
                                    src="{{ asset('upload/visa/father_profession_proof/' . $data->f_profession_proof) }}"
                                    width="100px" alt="">
                        </td></a>
                    </tr>
                    <tr>
                        <th>Photo Scan: </th>
                        <td>
                            <a href="{{ asset('upload/visa/photo_scan/' . $data->photo_scan) }}" download><img
                                    src="{{ asset('upload/visa/photo_scan/' . $data->photo_scan) }}" width="100px"
                                    alt=""></a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
