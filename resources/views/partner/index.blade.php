@extends('partner.layouts.partner_master')

@section('partner__content')
    <style>
        .card-body h5 {
            font-size: 16px;
            height: 50px;
        }

        .welcome {
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-size: 2rem;
            font-weight: 100;
            letter-spacing: 2px;
            text-align: center;
            color: #f35626;
            background-image: -webkit-linear-gradient(92deg, #f35626, #feab3a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            -webkit-animation: hue 10s infinite linear;
        }

        @-webkit-keyframes hue {
            from {
                -webkit-filter: hue-rotate(0deg);
            }

            to {
                -webkit-filter: hue-rotate(-360deg);
            }
        }

        .animatedbutton {
            display: inline-flex;
            /* border: 2px solid #BFC0C0; */
            margin: 20px 20px 20px 20px;
            color: #fff;
            text-transform: uppercase;
            text-decoration: none;
            font-size: 12px;
            letter-spacing: 1.5px;
            align-items: center;
            position: relative;
            justify-content: center;
            overflow: hidden;
            background: #ee0979;
            background: -webkit-linear-gradient(45deg, #ee0979, #ff6a00) !important;
            background: linear-gradient(45deg, #ee0979, #ff6a00) !important;
            padding: 10px 20px;
            left: 50%;
            transform: translateX(-50%);
        }

        /* Seventh Button */

        #button-7 {
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        #button-7 a {
            position: relative;
            left: 0;
            transition: all .35s ease-Out;
            color: #fff;
        }

        #dub-arrow {
            width: 100%;
            height: 100%;
            background: #BFC0C0;
            left: -200px;
            position: absolute;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .35s ease-Out;
            bottom: 0;
        }

        #button-7 img {
            width: 20px;
            height: auto;
        }

        #button-7:hover #dub-arrow {
            left: 0;
        }

        #button-7:hover a {
            left: 200px;
        }
    </style>

    @php
        $partners = App\Models\User::where('role_id', 3)->where('status', 1)->exists();
    @endphp

    @if ($partners)
        @php
            $video = \App\Models\WelcomeVideo::first();
        @endphp
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 bg-gradient-deepblue">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $system_id }}</h5>
                            <div class="ms-auto">
                                <i class="bx bx-user fs-3 text-white"></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">System Id</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 bg-gradient-deepblue">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $students }}</h5>
                            <div class="ms-auto">
                                <i class="bx bx-user fs-3 text-white"></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Total Student</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 bg-gradient-deepblue">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $offerLetter }}</h5>
                            <div class="ms-auto">
                                <i class="bx bx-user fs-3 text-white"></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0"><a href="{{ route('partner.offerletter') }}" class="text-white"
                                    target="_blank">Offer Letter</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 bg-gradient-deepblue">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $admissionLetter }}</h5>
                            <div class="ms-auto">
                                <i class="bx bx-user fs-3 text-white"></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0"><a href="{{ route('partner.admissionletter') }}" class="text-white"
                                    target="_blank">Admission Letter</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                @php
                    $visaPermissionLetter = \App\Models\Visaletter::whereHas('user', function ($query) {
                        $query->where('referance', auth()->user()->email);
                    })->count();
                @endphp
                <div class="card radius-10 bg-gradient-deepblue">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $visaPermissionLetter }}</h5>
                            <div class="ms-auto">
                                <i class="bx bx-user fs-3 text-white"></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0"><a href="{{ route('partner.visa.permission.letter') }}" class="text-white"
                                    target="_blank">Visa Permission
                                    Letter</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                @php
                    $anotherLeter = \App\Models\AnotherLetter::whereHas('user', function ($query) {
                        $query->where('referance', auth()->user()->email);
                    })->count();
                @endphp
                <div class="card radius-10 bg-gradient-deepblue">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $anotherLeter }}</h5>
                            <div class="ms-auto">
                                <i class="bx bx-user fs-3 text-white"></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0"><a href="{{ route('partner.anatherletter') }}" class="text-white"
                                    target="_blank">Another Letter</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h1 class="welcome">Welcome to SIAC Abroad!!!</h1>

                <div class="animatedbutton text-center" id="button-7" data-bs-toggle="modal"
                    data-bs-target="#exampleVerticallycenteredModal">
                    <div id="dub-arrow"><img
                            src="https://github.com/atloomer/atloomer.github.io/blob/master/img/iconmonstr-arrow-48-240.png?raw=true"
                            alt="" /></div>
                    <a href="#">More Information</a>
                </div>

                <div class="modal fade" id="exampleVerticallycenteredModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">More Information</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <iframe width="100%" height="400"
                                    src="https://www.youtube.com/embed/{{ $video->partner }}" frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <h1 class="welcome">You are not approved! <br> Please wait for admin approved or <a
                style="border-bottom: 2px solid red" href="mailto:{{ $setting->support_email }}">Contact</a> </h1>
    @endif
@endsection
