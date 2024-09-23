@extends('admin.admin_master')

@push('css')
    <link href="{{ asset('backend') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <style>
        span.select2.select2-container.select2-container--default.select2-container--above {
            width: 100% !important;
        }

        .form-group.mb-3 .select2 {
            width: 100% !important;
        }
    </style>
@endpush

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Permission Create</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-12 mx-auto card p-3">
            <form action="{{ route('update.permission', $permission->id) }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $permission->id }}">
                <div class="form-group mb-3">
                    <label for="name">Permission Name</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ $permission->name }}">
                </div>
                <div class="form-group mb-3">
                    <label for="group_name">Select Group</label>
                    <select name="group_name" id="group_name" class="form-select select2">
                        <option hidden selected disabled>Select Group</option>
                        <option value="contentMenu">Content Menu</option>
                        <option value="student">Student</option>
                        <option value="slider">Slider</option>
                        <option value="successCount">Success Count</option>
                        <option value="service">Service</option>
                        <option value="blog">Blog</option>
                        <option value="gallery">Gallery</option>
                        <option value="universityFacility">University Facility</option>
                        <option value="welcomVideo">Welcom Video</option>
                        <option value="studentFeedback">Student Feedback</option>
                        <option value="teamMember">Team Member</option>
                        <option value="studentHelp">Student Help/Contact</option>
                        <option value="letterSection">Letter Section</option>
                        <option value="paymentSection">Payment Section</option>
                        <option value="nocSection">Noc Section</option>
                        <option value="visaSection">Visa Section</option>
                        <option value="ticketingSection">Ticketing Section</option>
                        <option value="referanceSection">Referance Section</option>
                        <option value="letterVerificationSection">Letter Verification Section</option>
                        <option value="expensive">Expensive</option>
                        <option value="coupon">Coupon</option>
                        <option value="notice">Notice</option>
                        <option value="refundPolicy">Refund Policy</option>
                        <option value="contactMessage">Contact Message</option>
                        <option value="setting">Setting</option>
                        <option value="role&Permission">Role & Permission</option>
                        <option value="adminManage">Admin Manage</option>
                        <option value="totalStudent">Total Student</option>
                        <option value="totalStaff">Total Staff</option>
                        <option value="totalPartner">Total Partner</option>
                        <option value="totalCountry">Total Country</option>
                        <option value="totalUniversity">Total University</option>
                        <option value="totalProgram">Total Program Dicipline</option>
                        <option value="totalDepartment">Total Department</option>
                        <option value="totalCourse">Total Courses</option>
                        <option value="totalContent">Total Content</option>
                        <option value="totalPayment">Total Payment</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success"> Permission Update</button>
            </form>
        </div>
    </div>
    <!--end row-->

    <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/select2/js/select2.min.js"></script>

    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
