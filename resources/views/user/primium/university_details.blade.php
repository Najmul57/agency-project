@extends('user.user_master')


@section('user__content')
    <div class="card p-3">

        <div class="row g-3">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="countryDropdown">Select Country</label>
                    <select name="country_id" class="form-select" id="countryDropdown">
                        <option disabled selected>Select Country</option>
                        @foreach ($countries as $item)
                            <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="universityDropdown">Select University</label>
                    <select name="university_id" class="form-select" id="universityDropdown">
                        <option disabled selected>Select University</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="programDropdown">Program Type</label>
                    <select name="program_id" class="form-select" id="programDropdown">
                        <option>Select Program</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="departmentDropdown">Select Department</label>
                    <select name="course_id" class="form-select" id="coursesDropdown">
                        <option>Select Department</option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="courseDropdown">Select Course</label>
                    <select name="unicourse_id" class="form-select" id="uniCoursesDropdown">
                        <option>Select Course</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-primary" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link " data-bs-toggle="tab" href="#overview" role="tab"
                                    aria-selected="true">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title">Programme Overview</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#criteria" role="tab"
                                    aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title">Eligibility Criteria</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#scholarship" role="tab"
                                    aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title">Scholarship</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#career" role="tab"
                                    aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title">Career Path</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#programFee" role="tab"
                                    aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title">Programme Fee</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#financial" role="tab"
                                    aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title">Financial Assistance</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#faq" role="tab"
                                    aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title">FAG</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content py-3">
                            <div class="tab-pane fade " id="overview" role="tabpanel">
                                <div class="overview"></div>
                            </div>
                            <div class="tab-pane fade" id="criteria" role="tabpanel">
                                <div class="criteria"></div>
                            </div>
                            <div class="tab-pane fade" id="scholarship" role="tabpanel">
                                <div class="scholarship"></div>
                            </div>
                            <div class="tab-pane fade" id="career" role="tabpanel">
                                <div class="career"></div>
                            </div>
                            <div class="tab-pane fade" id="programFee" role="tabpanel">
                                <div class="fee"></div>
                            </div>
                            <div class="tab-pane fade" id="financial" role="tabpanel">
                                <div class="assistance"></div>
                            </div>
                            <div class="tab-pane fade" id="faq" role="tabpanel">
                                <div class="faq"></div>
                            </div>
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
