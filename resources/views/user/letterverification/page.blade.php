@extends('user.user_master')

@section('user__content')
    <style>
        .payment__page .nav-link {
            padding: 5px;
        }
    </style>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">{{ ucfirst(auth()->user()->name) }}</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Letter Verification</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row ">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-primary payment__page" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#guideline" role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Important Links/Guideline</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#documentverificatin" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Letter Verification</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#seeReport" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">See Report</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#contact" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Contact/Help</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content py-3">
                        <div class="tab-pane fade" id="guideline" role="tabpanel">
                            {!! $verification->description !!}
                        </div>
                        <div class="tab-pane fade" id="documentverificatin" role="tabpanel">
                            <form action="{{ route('letter.verificatin.store') }}" method="post" id="verify_form"
                                enctype="multipart/form-data" onsubmit="return validateForm()">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="document">Documents Verification</label>
                                            <select name="document" class="form-select" id="document"
                                                onchange="updateAmount()">
                                                <option selected disabled>Select Letter</option>
                                                <option value="Offer Letter">Offer Letter</option>
                                                <option value="Admission Letter">Admission Letter</option>
                                                <option value="Doctor Appointment Letter">Doctor Appointment Letter</option>
                                                <option value="Another Letter">Another Letter</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="referance_name">Referance Name</label>
                                            <input type="text" name="referance_name" id="referance_name"
                                                class="form-control" placeholder="enter referance name" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="referance_email">Referance Email</label>
                                            <input type="email" name="referance_email" id="referance_email"
                                                class="form-control" placeholder="enter referance email" required>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="fs-4 py-3">Upload Documents</h4>

                                <div class="row">
                                    <div class="col-12 col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="verification_letter">Verification Letter</label>
                                            <input type="file" id="verification_letter" name="verification_letter"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="paymentReceipt">Upload Payment Receipt</label>
                                            <input type="file" id="paymentReceipt" name="paymentReceipt"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="marksheet">Acadamic Mark Sheet</label>
                                            <input type="file" id="marksheet" name="marksheet" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="idProof">ID Proof</label>
                                            <input type="file" id="idProof" name="idProof" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="photo">Photo</label>
                                            <input type="file" id="photo" name="photo" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="signature">Signature</label>
                                            <input type="file" id="signature" name="signature" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="others">Others</label>
                                            <input type="file" id="others" name="others" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="method">Amount</label>
                                            <input type="number" name="amount" id="amount" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="method">Payment Method</label>
                                            <select name="method" id="method" class="form-select">
                                                <option value="bkash">Bkash</option>
                                                <option value="nagod">Nagod</option>
                                                <option value="dbbl">DBBL</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="transition">Transition Number</label>
                                            <input type="text" name="transition" id="transition" class="form-control"
                                                required placeholder="sdw4d0945">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info mt-3">Submit</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="seeReport" role="tabpanel">
                            @php
                                $document = \App\Models\DocumentUpload::where('user_id', auth()->id())->latest()->get();
                            @endphp
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered example2">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($document as $key => $data)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $data->created_at->format('d M Y') }}</td>
                                                        <td><a class="btn btn-sm btn-success"
                                                                href="{{ route('user.report.download', ['id' => $data->id]) }}">Download</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel">
                            <p>{!! $help->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function updateAmount() {
            var selectedDocument = document.getElementById("document").value;
            var amountField = document.getElementById("amount");

            switch (selectedDocument) {
                case "Offer Letter":
                    amountField.value = 1049;
                    break;
                case "Admission Letter":
                    amountField.value = 1499;
                    break;
                case "Doctor Appointment Letter":
                    amountField.value = 999;
                    break;
                case "Another Letter":
                    amountField.value = 1999;
                    break;
                default:
                    amountField.value = ""; // Clear the value if no match found
                    break;
            }
        }
    </script>
    <script>
        function validateForm() {
            var amountField = document.getElementById("amount").value;

            // Check if the amount field is empty
            if (amountField === "") {
                alert("Amount cannot be empty");
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }
    </script>
@endsection
