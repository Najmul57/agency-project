@extends('user.user_master')

@section('user__content')
    <style>
        .payment__page .nav-link {
            padding: 5px;
        }
    </style>
    @php
        $primium__country = \App\Models\PrimiumCountry::get();
        $primium__university = \App\Models\PrimiumUniversity::get();
        $primium__course = \App\Models\PrimiumCourse::get();
        $primium__university_course = \App\Models\PrimiumUniversityCourse::get();
    @endphp
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">{{ ucfirst(auth()->user()->name) }}</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Noc Page</li>
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
                            <a class="nav-link" data-bs-toggle="tab" href="#nocForm" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Noc Form</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#uploadNoc" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Upload Noc</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#downloadNoc" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Download Noc</div>
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
                            {!! $nocGuideline->description !!}
                        </div>
                        <div class="tab-pane fade" id="nocForm" role="tabpanel">
                            <form action="{{ route('noc.form.submit') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="system_id">System ID</label>
                                            <input type="text" name="system_id" id="system_id" class="form-control"
                                                value="{{ Auth::user()->system_id }}" readonly>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="name">Name of Student</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ Auth::user()->name }}" readonly>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="f_name">Fathers Name</label>
                                            <input type="text" name="f_name" id="f_name" class="form-control"
                                                value="{{ Auth::user()->f_name }}" readonly>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="m_name">Mothers Name</label>
                                            <input type="text" name="m_name" id="m_name" class="form-control"
                                                value="{{ Auth::user()->m_name }}" readonly>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="passport">Passport Number</label>
                                            <input type="text" name="passport" id="passport" class="form-control"
                                                placeholder="enter passport number">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" id="address" class="form-control"
                                                value="{{ Auth::user()->address }}" readonly>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                value="{{ Auth::user()->email }}" readonly>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="number">Phone</label>
                                            <input type="number" name="number" id="number" class="form-control"
                                                value="{{ Auth::user()->phone }}" readonly>
                                        </div>
                                    </div>
                                    @php
                                        $countries = \App\Models\PrimiumCountry::where('status', 1)
                                            ->orderby('name', 'asc')
                                            ->get();
                                    @endphp
                                    <div class="col-12 col-md-6">
                                        <div class="form-group mb-2" style="width:100%">
                                            <label for="countryDropdown">Select Country</label>
                                            <select name="country_id" class="form-select" id="countryDropdown">
                                                <option disabled selected>Select Country</option>
                                                @foreach ($countries as $item)
                                                    <option value="{{ $item->id }}">{{ ucfirst($item->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-2" style="width:100%">
                                            <label for="universityDropdown">Select University</label>
                                            <select name="university_id" class="form-select" id="universityDropdown">
                                                <option disabled selected>Select University</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-2" style="width:100%">
                                            <label for="programDropdown">Program Type</label>
                                            <select name="program_id" class="form-select" id="programDropdown">
                                                <option>Select Program</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-2" style="width:100%">
                                            <label for="departmentDropdown">Select Department</label>
                                            <select name="course_id" class="form-select" id="coursesDropdown">
                                                <option>Select Department</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-2" style="width:100%">
                                            <label for="courseDropdown">Select Course</label>
                                            <select name="unicourse_id" class="form-select" id="uniCoursesDropdown">
                                                <option>Select Course</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="signature">Student Signature</label>
                                            <input type="file" class="form-control" name="signature">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="guirdiansignature">Student Guidian Signature</label>
                                            <input type="file" class="form-control" name="guirdiansignature">
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary w-auto mt-3 me-2 d-inline-block">Submit</button>
                                </div>
                            </form>
                            <br> <br>

                            @php
                                $existingFile = \App\Models\NocForAll::first();
                            @endphp

                            @if ($existingFile)
                                <a href="{{ route('noc.download') }}" class="btn btn-info">Download Noc Form</a>
                            @else
                                <a href="#" class="btn btn-info disabled">Download Noc Form</a>
                                <p class="text-danger">We're working on it! Please wait for our <strong>Admin</strong> to
                                    upload the NOC
                                    file.
                                    You'll be able to download it as soon as it's available.</p>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="uploadNoc" role="tabpanel">
                            {{-- @if (session('message'))
                                <div class="alert alert-{{ session('alert-type') }}">
                                    {{ session('message') }}
                                </div>
                            @endif --}}

                            <form action="{{ route('noc.upload') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="uploadpdf">Upload Noc File</label>
                                    <input type="file" id="uploadpdf" name="uploadpdf" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-success mt-2">Submit</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="downloadNoc" role="tabpanel">
                            @php
                                $downloadNoc = \App\Models\NocForm::where('user_id', auth()->id())
                                    ->where('status', 1)
                                    ->get();
                            @endphp
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered example2" id="example2">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>System ID</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($downloadNoc as $key => $row)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $row->system_id }}</td>
                                                        <td><a
                                                                href="{{ route('noc.form.single.pdf.student', $row->id) }}">Download</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>System ID</th>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/jquery.min.js"></script>
    <script>
        $('#countryDropdown').on('change', function() {
            var idCountry = this.value;
            $("#universityDropdown").html('');
            $.ajax({
                url: "{{ route('fetchUniversity') }}",
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
                        $("#universityDropdown").append('<option value="' + value.id + '">' +
                            value.name + '</option>');
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
                    url: '{{ route('fetchProgram') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'university_id': universityId
                    },
                    success: function(data) {
                        var programDropdown = $('#programDropdown');
                        programDropdown.empty();
                        programDropdown.append('<option>Select Program</option>');
                        $.each(data.programs, function(key, value) {
                            programDropdown.append('<option value="' + value.id + '">' +
                                value.name + '</option>');
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
                    url: '{{ route('fetchDepartment') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'program_id': programId // Adjusted to match the expected parameter name in the PHP function
                    },
                    success: function(data) {
                        var coursesDropdown = $('#coursesDropdown');
                        coursesDropdown.empty();
                        coursesDropdown.append('<option>Select Department</option>');
                        $.each(data.departments, function(key, value) {
                            coursesDropdown.append('<option value="' + value.id + '">' +
                                value.name + '</option>');
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
                    url: '{{ route('fetchUniversityCourse') }}',
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
                            uniCoursesDropdown.append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching university courses:', error);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#uniCoursesDropdown').on('change', function() {
                var courseId = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('fetchUniversityContent') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'universitycourse_id': courseId
                    },
                    success: function(data) {
                        var descriptionDiv = $('.description');
                        descriptionDiv.empty();

                        var overviewDiv = $('.overview');
                        overviewDiv.empty();

                        var criteriaDiv = $('.criteria');
                        criteriaDiv.empty();

                        var scholarshipDiv = $('.scholarship');
                        scholarshipDiv.empty();

                        var careerDiv = $('.career');
                        careerDiv.empty();

                        var feeDiv = $('.fee');
                        feeDiv.empty();

                        var assistanceDiv = $('.assistance');
                        assistanceDiv.empty();

                        var faqDiv = $('.faq');
                        faqDiv.empty();

                        $.each(data.universityContent, function(key, value) {
                            descriptionDiv.append('<div>' + value.description +
                                '</div>');
                        });
                        $.each(data.universityContent, function(key, value) {
                            overviewDiv.append('<div>' + value.overview + '</div>');
                        });
                        $.each(data.universityContent, function(key, value) {
                            criteriaDiv.append('<div>' + value.criteria + '</div>');
                        });
                        $.each(data.universityContent, function(key, value) {
                            scholarshipDiv.append('<div>' + value.scholarship +
                                '</div>');
                        });
                        $.each(data.universityContent, function(key, value) {
                            careerDiv.append('<div>' + value.career + '</div>');
                        });
                        $.each(data.universityContent, function(key, value) {
                            feeDiv.append('<div>' + value.fee + '</div>');
                        });
                        $.each(data.universityContent, function(key, value) {
                            assistanceDiv.append('<div>' + value.assistance + '</div>');
                        });
                        $.each(data.universityContent, function(key, value) {
                            faqDiv.append('<div>' + value.faq + '</div>');
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
