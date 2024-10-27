@extends('admin.admin_master')
@section('admin_content')
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        @if (auth()->user()->can('Dashboard-Total-Student'))
            <div class="col">
                <div class="card radius-10 bg-gradient-deepblue">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $primiumStudents }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-user fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0"><a href="{{ route('student.list.admin') }}" class="text-white"
                                    target="_blank">Total Primium Student</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->can('Dashboard-Total-Student'))
            <div class="col">
                <div class="card radius-10 bg-gradient-deepblue">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $freeStudents }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-user fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0"><a href="{{ route('student.list.admin') }}" class="text-white"
                                    target="_blank">Total Free Student</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->can('Dashboard-Total-Staff	'))
            <div class="col">
                <div class="card radius-10 bg-gradient-ibiza">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $admins }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-user fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0"><a href="{{ route('all.admin') }}" class="text-white" target="_blank">Total
                                    Staff</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->can('Dashboard-Total-Partner'))
            <div class="col">
                <div class="card radius-10 bg-gradient-ibiza">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $partners }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-user fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0"><a href="{{ route('admin.partner') }}" class="text-white"
                                    target="_blank">Total
                                    Partner</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->can('Dashboard-Total-Country'))
            <div class="col">
                <div class="card radius-10 bg-gradient-ohhappiness">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $countries }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-world fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0"><a href="{{ route('primium.country.list') }}" class="text-white"
                                    target="_blank">Total Country</a></p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->can('Dashboard-Total-University'))
            <div class="col">
                <div class="card radius-10 bg-gradient-orange">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $universities }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-color-fill fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0"><a href="{{ route('primium.university.list') }}" target="_blank"
                                    class="text-white">Total
                                    University</a></p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->can('Dashboard-Total-Program-Dicipline'))
            <div class="col">
                <div class="card radius-10 bg-gradient-orange">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $dicipline }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-color-fill fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0"><a href="{{ route('program.type') }}" target="_blank"
                                    class="text-white">Total Program Dicipline</a></p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->can('Dashboard-Total-Department'))
            <div class="col">
                <div class="card radius-10 bg-gradient-orange">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $departments }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-color-fill fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0"><a href="{{ route('primium.course.list') }}" target="_blank"
                                    class="text-white">Total Department</a></p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->can('Dashboard-Total-Courses'))
            <div class="col">
                <div class="card radius-10 bg-gradient-orange">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $courses }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-color-fill fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0"><a href="{{ route('primium.unicourse.list') }}" target="_blank"
                                    class="text-white">Total Courses</a></p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->can('Dashboard-Total-Content'))
            <div class="col">
                <div class="card radius-10 bg-gradient-orange">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $content }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-color-fill fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0"><a href="{{ route('primium.content.list') }}" target="_blank"
                                    class="text-white">Total Courses Content</a></p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <h5><strong>Payment Fees</strong></h5>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        @if (auth()->user()->can('Dashboard-Admission-Fees'))
            <div class="col">
                <div class="card radius-10 bg-gradient-deepblue">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $finalAdmissionAmount }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-dollar-circle fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Admission Fees
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->can('Dashboard-Tuition-Fees'))
            <div class="col">
                <div class="card radius-10 bg-gradient-orange">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $finalTuitionFeesAmount }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-dollar-circle fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Tuition Fees</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->can('Dashboard-Tickets'))
            <div class="col">
                <div class="card radius-10 bg-gradient-ohhappiness">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $finalTicket }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-dollar-circle fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Tickets</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->can('Dashboard-Visa-Purpose'))
            <div class="col">
                <div class="card radius-10 bg-gradient-ibiza">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $finalVisa }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-dollar-circle fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Visa Purpose </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->can('Dashboard-Service-Charge'))
            <div class="col">
                <div class="card radius-10 bg-gradient-deepblue">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $finalService }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-dollar-circle fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Service Charge
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->can('Dashboard-Application-Fees'))
            <div class="col">
                <div class="card radius-10 bg-gradient-deepblue">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $finalApplication }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-dollar-circle fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Application Fees
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->can('Dashboard-Others'))
            <div class="col">
                <div class="card radius-10 bg-gradient-orange">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $finalOthers }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-dollar-circle fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Others</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <h5><strong>Letter Verification</strong></h5>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        @if (auth()->user()->can('Dashboard-Offer-Letter'))
            <div class="col">
                <div class="card radius-10 bg-gradient-deepblue">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $offerLetter }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-dollar-circle fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Offer Letter
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->can('Dashboard-Admission-Letter'))
            <div class="col">
                <div class="card radius-10 bg-gradient-orange">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $admissionLetter }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-dollar-circle fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Admission Letter</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->can('Dashboard-Doctor-Appointment-Letter'))
            <div class="col">
                <div class="card radius-10 bg-gradient-ohhappiness">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $doctorLetter }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-dollar-circle fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Doctor Appointment Letter</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->can('Dashboard-Another-Letter'))
            <div class="col">
                <div class="card radius-10 bg-gradient-ibiza">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $anotherLetter }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-dollar-circle fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Another Letter </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <h5><strong>Primium Subscription</strong></h5>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        @if (auth()->user()->can('Dashboard-Primium-Subcription'))
            <div class="col">
                <div class="card radius-10 bg-gradient-deepblue">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $userAmount }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-dollar-circle fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Primium Subcription
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <h5><strong>Total Student Collection Amount</strong></h5>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        @if (auth()->user()->can('Dashboard-Total-Amount'))
            <div class="col">
                <div class="card radius-10 bg-gradient-deepblue">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $totalAmount }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-dollar-circle fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Total Amount
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!--end row-->
@endsection
