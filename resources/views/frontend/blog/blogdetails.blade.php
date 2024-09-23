@extends('frontend.frontend_master')
@section('title')
    SIAC || {{ $blogdetails->short_description }}
@endsection
@section('frontend_content')
    <!-- breadcrumb start -->
    <div class="breadcrumb__area" style="background-image: url({{ asset('upload/blog/' . $blogdetails->image) }});">
        <h2>{{ $blogdetails->short_description }}</h2>
    </div>
    <!-- breadcrumb end -->

    <!-- details start  -->
    <div class="blog__details section__padding">
        <div class="container">
            <div class="row g-3">
                <div class="col-12">
                    <div class="blog__details__content card p-2 mb-3">
                        {!! $blogdetails->long_description !!}
                    </div>
                </div>
                <div class="col-12">
                    <div class="blog__list">
                        <h3>latest blog</h3>
                    </div>
                </div>
            </div>
            <div class="row g-3 mt-1">
                @foreach ($blogs as $row)
                    <div class="col-md-4 col-6 col-lg-3">
                        <div class="blog__list">
                            <a href="{{ route('blogdetails.page', $row->slug) }}">
                                <img src="{{ asset('upload/blog/' . $row->image) }}" alt="">
                                <h5 class="text-black mt-1">{{ $row->title }}</h5>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- details end  -->
@endsection
