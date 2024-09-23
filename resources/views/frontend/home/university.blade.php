<div class="top_university section__padding pt-0" data-aos="zoom-in-up" data-aos-duration="3000">
    <div class="container">
        <div class="row mb-3">
            <div class="col-12">
                <!-- heading -->
                <div class="section_heading text-center">
                    <h2>university</h2>
                    <!-- <span>university</span> -->
                </div>
            </div>
        </div>
        <div class="row g-3 mt-4">
            @foreach ($universities as $row)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="{{ route('universitydetails.page', $row->slug) }}" class="single__univeristy">
                        <img src="{{ asset('upload/university/' . $row->thumbnail) }}" alt="{{ $row->name }}" />
                        <h4>{{ $row->name }}</h4>
                        <p><i class="fa fa-location-dot"></i>{{ $row->address }}</p>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row mt-4 text-center">
            <div class="col-12">
                <a class="main_btn" href="{{ route('university.page') }}">see university</a>
            </div>
        </div>
    </div>
</div>
