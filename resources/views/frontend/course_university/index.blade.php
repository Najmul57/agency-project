@extends('frontend.frontend_master')
@section('title')
    {{-- SIAC || {{ ucfirst($singleCourse->name) }} --}}
@endsection
@section('frontend_content')
    <!-- breadcrumb start -->
    {{-- <div class="breadcrumb__area" style="background-image: url({{ asset('upload/course/' . $singleCourse->breadcrumb) }});">
        <h2>{{ $singleCourse->name }}</h2>
    </div> --}}
    <!-- breadcrumb end -->
    <!-- main -->
    <div class="main">
        <div class="course__university section__padding">
            <div class="container">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="department__wise__university card p-2">
                            {{-- {{ $universityCourses }} --}}
                            {{-- @foreach ($universityCourses as $row)
                                {{ $row->courseList->name }}
                            @endforeach --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main end -->
@endsection
