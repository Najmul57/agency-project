@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Service Add</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('service.index') }}" class="btn btn-info">
                    Service List</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('service.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        placeholder="enter title">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="short_description">Short Description</label>
                    <input type="text" name="short_description" class="form-control"
                        placeholder="enter short_description">
                </div>
                <div class="form-group mb-3">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                        id="image">
                    <span><strong class="text-danger">Note: </strong>Dimention 68x68</span> <br>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <!-- Add id="banner" here -->
                    <img id="showimage"
                        src="{{ !empty($adminData->service) ? url('/upload/service/' . $adminData->image) : url('upload/admin_images/no_image.jpg') }}"
                        alt="Admin" class="bg-primary" width="100">
                </div>
                <div class="form-group mb-3">
                    <label for="breadcrumb">Breadcrumb</label>
                    <input type="file" name="breadcrumb" class="form-control @error('breadcrumb') is-invalid @enderror"
                        id="breadcrumb">
                    @error('breadcrumb')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <!-- Add id="banner" here -->
                    <img id="showbreadcrumb"
                        src="{{ !empty($adminData->service) ? url('/upload/service/' . $adminData->image) : url('upload/admin_images/no_image.jpg') }}"
                        alt="Admin" class="bg-primary" width="100">
                </div>
                <div class="form-group mb-3">
                    <label for="long_description">Long Description</label>
                    <textarea name="long_description" id="summernote" class="form-control"></textarea>

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
            $('#breadcrumb').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showbreadcrumb').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]); // Change ['0'] to [0]
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
@endsection
