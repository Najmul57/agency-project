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
                    <li class="breadcrumb-item active" aria-current="page"> Course</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('primium.unicourse.list') }}" class="btn btn-info"> Course List</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('primium.unicourse.update', $uniCourse->id) }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="country_id"><strong>Country Name</strong></label> <br>
                    @php
                        $country_id = $data->country_id ?? null;
                    @endphp

                    <select name="country_id" class="select2 form-control @error('country_id') is-invalid @enderror"
                        id="country_id">
                        <option selected hidden>Select Country</option>
                        @foreach ($countries as $item)
                            {{-- {{ dd($item) }} --}}
                            <option value="{{ $item->id }}" {{ $item->id == $country_id ? 'selected' : '' }}>
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
                    <label for="course_id"><strong>Course Name</strong></label> <br>
                    <select name="course_id" class="select2 form-control @error('course_id') is-invalid @enderror"
                        id="course_id">
                        <option selected hidden>Select Course</option>
                    </select>
                    @error('course_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="name"><strong>Name</strong></label>
                    @php
                        $courselist = \App\Models\CoursesList::latest()->get();
                    @endphp
                    <select name="name" class="select2 form-control">
                        <option selected hidden>Select Course</option>
                        @foreach ($courselist as $item)
                            <option value="{{ $item->name }}" {{ $item->name == $uniCourse->name ? 'selected' : '' }}
                                data-image="{{ url("upload/courselist/{$item->image}") }}">
                                {{ ucfirst($item->name) }}
                            </option>
                        @endforeach
                    </select>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success mt-3">Update</button>
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

    <script>
        $(document).ready(function() {
            $('#country_id').change(function() {
                var countryId = $(this).val();
                if (countryId) {
                    $.ajax({
                        url: '{{ route('getUniversitiesNajmul') }}',
                        type: 'GET',
                        data: {
                            country_id: countryId
                        },
                        success: function(data) {
                            $('#university_id').empty().append(
                                '<option selected hidden>Select University</option>');
                            $.each(data, function(key, value) {
                                $('#university_id').append('<option value="' + key +
                                    '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#university_id').empty().append(
                        '<option selected hidden>Select University</option>');
                }
                $('#program_type_id').empty().append(
                    '<option selected hidden>Select Program Type</option>');
                $('#course_id').empty().append('<option selected hidden>Select Course</option>');
            });

            $('#university_id').change(function() {
                var universityId = $(this).val();
                if (universityId) {
                    $.ajax({
                        url: '{{ route('getProgramTypesNajmul') }}',
                        type: 'GET',
                        data: {
                            university_id: universityId
                        },
                        success: function(data) {
                            $('#program_type_id').empty().append(
                                '<option selected hidden>Select Program Type</option>');
                            $.each(data, function(key, value) {
                                $('#program_type_id').append('<option value="' + key +
                                    '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#program_type_id').empty().append(
                        '<option selected hidden>Select Program Type</option>');
                }
                $('#course_id').empty().append('<option selected hidden>Select Course</option>');
            });

            $('#program_type_id').change(function() {
                var programTypeId = $(this).val();
                if (programTypeId) {
                    $.ajax({
                        url: '{{ route('getCoursesNajmul') }}',
                        type: 'GET',
                        data: {
                            program_type_id: programTypeId
                        },
                        success: function(data) {
                            $('#course_id').empty().append(
                                '<option selected hidden>Select Course</option>');
                            $.each(data, function(key, value) {
                                $('#course_id').append('<option value="' + key + '">' +
                                    value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#course_id').empty().append('<option selected hidden>Select Course</option>');
                }
            });
        });
    </script>
@endsection
