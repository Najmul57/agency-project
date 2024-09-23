<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <a href="{{ route('admin.dashboard') }}"> <img src="{{ asset('upload/logo/' . $setting->logo) }}"
                    style="width: 100%" alt="logo icon"></a>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{ url('/') }}" target="_blank">
                <div class="parent-icon"><i class='bx bx-world'></i>
                </div>
                <div class="menu-title">View Site</div>
            </a>
        </li>
        @if (auth()->user()->can('content.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-book-alt'></i>
                    </div>
                    <div class="menu-title">University Information</div>
                </a>
                <ul>
                    @if (auth()->user()->can('country.list'))
                        <li> <a href="{{ route('primium.country.list') }}"><i class="bx bx-right-arrow-alt"></i>Country
                                List</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('university.list'))
                        <li> <a href="{{ route('primium.university.list') }}"><i
                                    class="bx bx-right-arrow-alt"></i>University
                                List</a></li>
                    @endif
                    @if (auth()->user()->can('program.type'))
                        <li> <a href="{{ route('program.type') }}"><i class="bx bx-right-arrow-alt"></i>Program Type</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('course.list'))
                        <li> <a href="{{ route('primium.course.list') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Department
                                List</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('unicourse.list'))
                        <li> <a href="{{ route('primium.unicourse.list') }}"><i class="bx bx-right-arrow-alt"></i>Course
                                List</a></li>
                    @endif
                    @if (auth()->user()->can('content.list'))
                        <li> <a href="{{ route('primium.content.list') }}"><i class="bx bx-right-arrow-alt"></i>Content
                                List</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth()->user()->can('student.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-user'></i>
                    </div>
                    <div class="menu-title">Student</div>
                </a>
                <ul>
                    @if (auth()->user()->can('student.list'))
                        <li> <a href="{{ route('student.list.admin') }}"><i class="bx bx-right-arrow-alt"></i>
                                Student
                                List</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('student.add'))
                        <li> <a href="{{ route('student.add.admin') }}"><i class="bx bx-right-arrow-alt"></i>
                                Student Add</a>
                        </li>
                    @endif
                    {{-- <li> <a href="{{ route('free.student.list.admin') }}"><i class="bx bx-right-arrow-alt"></i>Free
                                Student
                                List</a>
                        </li> --}}
                </ul>
            </li>
        @endif

        @if (auth()->user()->can('slider.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-slider'></i>
                    </div>
                    <div class="menu-title">Slider</div>
                </a>
                <ul>
                    @if (auth()->user()->can('slider.index'))
                        <li> <a href="{{ route('slider.index') }}"><i class="bx bx-right-arrow-alt"></i>Slider List</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('slider.create'))
                        <li> <a href="{{ route('slider.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Slider</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth()->user()->can('success.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-donate-blood"></i>
                    </div>
                    <div class="menu-title">Success Count</div>
                </a>
                <ul>
                    @if (auth()->user()->can('success.index'))
                        <li> <a href="{{ route('success.index') }}"><i class="bx bx-right-arrow-alt"></i>Success
                                List</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('success.create'))
                        <li> <a href="{{ route('success.create') }}"><i class="bx bx-right-arrow-alt"></i>Add
                                Success</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth()->user()->can('service.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-server'></i>
                    </div>
                    <div class="menu-title">Services</div>
                </a>
                <ul>
                    @if (auth()->user()->can('service.index'))
                        <li> <a href="{{ route('service.index') }}"><i class="bx bx-right-arrow-alt"></i>Services
                                List</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('service.create'))
                        <li> <a href="{{ route('service.create') }}"><i class="bx bx-right-arrow-alt"></i>Add
                                Service</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth()->user()->can('blog.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-repeat'></i>
                    </div>
                    <div class="menu-title">Blog</div>
                </a>
                <ul>
                    @if (auth()->user()->can('blog.index'))
                        <li> <a href="{{ route('blog.index') }}"><i class="bx bx-right-arrow-alt"></i>Blog List</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('blog.create'))
                        <li> <a href="{{ route('blog.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Blog</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth()->user()->can('gallery.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-images'></i>
                    </div>
                    <div class="menu-title">Gallery</div>
                </a>
                <ul>
                    @if (auth()->user()->can('gallery.index'))
                        <li> <a href="{{ route('gallery.index') }}"><i class="bx bx-right-arrow-alt"></i>Gallery
                                List</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('gallery.create'))
                        <li> <a href="{{ route('gallery.create') }}"><i class="bx bx-right-arrow-alt"></i>Add
                                Gallery</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        {{-- <li>
            <a href="{{ route('invoice.list') }}">
                <div class="parent-icon"><i class='bx bx-file'></i>
                </div>
                <div class="menu-title">Invoice List</div>
            </a>
        </li> --}}

        @if (auth()->user()->can('facilities.menu'))
            <li>
                <a href="{{ route('facilities.index') }}">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">University Facilities</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->can('welcome.video'))
            <li>
                <a href="{{ route('welcome.video') }}">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Welcome Video</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->can('feedback'))
            <li>
                <a href="{{ route('feedback') }}">
                    <div class="parent-icon"><i class='bx bx-user-circle'></i>
                    </div>
                    <div class="menu-title">Student Feedback</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->can('team.member'))
            <li>
                <a href="{{ route('admiin.team') }}">
                    <div class="parent-icon"><i class='bx bx-user-circle'></i>
                    </div>
                    <div class="menu-title">Team Member</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->can('student.help'))
            <li>
                <a href="{{ route('student.help') }}">
                    <div class="parent-icon"><i class='bx bx-user-circle'></i>
                    </div>
                    <div class="menu-title">Student
                        Help/Contact</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->can('payment.section.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-images'></i>
                    </div>
                    <div class="menu-title">Payment Section</div>
                </a>
                <ul>
                    @if (auth()->user()->can('payment.guideline'))
                        <li> <a href="{{ route('payment.guideline') }}"><i class="bx bx-right-arrow-alt"></i>Payment
                                Guideline</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('payfees.list'))
                        <li> <a href="{{ route('admin.payfees.list') }}"><i class="bx bx-right-arrow-alt"></i>Payfees
                                List</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('payment.receipt'))
                        <li> <a href="{{ route('admin.payment.receipt') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Payment
                                Receipt</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth()->user()->can('letter.section.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-images'></i>
                    </div>
                    <div class="menu-title">Letter Section</div>
                </a>
                <ul>
                    @if (auth()->user()->can('letter.guideline'))
                        <li> <a href="{{ route('letter.guideline') }}"><i class="bx bx-right-arrow-alt"></i>Letter
                                Guideline</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('offer.letter'))
                        <li> <a href="{{ route('admin.offer.letter') }}"><i class="bx bx-right-arrow-alt"></i>Offer
                                Letter</a></li>
                    @endif
                    @if (auth()->user()->can('admission.letter'))
                        <li> <a href="{{ route('admin.admission.letter') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Admission
                                Letter</a></li>
                    @endif
                    @if (auth()->user()->can('visa.letter'))
                        <li> <a href="{{ route('admin.visa.letter') }}"><i class="bx bx-right-arrow-alt"></i>Visa
                                Permission
                                Letter</a></li>
                    @endif
                    @if (auth()->user()->can('another.letter'))
                        <li> <a href="{{ route('admin.another.letter') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Another
                                Letter</a></li>
                    @endif
                    @if (auth()->user()->can('admission.letter.generate'))
                        <li> <a href="{{ route('admin.admission.letter.generate') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Admission Invoice Generate</a>
                        </li>
                    @endif
                    {{-- @if (auth()->user()->can('admission.invoice'))
                        <li> <a href="{{ route('admin.admission.invoice') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Admission
                                Invoice Upload</a></li>
                    @endif --}}
                </ul>
            </li>
        @endif

        @if (auth()->user()->can('noc.section.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-images'></i>
                    </div>
                    <div class="menu-title">NOC Section</div>
                </a>
                <ul>
                    @if (auth()->user()->can('noc.guideline'))
                        <li> <a href="{{ route('noc.guideline') }}"><i class="bx bx-right-arrow-alt"></i>NOC
                                Guideline</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('noc.form.list'))
                        <li> <a href="{{ route('noc.form.list') }}"><i class="bx bx-right-arrow-alt"></i>NOC Form
                                List</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('upload.noc.all.student'))
                        <li> <a href="{{ route('upload.noc.all.student') }}"><i class="bx bx-right-arrow-alt"></i>NOC
                                Form</a></li>
                    @endif
                    @if (auth()->user()->can('noc.list'))
                        <li> <a href="{{ route('noc.list') }}"><i class="bx bx-right-arrow-alt"></i>NOC File
                                List</a>
                        </li>
                    @endif
                    {{-- @if (auth()->user()->can('noc.aggreement'))
                        <li> <a href="{{ route('noc.pdf') }}"><i class="bx bx-right-arrow-alt"></i>NOC
                                Agreement for
                                Student</a></li>
                    @endif --}}
                </ul>
            </li>
        @endif

        @if (auth()->user()->can('visa.section.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-images'></i>
                    </div>
                    <div class="menu-title">Visa Section</div>
                </a>
                <ul>
                    @if (auth()->user()->can('visa.guideline'))
                        <li> <a href="{{ route('visa.guideline') }}"><i class="bx bx-right-arrow-alt"></i>Visa
                                Guideline</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('visa.apply.list'))
                        <li> <a href="{{ route('visa.apply.list') }}"><i class="bx bx-right-arrow-alt"></i>Visa Apply
                                Student</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('visa.application'))
                        <li> <a href="{{ route('visa.application') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Application
                                Copy</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('visa.copy.list'))
                        <li> <a href="{{ route('visa.copy.list') }}"><i class="bx bx-right-arrow-alt"></i>Visa
                                Copy</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('visa.upload'))
                        <li> <a href="{{ route('admin.visa.upload') }}"><i class="bx bx-right-arrow-alt"></i>Visa
                                Upload</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth()->user()->can('ticket.section.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-images'></i>
                    </div>
                    <div class="menu-title">Ticketing Section</div>
                </a>
                <ul>
                    @if (auth()->user()->can('ticketing.guideline'))
                        <li> <a href="{{ route('ticketing.guideline') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Ticketing
                                Guideline</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('ticket.request.list'))
                        <li> <a href="{{ route('ticket.request.list') }}"><i class="bx bx-right-arrow-alt"></i>Ticket
                                Request</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('ticket.status.admin'))
                        <li> <a href="{{ route('ticket.status.admin') }}"><i class="bx bx-right-arrow-alt"></i>Ticket
                                Status</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('admin.ticket'))
                        <li> <a href="{{ route('admin.ticket') }}"><i class="bx bx-right-arrow-alt"></i>Upload
                                Ticket</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('travel.guideline'))
                        <li> <a href="{{ route('travel.guideline') }}"><i class="bx bx-right-arrow-alt"></i>Travel
                                Guideline</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth()->user()->can('referance.section.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-images'></i>
                    </div>
                    <div class="menu-title">Referance Section</div>
                </a>
                <ul>
                    @if (auth()->user()->can('referance.guideline'))
                        <li> <a href="{{ route('referance.guideline') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Referance
                                Guideline</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('admin.paymentreceipt.upload'))
                        <li> <a href="{{ route('admin.paymentreceipt.upload') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Upload
                                Payment Receipt</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth()->user()->can('letter.verification.section.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-images'></i>
                    </div>
                    <div class="menu-title">Letter Verification Section</div>
                </a>
                <ul>
                    @if (auth()->user()->can('letterverificaion.guideline'))
                        <li> <a href="{{ route('letterverificaion.guideline') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Letter
                                Verification Guideline</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('document.verification'))
                        <li> <a href="{{ route('document.verification') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Document
                                Verification </a>
                        </li>
                    @endif
                    @if (auth()->user()->can('report.upload'))
                        <li> <a href="{{ route('report.upload') }}"><i class="bx bx-right-arrow-alt"></i>Report
                                Upload</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth()->user()->can('expensive'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-images'></i>
                    </div>
                    <div class="menu-title">Cashbook</div>
                </a>
                <ul>
                    @if (auth()->user()->can('admin.expensive'))
                        <li> <a href="{{ route('admin.expensive') }}"><i class="bx bx-right-arrow-alt"></i>Cashbook
                                List</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('create.expensive'))
                        <li> <a href="{{ route('create.expensive') }}"><i class="bx bx-right-arrow-alt"></i>Cashbook
                                Add</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth()->user()->can('coupon'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-images'></i>
                    </div>
                    <div class="menu-title">Coupon</div>
                </a>
                <ul>
                    @if (auth()->user()->can('admin.coupon'))
                        <li> <a href="{{ route('admin.coupon') }}"><i class="bx bx-right-arrow-alt"></i>Coupon
                                List</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('create.coupon'))
                        <li> <a href="{{ route('create.coupon') }}"><i class="bx bx-right-arrow-alt"></i>Coupon
                                Add</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth()->user()->can('notice'))
            <li>
                <a href="{{ route('admin.notice') }}">
                    <div class="parent-icon"><i class='bx bx-note'></i>
                    </div>
                    <div class="menu-title">Notice</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->can('admin.refund'))
            <li>
                <a href="{{ route('admin.refund') }}">
                    <div class="parent-icon"><i class='bx bx-user-circle'></i>
                    </div>
                    <div class="menu-title">Refund Policy</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->can('contact.message'))
            <li>
                <a href="{{ route('contact.message') }}">
                    <div class="parent-icon"><i class='bx bx-message-dots'></i>
                    </div>
                    <div class="menu-title">Contact Message</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->can('setting'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-cog'></i>
                    </div>
                    <div class="menu-title">Settings</div>
                </a>
                <ul>
                    @if (auth()->user()->can('seo.setting'))
                        <li> <a href="{{ route('seo.setting') }}"><i class="bx bx-right-arrow-alt"></i>SEO
                                Setting</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('about.setting'))
                        <li> <a href="{{ route('about.setting') }}"><i class="bx bx-right-arrow-alt"></i>About</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('website.setting'))
                        <li> <a href="{{ route('website.setting') }}"><i class="bx bx-right-arrow-alt"></i>Website
                                Setting</a>
                        </li>
                    @endif
                    @if (auth()->user()->can('page.index'))
                        <li> <a href="{{ route('page.index') }}"><i class="bx bx-right-arrow-alt"></i>Page Create</a>
                        </li>
                    @endif
                    {{-- @if (auth()->user()->can('smtp.setting'))
                        <li> <a href="{{ route('smtp.setting') }}"><i class="bx bx-right-arrow-alt"></i>SMTP
                                Setting</a>
                        </li>
                    @endif --}}
                </ul>
            </li>
        @endif

        @if (auth()->user()->can('role.permission.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-accessibility'></i>
                    </div>
                    <div class="menu-title">Roles & Permission</div>
                </a>
                <ul>
                    <li> <a href="{{ route('all.permission') }}"><i class="bx bx-right-arrow-alt"></i>All
                            Permission</a>
                    </li>
                    <li> <a href="{{ route('all.roles') }}"><i class="bx bx-right-arrow-alt"></i>All Roles</a>
                    </li>
                    <li> <a href="{{ route('add.roles.permission') }}"><i class="bx bx-right-arrow-alt"></i>Roles
                            in
                            Permission</a>
                    </li>
                    <li> <a href="{{ route('all.roles.permission') }}"><i class="bx bx-right-arrow-alt"></i>All
                            Roles
                            in
                            Permission</a>
                    </li>
                </ul>
            </li>
        @endif

        @if (auth()->user()->can('admin.manage.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-user'></i>
                    </div>
                    <div class="menu-title">Admin Manage</div>
                </a>
                <ul>
                    <li> <a href="{{ route('all.admin') }}"><i class="bx bx-right-arrow-alt"></i>All Admin</a>
                    </li>
                    <li> <a href="{{ route('add.admin') }}"><i class="bx bx-right-arrow-alt"></i>Add Admin</a>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
    <!--end navigation-->
</div>
