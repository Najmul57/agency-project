@extends('frontend.frontend_master')
@section('title')
    SIAC || {{ ucfirst($serviceDetails->title) }}
@endsection
@section('frontend_content')
    <style>
        .single__service h6 {
            font-size: 12px;
        }
    </style>
    <!-- breadcrumb start -->
    <div class="breadcrumb__area"
        style="background-image: url('{{ asset('upload/service/' . $serviceDetails->breadcrumb) }}')">
        <h2>{{ $serviceDetails->title }}</h2>
    </div>

    <!-- breadcrumb end -->

    <!-- service details start  -->
    <div class="service__details section__padding">
        <div class="container">
            <div class="row g-3">
                <div class="col-12">
                    <div class="service__details__content card p-2 mb-3">
                        <p>{!! $serviceDetails->long_description !!}</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="blog__list">
                        <h3>service list</h3>
                        <div class="row">
                            <div class="col-12 col-md-8 mx-auto">
                                <div class="row g-3 mt-4">
                                    @foreach ($services as $row)
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                            <a href="{{ route('servicedetails.page', $row->slug) }}"
                                                class="service__content position-relative">
                                                <div class="single__service">
                                                    <img src="{{ asset('upload/service/' . $row->image) }}"
                                                        alt="{{ $row->title }}">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service details end  -->
@endsection
