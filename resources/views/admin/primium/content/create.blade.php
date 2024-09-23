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
                    <li class="breadcrumb-item active" aria-current="page"> Course Content</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('primium.content.list') }}" class="btn btn-info"> Course Content List</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('primium.content.store') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="country_id"><strong>Country Name</strong></label> <br>
                    <select name="country_id" class="select2 form-control @error('country_id') is-invalid @enderror"
                        id="country_id">
                        <option selected hidden>Select Country</option>
                        @foreach ($countries as $item)
                            <option value="{{ $item->id }}"
                                {{ old('country_id', $data->country_id ?? '') == $item->id ? 'selected' : '' }}>
                                {{ ucfirst($item->name) }}
                            </option>
                        @endforeach
                    </select>
                    @error('country_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="university_id"><strong>University Name</strong></label> <br>
                    <select name="university_id" class="select2 form-control @error('university_id') is-invalid @enderror"
                        id="university_id">
                        <option selected hidden>Select University</option>
                    </select>
                    @error('university_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="program_type_id"><strong>Program Type</strong></label> <br>
                    <select name="program_type_id"
                        class="select2 form-control @error('program_type_id') is-invalid @enderror" id="program_type_id">
                        <option selected hidden>Select Program Type</option>
                    </select>
                    @error('program_type_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="course_id"><strong>Department Name</strong></label> <br>
                    <select name="course_id" class="select2 form-control @error('course_id') is-invalid @enderror"
                        id="course_id">
                        <option selected hidden>Select Department</option>
                    </select>
                    @error('course_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="universitycourse_id"><strong>Course Name</strong></label> <br>
                    <select name="universitycourse_id"
                        class="select2 form-control @error('universitycourse_id') is-invalid @enderror"
                        id="universitycourse_id">
                        <option selected hidden>Select Course</option>
                    </select>
                    @error('universitycourse_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="overview"><strong>Program Overview</strong></label>
                    <textarea name="overview" id="overview" class="summernote" class="form-control @error('overview') is-invalid @enderror"
                        rows="10"></textarea>
                    @error('overview')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="criteria"><strong>Eligibility Criteria</strong></label>
                    <textarea name="criteria" id="criteria" class="summernote" class="form-control @error('criteria') is-invalid @enderror"
                        rows="10"></textarea>
                    @error('criteria')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="scholarship"><strong>Scholarship</strong></label>
                    <textarea name="scholarship" id="scholarship" class="summernote"
                        class="form-control @error('scholarship') is-invalid @enderror" rows="10"></textarea>
                    @error('scholarship')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="career"><strong>Career Path</strong></label>
                    <textarea name="career" id="career" class="summernote" class="form-control @error('career') is-invalid @enderror"
                        rows="10"></textarea>
                    @error('career')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="fee"><strong>Programme Fee</strong></label>
                    <textarea name="fee" id="fee" class="summernote" class="form-control @error('fee') is-invalid @enderror"
                        rows="10"></textarea>
                    @error('fee')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="assistance"><strong>Financial Assistance</strong></label>
                    <textarea name="assistance" id="assistance" class="summernote"
                        class="form-control @error('assistance') is-invalid @enderror" rows="10"></textarea>
                    @error('assistance')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="faq"><strong>Frequently Asked Questions (FAQ's)</strong></label>
                    <textarea name="faq" id="faq" class="summernote" class="form-control @error('faq') is-invalid @enderror"
                        rows="10"></textarea>
                    @error('faq')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/select2/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $('.summernote').summernote({
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>

    <script>
        $(document).ready(function() {
            var preselectedCountryId = '{{ old('country_id', $data->country_id ?? '') }}';
            var preselectedUniversityId = '{{ old('university_id', $data->university_id ?? '') }}';
            var preselectedProgramTypeId = '{{ old('program_type_id', $data->program_type_id ?? '') }}';
            var preselectedCourseId = '{{ old('course_id', $data->course_id ?? '') }}';
            var preselectedUniversityCourseId =
                '{{ old('universitycourse_id', $data->universitycourse_id ?? '') }}';

            function fetchUniversities(countryId, selectedUniversityId = null) {
                $.get('{{ route('getUniversitiesUniContent') }}', {
                    country_id: countryId
                }, function(data) {
                    $('#university_id').empty().append(
                        '<option disabled selected>Select University</option>');
                    $('#program_type_id').empty().append(
                        '<option disabled selected>Select Program Type</option>');
                    $('#course_id').empty().append('<option disabled selected>Select Department</option>');
                    $('#universitycourse_id').empty().append(
                        '<option disabled selected>Select Course</option>');
                    $.each(data, function(key, value) {
                        $('#university_id').append('<option value="' + key + '">' + value +
                            '</option>');
                    });
                    if (selectedUniversityId) {
                        $('#university_id').val(selectedUniversityId).trigger('change');
                    }
                });
            }

            function fetchProgramTypes(universityId, selectedProgramTypeId = null) {
                $.get('{{ route('getProgramTypesUniContent') }}', {
                    university_id: universityId
                }, function(data) {
                    $('#program_type_id').empty().append(
                        '<option disabled selected>Select Program Type</option>');
                    $('#course_id').empty().append('<option disabled selected>Select Department</option>');
                    $('#universitycourse_id').empty().append(
                        '<option disabled selected>Select Course</option>');
                    $.each(data, function(key, value) {
                        $('#program_type_id').append('<option value="' + key + '">' + value +
                            '</option>');
                    });
                    if (selectedProgramTypeId) {
                        $('#program_type_id').val(selectedProgramTypeId).trigger('change');
                    }
                });
            }

            function fetchCourses(programTypeId, selectedCourseId = null) {
                $.get('{{ route('getCoursesUniContent') }}', {
                    program_type_id: programTypeId
                }, function(data) {
                    $('#course_id').empty().append('<option disabled selected>Select Department</option>');
                    $('#universitycourse_id').empty().append(
                        '<option disabled selected>Select Course</option>');
                    $.each(data, function(key, value) {
                        $('#course_id').append('<option value="' + key + '">' + value +
                            '</option>');
                    });
                    if (selectedCourseId) {
                        $('#course_id').val(selectedCourseId).trigger('change');
                    }
                });
            }

            function fetchUniversityCourses(courseId, selectedUniversityCourseId = null) {
                $.get('{{ route('getUniversityCoursesUniContent') }}', {
                    course_id: courseId
                }, function(data) {
                    $('#universitycourse_id').empty().append(
                        '<option disabled selected>Select Course</option>');
                    $.each(data, function(key, value) {
                        $('#universitycourse_id').append('<option value="' + key + '">' + value +
                            '</option>');
                    });
                    if (selectedUniversityCourseId) {
                        $('#universitycourse_id').val(selectedUniversityCourseId);
                    }
                });
            }

            $('#country_id').change(function() {
                fetchUniversities($(this).val());
            });

            $('#university_id').change(function() {
                fetchProgramTypes($(this).val());
            });

            $('#program_type_id').change(function() {
                fetchCourses($(this).val());
            });

            $('#course_id').change(function() {
                fetchUniversityCourses($(this).val());
            });

            if (preselectedCountryId) {
                $('#country_id').val(preselectedCountryId).trigger('change');
            }
            if (preselectedUniversityId) {
                fetchUniversities(preselectedCountryId, preselectedUniversityId);
            }
            if (preselectedProgramTypeId) {
                fetchProgramTypes(preselectedUniversityId, preselectedProgramTypeId);
            }
            if (preselectedCourseId) {
                fetchCourses(preselectedProgramTypeId, preselectedCourseId);
            }
            if (preselectedUniversityCourseId) {
                fetchUniversityCourses(preselectedCourseId, preselectedUniversityCourseId);
            }
        });
    </script>
@endsection
