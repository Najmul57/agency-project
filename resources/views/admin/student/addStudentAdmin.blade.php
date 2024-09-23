@extends('admin.admin_master')

@section('admin_content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .icon-outer img {
            max-width: 90px;
            margin: auto;
            width: 100%;
            border-radius: 100%;
        }

        .select2-container .select2-selection--single {
            height: 44px !important;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-top: 6px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 10px;
        }

        .pricing-block .inner-box {
            position: relative;
            background-color: #ffffff;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            padding: 0 0 30px;
            max-width: 370px;
            margin: 0 auto;
            border-bottom: 20px solid #40cbb4;
        }

        .pricing-block .icon-box {
            position: relative;
            padding: 50px 30px 0;
            background-color: #40cbb4;
            text-align: center;
        }

        .pricing-block .icon-box:before {
            position: absolute;
            left: 0;
            bottom: 0;
            height: 75px;
            width: 100%;
            border-radius: 50% 50% 0 0;
            background-color: #ffffff;
            content: "";
        }


        .pricing-block .icon-box .icon-outer {
            position: relative;
            height: 150px;
            width: 150px;
            background-color: #ffffff;
            border-radius: 50%;
            margin: 0 auto;
            padding: 10px;
        }

        .pricing-block .icon-box i {
            position: relative;
            display: block;
            height: 130px;
            width: 130px;
            line-height: 120px;
            border: 5px solid #40cbb4;
            border-radius: 50%;
            font-size: 50px;
            color: #40cbb4;
            -webkit-transition: all 600ms ease;
            -ms-transition: all 600ms ease;
            -o-transition: all 600ms ease;
            -moz-transition: all 600ms ease;
            transition: all 600ms ease;
        }

        .pricing-block .inner-box:hover .icon-box i {
            transform: rotate(360deg);
        }

        .pricing-block .price-box {
            position: relative;
            text-align: center;
            padding: 10px 20px;
        }

        ul.features li i {
            background: #054FB0;
            color: #fff;
            width: 25px;
            height: 25px;
            line-height: 1.8;
            border-radius: 50%;
            text-align: center;
            margin-right: 5px;
        }

        .pricing-block .title {
            position: relative;
            display: block;
            font-size: 24px;
            line-height: 1.2em;
            color: #222222;
            background: #054FB0;
            color: #fff;
            padding: 10px 0;
            border-radius: 10px;
            font-weight: 600;
        }

        .pricing-block .price {
            display: block;
            font-size: 30px;
            color: #222222;
            font-weight: 700;
            color: #40cbb4;
        }


        .pricing-block .features {
            position: relative;
            max-width: 225px;
            margin: 0 auto 20px;
        }

        .pricing-block .features li {
            position: relative;
            display: block;
            font-size: 14px;
            line-height: 30px;
            color: #848484;
            font-weight: 500;
            padding: 5px 0;
            border-bottom: 1px dashed #dddddd;
        }


        .pricing-block .features li a {
            color: #848484;
        }

        .pricing-block .features li:last-child {
            border-bottom: 0;
        }

        .pricing-block .btn-box {
            position: relative;
            text-align: center;
        }

        .pricing-block .btn-box a {
            position: relative;
            display: inline-block;
            font-size: 14px;
            line-height: 25px;
            color: #ffffff;
            font-weight: 500;
            padding: 8px 30px;
            background-color: #40cbb4;
            border-radius: 10px;
            border-top: 2px solid transparent;
            border-bottom: 2px solid transparent;
            -webkit-transition: all 400ms ease;
            -moz-transition: all 400ms ease;
            -ms-transition: all 400ms ease;
            -o-transition: all 400ms ease;
            transition: all 300ms ease;
        }

        .pricing-block .btn-box a:hover {
            color: #ffffff;
        }

        .pricing-block .inner-box:hover .btn-box a {
            color: #40cbb4;
            background: none;
            border-radius: 0px;
            border-color: #40cbb4;
        }

        .pricing-block:nth-child(2) .icon-box i,
        .pricing-block:nth-child(2) .inner-box {
            border-color: #1d95d2;
        }

        .pricing-block:nth-child(2) .btn-box a,
        .pricing-block:nth-child(2) .icon-box {
            background-color: #1d95d2;
        }

        .pricing-block:nth-child(2) .inner-box:hover .btn-box a {
            color: #1d95d2;
            background: none;
            border-radius: 0px;
            border-color: #1d95d2;
        }

        .free,
        .primium,
        .partner {
            display: none;
        }

        .form-title {
            color: #00c5b2;
            font-size: 22px;
            font-weight: 500;
            text-transform: uppercase;
            text-align: center;
            margin: 15px 0px 30px 0px;
        }

        .form-title-sc {
            color: #2c3638;
            font-size: 18px;
            font-weight: 500;
            text-transform: uppercase;
            text-align: center;
            margin: 15px 0px 30px 0px;
        }

        .contact__area .form {
            position: relative;
            width: 100%;
            padding: 15px 30px;
            background: white;
            box-shadow: 0px 0px 3px rgb(208 208 208 / 30%);
            border-radius: 4px;
        }

        .form-controll {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .form-controll:not(:last-of-type) {
            margin-bottom: 33px;
        }

        .form-input {
            position: relative;
            width: 100%;
        }

        .form-input input,
        .form-input textarea {
            position: relative;
            width: 100%;
            padding: 8px 0px;
            outline: 1px solid transparent;
            border: 1px solid transparent;
            border-bottom: 1px solid #c2c2c2;
            background: transparent !important;
            z-index: 9;
            color: #2c3638;
        }

        .form-controll label {
            position: absolute;
            left: 0px;
            bottom: 10px;
            color: #c2c2c2;
            font-size: 14px;
            z-index: 1;
            transition: all 0.1s ease-in;
        }

        input:focus+label,
        input:valid+label,
        textarea:focus+label,
        textarea:valid+label {
            bottom: 100%;
            z-index: 9;
            transition: all 0.1s ease-in-out;
        }

        textarea {
            resize: none;
            min-height: 50px;
        }

        input:focus {
            border-bottom: 1px solid #00c5b2;
        }



        .form-submit {
            position: relative;
            width: 100%;
            margin: 14px 0px;
        }

        .form-submit .form-btn {
            width: 100%;
            padding: 8px;
            background: #00c5b191;
            font-weight: 500;
            font-size: 14px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid transparent;
            text-transform: uppercase;
            transition: all 0.2s ease;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            letter-spacing: 0.5px;
            color: #FFF;
            cursor: pointer;
        }

        .form-submit .form-btn:hover {
            background: #00c5b2;
            transition: all 0.2s ease-out;
        }

        .grid-2 {
            position: relative;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 30px;
        }

        .password-showHide {
            position: absolute;
            right: 0px;
            top: 50%;
            display: grid;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 99;
        }

        .password-showHide .icon {
            grid-row: 1/2;
            grid-column: 1/2;
        }

        .password-showHide .icon path {
            fill: #c2c2c2;
            transition: all 0.2s ease;
        }

        .password-showHide:hover .icon path {
            fill: #2c3638;
            transition: all 0.2s ease;
        }

        .password-showHide .icon.show-password {
            opacity: 1;
            z-index: 9;
        }

        .password-showHide .icon.hide-password {
            opacity: 0;
            z-index: -1;
        }

        .password-showHide.hide .icon.show-password {
            opacity: 0;
            z-index: -1;
        }

        .password-showHide.hide .icon.hide-password {
            z-index: 9;
            opacity: 1;
        }

        /*Steps*/

        .step-tab-items {
            position: relative;
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            justify-content: center;
        }

        .step-tab-items .step-item {
            position: relative;
            list-style: none;
            width: 25px;
            height: 25px;
            background: #e2e2e2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFF;
            font-size: 14px;
            cursor: pointer;
        }

        .step-tab-items .step-item.active {
            background: #00c5b2;
        }


        .step-tab-items .step-item:not(:last-child) {
            margin-right: 45px;
        }

        .step-tab-items .step-item:not(:last-of-type)::before {
            position: absolute;
            content: "";
            width: 100%;
            height: 2px;
            background: rgb(241, 239, 239);
            left: calc(100% + 10px);
        }

        .step-tab-items .step-item.active::before {
            background: #00c5b2;
        }

        .step-tabs .step-tab {
            display: none;
        }

        .step-tabs .step-tab.active {
            display: block;
        }
    </style>

    @php
        $primium__country = \App\Models\PrimiumCountry::get();
        $primium__university = \App\Models\PrimiumUniversity::get();
        $primium__course = \App\Models\PrimiumCourse::get();
        $primium__university_course = \App\Models\PrimiumUniversityCourse::get();
        $program_type = \App\Models\ProgramType::get();
    @endphp

    @if (session('success'))
        <div class="alert alert-success" id="success-message">
            {{ session('success') }}
        </div>
    @endif
    <div class="contact__area">
        <form method="POST" action="{{ route('store.student.admin') }}" enctype="multipart/form-data" class="form">
            @csrf
            <input type="hidden" name="is_primium" value="">
            <div class="steps">
                <ul class="step-tab-items d-none">
                    <li class="step-item active">1</li>
                    <li class="step-item">2</li>
                    <li class="step-item">3</li>
                </ul>
                <div class="step-tabs">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="step-tab active " id="step-01">
                                    <h4 class="form-title-sc">Basic Information</h4>
                                    <div class="row align-items-center">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group mb-3">
                                                <label for="name">{{ __('Name') }}</label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    value="{{ old('name') }}" required autocomplete="name" autofocus
                                                    required>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group mb-3">
                                                <label for="email">{{ __('Email Address') }}</label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" required autocomplete="email" required>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group mb-3">
                                                <label for="city">{{ __('City/Town') }}</label>
                                                <input type="text"
                                                    class="form-control @error('city') is-invalid @enderror" name="city"
                                                    value="{{ old('city') }}" required autocomplete="city" required>

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
                                                <input type="number"
                                                    class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                    value="{{ old('phone') }}" required autocomplete="ciphonety">

                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group mb-3">
                                                <label for="regis__country">Destination Country</label>
                                                <select name="regis__country" class="form-select select2 regis__country"
                                                    style="width: 100%;" required>
                                                    <option selected hidden disabled>Destination Country</option>
                                                    @foreach ($primium__country as $item)
                                                        <option value="{{ $item->id }}">{{ ucfirst($item->name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group mb-3">
                                                <label for="regis__university">Choose University</label>
                                                <select name="regis__university"
                                                    class="form-select select2 regis__university" style="width: 100%;"
                                                    required>
                                                    <option selected hidden disabled>Choose University</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group mb-3">
                                                <label for="regis__program">Program Type</label>
                                                <select name="regis__program" class="form-select select2 regis__program"
                                                    style="width: 100%;" required>
                                                    <option selected hidden disabled>Choose Program Type</option>
                                                    @foreach ($program_type as $item)
                                                        <option value="{{ $item->id }}">{{ ucwords($item->name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group mb-3">
                                                <label for="regis_course">Program Dicipline</label>
                                                <select name="regis__course" class="form-select select2 regis_course"
                                                    style="width: 100%;" required>
                                                    <option selected hidden disabled>Choose Dicipline</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group mb-3">
                                                <label for="regis_uni_course">Course</label>
                                                <select name="regis__uni__course"
                                                    class="form-select select2 regis_uni_course" style="width: 100%;"
                                                    required>
                                                    <option selected hidden disabled>Choose Course</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-submit">
                                        <button class="form-btn" type="button" tab-target="step-02">Continue</button>
                                    </div>
                                </div>
                                <div class="step-tab" id="step-02">
                                    <h4 class="form-title-sc">Document Upload</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group d-flex align-items-center mb-2">
                                                <label for="o_level" style="width: 70%">10TH/'O' LEVEL</label>
                                                <input type="file" name="o_level" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group d-flex align-items-center mb-2">
                                                <label for="a_level" style="width: 70%">12TH/'A' LEVEL</label>
                                                <input type="file" name="a_level" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group d-flex align-items-center mb-2">
                                                <label for="graduate" style="width: 70%">GRADUATE</label>
                                                <input type="file" name="graduate" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group d-flex align-items-center mb-2">
                                                <label for="post_graduate" style="width: 70%">POST GRADUATE</label>
                                                <input type="file" name="post_graduate" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group d-flex align-items-center mb-2">
                                                <label for="nid" style="width: 70%">NID/Passport/Birth
                                                    Certificate<span class="text-danger">*</span></label>
                                                <input type="file" name="nid" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group d-flex align-items-center mb-2">
                                                <label for="photo" style="width: 70%">PHOTO<span
                                                        class="text-danger">*</span></label>
                                                <input type="file" name="photo" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group d-flex align-items-center mb-2">
                                                <label for="signature" style="width: 70%">SIGNATURE <span
                                                        class="text-danger">*</span></label>
                                                <input type="file" name="signature" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group d-flex align-items-center mb-2">
                                                <label for="others" style="width: 70%">OTHERS</label>
                                                <input type="file" name="others" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-submit grid-2">
                                        <button type="button" class="form-btn" tab-target="step-01">Previous</button>
                                        <button type="submit" class="form-btn">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.regis__country').change(function() {
                var countryId = $(this).val();

                $.ajax({
                    url: "{{ route('get-universitiesReg', ':countryId') }}".replace(':countryId',
                        countryId),
                    type: 'GET',
                    success: function(response) {
                        $('.regis__university').empty();
                        $('.regis__university').append(
                            '<option selected hidden disabled>Choose University</option>');

                        $.each(response, function(index, university) {
                            $('.regis__university').append('<option value="' +
                                university.id + '">' + university.name + '</option>'
                            );
                        });
                    }
                });
            });

            $('.regis__university').change(function() {
                var universityId = $(this).val();

                $.ajax({
                    url: "{{ route('get-programtypeReg', ':universityId') }}".replace(
                        ':universityId',
                        universityId),
                    type: 'GET',
                    success: function(response) {
                        $('.regis__program').empty();
                        $('.regis__program').append(
                            '<option selected hidden disabled>Choose Program Type</option>');

                        $.each(response, function(index, programType) {
                            $('.regis__program').append('<option value="' + programType
                                .id + '">' + programType.name + '</option>');
                        });
                    }
                });
            });

            $('.regis__program').change(function() {
                var programTypeId = $(this).val();

                $.ajax({
                    url: "{{ route('get-coursesReg', ':programTypeId') }}".replace(
                        ':programTypeId',
                        programTypeId),
                    type: 'GET',
                    success: function(response) {
                        $('.regis_course').empty();
                        $('.regis_course').append(
                            '<option selected hidden disabled>Choose Discipline</option>');

                        $.each(response, function(index, course) {
                            $('.regis_course').append('<option value="' + course.id +
                                '">' + course.name + '</option>');
                        });
                    }
                });
            });

            $('.regis_course').change(function() {
                var courseId = $(this).val();

                $.ajax({
                    url: "{{ route('get-unicoursesReg', ':courseId') }}".replace(':courseId',
                        courseId),
                    type: 'GET',
                    success: function(response) {
                        $('.regis_uni_course').empty(); // Corrected class name
                        $('.regis_uni_course').append(
                            '<option selected hidden disabled>Choose Course</option>');

                        $.each(response, function(index, course) {
                            $('.regis_uni_course').append('<option value="' + course
                                .id + '">' + course.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".freeSignup").click(function() {
                $(".free").show();
                $(".primium").hide();
                $(".partner").hide();
            });

            $(".primiumSignup").click(function() {
                $(".free").hide();
                $(".primium").show();
                $(".partner").hide();
            });
            $(".primiumPartner").click(function() {
                $(".free").hide();
                $(".primium").hide();
                $(".partner").show();
            });
        });
    </script>
    <script>
        // for form steps
        const allStepBtn = document.querySelectorAll('[tab-target]')
        const allStepItem = document.querySelectorAll('.step-item')
        const allTabs = document.querySelectorAll('.step-tab')
        allStepBtn.forEach(item => {
            item.addEventListener('click', () => {
                let currentTabId = item.getAttribute('tab-target')
                let currentTab = document.getElementById(`${currentTabId}`)

                allStepItem.forEach(item => {
                    item.classList.remove('active')
                })

                allTabs.forEach((tab, i) => {
                    if (tab.id === currentTab.id) {
                        for (let l = 0; i >= 0; i--) {
                            allStepItem[i].classList.add('active')
                        }

                    }
                })

                allTabs.forEach(item => {
                    item.classList.remove('active')
                })

                currentTab.classList.add('active')
                item.classList.add('active')
            })
        })
    </script>
    <script>
        const indianRupyRate = {{ $setting->inr_rate }};
        const usdRate = {{ $setting->doller_rate }};
        const canadaRate = {{ $setting->canada }};
        const euroRate = {{ $setting->euro }};
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var successMessage = document.getElementById('success-message');
                if (successMessage) {
                    successMessage.style.display = 'none';
                }
            }, 5000); // 5000 milliseconds = 5 seconds
        });
    </script>
@endsection
