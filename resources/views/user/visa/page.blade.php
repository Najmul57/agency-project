@extends('user.user_master')

@section('user__content')
    <style>
        .payment__page .nav-link {
            padding: 5px;
        }
    </style>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">{{ ucfirst(auth()->user()->name) }}</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Visa Page</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row ">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-primary payment__page" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#guideline" role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Guideline</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#applyvisa" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Apply For Visa</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#uploadApplication" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Upload Application Copy</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#uploadvisa" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Upload Your Visa Copy</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#download" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Download</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#contact" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Contact/Help</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content py-3">
                        <div class="tab-pane fade" id="guideline" role="tabpanel">
                            {!! $visaguideline->description !!}
                        </div>
                        <div class="tab-pane fade" id="applyvisa" role="tabpanel">
                            <form action="{{ route('visa.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="full_name">Full Name</label>
                                            <input type="text" id="full_name" name="full_name" class="form-control"
                                                placeholder="enter full name" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="f_name">Father Name</label>
                                            <input type="text" id="f_name" name="f_name" class="form-control"
                                                placeholder="enter father name" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="m_name">Mothers Name</label>
                                            <input type="text" id="m_name" name="m_name" class="form-control"
                                                placeholder="enter mother name" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="dob">Date of Birth</label>
                                            <input type="date" id="dob" name="dob" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="present_address">Present Address</label>
                                            <input type="text" id="present_address" name="present_address"
                                                class="form-control" placeholder="enter present address" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="permanent_address">Permanent Address</label>
                                            <input type="text" id="permanent_address" name="permanent_address"
                                                class="form-control" placeholder="enter permanent address" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="spouse_name">Spouse Name (if)</label>
                                            <input type="text" id="spouse_name" name="spouse_name"
                                                class="form-control" placeholder="enter spouse name" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="personal_mobile">Personal Mobile Number</label>
                                            <input type="number" id="personal_mobile" name="personal_mobile"
                                                class="form-control" placeholder="enter personal mobile" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="father_mobile">Father Mobile Number</label>
                                            <input type="number" id="father_mobile" name="father_mobile"
                                                class="form-control" placeholder="enter father mobile" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="enter email address" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="embassy">Which Embassy You Want to Face?</label>
                                            <input type="text" id="embassy" name="embassy" class="form-control"
                                                placeholder="enter embassy name" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="embassy_date">What date do you want to face the embassy?</label>
                                            <input type="date" id="embassy_date" name="embassy_date"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="expected_date">Expected Travel Date in India?</label>
                                            <input type="date" id="expected_date" name="expected_date"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="travel_history">Previous india Travel History</label>
                                            <input type="text" id="travel_history" name="travel_history"
                                                class="form-control" placeholder="previous india travel history" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="travel_amother_country">Previous another country Travel
                                                History</label>
                                            <input type="text" id="travel_amother_country"
                                                name="travel_amother_country" class="form-control"
                                                placeholder="previous another country travel history" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="father_profession">Father/Guardian Profession</label>
                                            <input type="text" id="father_profession" name="father_profession"
                                                class="form-control" placeholder="enter father profession" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="through_border">Through which border do you want to come to
                                                india?</label>
                                            <input type="text" id="through_border" name="through_border"
                                                class="form-control"
                                                placeholder="through which border do you want to come to
                                                india?"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="nid">NID</label>
                                            <input type="file" id="nid" name="nid" class="form-control"
                                                required>
                                            <p class="text-danger mb-0">pdf file not support</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="passport">Passport Copy</label>
                                            <input type="file" id="passport" name="passport" class="form-control"
                                                required>
                                            <p class="text-danger mb-0">pdf file not support</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="admission_letter">Admission Letter</label>
                                            <input type="file" id="admission_letter" name="admission_letter"
                                                class="form-control" required>
                                            <p class="text-danger mb-0">pdf file not support</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="pre_travel_history">Previous Travel History (if any)</label>
                                            <input type="file" id="pre_travel_history" name="pre_travel_history"
                                                class="form-control" required>
                                            <p class="text-danger mb-0">pdf file not support</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="f_profession_proof">Father Profession ID Proof</label>
                                            <input type="file" id="f_profession_proof" name="f_profession_proof"
                                                class="form-control" required>
                                            <p class="text-danger mb-0">pdf file not support</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group form-photo_scan">
                                            <label for="through_border">Photo Scan Copy</label>
                                            <input type="file" id="photo_scan" name="photo_scan" class="form-control"
                                                required>
                                            <p class="text-danger mb-0">pdf file not support</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="visaDisclimer" required>
                                            <label class="form-check-label" for="visaDisclimer">
                                                <strong class="text-danger">Disclaimer: </strong> I agree all the terms
                                                and
                                                condition. And providing all documents are genunie. I will not blame if
                                                I
                                                fill any wrong info & upload documents ETC.
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                            <div class="d-flex align-items-center gap-2">
                                <strong class="text-danger">Note: </strong>
                                <p class="mb-2 p-0">If You to fill up your own way than, no need to fill-up this form</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="uploadvisa" role="tabpanel">
                            <form action="{{ route('visa.file.upload') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="visa_file">Upload Visa File</label>
                                    <input type="file" class="form-control" name="visa_file" id="visa_file">
                                </div>
                                <button type="submit" class="btn btn-success mt-2">Submit</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="uploadApplication" role="tabpanel">
                            <form action="{{ route('visa.application.upload') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="visa_application">Upload Visa Application</label>
                                    <input type="file" class="form-control" name="visa_application"
                                        id="visa_application" required>
                                </div>
                                <button type="submit" class="btn btn-success mt-2">Submit</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="download" role="tabpanel">
                            @php
                                $visa = \App\Models\VisaUpload::where('user_id', auth()->id())->get();
                            @endphp
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered example2">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($visa as $key => $data)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $data->created_at->format('d M Y') }}</td>
                                                        <td><a
                                                                href="{{ route('student.visa.download.user', ['id' => $data->id]) }}">Download</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel">
                            <p>{!! $help->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
