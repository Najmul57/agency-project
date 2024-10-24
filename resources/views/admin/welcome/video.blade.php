@extends('admin.admin_master')

@section('admin_content')
    <div class="card p-3">
        <form action="{{ route('welcome.video.update', $data->id) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="video">Student Welcome Video</label>
                <input type="text" name="video" class="form-control mb-2" id="video" value="{{ $data->video }}">
            </div>
            <div class="form-group">
                <label for="partner">Partner Welcome Video</label>
                <input type="text" name="partner" class="form-control mb-2" id="partner" value="{{ $data->partner }}">
            </div>
                <button type="submit" class="btn btn-success">Update</button>
           
        </form>
    </div>
    @php
        $video = \App\Models\WelcomeVideo::first();
    @endphp
    <h4>Student Video</h4>
    <iframe width="100%" height="400" src="https://www.youtube.com/embed/{{ $video->video }}" frameborder="0"
        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

    <h4>Partner Video</h4>
    <iframe width="100%" height="400" src="https://www.youtube.com/embed/{{ $video->partner }}" frameborder="0"
        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
@endsection
