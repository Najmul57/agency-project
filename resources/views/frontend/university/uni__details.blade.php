@extends('frontend.frontend_master')
@section('title')
    SIAC || {{ ucfirst($unidetails->name) }}
@endsection
@section('frontend_content')
    <!-- breadcrumb start -->
    <div class="breadcrumb__area"
        style="background-image: url('{{ asset('upload/university/' . $unidetails->breadcrumb) }}')">
        <h2>{{ $unidetails->name }}</h2>
    </div>
    <!-- breadcrumb end -->

    <!-- university details start -->
    <div class="university__details section__padding">
        <div class="container">
            <div class="row g-2">
                <div class="col-12 ">
                    <div class="university__info card p-3">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="uni__info1" data-bs-toggle="tab"
                                    data-bs-target="#uni__info1-pane" type="button" role="tab"
                                    aria-controls="uni__info1-pane" aria-selected="true">About</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="uni__type" data-bs-toggle="tab"
                                    data-bs-target="#uni__type-pane" type="button" role="tab"
                                    aria-controls="uni__type-pane" aria-selected="false">Courses</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="uni__info3" data-bs-toggle="tab"
                                    data-bs-target="#uni__info3-pane" type="button" role="tab"
                                    aria-controls="uni__info3-pane" aria-selected="false">Address</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="uni__info5" data-bs-toggle="tab"
                                    data-bs-target="#uni__info5-pane" type="button" role="tab"
                                    aria-controls="uni__info5-pane" aria-selected="false">Facilities</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="uni__info1-pane" role="tabpanel"
                                aria-labelledby="uni__info1" tabindex="0">
                                <div class="university__about__content p-2">
                                    <div id="profile-description">
                                        <div class="text show-more-height">
                                            {!! $unidetails->about !!}
                                        </div>
                                        <p>more avaliable content? please <a href="{{ route('user.dashboard') }}"
                                                style="color: ##f2382c" target="_blank"> Primium Subscribe</a></p>
                                        <div class="show-more">(Show More)</div>
                                    </div><!-- [End] #profile-description -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="uni__type-pane" role="tabpanel" aria-labelledby="uni__type"
                                tabindex="0">
                                <div class="university__about__content p-2 border mt-3">


                                    @forelse ($courses as $item)
                                        <b>{{ ucwords($item->name) }}</b>
                                    @empty
                                        Course isn't available.
                                    @endforelse

                                    <p class="mt-3">more avaliable information? please <a
                                            href="{{ route('user.dashboard') }}" style="color: ##f2382c" target="_blank">
                                            Primium Subscribe</a></p>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="uni__info3-pane" role="tabpanel" aria-labelledby="uni__info3"
                                tabindex="0">
                                <div class="university__about__content p-2 border mt-3">
                                    <div class="text-center mb-3">
                                        <h3>{{ ucwords($unidetails->name) }}</h3>
                                        <span>{{ ucfirst($unidetails->address) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="uni__info5-pane" role="tabpanel" aria-labelledby="uni__info5"
                                tabindex="0">
                                <div class="university__about__content p-2 border mt-3">
                                    <ul class="university__facilities">
                                        @foreach ($facilities as $row)
                                            <li>
                                                <img src="{{ asset('upload/facilities/' . $row->image) }}" alt="">
                                                <span>{{ $row->name }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 ">
                    <div class="sidebar__university card p-2">
                        <div class="row g-3">
                            @foreach ($universities as $row)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <a href="{{ route('universitydetails.page', $row->slug) }}" class="single__univeristy">
                                        <img src="{{ asset('upload/university/' . $row->thumbnail) }}"
                                            alt="{{ $row->name }}" />
                                        <h4>{{ $row->name }}</h4>
                                        <p><i class="fa fa-location-dot"></i>{{ $row->address }}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- university details end -->
@endsection
