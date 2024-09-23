@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Website Setting</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-9 mx-auto card p-3">
            <form action="{{ route('page.setting.update', $setting->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- <div class="form-group mb-3">
                <label for="currency">Currency</label>
                <select name="currency" id="currency" class="form-select">
                    <option value="$" {{ ($setting->currency=='$') ? 'selected' :'' }}>Doller</option>
                    <option value="৳" {{ ($setting->currency=='৳') ? 'selected' :'' }}>Taka</option>
                </select>
            </div> --}}
                <div class="form-group mb-3">
                    <label for="doller_rate">Doller Rate</label>
                    <input type="text" name="doller_rate" id="doller_rate" class="form-control"
                        value="{{ $setting->doller_rate }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="inr_rate">Indian Rate</label>
                    <input type="text" name="inr_rate" id="inr_rate" class="form-control"
                        value="{{ $setting->inr_rate }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="canada_rate">Canada Rate</label>
                    <input type="text" name="canada_rate" id="canada_rate" class="form-control"
                        value="{{ $setting->canada }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="euro_rate">Euro Rate</label>
                    <input type="text" name="euro_rate" id="euro_rate" class="form-control" value="{{ $setting->euro }}"
                        required>
                </div>
                <div class="form-group mb-3">
                    <label for="primium_subscription">Primium Subscription</label>
                    <input type="text" name="primium_subscription" id="primium_subscription" class="form-control"
                        value="{{ $setting->primium_subscription }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="partner_subscription">Partner Subscription</label>
                    <input type="text" name="partner_subscription" id="partner_subscription" class="form-control"
                        value="{{ $setting->partner_subscription }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="phone_one">Phone One</label>
                    <input type="text" name="phone_one" id="phone_one" class="form-control"
                        value="{{ $setting->phone_one }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="phone_two">Phone Two</label>
                    <input type="text" name="phone_two" id="phone_two" class="form-control"
                        value="{{ $setting->phone_two }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="main_email">Main Email</label>
                    <input type="email" name="main_email" id="main_email" class="form-control"
                        value="{{ $setting->main_email }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="support_email">Support Email</label>
                    <input type="email" name="support_email" id="support_email" class="form-control"
                        value="{{ $setting->support_email }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control"
                        value="{{ $setting->address }}">
                </div>
                <div class="form-group mb-3">
                    <label for="facebook">Facebook</label>
                    <input type="text" name="facebook" id="facebook" class="form-control"
                        value="{{ $setting->facebook }}">
                </div>
                <div class="form-group mb-3">
                    <label for="twitter">Twitter</label>
                    <input type="text" name="twitter" id="twitter" class="form-control"
                        value="{{ $setting->twitter }}">
                </div>
                <div class="form-group mb-3">
                    <label for="instagram">Instagram</label>
                    <input type="text" name="instagram" id="instagram" class="form-control"
                        value="{{ $setting->instagram }}">
                </div>
                <div class="form-group mb-3">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" name="linkedin" id="linkedin" class="form-control"
                        value="{{ $setting->linkedin }}">
                </div>
                <div class="form-group mb-3">
                    <label for="youtube">Youtube</label>
                    <input type="text" name="youtube" id="youtube" class="form-control"
                        value="{{ $setting->youtube }}">
                </div>
                <div class="form-group mb-3">
                    <label for="short_about">Short About</label>
                    <textarea name="short_about" id="short_about" cols="30" rows="5" class="form-control">{!! $setting->short_about !!}</textarea>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <div class="form-group mb-3">
                            <label for="logo">Logo <strong class="text-danger">(150x74)</strong></label>
                            <input type="file" name="logo" id="logo" class="form-control">
                            <input type="hidden" name="old_logo" value="{{ $setting->logo }}">

                            <img id="showlogo" class="mt-2"
                                src="{{ !empty($setting->logo) ? url('/upload/logo/' . $setting->logo) : url('upload/admin_images/no_image.jpg') }}"
                                alt="Admin" class="rounded-circle p-1 bg-primary">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group mb-3">
                            <label for="favicon">Favicon <strong class="text-danger">(32x32)</strong></label>
                            <input type="file" name="favicon" id="favicon" class="form-control">
                            <input type="hidden" name="old_favicon" value="{{ $setting->favicon }}">

                            <img id="showfavicon" class="mt-2"
                                src="{{ !empty($setting->favicon) ? url('/upload/favicon/' . $setting->favicon) : url('upload/admin_images/no_image.jpg') }}"
                                alt="Admin" class="rounded-circle p-1 bg-primary" style="object-fit:contain">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group mb-3">
                            <label for="signature">Author Signature <strong class="text-danger">(300x80)</strong></label>
                            <input type="file" name="signature" id="signature" class="form-control">
                            <input type="hidden" name="old_signature" value="{{ $setting->signature }}">

                            <img id="showsignature" class="mt-2"
                                src="{{ !empty($setting->signature) ? url('/upload/authorsignature/' . $setting->signature) : url('upload/admin_images/no_image.jpg') }}"
                                alt="Admin" class="rounded-circle p-1 bg-primary" style="object-fit:contain">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success"> Website Settings</button>
            </form>
        </div>
    </div>
    <!--end row-->

    <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#logo').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showlogo').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
        $(document).ready(function() {
            $('#favicon').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showfavicon').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
        $(document).ready(function() {
            $('#signature').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showsignature').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
@endsection
