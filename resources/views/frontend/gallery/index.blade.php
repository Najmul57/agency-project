@extends('frontend.frontend_master')
@section('title')
    SIAC || Gallery
@endsection
@section('frontend_content')
    <!-- breadcrumb start -->
    <div class="breadcrumb__area" style="background-image: url({{ asset('frontend') }}/assets/image/study/canada.jpg);">
        <h2>gallery</h2>
    </div>
    <!-- breadcrumb end -->
    <!-- gallery start -->
    <div class="gallery_area section__padding">
        <div class="container">
            <div class="row g-3">
                @foreach ($galleries as $row)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="{{ asset('upload/gallery/' . $row->image) }}" data-lightbox="image-1" data-title="My caption"
                            class="single__photo">
                            <img src="{{ asset('upload/gallery/' . $row->image) }}" alt="">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- gallery end -->
@endsection
