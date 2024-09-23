<div class="student__review__area section__padding" style="background-image: url(assets/image/partnet.png);"
    data-aos="zoom-in-down" data-aos-duration="3000">
    <div class="container">
        <div class="row mb-3">
            <div class="col-12">
                <!-- heading -->
                <div class="section_heading text-center">
                    <h2>student feedback</h2>
                    <!-- <span>success student</span> -->
                </div>
            </div>
        </div>
        <div class="review__active mt-4">
            @foreach ($feedback as $row)
                <div class="single__review" title="{{ $row->feedback }}">
                    <div class="review__description p-3">
                        <p>{{ $row->feedback }}</p>
                    </div>
                    <div class="review__author">
                        @if ($row->user && !empty($row->user->photo))
                            <img src="{{ url('/upload/student/' . $row->user->photo) }}" alt="#">
                        @else
                            <img src="{{ url('upload/no_image.jpg') }}" alt="#">
                        @endif

                        @if ($row->user)
                            <h5>{{ ucfirst($row->user->name) }}</h5>
                            <p>{{ ucfirst($row->user->university_name) }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
