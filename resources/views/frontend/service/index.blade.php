@extends('frontend.frontend_master')
@section('title')
    SIAC || Services
@endsection
@section('frontend_content')
    <!-- breadcrumb start -->
    <div class="breadcrumb__area" style="background-image: url({{ asset('frontend/assets/image/services/service.jpg') }})">
        <h2>services</h2>
    </div>
    <!-- breadcrumb end -->

    <!-- courses start -->
    <div class="courses_area section__padding">
        <div class="container">
            <div class="row align-items-center g-2">
                @foreach ($services as $row)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                        <a href="{{ route('servicedetails.page', $row->slug) }}" class="service__content position-relative">
                            <div class="single__service">
                                <img src="{{ asset('upload/service/' . $row->image) }}" alt="{{ $row->title }}">
                                <h6>{{ ucfirst($row->title) }}</h6>
                            </div>
                            <div class="service__hover">
                                <p>{{ ucfirst($row->short_description) }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- courses end -->
@endsection
