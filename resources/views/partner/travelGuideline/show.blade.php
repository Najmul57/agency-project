@extends('partner.layouts.partner_master')

@section('partner__content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">{{ ucfirst($data->name) }}</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Travel Guideline</li>
                </ol>
            </nav>
        </div>
    </div>


    <div class="card p-3">
        @if ($data->travelguideline && $data->travelguideline->description)
            {!! $data->travelguideline->description !!}
        @else
        @endif

        @if ($data->travelguideline && $data->travelguideline->pdf)
            <div class="embed-responsive embed-responsive-16by9" style="width: 100%; height: 600px;">
                <iframe class="embed-responsive-item"
                    src="{{ asset('upload/travelguideline/' . $data->travelguideline->pdf) }}" allowfullscreen
                    style="width: 100%; height: 100%;"></iframe>
            </div>
        @else
        @endif


    </div>
@endsection
