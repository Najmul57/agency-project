@extends('frontend.frontend_master')
@section('title')
    SIAC || {{ ucfirst($page->page_name) }}
@endsection
@section('frontend_content')
    <!-- breadcrumb start -->
    <div class="breadcrumb__area" style="background-image: url({{ asset('frontend') }}/assets/image/study/canada.jpg);">
        <h2>{{ $page->page_name }}</h2>
    </div>
    <!-- breadcrumb end -->


    <!-- page start -->
    <div class="page_area section__padding">
        <div class="container">
            <div class="row align-items-center g-2">
                {!! $page->page_description !!}
            </div>
        </div>
    </div>
    <!-- page end -->
@endsection
