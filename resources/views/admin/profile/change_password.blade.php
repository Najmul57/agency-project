@extends('admin.admin_master')

@section('admin_content')
   	<!--breadcrumb-->
       <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-9 mx-auto card p-3">
            <form action="{{ route('password.update') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="old_password">Old Password</label>
                    <input type="password" name="old_password" id="old_password" class="form-control" placeholder="old password">
                </div>
                <div class="form-group mb-3">
                    <label for="password">New Password</label>
                    <input id="password" type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="new password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="confirm password">
                </div>
                <button type="submit" class="btn btn-success"> Update Password</button>
            </form>
        </div>
    </div>
    <!--end row-->
@endsection
