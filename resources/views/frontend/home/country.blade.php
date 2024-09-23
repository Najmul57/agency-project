<div class="country__area section__padding" data-aos="fade-right" data-aos-duration="3000">
    <div class="container">
        <div class="row mb-3">
            <div class="col-12">
                <!-- heading -->
                <div class="section_heading text-center">
                    <h2>countries</h2>
                    <!-- <span>countries</span> -->
                </div>
            </div>
        </div>
        <div class="row g-3 mt-4">
            @foreach ($countries as $row)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single__country position-relative">
                        <div class="country__thumbnail">
                            <img src="{{ asset('upload/country/' . $row->thumbnail) }}" alt="{{ $row->name }}">
                            <h4>{{ $row->name }}</h4>
                        </div>
                        <div class="view_list">
                            <a href="{{ route('countrydetails.page', $row->slug) }}" class="main_btn">details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row mt-4 text-center">
            <div class="col-12">
                <a href="{{ route('country.page') }}" class="main_btn">more countries</a>
            </div>
        </div>
    </div>
</div>
