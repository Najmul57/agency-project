@extends('frontend.frontend_master')
@section('title')
    SIAC || Study International Admission Care
@endsection
@section('frontend_content')
    <!-- slider start -->
    @include('frontend.includes.slider')
    <!-- slider end -->

    <!-- success count start -->
    @include('frontend.home.success')
    <!-- success count end -->

    <!-- courses start -->
    @include('frontend.home.course')
    <!-- courses end -->

    <!-- service start -->
    @include('frontend.home.service')
    <!-- service end -->

    <!-- country start -->
    @include('frontend.home.country')
    <!-- country end -->

    <!-- top university start -->
    @include('frontend.home.university')
    <!-- top university end -->

    <!-- video start -->
    @include('frontend.home.video')
    <!-- video end -->


    <!-- student review start -->
    @include('frontend.home.review')
    <!-- student review end -->

    <!-- blog start -->
    @include('frontend.home.blog')
    <!-- blog end -->
@endsection
