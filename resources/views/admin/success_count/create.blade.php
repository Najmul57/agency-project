@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Success</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('success.index') }}" class="btn btn-info">Success List</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('success.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="title"><strong>Title</strong></label>
                    <input type="text" name="title" id="title"
                        class="form-control @error('title') is-invalid @enderror" placeholder="enter title">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="title"><strong>Count</strong></label>
                    <input type="text" name="count" id="count"
                        class="form-control @error('count') is-invalid @enderror" placeholder="enter count">
                    @error('count')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                        id="image" required>
                    <span><strong class="text-danger">Note: </strong>Dimention 100x100</span> <br>
                    <!-- Add id="banner" here -->
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <img id="showimage"
                        src="{{ !empty($adminData->success) ? url('/upload/success/' . $adminData->image) : url('upload/admin_images/no_image.jpg') }}"
                        alt="Admin" class="bg-primary" width="100">
                </div>
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showimage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]); // Change ['0'] to [0]
            });
        });
    </script>
@endsection
