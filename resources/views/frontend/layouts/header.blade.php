<header class="header_section">
    <!-- top header -->
    <div class="top_header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row g-0 align-items-center justify-content-between">
                <!-- contact no -->
                <div class="col-8 col-lg-3 order-last order-lg-1">
                    <!-- contact -->
                    <div class="header_contact">
                        <!-- wrapper -->
                        <ul class="d-flex align-items-center gap-3 flex-wrap">
                            <!-- phone -->
                            <li>
                                <a href="tel:+01937563157">
                                    <span class="d-inline-block contact_header_icon"><i
                                            class="fa-solid fa-phone"></i></span>
                                    <span class="d-inline-block contact_header_text">{{ $setting->phone_one }}</span>
                                </a>
                            </li>
                            <!-- email -->
                            <li>
                                <div class="socila_list">
                                    <ul class="d-flex align-items-center gap-3">
                                        <li>
                                            <a class="social_icon" href="{{ $setting->facebook }}" target="_blank"><i
                                                    class="fa-brands fa-facebook-f"></i></a>
                                        </li>
                                        <li>
                                            <a class="social_icon" href="{{ $setting->youtube }}" target="blank"><i
                                                    class="fa-brands fa-youtube"></i></a>
                                        </li>
                                        <li>
                                            <a class="social_icon" href="{{ $setting->linkedin }}" target="blank"><i
                                                    class="fa-brands fa-linkedin-in"></i></a>
                                        </li>
                                        <li>
                                            <a class="social_icon" href="{{ $setting->instagram }}" target="blank"><i
                                                    class="fa-brands fa-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a class="social_icon" href="{{ $setting->twitter }}" target="blank"><i
                                                    class="fa-brands fa-twitter"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                @php
                    $notice = \App\Models\Notice::first();
                @endphp
                <div class="col-12 col-lg-7 order-fast order-lg-2">
                    <div class="notice">
                        <marquee behavior="scroll" direction="left" onmouseover="this.stop();"
                            onmouseout="this.start();">
                            <a href="{{ route('user.dashboard') }}" target="_blank"
                                class="text-white fs-5">{!! $notice->description !!}</a>
                        </marquee>
                    </div>
                </div>
                <!-- digital clock -->
                <div class="col-4 col-lg-2 text-end order-last order-lg-3">
                    @php
                        use Illuminate\Support\Facades\Auth;
                    @endphp

                    <!-- clock -->
                    <ul class="profile d-flex gap-2 justify-content-end">
                        <li class="header_nav_item">
                            @auth
                                @if (auth()->user()->role_id == 1)
                                    <a class="main_btn" href="{{ route('admin.dashboard') }}">Admin Panel</a>
                                @else
                                    <a class="main_btn" href="{{ route('user.dashboard') }}">Student Panel</a>
                                @endif
                            @else
                                <a class="main_btn" href="{{ route('login') }}">Login</a>
                            @endauth
                        </li>

                        <!-- <li class="header_nav_item">
                            <a class="main_btn" href="">Registation</a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- main header -->
    <div class="main_header">
        <div class="container">
            <div class="header_wrapper">
                <!-- logo -->
                <div class="logo">
                    <a href="{{ url('/') }}" class="logo_image">
                        <!-- logo imgae -->
                        <img src="{{ asset('upload/logo/' . $setting->logo) }}" alt="" />
                    </a>
                </div>
                <!-- header nav -->
                <nav class="header_nav d-none d-lg-block">
                    <ul class="d-flex gap-4 align-items-center">
                        <li class="header_nav_item">
                            <a class="header_nav_link" href="{{ url('/') }}">home</a>
                        </li>
                        <li class="header_nav_item">
                            <a class="header_nav_link" href="{{ route('service.page') }}">services</a>
                        </li>
                        @php
                            $countries = App\Models\PrimiumCountry::where('status', 1)
                                ->orderBy('name', 'asc')
                                ->latest()
                                ->get();
                        @endphp

                        <li class="header_nav_item">
                            <a class="header_nav_link" href="{{ route('country.page') }}">Country
                                @if (count($countries) > 0)
                                    <ul class="country__submenu">
                                        @foreach ($countries as $item)
                                            <li><a
                                                    href="{{ route('countrydetails.page', ['slug' => $item->slug]) }}">{{ ucwords($item->name) }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </a>
                        </li>

                        @php
                            $countries = App\Models\PrimiumCountry::where('status', 1)
                                ->orderBy('name', 'asc')
                                ->latest()
                                ->get();
                        @endphp

                        <li class="header_nav_item">
                            <a class="header_nav_link" href="{{ route('university.page') }}">University</a>
                            <div class="sub_university">
                                <div class="row">
                                    @foreach ($countries as $country)
                                        @if ($country->universities->isNotEmpty())
                                            <div class="col-md-3">
                                                <div class="single_sub_university mb-3">
                                                    <h5>{{ ucwords($country->name) }}</h5>
                                                    <ul>
                                                        @foreach ($country->universities as $university)
                                                            <li><a
                                                                    href="{{ route('universitydetails.page', ['slug' => $university->slug]) }}">{{ ucwords($university->name) }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        @auth
                            <li class="header_nav_item">
                                <a class="header_nav_link" href="{{ route('payfees.page') }}">pay fees</a>
                            </li>
                        @endauth
                        <li class="header_nav_item">
                            <a class="header_nav_link" href="{{ route('blog.page') }}">blog</a>
                        </li>
                        <li class="header_nav_item">
                            <a class="main_btn" href="{{ route('contact.page') }}">contact</a>
                        </li>
                    </ul>
                </nav>
                <!-- toggler -->
                <div class="toggle_nav d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#toggle_nav">
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile nav -->
    <div class="offcanvas offcanvas-start" id="toggle_nav">
        <!-- offcanvas header -->
        <div class="offcanvas-header">
            <div class="nav_logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('upload/logo/' . $setting->logo) }}" alt="" />
                </a>
            </div>
            <button type="button btn" data-bs-dismiss="offcanvas">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <!-- offcanvas body -->
        <div class="offcanvas-body">
            <div class="mobile_nav">
                <ul>
                    <!-- item -->
                    <li>
                        <a href="{{ url('/') }}">
                            <p class="d-flex gap-2">
                                <span>home</span>
                            </p>
                        </a>
                    </li>
                    <!-- item -->
                    <li>
                        <a class="dropdown_button" href="{{ route('about.page') }}">
                            <p class="d-flex gap-2">
                                <span>about</span>
                            </p>
                        </a>
                    </li>
                    <!-- item -->
                    <li>
                        <a href="{{ route('service.page') }}">
                            <p class="d-flex gap-2">
                                <span>services</span>
                            </p>
                        </a>
                    </li>
                    <!-- item -->
                    <li class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <div class="accordion-button collapsed text-capitilize" style="padding-left: 20px"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                    aria-expanded="false" aria-controls="flush-collapseOne">
                                    Country
                                </div>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <ul class="accordion-body">
                                    @foreach ($countries as $item)
                                        <li><a href="{{ $item->slug }}">{{ ucfirst($item->name) }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- item -->
                    <li class="accordion accordion-flush" id="universityflus">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <div class="accordion-button collapsed text-capitilize" style="padding-left: 20px"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                    aria-expanded="false" aria-controls="flush-collapseTwo">
                                    University
                                </div>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                data-bs-parent="#universityflus">
                                @foreach ($countries as $country)
                                    @if ($country->universities->isNotEmpty())
                                        <div class="single_sub_university">
                                            <h5>{{ ucfirst($country->name) }}</h5>
                                            <ul>
                                                @foreach ($country->universities as $university)
                                                    <li><a
                                                            href="{{ $university->slug }}">{{ ucfirst($university->name) }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </li>
                    @auth
                        <li class="header_nav_item">
                            <a class="header_nav_link" href="{{ route('payfees.page') }}">pay fees</a>
                        </li>
                    @endauth
                    <!-- item -->
                    <li class="header_nav_item">
                        <a class="header_nav_link" href="{{ route('blog.page') }}">blog</a>
                    </li>
                    <li>
                        <a href="{{ route('contact.page') }}"
                            class="main_btn btn_collapse btn_hover text-white justify-content-center">
                            <p class="d-flex gap-2">
                                <span>contact</span>
                            </p>
                        </a>
                    </li>
                    <!-- item -->
                    {{-- <li>
                        <a class="main_btn btn_collapse btn_hover text-white justify-content-center" href="#"
                            tabindex="0">apply now</a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
</header>
