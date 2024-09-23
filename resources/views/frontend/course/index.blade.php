@extends('frontend.frontend_master')
@section('title')
    SIAC || Course
@endsection
@section('frontend_content')
    <!-- breadcrumb start -->
    <div class="breadcrumb__area" style="background-image: url({{ asset('frontend/assets/image/course/course.jpg') }})">
        <h2>Courses</h2>
    </div>
    <!-- breadcrumb end -->

    <!-- courses start -->
    <div class="courses_area section__padding" style="background-color: #E5ECF4;">
        <div class="container">
            <div class="row g-3 mt-3">
                @foreach ($groupedCourses as $name => $group)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                        <a href="{{ route('course.university', $name) }}" class="single__course">
                            <img src="@if (file_exists(public_path("upload/courselist/{$group->first()->image}"))) {{ asset("upload/courselist/{$group->first()->image}") }} @else {{ asset('upload/no_image.jpg') }} @endif"
                                alt="{{ $name }}" />
                            <span>{{ ucfirst($name) }}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- courses end -->
@endsection
