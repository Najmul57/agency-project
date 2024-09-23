@extends('user.user_master')

@section('user__content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($user->name) }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="student__info">
        <div class="row">
            <div class="col-12 col-md-6">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>System Id: </th>
                        <td>{{ $user->system_id }}</td>
                    </tr>
                    <tr>
                        <th>Name: </th>
                        <td>{{ ucfirst($user->name) }}</td>
                    </tr>
                    <tr>
                        <th>Father's Name: </th>
                        <td>{{ ucfirst($user->f_name) }}</td>
                    </tr>
                    <tr>
                        <th>Mother's Name: </th>
                        <td>{{ ucfirst($user->m_name) }}</td>
                    </tr>
                    <tr>
                        <th>Email: </th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Date of Birth: </th>
                        <td>{{ date('d F Y', strtotime($user->dob)) }}</td>
                    </tr>
                    <tr>
                        <th>Phone: </th>
                        <td>{{ $user->phone }}</td>
                    </tr>
                    <tr>
                        <th>City: </th>
                        <td>{{ ucfirst($user->city) }}</td>
                    </tr>
                    <tr>
                        <th>Address: </th>
                        <td>{{ ucwords($user->address) }}</td>
                    </tr>
                    <tr>
                        <th>CGPA: </th>
                        <td>{{ $user->cgpa }}</td>
                    </tr>
                    <tr>
                        <th>Country: </th>
                        <td>{{ ucwords(optional($user->premiumCountry)->name) }}</td>
                    </tr>
                    <tr>
                        <th>University: </th>
                        <td>{{ ucwords(optional($user->premiumUniversity)->name) }}</td>
                    </tr>
                    <tr>
                        <th>Program: </th>
                        <td>{{ ucwords(optional($user->programType)->name) }}</td>
                    </tr>
                    <tr>
                        <th>Department: </th>
                        <td>{{ ucwords(optional($user->department)->name) }}</td>
                    </tr>
                    <tr>
                        <th>Course: </th>
                        <td>{{ ucwords(optional($user->course)->name) }}</td>
                    </tr>
                </table>
            </div>

            <div class="col-12 col-md-6">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Photo: </th>
                        <td>
                            @if ($user->photo && file_exists(public_path('upload/student/' . $user->photo)))
                                <a href="{{ asset('upload/student/' . $user->photo) }}" download>
                                    <img src="{{ asset('upload/student/' . $user->photo) }}" alt="{{ $user->name }}"
                                        style="width:100px; height:100px">
                                </a>
                            @else
                                <span>No photo available</span>
                            @endif
                        </td>
                        <th>NID: </th>
                        <td>
                            @if ($user->nid && file_exists(public_path('upload/student/' . $user->nid)))
                                <a href="{{ asset('upload/student/' . $user->nid) }}" download>
                                    <img src="{{ asset('upload/student/' . $user->nid) }}" alt="{{ $user->name }}"
                                        style="width:100px; height:100px">
                                </a>
                            @else
                                <span>No photo available</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Signature: </th>
                        <td>
                            @if ($user->signature && file_exists(public_path('upload/student/' . $user->signature)))
                                <a href="{{ asset('upload/student/' . $user->signature) }}" download>
                                    <img src="{{ asset('upload/student/' . $user->signature) }}" alt="{{ $user->name }}"
                                        style="width:100px; height:100px">
                                </a>
                            @else
                                <span>No photo available</span>
                            @endif
                        </td>
                        <th>O Lebel: </th>
                        <td>
                            @if ($user->o_level && file_exists(public_path('upload/student/' . $user->o_level)))
                                <a href="{{ asset('upload/student/' . $user->o_level) }}" download>
                                    <img src="{{ asset('upload/student/' . $user->o_level) }}" alt="{{ $user->name }}"
                                        style="width:100px; height:100px">
                                </a>
                            @else
                                <span>No photo available</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>A Lebel: </th>
                        <td>
                            @if ($user->a_level && file_exists(public_path('upload/student/' . $user->a_level)))
                                <a href="{{ asset('upload/student/' . $user->a_level) }}" download>
                                    <img src="{{ asset('upload/student/' . $user->a_level) }}" alt="{{ $user->name }}"
                                        style="width:100px; height:100px">
                                </a>
                            @else
                                <span>No photo available</span>
                            @endif
                        </td>
                        <th>Graduate: </th>
                        <td>
                            @if ($user->graduate && file_exists(public_path('upload/student/' . $user->graduate)))
                                <a href="{{ asset('upload/student/' . $user->graduate) }}" download>
                                    <img src="{{ asset('upload/student/' . $user->graduate) }}" alt="{{ $user->name }}"
                                        style="width:100px; height:100px">
                                </a>
                            @else
                                <span>No photo available</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Post Graduate: </th>
                        <td>
                            @if ($user->post_graduate && file_exists(public_path('upload/student/' . $user->post_graduate)))
                                <a href="{{ asset('upload/student/' . $user->post_graduate) }}" download>
                                    <img src="{{ asset('upload/student/' . $user->post_graduate) }}"
                                        alt="{{ $user->name }}" style="width:100px; height:100px">
                                </a>
                            @else
                                <span>No photo available</span>
                            @endif
                        </td>
                        <th>Others: </th>
                        <td>
                            @if ($user->others && file_exists(public_path('upload/student/' . $user->others)))
                                <a href="{{ asset('upload/student/' . $user->others) }}" download>
                                    <img src="{{ asset('upload/student/' . $user->others) }}" alt="{{ $user->name }}"
                                        style="width:100px; height:100px">
                                </a>
                            @else
                                <span>No photo available</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    @php
        $primium__country = \App\Models\PrimiumCountry::get();
        $primium__university = \App\Models\PrimiumUniversity::get();
        $primium__course = \App\Models\PrimiumCourse::get();
        $primium__university_course = \App\Models\PrimiumUniversityCourse::get();
        $program_type = \App\Models\ProgramType::get();
    @endphp
    <div class="card radius-10">
        <div class="card-body">
            <h2 class="text-center">Update Your Information</h2>
            <form action="{{ route('update.details.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row align-items-center">
                    <h4>Basic Information</h4>
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
                            <label for="city">{{ __('City/Town') }}</label>
                            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror"
                                name="city" value="{{ ucfirst(old('name', $user->city)) }}" required
                                autocomplete="city">

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
                                name="phone" value="{{ old('name', $user->phone) }}" required>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="f_name">{{ __('Father Name') }}</label>
                            <input id="f_name" type="text" class="form-control @error('f_name') is-invalid @enderror"
                                name="f_name" value="{{ old('name', $user->f_name) }}" required>
                            @error('f_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="m_name">{{ __('Mother Name') }}</label>
                            <input id="m_name" type="text"
                                class="form-control @error('m_name') is-invalid @enderror" name="m_name"
                                value="{{ old('name', $user->m_name) }}" required>
                            @error('m_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="dob">{{ __('Date of Birth') }}</label>
                            <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror"
                                name="dob" value="{{ old('name', $user->dob) }}" required>
                            @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="address">{{ __('Address') }}</label>
                            <input id="address" type="text"
                                class="form-control @error('address') is-invalid @enderror" name="address"
                                value="{{ old('name', $user->address) }}" required>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="row">
                    <h4>Course Information</h4>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="cgpa">CGPA</label>
                            <input type="number" name="cgpa" class="form-control" id="cgpa" max="4.0"
                                placeholder="enter cgpa" value="{{ old('cgpa', $user->cgpa) }}">
                            @if ($errors->has('cgpa'))
                                <span class="text-danger">{{ $errors->first('cgpa') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="regis__country">Destination Country</label>
                            <select name="regis__country" class="form-select select2 regis__country"
                                style="width: 100%;">
                                <option value="" selected hidden disabled>Destination Country</option>
                                @foreach ($primium__country as $item)
                                    <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="regis__university">Choose University</label>
                            <select name="regis__university" class="form-select select2 regis__university"
                                style="width: 100%;">
                                <option selected hidden disabled>Choose University</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="regis__program">Program Type</label>
                            <select name="regis__program" class="form-select select2 regis__program"
                                style="width: 100%;">
                                <option selected hidden disabled>Choose Program Type</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="regis__course">Program Discipline</label>
                            <select name="regis__course" class="form-select select2 regis_course" style="width: 100%;">
                                <option selected hidden disabled>Choose Discipline</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="regis_uni_course">Course</label>
                            <select name="regis__uni__course" class="form-select select2 regis_uni_course"
                                style="width: 100%;">
                                <option selected hidden disabled>Choose Course</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <h4>Certificate Information</h4>
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
    <script src="{{ asset('frontend') }}/assets/js/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.regis__country').change(function() {
                var countryId = $(this).val();
                $.ajax({
                    url: "{{ route('get-universitiesStd', ':countryId') }}".replace(':countryId',
                        countryId),
                    type: 'GET',
                    success: function(response) {
                        var selectUniversity = $('.regis__university');
                        selectUniversity.empty();
                        selectUniversity.append(
                            '<option selected hidden disabled>Choose University</option>');

                        $.each(response, function(index, university) {
                            selectUniversity.append('<option value="' + university.id +
                                '">' + university.name + '</option>');
                        });
                        selectUniversity.trigger('change');
                    }
                });
            });

            $('.regis__university').change(function() {
                var universityId = $(this).val();
                $.ajax({
                    url: "{{ route('get-programtypeStd', ':universityId') }}".replace(
                        ':universityId', universityId),
                    type: 'GET',
                    success: function(response) {
                        var selectProgram = $('.regis__program');
                        selectProgram.empty();
                        selectProgram.append(
                            '<option selected hidden disabled>Choose Program Type</option>');

                        $.each(response, function(index, programType) {
                            selectProgram.append('<option value="' + programType.id +
                                '">' + programType.name + '</option>');
                        });
                        selectProgram.trigger('change');
                    }
                });
            });

            $('.regis__program').change(function() {
                var programTypeId = $(this).val();
                $.ajax({
                    url: "{{ route('get-coursesStd', ':programTypeId') }}".replace(
                        ':programTypeId', programTypeId),
                    type: 'GET',
                    success: function(response) {
                        var selectCourse = $('.regis_course');
                        selectCourse.empty();
                        selectCourse.append(
                            '<option selected hidden disabled>Choose Discipline</option>');

                        $.each(response, function(index, course) {
                            selectCourse.append('<option value="' + course.id + '">' +
                                course.name + '</option>');
                        });
                        selectCourse.trigger('change');
                    }
                });
            });

            $('.regis_course').change(function() {
                var courseId = $(this).val();
                $.ajax({
                    url: "{{ route('get-unicoursesStd', ':courseId') }}".replace(':courseId',
                        courseId),
                    type: 'GET',
                    success: function(response) {
                        var selectUniCourse = $('.regis_uni_course');
                        selectUniCourse.empty();
                        selectUniCourse.append(
                            '<option selected hidden disabled>Choose Course</option>');

                        $.each(response, function(index, course) {
                            selectUniCourse.append('<option value="' + course.id +
                                '">' + course.name + '</option>');
                        });
                        selectUniCourse.trigger('change');
                    }
                });
            });
        });
    </script>
@endsection
