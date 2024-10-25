<div class="blog__area pb-4" data-aos-duration="3000" data-aos="zoom-in">
    <div class="container">
        <div class="row mb-3">
            <div class="col-12">
                <!-- heading -->
                <div class="section_heading text-center">
                    <h2>recent news</h2>
                    <!-- <span>blog</span> -->
                </div>
            </div>
        </div>
        <div class="row g-3 mt-4">
            @foreach ($blogs as $row)
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="single__blog">
                        <div class="blog__thumbnail">
                            <a href="{{ route('blogdetails.page', $row->slug) }}"><img
                                    src="{{ asset('upload/blog/' . $row->image) }}" alt="{{ $row->title }}"></a>
                        </div>
                        <ul class="blog__meta">
                            <li><i class="fa-regular fa-clock"></i>
                                {{ date('d-m-Y', strtotime($row->created_at)) }}
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
        <div class="row mt-4 text-center">
            <div class="col-12">
                <a href="{{ route('blog.page') }}" class="main_btn">more blog</a>
            </div>
        </div>
    </div>
</div>
