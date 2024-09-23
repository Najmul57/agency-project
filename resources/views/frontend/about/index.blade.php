@extends('frontend.frontend_master')
@section('title')
    SIAC || About
@endsection
@section('frontend_content')
    <!-- breadcrumb start -->
    <div class="breadcrumb__area" style="background-image: url({{ asset('frontend') }}/assets/image/study/canada.jpg);">
        <h2>about siac</h2>
    </div>
    <!-- breadcrumb end -->

    <!-- about start -->
    <div class="about__area section__padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {!! $data->about !!}
                </div>
            </div>
        </div>
    </div>
    <!-- about end -->


    <!-- partner start -->
    <div class="partner__area section__padding" style="background-color: #F2F3F7;">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <!-- heading -->
                    <div class="section_heading text-center">
                        <h2>Who Can Help You?</h2>
                        <!-- <span>partner</span> -->
                    </div>
                </div>
            </div>

            @php
                $teams = App\Models\Team::all();
            @endphp

            <div class="team__active mt-5">
                <div class="row g-3">
                    @foreach ($teams as $team)
                        <div class="col-md-4">
                            <div class="single__team">
                                <img src="{{ asset('upload/team/' . $team->image) }}" alt="{{ $team->name }}">
                                <h4>{{ $team->name }}</h4>
                                <p>{{ $team->position }} <br><strong>SIAC</strong></p>
                                <div class="team__social">
                                    <a href="{{ $team->facebook }}" target="_blank" title="facebook"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a href="{{ $team->youtube }}" target="_blank" title="youtube"><i
                                            class="fab fa-youtube"></i></a>
                                    <a href="{{ $team->instagram }}" target="_blank" title="instagram"><i
                                            class="fab fa-instagram"></i></a>
                                    <a href="{{ $team->whatsapp }}" target="_blank" title="whatsapp"><i
                                            class="fab fa-whatsapp"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- partner end -->

    <!-- partner start -->
    <div class="partner__area section__padding" style="background-color: #F2F3F7;">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <!-- heading -->
                    <div class="section_heading text-center">
                        <h2>partner</h2>
                        <!-- <span>partner</span> -->
                    </div>
                </div>
            </div>

            @php
                $university = App\Models\PrimiumUniversity::where('status', 1)->get();
                // return $university;
            @endphp
            <div class="partnet__active mt-5">
                @foreach ($university as $item)
                    <img src="{{ asset('upload/university/' . $item->thumbnail) }}" alt="">
                @endforeach
            </div>
        </div>
    </div>
    <!-- partner end -->
@endsection
