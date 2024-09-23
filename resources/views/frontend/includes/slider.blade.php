<div class="slider__area position-relative">
    <div class="slider__active">
        @foreach ($sliders as $row)
            <div class="single__slider">
                <img src="{{ asset('upload/banner/' . $row->banner) }}" alt="slider">
            </div>
        @endforeach
    </div>


    <div class="advanced__search">
        <h1 data-aos="zoom-in" data-aos-duration="3000">Find your dream study</h1>
        <form action="" method="get" data-aos="zoom-in" data-aos-duration="3000">
            <input type="text" class="form-control" id="search" name="search"
                placeholder="Search colleges/school/course">
            <div class="search__result" id="search__result"></div>
        </form>

        <ul class="d-flex align-items-center justify-content-center">
            <li><a href="{{ route('country.page') }}"><i class="fa-solid fa-globe"></i> {{ $totalCountry }}
                    countries</a></li>
            <li><a href="{{ route('university.page') }}"><i class="fa-solid fa-graduation-cap"></i>
                    {{ $totalUniversity }} universitiy</a></li>
        </ul>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

<script>
    // slider start
    $(".slider__active").slick({
        dots: false,
        infinite: true,
        speed: 300,
        arrows: false,
        autoplay: true,
        draggable: false,
        fade: true,
        speed: 1000,
        slidesToShow: 1,
        slidesToScroll: 1,
    });
</script>

<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val().trim();

            if (query.length < 3) {
                $('#search__result').html('');
                return;
            }

            $.ajax({
                url: "{{ route('search') }}",
                method: 'GET',
                data: {
                    search: query
                },
                dataType: 'html',
                success: function(response) {
                    $('#search__result').html(response);
                }
            });
        });
    });
</script>
