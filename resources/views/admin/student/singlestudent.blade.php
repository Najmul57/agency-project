@extends('admin.admin_master')

@section('admin_content')
    @push('css')
        <style>
            .invalid-feedback {
                display: none;
                color: red;
            }

            .is-invalid .invalid-feedback {
                display: block;
            }

            .button__group {
                gap: 10px;
                flex-wrap: wrap;
            }

            .button__group .btn {
                text-transform: capitalize;
            }

            .sendEmail {
                display: flex;
                flex-direction: row;
                gap: 10px;
                flex-wrap: wrap;
                padding: 10px;
            }
        </style>
    @endpush
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $singlestudent->name }}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('student.list.admin') }}" class="btn btn-info">Student list</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    @php
        $primium__country = \App\Models\PrimiumCountry::get();
        $primium__university = \App\Models\PrimiumUniversity::get();
        $primium__course = \App\Models\PrimiumCourse::get();
        $primium__university_course = \App\Models\PrimiumUniversityCourse::get();
        $program_type = \App\Models\ProgramType::get();
    @endphp

    <div class="card">
        <div class="card-body">
            <div class="student__info">
                <h3>Check Information</h3>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>System Id </th>
                                <td>{{ $singlestudent->system_id }}</td>
                            </tr>
                            <tr>
                                <th>Name </th>
                                <td>{{ $singlestudent->name }}</td>
                            </tr>
                            <tr>
                                <th>Father's Name </th>
                                <td>{{ ucfirst($singlestudent->f_name) }}</td>
                            </tr>
                            <tr>
                                <th>Mother's Name </th>
                                <td>{{ ucfirst($singlestudent->m_name) }}</td>
                            </tr>
                            <tr>
                                <th>Email </th>
                                <td>{{ $singlestudent->email }}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth </th>
                                <td>{{ $singlestudent->dob }}</td>
                            </tr>
                            <tr>
                                <th>Phone </th>
                                <td>{{ $singlestudent->phone }}</td>
                            </tr>
                            <tr>
                                <th>City </th>
                                <td>{{ ucfirst($singlestudent->city) }}</td>
                            </tr>
                            <tr>
                                <th>Address </th>
                                <td>{{ ucfirst($singlestudent->address) }}</td>
                            </tr>
                            <tr>
                                <th>Country </th>
                                <td>{{ optional($singlestudent->premiumCountry)->name ? ucfirst(optional($singlestudent->premiumCountry)->name) : 'Unknown' }}
                                </td>
                            </tr>
                            <tr>
                                <th>University </th>
                                <td>{{ optional($singlestudent->premiumUniversity)->name ? ucfirst(optional($singlestudent->premiumUniversity)->name) : 'Unknown' }}
                                </td>
                            </tr>
                            <tr>
                                <th>Program </th>
                                <td>{{ optional($singlestudent->programType)->name ? ucfirst(optional($singlestudent->programType)->name) : 'Unknown' }}
                                </td>
                            </tr>
                            <tr>
                                <th>Department </th>
                                <td>{{ optional($singlestudent->department)->name ? ucfirst(optional($singlestudent->department)->name) : 'Unknown' }}
                                </td>
                            </tr>
                            <tr>
                                <th>Course </th>
                                <td>{{ ucwords(optional($singlestudent->course)->name ? ucfirst(optional($singlestudent->course)->name) : 'Unknown') }}
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-12 col-md-6">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Photo: </th>
                                <td>
                                    @if ($singlestudent->photo && file_exists(public_path('upload/student/' . $singlestudent->photo)))
                                        <img src="{{ asset('upload/student/' . $singlestudent->photo) }}"
                                            alt="{{ $singlestudent->name }}" style="width:100px; height:100px">
                                    @else
                                        <span>No photo available</span>
                                    @endif
                                </td>
                                <th>NID: </th>
                                <td>
                                    @if ($singlestudent->nid && file_exists(public_path('upload/student/' . $singlestudent->nid)))
                                        <img src="{{ asset('upload/student/' . $singlestudent->nid) }}"
                                            alt="{{ $singlestudent->name }}" style="width:100px; height:100px">
                                    @else
                                        <span>No nid available</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Signature: </th>
                                <td>
                                    @if ($singlestudent->signature && file_exists(public_path('upload/student/' . $singlestudent->signature)))
                                        <img src="{{ asset('upload/student/' . $singlestudent->signature) }}"
                                            alt="{{ $singlestudent->name }}" style="width:100px; height:100px">
                                    @else
                                        <span>No Signature available</span>
                                    @endif
                                </td>
                                <th>O Lebel: </th>
                                <td>
                                    @if ($singlestudent->o_level && file_exists(public_path('upload/student/' . $singlestudent->o_level)))
                                        <img src="{{ asset('upload/student/' . $singlestudent->o_level) }}"
                                            alt="{{ $singlestudent->name }}" style="width:100px; height:100px">
                                    @else
                                        <span>No O Lebel available</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>A Lebel: </th>
                                <td>
                                    @if ($singlestudent->a_level && file_exists(public_path('upload/student/' . $singlestudent->a_level)))
                                        <img src="{{ asset('upload/student/' . $singlestudent->a_level) }}"
                                            alt="{{ $singlestudent->name }}" style="width:100px; height:100px">
                                    @else
                                        <span>No A Lebel available</span>
                                    @endif
                                </td>
                                <th>Graduate: </th>
                                <td>
                                    @if ($singlestudent->graduate && file_exists(public_path('upload/student/' . $singlestudent->graduate)))
                                        <img src="{{ asset('upload/student/' . $singlestudent->graduate) }}"
                                            alt="{{ $singlestudent->name }}" style="width:100px; height:100px">
                                    @else
                                        <span>No Graduate available</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Post Graduate: </th>
                                <td>
                                    @if ($singlestudent->post_graduate && file_exists(public_path('upload/student/' . $singlestudent->post_graduate)))
                                        <img src="{{ asset('upload/student/' . $singlestudent->post_graduate) }}"
                                            alt="{{ $singlestudent->name }}" style="width:100px; height:100px">
                                    @else
                                        <span>No Post Graduate available</span>
                                    @endif
                                </td>
                                <th>Others: </th>
                                <td>
                                    @if ($singlestudent->others && file_exists(public_path('upload/student/' . $singlestudent->others)))
                                        <img src="{{ asset('upload/student/' . $singlestudent->others) }}"
                                            alt="{{ $singlestudent->name }}" style="width:100px; height:100px">
                                    @else
                                        <span>No Others available</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-3">
        <p><strong class="text-danger">Offer Letter : </strong> you want to <strong> Offer Letter</strong> send than first
            complete
            student profile.
        </p>
        <p><strong class="text-danger">Admission Letter : </strong> you want to <strong>Admission Letter </strong> send ,
            first <strong><a href="{{ route('admin.admission.letter.generate') }}" target="_blank">Generate Admission
                    Invoice</a></strong>
            {{-- and <strong><a href="{{ route('admin.admission.invoice') }}" target="_blank">Upload University
                    Invoice</a></strong> --}}
        </p>
        <p><strong class="text-danger">Visa Letter : </strong> you want to <strong>Visa Letter</strong> send , at first
            please check <strong><a href="{{ route('ticket.request.list') }}" target="_blank">This List .</a> </strong> If
            have a
            passport
            than send
            this.
        </p>
        <p class="mb-0"><strong class="text-danger">Pickup Letter : </strong> you want to <strong><a
                    href="{{ route('admin.ticket') }}" target="_blank">Pickup Letter</a></strong>
            send , first
            upload student
            Pickup Letter than send.
        </p>
    </div>

    <div class="card">
        @php
            $universiity = \App\Models\PrimiumUniversity::where('status', 1)->get();
        @endphp
        <div class="email__button mb-3">
            <div class="card mb-0 sendEmail" style="background: transparent;box-shadow:none">
                <div class="emailSend">
                    <a title="{{ $singlestudent->premiumUniversity->email }}"
                        href="{{ route('offer.letter', ['id' => $singlestudent->id, 'university_id' => $singlestudent->premiumUniversity->id]) }}"
                        class="btn btn-sm btn-outline-danger">Offer Letter</a>
                </div>
                <div class="emailSend">
                    <a title="{{ $singlestudent->premiumUniversity->email }}"
                        href="{{ route('admission.letter', ['id' => $singlestudent->id, 'university_id' => $singlestudent->premiumUniversity->id]) }}"
                        class="btn btn-sm btn-outline-danger">Admission Letter</a>
                </div>
                <div class="emailSend">
                    <a title="{{ $singlestudent->premiumUniversity->email }}"
                        href="{{ route('visa.letter', ['id' => $singlestudent->id, 'university_id' => $singlestudent->premiumUniversity->id]) }}"
                        class="btn btn-sm btn-outline-danger">Visa Letter</a>
                </div>
                <div class="emailSend">
                    <a title="{{ $singlestudent->premiumUniversity->email }}"
                        href="{{ route('pickup.letter', ['id' => $singlestudent->id, 'university_id' => $singlestudent->premiumUniversity->id]) }}"
                        class="btn btn-sm btn-outline-danger">Pickup Letter</a>
                </div>
                <div class="emailSend">
                    <a href="mailto:{{ $singlestudent->premiumUniversity->email }}"
                        class="btn btn-sm btn-outline-danger">Another Letter</a>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/jquery.min.js"></script>


    <script>
        // JavaScript to handle click event and update modal title
        document.addEventListener('DOMContentLoaded', function() {
            const universityButtons = document.querySelectorAll('.universityButton');

            universityButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const universityName = this.dataset.name;
                    document.getElementById('modalUniversityName').textContent = universityName;
                });
            });
        });
    </script>
@endsection
