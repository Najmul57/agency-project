@extends('frontend.frontend_master')
@section('title')
    SIAC || Pay Fees
@endsection
@section('frontend_content')
    <style>
        div#coupon_code_container {
            width: 100%;
            display: flex;
            gap: 10px;
        }

        div#coupon_code_container input[type="submit"] {
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button.delete_coupon {
            width: 60px;
            height: 50px;
            margin-top: 7px;
            background: #f2382c;
            color: #fff;
            border: 0;
            margin-left: 7px;
            border-radius: 5px;
        }
    </style>

    <!-- breadcrumb start -->
    <div class="breadcrumb__area" style="background-image: url({{ asset('frontend') }}/assets/image/study/canada.jpg);">
        <h2>pay fees</h2>
    </div>
    <!-- breadcrumb end -->

    <div class="payfee__form section__padding">
        <div class="container">
            <div class="row">
                <h2 class="text-center mb-3">Purpose of Payment</h2>
                <div class="col-12 col-md-6 col-sm-8 offset-sm-2 offset-md-3 card p-4">
                    <div class="form-group mt-2 mb-3">
                        <label for="payment_type">Payment Purpose</label>
                        <select name="payment_type" id="payment_type" class="select2">
                            <option selected disabled>Select Type</option>
                            <option value="Admission">Admission</option>
                            <option value="Tuition_fee">Tuition Fee</option>
                            <option value="Tickets">Tickets</option>
                            <option value="Visa_purpose">Visa Purpose</option>
                            <option value="Service_charge">Service Charge</option>
                            <option value="application_fees">Application Fees</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="payment__system">
                        <div class="form-group">
                            <label for="payment_option">Currency</label>
                            <select name="payment_option" id="payment_option" class="select2" onchange="convertCurrency()">
                                <option selected disabled>Select Currency</option>
                                <option value="usd">USD</option>
                                <option value="inr">INR</option>
                                <option value="canada">Canada</option>
                                <option value="euro">Euro</option>
                                <option value="bdt">BDT</option>
                            </select>
                        </div>

                        <div class="form-group mt-1">
                            <input type="checkbox" id="coupon___code" name="coupon___code" value="have a coupon code?">
                            <label for="coupon___code">have a coupon code?</label>
                        </div>

                        <div class="form-group mt-3" id="usd_amount" style="display: none;">
                            <label for="usd_input">USD Amount</label>
                            <input type="text" name="usd_input" id="usd_input" class="form-control"
                                placeholder="USD Amount">
                        </div>

                        <div class="form-group mt-3" id="inr_amount" style="display: none;">
                            <label for="inr_amount">INR Amount</label>
                            <input type="text" name="inr_amount" id="inr_amount_input" class="form-control"
                                placeholder="INR Amount">
                        </div>

                        <div class="form-group mt-3" id="canada_amount" style="display: none;">
                            <label for="canada_amount">Canada Amount</label>
                            <input type="text" name="canada_amount" id="canada_amount_input" class="form-control"
                                placeholder="Canada Amount">
                        </div>

                        <div class="form-group mt-3" id="euro_amount" style="display: none;">
                            <label for="euro_amount">Euro Amount</label>
                            <input type="text" name="euro_amount" id="euro_amount_input" class="form-control"
                                placeholder="Euro Amount">
                        </div>

                        <div class="form-group mt-3" id="bdt_amount" style="display: none;">
                            <label for="taka">BDT Amount</label>
                            <input type="text" name="taka" id="taka" class="form-control"
                                placeholder="BDT Amount">
                        </div>

                    </div>
                </div>
            </div>
            <form action="{{ route('payfees.store') }}" method="post" enctype="multipart/form-data" id="paymentForm">
                @csrf
                <div class="row mt-5">
                    <div class="col-md-12 col-lg-8">
                        <div class="student__info">
                            <h3 class="mb-2">Student Information</h3>
                            <div class="row">
                                <div class="col-12 col-md-6 col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            @auth
value="{{ auth()->user()->name }}" @endauth readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="registation_id">Registation Number/System ID</label>
                                        <input type="text" id="registation_id" name="registation_id"
                                            class="form-control" @auth value="{{ auth()->user()->system_id }}" @endauth
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="university_name">University Name</label>
                                        <input type="text" id="university_name" name="university_name"
                                            class="form-control"
                                            @auth value="{{ auth()->user()->premiumUniversity->name ?? '' }}" @endauth
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            @auth
value="{{ auth()->user()->email }}" @endauth readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="number">Number</label>
                                        <input type="text" id="number" name="number" class="form-control"
                                            @auth
value="{{ auth()->user()->phone }}" @endauth readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="address">Address</label>
                                        <input type="text" id="address" name="address" class="form-control"
                                            @auth
