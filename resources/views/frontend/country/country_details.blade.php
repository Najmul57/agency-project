@extends('frontend.frontend_master')
@section('title')
    SIAC || Study in {{ ucfirst($countrydetails->name) }}
@endsection
@section('frontend_content')
    <style>
        a.single_country {
            display: block;
            padding: 10px;
            border-radius: 10px;
            background: white;
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
        }
    </style>
    <!-- breadcrumb start -->
    @if ($countrydetails)
        <div class="breadcrumb__area" style="background: url('{{ asset('upload/country/' . $countrydetails->breadcrumb) }}')">
            <h2>Study in {{ $countrydetails->name }}</h2>
        </div>
    @endif


    <!-- breadcrumb end -->

    <!-- abroad start -->
    <div class="abroad__area section__padding">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="country__info p-3 card">
                        <h1 class="study_country_headline mb-3">Study in <span>{{ $countrydetails->name ?? '' }}</span></h1>
                        <p>{!! $countrydetails->description ?? '' !!}</p>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="blog__list">
                        <h3>Country List</h3>
                    </div>
                </div>
            </div>
            <div class="row g-3">
                @foreach ($countries as $row)
                    <div class="col-md-3 col-6 col-sm-4 col-lg-2">
                        <a href="{{ route('countrydetails.page', $row->slug) }}" class="single_country">
                            <img src="{{ asset('upload/country/' . $row->thumbnail) }}" alt="">
                            <h5 class="text-black mt-2">{{ ucwords($row->name) }}</h5>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- abroad end -->

    <!-- courses start -->
    <div class="courses_area section__padding pt-0">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <!-- heading -->
                    <div class="section_heading text-center">
                        <h2 class="border-bottom d-inline mt-3">universitiy</h2>
                    </div>
                </div>
            </div>
            <div class="row g-3 mt-4">
                @if ($countrydetails->universities->count() > 0)
                    @foreach ($countrydetails->universities as $university)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <a href="{{ route('universitydetails.page', $university->slug) }}" class="single__univeristy">
                                <img src="{{ asset('upload/university/' . $university->thumbnail) }}"
                                    alt="{{ $university->name }}">
                                <h4>{{ $university->name }}</h4>
                                <p><i class="fa fa-location-dot"></i>{{ $university->address }}</p>
                            </a>
                        </div>
                    @endforeach
                @else
                    <h4 class="text-center">University not available in <strong
                            style="color: #F2382C;font-size:1.5rem">{{ ucwords($countrydetails->name) }}</strong>.</h4>
                @endif
            </div>
        </div>
    </div>
    <!-- courses end -->
@endsection
