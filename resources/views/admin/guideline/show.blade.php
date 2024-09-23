@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Travel Guideline</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('travel.guideline') }}" class="btn btn-info">Travel Guideline</a>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            {!! $data->description !!}
            <embed src="{{ asset('upload/travelguideline/' . $data->pdf) }}" type="application/pdf" width="100%"
                height="600px" />
            {{-- Iframe alternative --}}
            {{-- <iframe src="{{ asset('upload/travelguideline/' . $data->pdf) }}" style="width:100%; height:600px;" frameborder="0"></iframe> --}}
        </div>
    </div>
@endsection
