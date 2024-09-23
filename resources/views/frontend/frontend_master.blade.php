<!DOCTYPE html>
<html laxng="en">

<head>
    <meta charset="UTF-8" />

    <meta name="description" content="{{ $seo->meta_description }}">
    <meta name="keywords" content="{{ $seo->meta_keywords }}">
    <meta name="author" content="{{ $seo->meta_author }}">
    <meta name="title" content="{{ $seo->meta_title }}">
    <meta name="tag" content="{{ $seo->meta_tag }}">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title> @yield('title')</title>
    <!-- link shortcut -->
    <link rel="shortcut icon" href="{{ asset('upload/favicon/' . $setting->favicon) }}" type="image/x-icon" />
    <!-- bootstarp link -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap.min.css" />
    <!-- font awesome -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/fontawesome.min.css" />
    <!-- magnific -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/magnificpopup.css" />
    <!-- slick slider -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/slick.css" />
    <!-- light box -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/lightbox.css" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- css file link -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/global.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/main.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <style>
        #preloader {
            position: fixed;
            width: 100%;
            height: 100%;
            background: #fff;
            z-index: 9999;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #preloader img {
            max-width: 100px;
            animation: spin 2s linear infinite;
            /* Apply animation */
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        a.sc-sbsi7l-0.cLcbjv {
            display: none;
        }
    </style>
</head>

<body>

    <div id="preloader">
        <img src="{{ asset('upload/logo/' . $setting->logo) }}" alt="" />
    </div>


    <!-- header section -->
    @include('frontend.layouts.header')
    <!-- header section end -->

    @yield('frontend_content')

    <!-- footer star -->
    @include('frontend.layouts.footer')
    <!-- footer end -->

    {{-- apply modal --}}
    <div class="modal fade" id="apply_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Apply Now</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="contact__form card p-4">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <input type="hidden" name="course_name">
                            <input type="hidden" name="university_name">
                            <input type="hidden" name="university_email">
                            <div class="form-group mb-3">
                                <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <button type="submit" class="btn"> {{ __('Apply') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- GetButton.io widget -->
    <script type="text/javascript">
        (function() {
            var options = {
                whatsapp: "{{ $setting->phone_one }}",
                button_color: "#FF6550",
                position: "right",
            };
            var proto = 'https:',
                host = "getbutton.io",
                url = proto + '//static.' + host;
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = url + '/widget-send-button/js/init.js';
            s.onload = function() {
                WhWidgetSendButton.init(host, proto, options);
            };
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
        })();


        setTimeout(() => {
            var x = document.getElementsByClassName("sbsi7l-0 evMtho");
            x[0].remove();
        }, 1000)
    </script>


    <!-- jquery link -->
    <script src="{{ asset('frontend') }}/assets/js/jquery.min.js"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('frontend') }}/assets/js/bootstrap.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/popper.min.js"></script>
    <!-- slick slider -->
    <script src="{{ asset('frontend') }}/assets/js/slick.min.js"></script>
    <!-- zooom -->
    <script type="text/javascript" src="{{ asset('frontend') }}/assets/js/lightbox.js"></script>
    <!-- magmific popup -->
    <script src="{{ asset('frontend') }}/assets/js/magnific.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- scrollup -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollup/2.4.1/jquery.scrollUp.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <!-- main js -->
    <script src="{{ asset('frontend') }}/assets/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener("load", function() {
                var preloader = document.getElementById("preloader");
                preloader.style.display = "none";
            });
        });
    </script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>
    <script>
        AOS.init();
    </script>
</body>

</html>
