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
                    <li class="breadcrumb-item active" aria-current="page">Department</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('primium.course.list') }}" class="btn btn-info">Department List</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('primium.course.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <label for="country_id"><strong>Country</strong></label> <br>
                    <select name="country_id" class="select2 form-control @error('country_id') is-invalid @enderror"
                        id="country_id">
                        <option disabled selected>Select Country</option>
                        @foreach ($countries as $item)
                            <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                        @endforeach
                    </select>
                    @error('country_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="university_id"><strong>University</strong></label> <br>
                    <select name="university_id" class="select2 form-control @error('university_id') is-invalid @enderror"
                        id="university_id">
                        <option disabled selected>Select University</option>
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
                        <option disabled selected>Select Program Type</option>
                    </select>
                    @error('program_type_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                @php
                    $department = \App\models\DepartmentList::orderby('name', 'asc')->get();
                @endphp
                <div class="form-group mb-3">
                    <label for="name"><strong>Name</strong></label>
                    <select name="name" class="select2 form-control @error('name') is-invalid @enderror" id="">
                        <option value="" hidden>Select Department</option>
                        @foreach ($department as $item)
                            <option value="{{ $item->name }}">{{ ucfirst($item->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="thumbnail"><strong>Thumbnail</strong></label>
                    <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror">
                    <p><strong class="text-danger">Note : </strong>Dimention 300 x 200</p>
                    @error('thumbnail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="breadcrumb"><strong>Breadcrumb</strong></label>
                    <input type="file" name="breadcrumb" class="form-control @error('breadcrumb') is-invalid @enderror">
                    @error('breadcrumb')
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

    <script>
        $(document).ready(function() {
            $('#country_id').change(function() {
                var countryId = $(this).val();
                if (countryId) {
                    $.ajax({
                        url: '{{ route('get-universities') }}',
                        type: 'GET',
                        data: {
                            country_id: countryId
                        },
                        success: function(data) {
                            $('#university_id').empty().append(
                                '<option disabled selected>Select University</option>');
                            $('#program_type_id').empty().append(
                                '<option disabled selected>Select Program Type</option>'
                            ); // Reset program types
                            $.each(data, function(key, value) {
                                $('#university_id').append('<option value="' + key +
                                    '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#university_id').empty().append(
                        '<option disabled selected>Select University</option>');
                    $('#program_type_id').empty().append(
                        '<option disabled selected>Select Program Type</option>');
                }
            });

            $('#university_id').change(function() {
                var universityId = $(this).val();
                if (universityId) {
                    $.ajax({
                        url: '{{ route('get-program-types') }}',
                        type: 'GET',
                        data: {
                            university_id: universityId
                        },
                        success: function(data) {
                            $('#program_type_id').empty().append(
                                '<option disabled selected>Select Program Type</option>');
                            $.each(data, function(key, value) {
                                $('#program_type_id').append('<option value="' + key +
                                    '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#program_type_id').empty().append(
                        '<option disabled selected>Select Program Type</option>');
                }
            });
        });
    </script>
@endsection
