@extends('partner.layouts.partner_master')

@section('partner__content')

    <style>
        .payment__page .nav-link {
            padding: 5px;
        }

        div#earnCreadit h5 span {
            background: #427fcc;
            display: inline-block;
            color: #fff;
            padding: 10px 20px;
            border-radius: 10px;
        }
    </style>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">{{ ucfirst(auth()->user()->name) }}</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Referance Page</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row ">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <span>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    <ul class="nav nav-tabs nav-primary payment__page" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#referralForm" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Referral Form</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#referralStudentlist" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Referral Student list</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#uploadPaymentReceipt" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Upload Payment Receipt</div>
                                </div>
                            </a>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#downloadPaymentReceipt" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Download Payment Receipt</div>
                                </div>
                            </a>
                        </li> --}}
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#earnCreadit" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Earn Creadit</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content py-3">
                        <div class="tab-pane fade" id="referralForm" role="tabpanel">
                            <form action="{{ route('partner.referance.form') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="referance" value='{{ Auth::user()->email }}'>
                                <div class="row align-items-center">
                                    <h5 class="py-2">Basic Information</h5>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="form-group mb-3">
                                            <label for="name">{{ __('Name') }}</label>
                                            <input id="name" name="name" type="text" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="form-group mb-3">
                                            <label for="email">{{ __('Email Address') }}</label>
                                            <input id="email" type="email" name="email" class="form-control ">

                                            <input type="checkbox" id="studentemail" name="studentemail"
                                                value="studentemail">
                                            <label for="studentemail"> Send Student Email?</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="form-group mb-3">
                                            <label for="city">{{ __('City/Town') }}</label>
                                            <input id="city" type="text"
                                                class="form-control @error('city') is-invalid @enderror" name="city"
                                                required autocomplete="city">

                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="form-group mb-3">
                                            <label for="phone">{{ __('Mobile') }}</label>
                                            <input id="phone" type="number"
                                                class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                required autocomplete="ciphonety">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <h5 class="py-2">Course Information</h5>
                                    @php
                                        $countries = \App\Models\PrimiumCountry::where('status', 1)
                                            ->orderBy('name', 'asc')
                                            ->get();
                                    @endphp
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="countryDropdown">Select Country</label>
                                            <select name="country_id" class="form-select" id="countryDropdown">
                                                <option disabled selected>Select Country</option>
                                                @foreach ($countries as $item)
                                                    <option value="{{ $item->id }}">{{ ucfirst($item->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="universityDropdown">Select University</label>
                                            <select name="university_id" class="form-select" id="universityDropdown">
                                                <option disabled selected>Select University</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="programDropdown">Program Type</label>
                                            <select name="program_id" class="form-select" id="programDropdown">
                                                <option>Select Program</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="departmentDropdown">Select Department</label>
                                            <select name="course_id" class="form-select" id="coursesDropdown">
                                                <option>Select Department</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="courseDropdown">Select Course</label>
                                            <select name="unicourse_id" class="form-select" id="uniCoursesDropdown">
                                                <option>Select Course</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <h5 class="py-2">Upload Documents</h5>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="form-group mb-3">
                                            <label for="a_level" style="width: 70%">12TH/'A' LEVEL</label>
                                            <input type="file" id="a_level" name="a_level" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="form-group mb-3">
                                            <label for="graduate" style="width: 70%">GRADUATE</label>
                                            <input type="file" id="graduate" name="graduate" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="form-group mb-3">
                                            <label for="post_graduate" style="width: 70%">POST GRADUATE</label>
                                            <input type="file" id="post_graduate" name="post_graduate"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="form-group mb-3">
                                            <label for="nid" style="width: 70%">NID<span
                                                    class="text-danger">*</span></label>
                                            <input type="file" id="nid" name="nid" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="form-group mb-3">
                                            <label for="photo" style="width: 70%">PHOTO<span
                                                    class="text-danger">*</span></label>
                                            <input type="file" id="photo" name="photo" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="form-group mb-3">
                                            <label for="signature" style="width: 70%">SIGNATURE<span
                                                    class="text-danger">*</span></label>
                                            <input type="file" id="signature" name="signature" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="form-group mb-3">
                                            <label for="others" style="width: 70%">OTHERS</label>
                                            <input type="file" id="others" name="others" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-info mt-3">Submit</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="referralStudentlist" role="tabpanel">
                            @php
                                $users = \App\Models\User::where('role_id', 2)
                                    ->where('referance', auth()->user()->email)
                                    ->get();
                            @endphp

                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered example">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>System Id</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($users->isNotEmpty())
                                                    @foreach ($users as $key => $user)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $user->system_id }}</td>
                                                            <td>{{ ucfirst($user->name) }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->phone }}</td>
                                                            <td><a
                                                                    href="{{ route('partner.referrance', $user->id) }}">Show</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>System Id</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="uploadPaymentReceipt" role="tabpanel">
                            @php
                                $authUserEmail = auth()->user()->email;
                                $users = \App\Models\User::where('role_id', 2)
                                    ->where('referance', $authUserEmail)
                                    ->get();
                            @endphp
                            <form action="{{ route('paymentreceipt.partnetStudent') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-2">
                                    <label for="referace_user_id">Select Student</label>
                                    <select name="referace_user_id" id="referace_user_id" class="form-select" required>
                                        <option selected disabled>Select Student</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }} - {{ $user->system_id }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="receipt">Upload Receipt</label>
                                    <input type="file" id="receipt" name="receipt" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-success mt-3">Submit</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="downloadPaymentReceipt" role="tabpanel">
                            @php
                                $users = \App\Models\User::where('role_id', 2)
                                    ->where('referance', auth()->user()->email)
                                    ->get();
                            @endphp

                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered example">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>System Id</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($users->isNotEmpty())
                                                    @foreach ($users as $key => $user)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $user->system_id }}</td>
                                                            <td>{{ ucfirst($user->name) }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->phone }}</td>
                                                            <td>
                                                                <a class="btn btn-sm btn-primary"
                                                                    href="{{ route('partner.receipt.download', ['id' => $user->id]) }}">Download</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>System Id</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="earnCreadit" role="tabpanel">
                            <h5>You are Earning <span>{{ Auth::user()->balance }}</span> Points</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $('#countryDropdown').on('change', function() {
            var idCountry = this.value;
            $("#universityDropdown").html('');
            $.ajax({
                url: "{{ route('partner.fetchUniversity') }}",
                type: "POST",
                data: {
                    country_id: idCountry,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#universityDropdown').html(
                        '<option selected hidden>-- Select University --</option>');
                    $.each(result.university, function(key, value) {
                        let capitalizedValueName = value.name.charAt(0)
                            .toUpperCase() + value.name.slice(1);
                        $("#universityDropdown").append('<option value="' + value.id + '">' +
                            capitalizedValueName + '</option>');
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#universityDropdown').on('change', function() {
                var universityId = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('partner.fetchProgram') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'university_id': universityId
                    },
                    success: function(data) {
                        var programDropdown = $('#programDropdown');
                        programDropdown.empty();
                        programDropdown.append('<option>Select Program</option>');
                        $.each(data.programs, function(key, value) {
                            let capitalizedValueName = value.name.charAt(0)
                                .toUpperCase() + value.name.slice(1);
                            programDropdown.append('<option value="' + value.id + '">' +
                                capitalizedValueName + '</option>');
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching programs:', error);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#programDropdown').on('change', function() {
                var programId = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('partner.fetchDepartment') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'program_id': programId // Adjusted to match the expected parameter name in the PHP function
                    },
                    success: function(data) {
                        var coursesDropdown = $('#coursesDropdown');
                        coursesDropdown.empty();
                        coursesDropdown.append('<option>Select Department</option>');
                        $.each(data.departments, function(key, value) {
                            let capitalizedValueName = value.name.charAt(0)
                                .toUpperCase() + value.name.slice(1);
                            coursesDropdown.append('<option value="' + value.id + '">' +
                                capitalizedValueName + '</option>');
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching departments:', error);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#coursesDropdown').on('change', function() {
                var courseId = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('partner.fetchUniversityCourse') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'course_id': courseId
                    },
                    success: function(data) {
                        var uniCoursesDropdown = $('#uniCoursesDropdown');
                        uniCoursesDropdown.empty();
                        uniCoursesDropdown.append(
                            '<option selected hidden>Select University Course</option>');
                        $.each(data.universityCourses, function(key, value) {
                            let capitalizedValueName = value.name.charAt(0)
                                .toUpperCase() + value.name.slice(1);
                            uniCoursesDropdown.append('<option value="' + value.id +
                                '">' + capitalizedValueName + '</option>');
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching university courses:', error);
                    }
                });
            });
        });
    </script>

@endsection
