@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($data->name) }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-12 col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>System ID </th>
                            <td>{{ ucfirst($data->system_id) }}</td>
                        </tr>
                        <tr>
                            <th>Name </th>
                            <td>{{ ucfirst($data->name) }}</td>
                        </tr>
                        <tr>
                            <th>Father Name </th>
                            <td>{{ ucfirst($data->f_name) }}</td>
                        </tr>
                        <tr>
                            <th>Mother Name </th>
                            <td>{{ ucfirst($data->m_name) }}</td>
                        </tr>
                        <tr>
                            <th>Passport </th>
                            <td>{{ ucfirst($data->passport) }}</td>
                        </tr>
                        <tr>
                            <th>Address </th>
                            <td>{{ ucfirst($data->address) }}</td>
                        </tr>
                        <tr>
                            <th>Email </th>
                            <td>{{ ucfirst($data->email) }}</td>
                        </tr>
                        <tr>
                            <th>Mobile Number </th>
                            <td>{{ ucfirst($data->number) }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-12 col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Country: </th>
                            <td>
                                {{ ucfirst($country->name) ?? 'Unknown' }}
                            </td>
                        </tr>
                        <tr>
                            <th>University: </th>
                            <td>
                                {{ ucfirst($university->name) ?? 'Unknown' }}
                            </td>
                        </tr>
                        <tr>
                            <th>Program Type: </th>
                            <td>{{ ucfirst($type->name) ?? 'Unknown' }}</td>
                        </tr>

                        <tr>
                            <th>Department: </th>
                            <td>{{ ucfirst($department->name) }}</td>
                        </tr>
                        <tr>
                            <th>University Course: </th>
                            <td>{{ ucfirst($uni_course->name) }}</td>
                        </tr>
                        <tr>
                            <th>Signature: </th>
                            <td><img src="{{ asset('upload/noc/' . $data->signature) }}" width="100px" alt="">
                            </td>
                        </tr>
                        <tr>
                            <th>Guardiant Signature: </th>
                            <td><img src="{{ asset('upload/noc/' . $data->guirdiansignature) }}" width="100px"
                                    alt="">
                            </td>
                        </tr>
                    </table>
                    <a href="{{ route('noc.form.single.pdf', ['id' => $data->id]) }}"
                        class="btn btn-success d-inline">Download PDF</a>
                </div>
            </div>
        </div>
    </div>
@endsection
