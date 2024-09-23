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
            <form action="{{ route('smtp.setting.update', $smtp->id) }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="mailer">Mailer</label>
                    <input type="text" name="mailer" id="mailer" class="form-control" value="{{ $smtp->mailer }}">
                </div>
                <div class="form-group mb-3">
                    <label for="host">Mail Host</label>
                    <input type="text" name="host" id="host" class="form-control" value="{{ $smtp->host }}">
                </div>
                <div class="form-group mb-3">
                    <label for="port">Mail Port</label>
                    <input type="number" name="port" id="port" class="form-control" value="{{ $smtp->port }}">
                </div>
                <div class="form-group mb-3">
                    <label for="user_name">Mail User Name</label>
                    <input type="text" name="user_name" id="user_name" class="form-control"
                        value="{{ $smtp->user_name }}">
                </div>
                <div class="form-group mb-3">
                    <label for="password">Mail Password</label>
                    <input type="password" name="password" id="password" class="form-control"
                        value="{{ $smtp->password }}">
                </div>

                <button type="submit" class="btn btn-success"> SMTP Update</button>
            </form>
        </div>
    </div>
    <!--end row-->
@endsection
