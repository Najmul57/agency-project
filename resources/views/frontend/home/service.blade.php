<div class="service__area section__padding pb-0" data-aos="flip-left" data-aos-easing="ease-out-cubic"
    data-aos-duration="2000">
    <div class="container">
        <div class="row mb-3">
            <div class="col-12">
                <!-- heading -->
                <div class="section_heading text-center">
                    <h2>services</h2>
                    <!-- <span>services</span> -->
                </div>
            </div>
        </div>
        <div class="row g-3 mt-4">
            @foreach ($services as $row)
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <a href="{{ route('servicedetails.page', $row->slug) }}" class="service__content position-relative">
                        <div class="single__service">
                            <img src="{{ asset('upload/service/' . $row->image) }}" alt="{{ $row->title }}">
                            <h6>{{ ucfirst($row->title) }}</h6>
                        </div>
                        <div class="service__hover">
                            <p>{{ ucfirst($row->short_description) }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row mt-4 text-center">
            <div class="col-12">
                <a href="{{ route('service.page') }}" class="main_btn">more services</a>
            </div>
        </div>
    </div>
</div>
