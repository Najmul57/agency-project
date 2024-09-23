<footer>
    <div class="footer__area pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="footer-widget">
                        <div class="footer__logo"></div>
                        <div class="footer__about">
                            <div class="single__footer__about">
                                <h6>Head Office</h6>
                                <p>{{ $setting->address }}</p>
                            </div>
                            <div class="single__footer__about">
                                <h6>About SIAC</h6>
                                <p>{{ $setting->short_about }}</p>
                            </div>
                        </div>
                        <ul class="footer__social d-flex align-items-center gap-3 mt-3">
                            <li>
                                <a href="{{ $setting->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="{{ $setting->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="{{ $setting->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                            </li>
                            <li>
                                <a href="{{ $setting->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="{{ $setting->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                @php
                    $pages = DB::table('pages')->get();
                @endphp
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="footer-widget footer__menu">
                        <div class="footer__title">Quick Links</div>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ route('about.page') }}">About</a></li>
                            <li><a href="{{ route('gallery.page') }}">Gallery</a></li>
                            <li><a href="{{ route('feedback.page') }}">Success History</a></li>
                            <li><a href="{{ route('blog.page') }}">Blog</a></li>
                            @auth
                                <li class="header_nav_item">
                                    <a class="header_nav_link" href="{{ route('payfees.page') }}">pay fees</a>
                                </li>
                            @endauth
                            <li><a href="{{ route('contact.page') }}">Contact Us</a></li>

                            @foreach ($pages as $item)
                                <li><a href="{{ route('view.page', $item->page_slug) }}">{{ $item->page_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @php
                    $countries = App\Models\PrimiumCountry::where('status', 1)->latest()->limit(8)->get();
                @endphp
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="footer-widget footer__menu">
                        <div class="footer__title">Study Abroad</div>
                        <ul>
                            @foreach ($countries as $row)
                                <li><a href="{{ route('countrydetails.page', $row->slug) }}">Study In
                                        {{ $row->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12 col-12">
                    <div class="footer__about">
                        <div class="footer__title">Contact</div>
                        <div class="single__footer__about">
                            <div class="d-flex gap-2 mb-2">
                                <p><i class="fa fa-phone"></i>
                                </p>
                                <p>
                                    <a href="tel:+{{ $setting->phone_one }}">{{ $setting->phone_one }}</a>,
                                    <a href="tel:+{{ $setting->phone_two }}">{{ $setting->phone_two }}</a>
                                </p>
                            </div>
                            <div class="d-flex gap-2 mb-2">
                                <p><i class="fa fa-envelope"></i>
                                </p>
                                <p>
                                    <a href="mailto:{{ $setting->main_email }}">{{ $setting->main_email }}</a>,
                                    <a href="mailto:{{ $setting->support_email }}">{{ $setting->support_email }}</a>
                                </p>
                            </div>
                            <div class="d-flex gap-2">
                                <p><i class="fa fa-home"></i>
                                </p>
                                <p>
                                    {{ $setting->address }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright d-flex align-items-center justify-content-center p-3">
        <p>Copyright &copy;
            <script>
                document.write(new Date().getFullYear())
            </script> <strong><a href="{{ url('/') }}" class="text-white">SIAC</a></strong> All
            Rights
            Reserved
        </p>
    </div>
</footer>
