<div class="success__count__start pt-5 pb-5 mt-3" data-aos="fade-up" data-aos-duration="3000">
    <div class="container">
        <div class="row g-3">
            @foreach ($success as $row)
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="single__count text-center">
                        <img src="{{ asset('upload/success/' . $row->image) }}" alt="{{ $row->title }}">
                        <h2>{{ $row->count }}</h2>
                        <h4>{{ $row->title }}</h4>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
