@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"> Letter Verification List <span
                            class="total_count">{{ $data->count() }}</span></li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered example2">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($data) --}}
                        @foreach ($data as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ optional($row->user)->name }}</td>
                                <td>{{ optional($row->user)->email }}</td>
                                <td>{{ optional($row->user)->phone }}</td>
                                <td>{{ $row->document }}</td>
                                <td>
                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                        data-bs-target="#documentModal{{ $row->id }}"
                                        class="btn btn-sm btn-success">View</a>
                                    <a href="{{ route('document.verification.destroy', $row->id) }}"
                                        class="btn btn-sm btn-danger" id="delete">Delete</a>
                                </td>
                            </tr>

                            <!-- Document Modal -->
                            <div class="modal fade" id="documentModal{{ $row->id }}" tabindex="-1"
                                aria-labelledby="documentModalLabel{{ $row->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="documentModalLabel{{ $row->id }}">
                                                {{ $row->document }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="single_doc">
                                                <h6>Document Type : {{ $row->document }}</h6>
                                            </div>
                                            <div class="single_doc">
                                                <h6>Referance Name : {{ $row->referance_name }}</h6>
                                            </div>
                                            <div class="single_doc">
                                                <h6>Payment Type : {{ $row->method }}</h6>
                                            </div>
                                            <div class="single_doc">
                                                <h6>Amount : {{ $row->amount }}</h6>
                                            </div>
                                            <div class="single_doc">
                                                <h6>Referance Email : {{ $row->referance_email }}</h6>
                                            </div>
                                            <div class="single_doc">
                                                <h6>Letter Verification <a
                                                        href="{{ asset('upload/letter_verification/' . $row->verification_letter) }}"
                                                        download>Download</a></h6>
                                            </div>
                                            <div class="single_doc">
                                                <h6>Payment Receipt <a
                                                        href="{{ asset('upload/letter_verification/' . $row->paymentReceipt) }}"
                                                        download>Download</a></h6>
                                            </div>
                                            <div class="single_doc">
                                                <h6>Mark sheet <a
                                                        href="{{ asset('upload/letter_verification/' . $row->marksheet) }}"
                                                        download>Download</a></h6>
                                            </div>
                                            <div class="single_doc">
                                                <h6>ID Proof <a
                                                        href="{{ asset('upload/letter_verification/' . $row->idProof) }}"
                                                        download>Download</a></h6>
                                            </div>
                                            <div class="single_doc">
                                                <h6>Photo <a
                                                        href="{{ asset('upload/letter_verification/' . $row->photo) }}"
                                                        download>Download</a>
                                                </h6>
                                            </div>
                                            <div class="single_doc">
                                                <h6>Signature <a
                                                        href="{{ asset('upload/letter_verification/' . $row->signature) }}"
                                                        download>Download</a></h6>
                                            </div>
                                            <div class="single_doc">
                                                <h6>Others <a
                                                        href="{{ asset('upload/letter_verification/' . $row->others) }}"
                                                        download>Download</a></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
