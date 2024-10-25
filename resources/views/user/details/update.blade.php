@extends('user.user_master')

@section('user__content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update Information</li>
                </ol>
            </nav>
        </div>
    </div>
    @php
        $primium__country = \App\Models\PrimiumCountry::get();
        $primium__university = \App\Models\PrimiumUniversity::get();
        $primium__course = \App\Models\PrimiumCourse::get();
        $primium__university_course = \App\Models\PrimiumUniversityCourse::get();
        $program_type = \App\Models\ProgramType::get();
        $student_country = \App\Models\StudentCountry::get();
    @endphp
    <div class="card radius-10">
        <div class="card-body">
            <form action="{{ route('update.details.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control "
                                value="{{ old('name', $user->name) }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="email">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control "
                                value="{{ old('name', $user->email) }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="country">Country</label>
                            <select name="country" id="country" class="form-select select2" style="width: 100%;">
                                <option value="" selected hidden disabled>Country</option>
                                @foreach ($student_country as $item)
                                    <option value="{{ $item->id }}" @if ($item->id == $user->country) selected @endif>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="city">{{ __('City/Town') }}</label>
                            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror"
                                name="city" value="{{ old('name', $user->city) }}" required autocomplete="city">

                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="phone">{{ __('Mobile') }}</label>
                            <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror"
                                name="phone" value="{{ old('name', $user->phone) }}" required autocomplete="ciphonety">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="regis__program">Program Type</label>

                            <input id="regis__program" type="text" class="form-control"
                                value="{{ optional($user->programType)->name }}" readonly>

                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="regis__country">Destination Country</label>
                            <input id="regis__country" type="text" class="form-control"
                                value="{{ optional($user->premiumCountry)->name }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="regis__university">Choose University</label>
                            <input id="regis__university" type="text" class="form-control"
                                value="{{ optional($user->premiumUniversity)->name }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="regis_course">Program Dicipline</label>
                            <input id="regis_course" type="text" class="form-control"
                                value="{{ optional($user->department)->name }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="regis_uni_course">Course</label>
                            <input id="regis_uni_course" type="text" class="form-control"
                                value="{{ optional($user->course)->name }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="o_level" style="width: 70%">10TH/'O' LEVEL</label>
                            <input type="file" id="o_level" name="o_level" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="a_level" style="width: 70%">12TH/'A' LEVEL</label>
                            <input type="file" id="a_level" name="a_level" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="graduate" style="width: 70%">GRADUATE</label>
                            <input type="file" id="graduate" name="graduate" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="post_graduate" style="width: 70%">POST GRADUATE</label>
                            <input type="file" id="post_graduate" name="post_graduate" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="nid" style="width: 70%">NID</label>
                            <input type="file" id="nid" name="nid" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="photo" style="width: 70%">PHOTO</label>
                            <input type="file" id="photo" name="photo" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="signature" style="width: 70%">SIGNATURE</label>
                            <input type="file" id="signature" name="signature" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="others" style="width: 70%">OTHERS</label>
                            <input type="file" id="others" name="others" class="form-control">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-info mt-3">Update</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#regis__country').change(function() {
                var countryId = $(this).val();

                $.ajax({
                    url: "{{ route('get-user-universities', ':countryId') }}".replace(':countryId',
                        countryId),
                    type: 'GET',
                    success: function(response) {
                        $('#regis__university').empty();
                        $('#regis__university').append(
                            '<option selected hidden disabled>Choose University</option>');

                        $.each(response, function(index, university) {
                            $('#regis__university').append('<option value="' +
                                university.id + '">' + university.name + '</option>'
                            );
                        });
                    }
                });
            });

            $('#regis__university').change(function() {
                var universityId = $(this).val();

                $.ajax({
                    url: "{{ route('get-user-courses', ':universityId') }}".replace(
                        ':universityId',
                        universityId),
                    type: 'GET',
                    success: function(response) {
                        $('#regis_course').empty();
                        $('#regis_course').append(
                            '<option selected hidden disabled>Choose University</option>');

                        $.each(response, function(index, course) {
                            $('#regis_course').append('<option value="' + course.id +
                                '">' + course.name + '</option>');
                        });
                    }
                });
            });
            $('#regis_course').change(function() {
                var courseId = $(this).val();

                $.ajax({
                    url: "{{ route('get-user-unicourses', ':courseId') }}".replace(':courseId',
                        courseId),
                    type: 'GET',
                    success: function(response) {
                        $('#regis_uni_course').empty();
                        $('#regis_uni_course').append(
                            '<option selected hidden disabled>Choose University</option>');

                        $.each(response, function(index, unicourse) {
                            $('#regis_uni_course').append('<option value="' + unicourse
                                .id + '">' + unicourse.name + '</option>');
                        });
                    }
                });
            });

        });
    </script>
@endsection
