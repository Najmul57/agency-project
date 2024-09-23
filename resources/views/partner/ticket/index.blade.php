@extends('partner.layouts.partner_master')

@section('partner__content')
    <form action="{{ route('partner.ticket.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 col-md-4 mb-2">
                <div class="form-group">
                    <label for="user_id">Student Name</label>
                    <select name="user_id" id="user_id" class="form-select">
                        <option value="">Select Student</option>
                        @foreach ($users as $item)
                            <option value="{{ $item->id }}">{{ ucfirst($item->name) }}-{{ $item->system_id }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
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
                    <input type="text" id="from" name="from" class="form-control" placeholder="from">
                </div>
            </div>
            <div class="col-12 col-md-4 mb-2">
                <div class="form-group">
                    <label for="to">To</label>
                    <input type="text" id="to" name="to" class="form-control" placeholder="to">
                </div>
            </div>
            <div class="col-12 col-md-4 mb-2">
                <div class="form-group">
                    <label for="person">Person of Travel</label>
                    <input type="number" id="person" name="person" class="form-control" placeholder="person">
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
                    <input class="form-check-input" type="checkbox" value="" id="ticketDisclimer" required>
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

    <p class="mt-3">
        <strong class="text-danger">Note: </strong>if anyone want to do ticket through
        SIAC than definitely should mail on your ticket fair payment receipt- <a style="color: #F32556;font-weight:700"
            href="mailto:tickets@siacabroad.com">tickets@siacabroad.com</a> this email id.
    </p>
@endsection
