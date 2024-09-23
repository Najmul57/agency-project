@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Page Create</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('page.index') }}" class="btn btn-info"> Page List</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-12 mx-auto card p-3">
            <form action="{{ route('page.store') }}" method="post">
                @csrf
                {{-- <div class="form-group mb-3">
                <label for="page_position">Page Positiion</label>
                <select name="page_position" id="page_position" class="form-select">
                    <option value="1">Line One</option>
                    <option value="2">Line Two</option>
                </select>
            </div> --}}
                <div class="form-group mb-3">
                    <label for="page_name">Page Name</label>
                    <input type="text" name="page_name" id="page_name" class="form-control" placeholder="Page Name">
                </div>
                <div class="form-group mb-3">
                    <label for="page_title">Page Title</label>
                    <input type="text" name="page_title" id="page_title" class="form-control" placeholder="Page Title">
                </div>
                <div class="form-group mb-3">
                    <label for="summernote">Page Description</label>
                    <textarea name="page_description" id="summernote" class="summernote form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-success"> Page Create</button>
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
