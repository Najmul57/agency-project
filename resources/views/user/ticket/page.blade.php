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
                    <li class="breadcrumb-item active" aria-current="page">Ticket Page</li>
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
                                    <div class="tab-title">Guideline</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#ticketForm" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Ticket Form</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#checkStatus" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Check Status</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#ticket" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Ticket</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#travelGuideline" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Travel Guideline</div>
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
                            {!! $ticketingGuideline->description !!}
                        </div>
                        <div class="tab-pane fade" id="ticketForm" role="tabpanel">
                            <form action="{{ route('ticket.form.submit') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="traveldate">Date of Travel</label>
                                            <input type="date" id="traveldate" name="traveldate" class="form-control"
                                                placeholder="date of travel">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="travelby">Travel by</label>
                                            <select name="travelby" id="travelby" class="form-select">
                                                <option value="byair">By Air</option>
                                                <option value="byroad">By Road</option>
                                                <option value="bytrain">By Train</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="from">From</label>
                                            <input type="text" id="from" name="from" class="form-control"
                                                placeholder="from">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="to">To</label>
                                            <input type="text" id="to" name="to" class="form-control"
                                                placeholder="to">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="person">Person of Travel</label>
                                            <input type="number" id="person" name="person" class="form-control"
                                                placeholder="person">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="passport">Upload Passport</label>
                                            <input type="file" id="passport" name="passport" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="visa">Upload Visa</label>
                                            <input type="file" id="visa" name="visa" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="ticketDisclimer" required>
                                            <label class="form-check-label" for="ticketDisclimer">
                                                <strong class="text-danger">Disclaimer: </strong> I agree all the terms
                                                and
                                                condition. And providing all documents are genunie.
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="checkStatus" role="tabpanel">

                            {!! auth()->user()->ticketStatus->description ?? '' !!}

                        </div>
                        <div class="tab-pane fade" id="ticket" role="tabpanel">
                            @php
                                $ticket = \App\Models\StudentTicket::where('user_id', auth()->id())->get();
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
                                                @foreach ($ticket as $key => $data)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $data->created_at->format('d M Y') }}</td>
                                                        <td><a
                                                                href="{{ route('admin.ticket.download', ['id' => $data->id]) }}">Download</a>
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
                        <div class="tab-pane fade" id="travelGuideline" role="tabpanel">

                            @foreach ($travelGuideline as $data)
                                @if ($data->status == 1)
                                    {!! $data->description !!}
                                    <embed src="{{ asset('upload/travelguideline/' . $data->pdf) }}"
                                        type="application/pdf" width="100%" height="600px" />
                                @endif
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel">
                            <p>{!! $help->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