value="{{ auth()->user()->city }}" @endauth readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="signature">Upload Signature</label>
                                        <input type="file" name="signature" id="signature" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <h3 class="mb-2 pb-4">Your Payment </h3>
                        <div class="payment__section">
                            <ul>
                                <li>
                                    <p>Sub Total</p>
                                    <input type="text" id="display_amount" name="display_amount" readonly
                                        value="Payment Total Amount">
                                </li>
                                <li>
                                    <div class="form-group mt-2 d-none" id="coupon_code_container">
                                        <input type="text" name="coupon_code" id="coupon_code" class="form-control"
                                            placeholder="Coupon Code">
                                        <input type="button" class="apply" value="Apply">
                                    </div>
                                    <button type="button" class="delete_coupon" style="display:none"><i
                                            class="fa fa-xmark"></i></button>
                                </li>
                                <li class="hide">
                                    <p>Coupon Amount: <span id="coupon_amount"></span></p>
                                    <div>
                                        <p>Total: <span id="grand_total">0</span></p>
                                        <input type="hidden" name="grand_total" id="grand_total_input" value="0">
                                    </div>
                                </li>

                                <li>
                                    <p>Type</p>
                                    <input type="text" id="display_type" name="display_type" readonly
                                        value="Payment Type">
                                </li>
                            </ul>
                            <div class="payment__method p-3">
                                <div class="form-group">
                                    <label for="payment_method_item">Payment Method</label>
                                    <select name="payment_method_item" id="payment_method_item" class="select2"
                                        onchange="najmul()">
                                        <option selected hidden>Select method</option>
                                        <option value="bkash">Bkash</option>
                                        <option value="nagod">Nagod</option>
                                        <option value="dbbl">DBBL</option>
                                        {{-- <option value="bank">Bank Transfer</option> --}}
                                    </select>
                                </div>
                                <div class="form-group mt-3" style="display: none;" id="txt_number_div">
                                    <label for="txt_number">Transaction Number</label>
                                    <input type="text" name="txt_number" id="txt_number" class="form-control"
                                        placeholder="Transaction number" required>
                                </div>
                                <div class="form-group mt-3" style="display: none;" id="bank_name_div">
                                    <label for="bank_name">Bank Name</label>
                                    <input type="text" name="bank_name" id="bank_name" class="form-control"
                                        placeholder="Bank Name">
                                </div>
                                <div class="form-group mt-3" style="display: none;" id="bank_txt_upload_div">
                                    <label for="bank_txt_upload">Transaction Upload</label>
                                    <input type="file" name="bank_txt_upload" id="bank_txt_upload"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="checkbox" style="display: flex; align-items: baseline; gap: 10px;  margin-top: 10px;">
                            <input type="checkbox" id="disclaimer" name="disclaimer" value="disclaimer" required>
                            <label for="disclaimer"> I agree all the term and condition. And providing details and
                                documents and genuine.</label>
                        </div>
                        <button type="submit" class="main_btn border mt-3">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- <script src="{{ asset('frontend') }}/assets/js/jquery.min.js"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        //payment type
        $(document).ready(function() {
            $('#payment_type').change(function() {
                var selectedValue = $(this).val();

                $('#display_type').val(selectedValue);
            });
        });
    </script>
    <script>
        const indianRupyRate = {{ $setting->inr_rate }};
        const usdRate = {{ $setting->doller_rate }};
        const canadaRate = {{ $setting->canada }};
        const euroRate = {{ $setting->euro }};
    </script>
    <script>
        $(document).ready(function() {
            $('#coupon___code').click(function() {
                $('#coupon_code_container').toggleClass('d-none');
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', '.apply', function() {
            var coupon_code = $('#coupon_code').val();
            //console.log(code);
            if (coupon_code) {
                //console.log(url);
                $.ajax({
                    // headers: {
                    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // },
                    url: "{{ route('coupon.get') }}",
                    method: "GET",
                    data: {
                        'coupon_code': coupon_code
                    },
                    success: function(response) {
                        if ((response.success)) {
                            var coupon = response.coupon;
                            var couponAmount = coupon.amount;
                            var display_amount = parseFloat($('#display_amount').val());
                            var total = display_amount - couponAmount;
                            var grandPrice = parseFloat($('#grand_total').text(total));
                            var couponamount = parseFloat($('#coupon_amount').text(couponAmount));
                            $('#coupon_code').prop('disabled', true);
                            $('.delete_coupon').show();
                        } else {
                            //console.log("Coupon not found.");
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 1200
                            })
                            Toast.fire({
                                type: 'error',
                                title: response.error
                            })
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX request failed: " + error);
                    }
                });
            }
        });

        $(document).on('click', '.delete_coupon', function() {
            var display_amount = parseFloat($('#display_amount').val());
            console.log('display_amount', display_amount)
            var couponamount = parseFloat($('#coupon_amount').text(0));
            var grandPrice = parseFloat($('#grand_total').text(display_amount));
            $('#coupon_code').prop('disabled', true);
            $('.hide').hide();
            $('.delete_coupon').hide();

        })
    </script>
    <script>
        document.getElementById('paymentForm').addEventListener('submit', function() {
            var grandTotalSpan = document.getElementById('grand_total').innerText;
            document.getElementById('grand_total_input').value = grandTotalSpan;
        });
    </script>
@endsection
