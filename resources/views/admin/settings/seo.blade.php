@extends('admin.admin_master')

@section('admin_content')
   	<!--breadcrumb-->
       <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">SEO Setting</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-9 mx-auto card p-3">
            <form action="{{ route('seo.setting.update',$data->id) }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{ $data->meta_title }}">
                </div>
                <div class="form-group mb-3">
                    <label for="meta_author">Meta Author</label>
                    <input type="text" name="meta_author" id="meta_author" class="form-control" value="{{ $data->meta_author }}">
                </div>
                <div class="form-group mb-3">
                    <label for="meta_tag">Meta Tag</label>
                    <input type="text" name="meta_tag" id="meta_tag" class="form-control" value="{{ $data->meta_tag }}">
                </div>
                <div class="form-group mb-3">
                    <label for="meta_description">Meta Description</label>
                    <input type="text" name="meta_description" id="meta_description" class="form-control" value="{{ $data->meta_description }}">
                </div>
                <div class="form-group mb-3">
                    <label for="meta_keywords">Meta Keywords</label>
                    <input type="text" name="meta_keywords" id="meta_keywords" class="form-control" value="{{ $data->meta_keywords }}">
                </div>
                <div class="form-group mb-3">
                    <label for="google_verification">Google Verification</label>
                    <input type="text" name="google_verification" id="google_verification" class="form-control" value="{{ $data->google_verification }}">
                </div>
                <div class="form-group mb-3">
                    <label for="google_analytics">Google Analytics</label>
                    <input type="text" name="google_analytics" id="google_analytics" class="form-control" value="{{ $data->google_analytics }}">
                </div>
                <div class="form-group mb-3">
                    <label for="alexa_varification">Alexa Varification</label>
                    <input type="text" name="alexa_varification" id="alexa_varification" class="form-control" value="{{ $data->alexa_varification }}">
                </div>
                <div class="form-group mb-3">
                    <label for="google_adsense">Google Adsense</label>
                    <input type="text" name="google_adsense" id="google_adsense" class="form-control" value="{{ $data->google_adsense }}">
                </div>
                <button type="submit" class="btn btn-success"> SEO Update</button>
            </form>
        </div>
    </div>
    <!--end row-->
@endsection
