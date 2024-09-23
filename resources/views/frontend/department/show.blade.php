@extends('frontend.frontend_master')
@section('title')
    {{-- SIAC || {{ ucfirst($department->name) }} --}}
@endsection
@section('frontend_content')
    <!-- breadcrumb start -->
    <div class="breadcrumb__area" style="padding: 50px 0">
        <h4 class="text-white">{{ ucwords($slug) }}</h4>
    </div>
    <!-- breadcrumb end -->
    <!-- main -->
    <div class="main">
        <div class="course__university section__padding">
            <div class="container">
                <div class="department__wise__university card p-2">
                    <div class="row g-3">
                        @foreach ($universities as $university)
                            <div class="col-md-6">
                                <div class="university__item">
                                    <div class="university__course__list d-flex align-items-center">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="university__thumbnail">
                                                    <a href="{{ route('universitydetails.page', $university->slug) }}"><img
                                                            src="{{ asset('upload/university/' . $university->thumbnail) }}"
                                                            alt="{{ $university->name }}"></a>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <div class="university__course__list">
                                                    {{-- <ul class="course__list mb-1">
                                                        @foreach ($groupedCourses as $name => $item)
                                                            <li>{{ ucwords($name) }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <hr> --}}
                                                    <div class="universitiy__heading d-flex"
                                                        style="flex-direction: column; gap:10px">
                                                        <a href="{{ route('universitydetails.page', $university->slug) }}">
                                                            <img src="{{ asset('upload/university/' . $university->logo) }}"
                                                                alt="{{ $university->name }}" />
                                                        </a>
                                                        <div class="university__item__content">
                                                            <a
                                                                href="{{ route('universitydetails.page', $university->slug) }}">
                                                                <h5 class="university__name">
                                                                    {{ ucfirst($university->name) }}
                                                                </h5>
                                                            </a>
                                                            <p>{{ ucwords($university->address) }}</p>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <hr>
                                                    <br>
                                                    <p class="mt-1">Facilities
                                                        @foreach ($facilities as $item)
                                                            <img title="boys"
                                                                src="{{ asset('upload/facilities/' . $item->image) }}"
                                                                alt="{{ ucfirst($item->name) }}">
                                                        @endforeach
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main end -->
@endsection
