@extends('frontend.frontend_master')
@section('title')
    SIAC || University
@endsection
@section('frontend_content')
    <!-- breadcrumb start -->
    <div class="breadcrumb__area"
        style="background-image: url({{ asset('frontend/assets/image/universitiy/university.webp') }})">
        <h2>we represent universities</h2>
    </div>
    <!-- breadcrumb end -->



    <!-- university start -->
    <div class="university_area section__padding">
        <div class="container">
            <div class="row g-3">
                @foreach ($universities as $row)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="{{ route('universitydetails.page', $row->slug) }}" class="single__univeristy">
                            <img src="{{ asset('upload/university/' . $row->thumbnail) }}" alt="{{ $row->name }}" />
                            <h4>{{ $row->name }}</h4>
                            <p><i class="fa fa-location-dot"></i>{{ $row->address }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- university end -->
@endsection
