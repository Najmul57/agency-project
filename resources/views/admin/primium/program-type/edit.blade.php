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
                    <li class="breadcrumb-item active" aria-current="page">Program Type</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('program.type') }}" class="btn btn-info">Program Type List</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('program.type.update', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="country_id"><strong>Country Name</strong></label> <br>
                    <select name="country_id" class="select2 form-control @error('country_id') is-invalid @enderror"
                        id="country_id">
                        <option selected disabled value="">Select Country</option>
                        @foreach ($countries as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $selectedCountryId ? 'selected' : '' }}>
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
                        <option selected disabled value="">Select University</option>
                    </select>
                    @error('university_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name"><strong>Name</strong></label>
                    @php
                        $types = \App\Models\ProgramTypeList::latest()->get();
                    @endphp
                    <select name="name" id="name" class="select2 form-control @error('name') is-invalid @enderror">
                        <option value="">Select Program Type</option>
                        @foreach ($types as $item)
                            <option value="{{ $item->name }}" {{ old('name') == $item->name ? 'selected' : '' }}>
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

                <div class="form-group mb-2 mt-2">
                    <label for="thumbnail"><strong>Thumbnail</strong></label>
                    <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror">
                    <p><strong class="text-danger">Note : </strong>Dimention 300 x 200</p>
                    @error('thumbnail')
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
        $(document).ready(function() {
            // Function to populate universities based on selected country
            function populateUniversities(countryId, selectedUniversityId = null) {
                if (countryId) {
                    $.ajax({
                        url: '{{ route('get-universities') }}',
                        type: 'GET',
                        data: {
                            country_id: countryId
                        },
                        success: function(data) {
                            $('#university_id').empty();
                            $('#university_id').append(
                                '<option selected disabled value="">Select University</option>');
                            $.each(data, function(key, value) {
                                if (key == selectedUniversityId) {
                                    $('#university_id').append('<option value="' + key +
                                        '" selected>' + value + '</option>');
                                } else {
                                    $('#university_id').append('<option value="' + key + '">' +
                                        value + '</option>');
                                }
                            });
                        }
                    });
                } else {
                    $('#university_id').empty();
                    $('#university_id').append('<option selected disabled value="">Select University</option>');
                }
            }

            // Event listener for country dropdown change
            $('#country_id').change(function() {
                var countryId = $(this).val();
                populateUniversities(countryId);
            });

            // Populate universities for the selected country on page load
            var selectedCountryId = '{{ $selectedCountryId }}';
            var selectedUniversityId = '{{ $selectedUniversityId }}';
            if (selectedCountryId) {
                populateUniversities(selectedCountryId, selectedUniversityId);
            }
        });
    </script>

    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
