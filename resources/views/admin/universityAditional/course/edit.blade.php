@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"> Department List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('courselist.index') }}" class="btn btn-info">List</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('courselist.update', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="name"><strong>Name</strong></label>
                            <input type="text" name="name" value="{{ $data->name }}"
                                class="form-control @error('name') is-invalid @enderror" required placeholder="enter name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="image"><strong>Image</strong></label>
                            <input type="file" class="form-control" id="image" name="image"
                                onchange="readURL(this)">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @if ($data->image)
                                <img src="{{ asset('upload/courselist/' . $data->image) }}" alt="Existing Image"
                                    width="100" height="100">
                            @endif
                            <img id="uploaded-image" src="#" alt="Uploaded Image" width="100" height="100"
                                style="display: none">
                        </div>
                        <button type="submit" class="btn btn-success mt-3">update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#uploaded-image').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
