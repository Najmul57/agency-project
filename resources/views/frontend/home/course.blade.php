<div class="courses_area section__padding" style="background-color: #E5ECF4;" data-aos="fade-down" data-aos-easing="linear"
    data-aos-duration="1500">
    <div class="container">
        <div class="row mb-3">
            <div class="col-12">
                <!-- heading -->
                <div class="section_heading text-center">
                    <h2>Course</h2>
                </div>
            </div>
        </div>
        <div class="row g-3 mt-4">
            @foreach ($groupedCourses as $name => $group)
                <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                    <a href="{{ route('course.university', $name) }}" class="single__course">
                        <img src="@if (file_exists(public_path("upload/courselist/{$group->first()->image}"))) {{ asset("upload/courselist/{$group->first()->image}") }} @else {{ asset('upload/no_image.jpg') }} @endif"
                            alt="{{ $name }}" />
                        <span>{{ ucfirst($name) }}</span>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row mt-3 text-center">
            <div class="col-12">
                <a class="main_btn" href="{{ route('course.page') }}">see more</a>
            </div>
        </div>
    </div>

    <div class="shapes" style="position: relative;z-index:999">
        <svg class="abstract-svg-1" viewBox="0 0 102 102">
            <circle cx="50" cy="50" r="50"></circle>
        </svg>
        <svg class="abstract-svg-3" viewBox="0 0 401.998 401.998">
            <path d="M377.87,24.126C361.786,8.042,342.417,0,319.769,0H82.227C59.579,0,40.211,8.042,24.125,24.126
        C8.044,40.212,0.002,59.576,0.002,82.228v237.543c0,22.647,8.042,42.014,24.123,58.101c16.086,16.085,35.454,24.127,58.102,24.127
        h237.542c22.648,0,42.011-8.042,58.102-24.127c16.085-16.087,24.126-35.453,24.126-58.101V82.228
        C401.993,59.58,393.951,40.212,377.87,24.126z M365.448,319.771c0,12.559-4.47,23.314-13.415,32.264
        c-8.945,8.945-19.698,13.411-32.265,13.411H82.227c-12.563,0-23.317-4.466-32.264-13.411c-8.945-8.949-13.418-19.705-13.418-32.264
        V82.228c0-12.562,4.473-23.316,13.418-32.264c8.947-8.946,19.701-13.418,32.264-13.418h237.542
        c12.566,0,23.319,4.473,32.265,13.418c8.945,8.947,13.415,19.701,13.415,32.264V319.771L365.448,319.771z"></path>
        </svg>
        <svg class="abstract-svg-4" viewBox="0 0 102 102">
            <circle cx="50" cy="50" r="50"></circle>
        </svg>
    </div>
</div>
