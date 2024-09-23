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
            $student = App\Models\User::where('role_id', 2)->where('status', 1)->exists();
        @endphp
        <li>
            <a href="{{ route('user.dashboard') }}">
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
        @if ($student)
            @if (Auth::user()->is_primium == 'is_primium')
                <li>
                    <a href="{{ route('primium.university.detils') }}">
                        <div class="parent-icon"><i class='bx bx-square'></i></div>
                        <div class="menu-title">University Details</div>
                    </a>
                </li>
            @endif
            <li>
                <a href="{{ route('student.information') }}">
                    <div class="parent-icon"><i class='bx bx-accessibility'></i></div>
                    <div class="menu-title">Application</div>
                </a>
            </li>

            <li>
                <a href="{{ route('payment.page') }}">
                    <div class="parent-icon"><i class='bx bx-dollar'></i>
                    </div>
                    <div class="menu-title">Payment</div>
                </a>
            </li>
            <li>
                <a href="{{ route('letter.page') }}">
                    <div class="parent-icon"><i class='bx bx-paper-plane'></i>
                    </div>
                    <div class="menu-title">Letter</div>
                </a>
            </li>
            <li>
                <a href="{{ route('noc.page') }}">
                    <div class="parent-icon"><i class='bx bx-ghost'></i>
                    </div>
                    <div class="menu-title">NOC</div>
                </a>
            </li>
            <li>
                <a href="{{ route('visa.page') }}">
                    <div class="parent-icon"><i class='bx bx-landscape'></i>
                    </div>
                    <div class="menu-title">Visa</div>
                </a>
            </li>
            <li>
                <a href="{{ route('ticket.page') }}">
                    <div class="parent-icon"><i class='bx bx-sticker'></i>
                    </div>
                    <div class="menu-title">Ticket</div>
                </a>
            </li>
            <li>
                <a href="{{ route('referrance.page') }}">
                    <div class="parent-icon"><i class='bx bx-user'></i>
                    </div>
                    <div class="menu-title">Reference</div>
                </a>
            </li>
            <li>
                <a href="{{ route('letterverification.page') }}">
                    <div class="parent-icon"><i class='bx bx-paper-plane'></i>
                    </div>
                    <div class="menu-title">Letter Verification</div>
                </a>
            </li>
            <li>
                <a href="{{ route('student.feedback') }}">
                    <div class="parent-icon"><i class='bx bx-message-rounded-detail'></i>
                    </div>
                    <div class="menu-title">Feedback</div>
                </a>
            </li>
            <li>
                <a href="{{ route('user.refund') }}">
                    <div class="parent-icon"><i class='bx bx-coin-stack'></i>
                    </div>
                    <div class="menu-title">Refund Policy</div>
                </a>
            </li>
        @endif
    </ul>
    <!--end navigation-->
</div>
