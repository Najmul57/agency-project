@extends('admin.admin_master')

@push('css')
    <style>
        <link href="{{ asset('backend') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />span.select2.select2-container.select2-container--default.select2-container--above {
            width: 100% !important;
        }

        .form-group.mb-3 .select2 {
            width: 100% !important;
        }
    </style>
@endpush

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">University</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('primium.university.list') }}" class="btn btn-info">University List</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('primium.university.update', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="name"><strong>Country Name</strong></label> <br>
                    <select name="country_id" class="select2" id="name" required>
                        <option selected hidden>Select Country</option>
                        @foreach ($countries as $item)
                            <option value="{{ $item->id }}" @if ($item->id == $selectedCountryId) selected @endif>
                                {{ ucfirst($item->name) }}</option>
                        @endforeach
                    </select>
                    @error('country_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="name"><strong>Name</strong></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ $data->name }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="email"><strong>Email</strong></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ $data->email }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="university_id"><strong>University ID/INT Number</strong></label>
                    <input type="text" name="university_id"
                        class="form-control @error('university_id') is-invalid @enderror"
                        value="{{ $data->university_id }}">
                    @error('university_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="address"><strong>Address</strong></label>
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                        value="{{ $data->address }}">
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="logo"><strong>Logo</strong></label>
                    <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
                    <p><strong class="text-danger">Note :</strong> Dimention 80 x 80</p>
                    @error('logo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="thumbnail"><strong>Thumbnail</strong></label>
                    <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror">
                    <p><strong class="text-danger">Note :</strong>Dimention 300 x 200</p>
                    @error('thumbnail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="breadcrumb"><strong>Breadcrumb</strong></label>
                    <input type="file" name="breadcrumb" class="form-control @error('breadcrumb') is-invalid @enderror">
                    @error('breadcrumb')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="summernote"><strong>About</strong></label>
                    <textarea name="about" id="summernote">{{ $data->about }}</textarea>
                </div>
                <button type="submit" class="btn btn-success mt-3">Update</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/select2/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
