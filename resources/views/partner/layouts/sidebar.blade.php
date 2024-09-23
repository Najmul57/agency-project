<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <a href="{{ route('user.dashboard') }}">
            <img src="{{ asset('upload/logo/' . $setting->logo) }}" style="width: 100%" alt="logo icon">
        </a>
        <div>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @php
            $premium_student = App\Models\PrimiumStudent::where('user_id', auth()->id())->where('status', 1)->first();
        @endphp
        @php
            $partners = App\Models\User::where('role_id', 3)->where('status', 1)->exists();
        @endphp
        <li>
            <a href="{{ route('partner.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{ url('/') }}" target="_blank">
                <div class="parent-icon"><i class='bx bx-globe'></i>
                </div>
                <div class="menu-title">Website</div>
            </a>
        </li>
        @if ($partners)
            <li>
                <a href="{{ route('partner.university.detils') }}">
                    <div class="parent-icon"><i class='bx bx-square'></i></div>
                    <div class="menu-title">University Details</div>
                </a>
            </li>
            <li>
                <a href="{{ route('partner.referance') }}">
                    <div class="parent-icon"><i class='bx bx-user'></i>
                    </div>
                    <div class="menu-title">Reference</div>
                </a>
            </li>
            <li>
                <a href="{{ route('payfees.page') }}" target="_blank">
                    <div class="parent-icon"><i class='bx bx-dollar'></i>
                    </div>
                    <div class="menu-title">Payment</div>
                </a>
                {{-- <a href="{{ route('partner.payment') }}">
                    <div class="parent-icon"><i class='bx bx-dollar'></i>
                    </div>
                    <div class="menu-title">Payment</div>
                </a> --}}
            </li>
            <li>
                <a href="{{ route('partner.offerletter') }}">
                    <div class="parent-icon"><i class='bx bx-paper-plane'></i>
                    </div>
                    <div class="menu-title">Offer Letter</div>
                </a>
            </li>
            <li>
                <a href="{{ route('partner.admissionletter') }}">
                    <div class="parent-icon"><i class='bx bx-paper-plane'></i>
                    </div>
                    <div class="menu-title">Admission Letter</div>
                </a>
            </li>
            <li>
                <a href="{{ route('partner.anatherletter') }}">
                    <div class="parent-icon"><i class='bx bx-paper-plane'></i>
                    </div>
                    <div class="menu-title">Another Letter</div>
                </a>
            </li>
            <li>
                <a href="{{ route('partner.visa.permission.letter') }}">
                    <div class="parent-icon"><i class='bx bx-landscape'></i>
                    </div>
                    <div class="menu-title">Visa Permission letter</div>
                </a>
            </li>
            <li>
                <a href="{{ route('upload.visa.copy') }}">
                    <div class="parent-icon"><i class='bx bx-landscape'></i>
                    </div>
                    <div class="menu-title">Upload Visa Copy</div>
                </a>
            </li>
            <li>
                <a href="{{ route('partner.ticket.form') }}">
                    <div class="parent-icon"><i class='bx bx-sticker'></i>
                    </div>
                    <div class="menu-title">Ticket</div>
                </a>
            </li>
            <li>
                <a href="{{ route('partner.travel.guideline') }}">
                    <div class="parent-icon"><i class='bx bx-paper-plane'></i>
                    </div>
                    <div class="menu-title">Travel Guideline</div>
                </a>
            </li>
            <li>
                <a href="{{ route('partner.feedback') }}">
                    <div class="parent-icon"><i class='bx bx-message-rounded-detail'></i>
                    </div>
                    <div class="menu-title">Feedback</div>
                </a>
            </li>
            <li>
                <a href="{{ route('partner.refund') }}">
                    <div class="parent-icon"><i class='bx bx-coin-stack'></i>
                    </div>
                    <div class="menu-title">Refund Policy</div>
                </a>
            </li>
        @endif
    </ul>
    <!--end navigation-->
</div>
