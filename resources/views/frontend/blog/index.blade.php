@extends('frontend.frontend_master')
@section('title')
    SIAC || Blog
@endsection
@section('frontend_content')
    <!-- breadcrumb start -->
    <div class="breadcrumb__area" style="background-image: url({{ asset('frontend/assets/image/blog/blog.jpg') }});">
        <h2>blog list</h2>
    </div>
    <!-- breadcrumb end -->

    <!-- blog start -->
    <div class="blog_area section__padding">
        <div class="container">
            <div class="row g-3 mt-3">
                @foreach ($blogs as $row)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="single__blog">
                            <div class="blog__thumbnail">
                                <a href="{{ route('blogdetails.page', $row->slug) }}"><img
                                        src="{{ asset('upload/blog/' . $row->image) }}" alt=""></a>
                            </div>
                            <ul class="blog__meta">
                                <li><i class="fa-regular fa-clock"></i>
                                    {{ \Carbon\Carbon::parse($row->created_at)->format('F Y') }}
                                </li>
                            </ul>
                            <div class="blog__content">
                                <a href="{{ route('blogdetails.page', $row->slug) }}">{{ $row->title }}</a>
                                <p>{{ $row->short_description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- blog end -->



    </div>
    <!-- main end -->
@endsection
