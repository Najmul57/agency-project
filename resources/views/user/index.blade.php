@extends('user.user_master')

@section('user__content')
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

        .progress {
            width: 150px;
            height: 150px;
            line-height: 150px;
            background: none;
            margin: 0 auto;
            box-shadow: none;
            position: relative;
            display: flex;
            justify-content: center;
        }

        .progress:after {
            content: "";
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 7px solid #eee;
            position: absolute;
            top: 0;
            left: 0;
        }

        .progress>span {
            width: 50%;
            height: 100%;
            overflow: hidden;
            position: absolute;
            top: 0;
            z-index: 1;
        }

        .progress .progress-left {
            left: 0;
        }

        .progress .progress-bar {
            width: 100%;
            height: 100%;
            background: none;
            border-width: 7px;
            border-style: solid;
            position: absolute;
            top: 0;
            border-color: #ffb43e;
        }

        .progress .progress-left .progress-bar {
            left: 100%;
            border-top-right-radius: 75px;
            border-bottom-right-radius: 75px;
            border-left: 0;
            -webkit-transform-origin: center left;
            transform-origin: center left;
        }

        .progress .progress-right {
            right: 0;
        }

        .progress .progress-right .progress-bar {
            left: -100%;
            border-top-left-radius: 75px;
            border-bottom-left-radius: 75px;
            border-right: 0;
            -webkit-transform-origin: center right;
            transform-origin: center right;
        }

        .progress .progress-value {
            display: flex;
            border-radius: 50%;
            font-size: 36px;
            text-align: center;
            line-height: 20px;
            align-items: center;
            justify-content: center;
            height: 100%;
            font-weight: 300;
        }

        .progress .progress-value div {
            margin-top: 10px;
        }

        .progress .progress-value span {
            font-size: 12px;
            text-transform: uppercase;
        }

        .progress[data-percentage="25"] .progress-right .progress-bar {
            animation: loading-2 1.5s linear forwards;
        }

        .progress[data-percentage="25"] .progress-left .progress-bar {
            animation: 0;
        }

        .progress[data-percentage="50"] .progress-right .progress-bar {
            animation: loading-5 1.5s linear forwards;
        }

        .progress[data-percentage="50"] .progress-left .progress-bar {
            animation: 0;
        }

        .progress[data-percentage="75"] .progress-right .progress-bar {
            animation: loading-5 1.5s linear forwards;
        }

        .progress[data-percentage="75"] .progress-left .progress-bar {
            animation: loading-3 1.5s linear forwards 1.5s;
        }

        .progress[data-percentage="100"] .progress-right .progress-bar {
            animation: loading-5 1.5s linear forwards;
        }

        .progress[data-percentage="100"] .progress-left .progress-bar {
            animation: loading-5 1.5s linear forwards 1.5s;
        }

        @keyframes loading-1 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(36);
                transform: rotate(36deg);
            }
        }

        @keyframes loading-2 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(72);
                transform: rotate(72deg);
            }
        }

        @keyframes loading-3 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(108);
                transform: rotate(108deg);
            }
        }

        @keyframes loading-4 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(144);
                transform: rotate(144deg);
            }
        }

        @keyframes loading-5 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(180);
                transform: rotate(180deg);
            }
        }

        .progress {
            margin-bottom: 1em;
        }
    </style>
    @php
        $student = App\Models\User::where('role_id', 2)->where('status', 1)->exists();
    @endphp

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 bg-gradient-deepblue">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{ $user->system_id }}</h5>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height: 3px">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">System ID</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <?php
            use App\Models\PrimiumUniversityCourse;

            $uniCourse = PrimiumUniversityCourse::find($user->regis__uni__course);
            $uniCourseName = $uniCourse ? $uniCourse->name : 'Unknown Course';
            ?>
            <div class="card radius-10 bg-gradient-orange">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{ ucwords($uniCourseName) }}</h5>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height: 3px">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Course Name</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <?php
            use App\Models\PrimiumUniversity;

            $university = PrimiumUniversity::find($user->regis__university);
            $uniName = $university ? $university->name : '';
            ?>
            <div class="card radius-10 bg-gradient-ohhappiness">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{ ucwords($uniName) }}</h5>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height: 3px">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">University Name</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">

            @php
                $admissionLetter = \App\Models\AdmissionLetter::where('user_id', auth()->id())->first();
            @endphp
            @php
                $visaletter = \App\Models\VisaLetter::where('user_id', auth()->id())->first();
            @endphp
            @php
                $visa = \App\Models\VisaUpload::where('user_id', auth()->id())->first();
            @endphp

            @if ($visaletter)
                <div class="progress" data-percentage="100">
                    <span class="progress-left">
                        <span class="progress-bar"></span>
                    </span>
                    <span class="progress-right">
                        <span class="progress-bar"></span>
                    </span>
                    <div class="progress-value">
                        <div>
                            100%<br />
                            <span>completed</span>
                        </div>
                    </div>
                </div>
            @elseif ($visa)
                <div class="progress" data-percentage="75">
                    <span class="progress-left">
                        <span class="progress-bar"></span>
                    </span>
                    <span class="progress-right">
                        <span class="progress-bar"></span>
                    </span>
                    <div class="progress-value">
                        <div>
                            75%<br />
                            <span>completed</span>
                        </div>
                    </div>
                </div>
            @elseif ($admissionLetter)
                <div class="progress" data-percentage="50">
                    <span class="progress-left">
                        <span class="progress-bar"></span>
                    </span>
                    <span class="progress-right">
                        <span class="progress-bar"></span>
                    </span>
                    <div class="progress-value">
                        <div>
                            50%<br />
                            <span>completed</span>
                        </div>
                    </div>
                </div>
            @elseif (auth()->check())
                <div class="progress" data-percentage="25">
                    <span class="progress-left">
                        <span class="progress-bar"></span>
                    </span>
                    <span class="progress-right">
                        <span class="progress-bar"></span>
                    </span>
                    <div class="progress-value">
                        <div>
                            25%<br />
                            <span>completed</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if ($student)
        @if (auth()->user()->is_primium == 'is_primium')
            <!-- Do nothing or show something else for premium users if needed -->
        @else
            <div class="row">
                <div class="col-12">
                    <button data-bs-toggle="modal" class="border-0 p-2" data-bs-target="#primiumSubscribe"
                        style="background: #00b09b; background: -webkit-linear-gradient(45deg, #00b09b, #96c93d) !important; background: linear-gradient(45deg, #00b09b, #96c93d) !important;">
                        <a class="dropdown-item" href="#"><i class="bx bx-user"></i><span>Premium Student</span></a>
                    </button>

                    <div class="modal fade" id="primiumSubscribe" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Premium Subscribe Form</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('user.primium.subscribe') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="number" name="amount" class="form-control" id="amount"
                                                placeholder="1000" required>
                                            <span class="text-danger">Premium Subscription fees:
                                                @if (isset($setting))
                                                    <strong
                                                        id="subscription_fee">{{ $setting->primium_subscription }}</strong>
                                                @else
                                                    No settings found.
                                                @endif
                                            </span>
                                        </div>

                                        <div class="form-group mt-2">
                                            <label for="method">Method</label>
                                            <select name="method" id="method" class="form-select" required>
                                                <option disabled selected>Select Method</option>
                                                <option value="bkash">Bkash</option>
                                                <option value="dbbl">DBBL</option>
                                                <option value="nagod">Nagod</option>
                                            </select>
                                        </div>

                                        <div class="form-group mt-2">
                                            <label for="txt_number">Transaction Number</label>
                                            <input type="text" name="txt_number" class="form-control"
                                                placeholder="transaction number" required>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary mt-3">Premium
                                            Subscribe</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <hr>
        <div class="row">
            <div class="col-12">
                <h1 class="welcome">Scholarship</h1>

                <div class="scholarship-info" id="scholarshipInfo">
                    @if (Auth::user()->cgpa == 4)
                        <p class="welcome" style="font-size: 16px;margin-bottom:0">You are eligible for a 50% Scholarship
                        </p>
                    @elseif (Auth::user()->cgpa >= 3.5 && Auth::user()->cgpa <= 3.75)
                        <p class="welcome" style="font-size: 16px;margin-bottom:0">You are eligible for a 35% Scholarship
                        </p>
                    @elseif (Auth::user()->cgpa >= 3.0 && Auth::user()->cgpa < 3.5)
                        <p class="welcome" style="font-size: 16px;margin-bottom:0">You are eligible for a 25% Scholarship
                        </p>
                    @else
                        <p class="welcome" style="font-size: 16px;margin-bottom:0">No scholarship available for you!!!</p>
                    @endif
                </div>
            </div>
        </div>
        <hr>
        <!--end row-->

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
                                    src="https://www.youtube.com/embed/{{ $video->video }}" frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    @else
        <h1 class="welcome">You are not approved! <br> Please wait for admin approved or <a
                style="border-bottom: 2px solid red" href="mailto:{{ $setting->support_email }}">Contact</a> </h1>
    @endif

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
    <script>
        var stringifyObject = require("stringify-object");
        var createKeyframe = require("create-keyframe");
        var insertCSS = require("insert-styles");

        function generateKeyframe() {
            // var randomColors = createRandomColors()

            var shakeDistance = Number((Math.random() * 70).toFixed(0)) + 30;

            var cssKeyframe;
            cssKeyframe = {
                0: {
                    transform: 0 + "deg",
                },
                100: {
                    transform: 30 + "deg"
                },
            };
            var keyframeObj = createKeyframe(cssKeyframe);
            insertCSS(keyframeObj.css, {
                id: "animaton-tutorial-keyframe"
            });

            jsonDisplay.innerHTML =
                `@keyframe ${keyframeObj.name} ` +
                stringifyObject(cssKeyframe, {
                    indent: "  "
                });
            userMessage.style.animation = keyframeObj.name + " ease 3s infinite";
        }

        generateKeyframe();
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const amountInput = document.getElementById('amount');
            const subscriptionFee = document.getElementById('subscription_fee').textContent.trim();

            amountInput.value = subscriptionFee;

            amountInput.addEventListener('input', function() {
                amountInput.value = subscriptionFee;
            });
        });
    </script>
@endsection
