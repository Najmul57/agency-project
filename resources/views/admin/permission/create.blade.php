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
            <form action="{{ route('store.permission') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Permission Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Permission Name"
                        required>
                </div>
                <div class="form-group mb-3">
                    <label for="group_name">Select Group</label>
                    <select name="group_name" id="group_name" class="form-select select2" required>
                        <option hidden selected disabled>Select Group</option>
                        <option value="University-Information">University Information</option>
                        <option value="Student">Student</option>
                        <option value="Slider">Slider</option>
                        <option value="Success-Count">Success Count</option>
                        <option value="Service">Service</option>
                        <option value="Blog">Blog</option>
                        <option value="Gallery">Gallery</option>
                        <option value="University-Facility">University Facility</option>
                        <option value="Welcome-Video">Welcome Video</option>
                        <option value="Student-Feedback">Student Feedback</option>
                        <option value="Team-Member">Team Member</option>
                        <option value="Student-Help/Contact">Student Help/Contact</option>
                        <option value="Payment">Payment </option>
                        <option value="Letter">Letter </option>
                        <option value="Noc">Noc</option>
                        <option value="Visa">Visa</option>
                        <option value="Ticketing">Ticketing</option>
                        <option value="Referance">Referance</option>
                        <option value="Letter-Verification">Letter Verification</option>
                        <option value="Cashbook">Cashbook</option>
                        <option value="Coupon">Coupon</option>
                        <option value="Notice">Notice</option>
                        <option value="Refund-Policy">Refund Policy</option>
                        <option value="Contact-Message">Contact Message</option>
                        <option value="Setting">Setting</option>
                        <option value="Role-&-Permission">Role & Permission</option>
                        <option value="Admin-Manage">Admin Manage</option>
                        <option value="Total-Student">Total Student</option>
                        <option value="Total-Staff">Total Staff</option>
                        <option value="Total-Partner">Total Partner</option>
                        <option value="Total-Country">Total Country</option>
                        <option value="Total-University">Total University</option>
                        <option value="Total-Program-Dicipline">Total Program Dicipline</option>
                        <option value="Total-Department">Total Department</option>
                        <option value="Total-Courses">Total Courses</option>
                        <option value="Total-Content">Total Content</option>
                        <option value="Total-Payment">Total Payment</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success"> Permission Create</button>
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
