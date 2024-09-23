@extends('frontend.frontend_master')
@section('title')
    SIAC || Country
@endsection
@section('frontend_content')
    <!-- breadcrumb start -->
    <div class="breadcrumb__area"
        style="background-image: url({{ asset('frontend') }}/assets/image/country/country.jpg); background-position: bottom;">
        <h2>country list</h2>
    </div>
    <!-- breadcrumb end -->

    <!-- courses start -->
    <div class="courses_area section__padding">
        <div class="container">
            <div class="row g-3">
                @foreach ($countries as $row)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single__country position-relative">
                            <div class="country__thumbnail">
                                <img src="{{ asset('upload/country/' . $row->thumbnail) }}" alt="{{ $row->name }}">
                                <h4>{{ $row->name }}</h4>
                            </div>
                            <div class="view_list">
                                <a href="{{ route('countrydetails.page', $row->slug) }}" class="main_btn">details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- courses end -->
@endsection
