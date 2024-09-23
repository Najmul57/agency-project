@extends('frontend.frontend_master')

@section('frontend_content')
    <!-- breadcrumb start -->
    <div class="breadcrumb__area" style="background-image: url({{ asset('frontend/assets/image/review/feedback.jpg') }})">
        <h2>student feedback</h2>
    </div>
    <!-- breadcrumb end -->

    <!-- main -->
    <div class="main">

        <!-- history start -->
        <div class="history__area section__padding">
            <div class="container">
                <div class="row g-3">
                    @foreach ($feedback as $item)
                        <div class="col-lg-4 col-sm-6">
                            <div class="single__review">
                                <div class="review__description review__page p-3">
                                    <p>{{ $item->feedback }}</p>
                                </div>
                                <div class="review__author">
                                    @if ($item->user && !empty($item->user->photo))
                                        <img src="{{ url('/upload/student/' . $item->user->photo) }}" class="user-img"
                                            alt="user avatar">
                                    @else
                                        <img src="{{ url('upload/admin_images/no_image.jpg') }}" class="user-img"
                                            alt="user avatar">
                                    @endif
                                    @if ($item->user)
                                        <h5>{{ $item->user->name }}</h5>
                                        <p>{{ $item->user->university_name }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- history end -->

    </div>
    <!-- main end -->
@endsection
