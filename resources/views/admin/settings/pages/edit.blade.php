@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Page Update</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-12 mx-auto card p-3">
            <form action="{{ route('page.update', $data->id) }}" method="post">
                @csrf
                {{-- <div class="form-group mb-3">
                <label for="page_position">Page Positiion</label>
                <select name="page_position" id="page_position" class="form-select">
                    <option value="1" {{ ($data->page_position==1) ? "selected":'' }}>Line One</option>
                    <option value="2" {{ ($data->page_position==2) ? "selected":'' }}>Line Two</option>
                </select>
            </div> --}}
                <div class="form-group mb-3">
                    <label for="page_name">Page Name</label>
                    <input type="text" name="page_name" id="page_name" class="form-control"
                        value="{{ $data->page_name }}">
                </div>
                <div class="form-group mb-3">
                    <label for="page_title">Page Title</label>
                    <input type="text" name="page_title" id="page_title" class="form-control"
                        value="{{ $data->page_title }}">
                </div>
                <div class="form-group mb-3">
                    <label for="page_description">Page Description</label>
                    <textarea name="page_description" id="page_description" class="summernote form-control">{{ $data->page_description }}</textarea>
                </div>
                <button type="submit" class="btn btn-success"> Page Update</button>
            </form>
        </div>
    </div>
    <!--end row-->
    <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $('.summernote').summernote({
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
