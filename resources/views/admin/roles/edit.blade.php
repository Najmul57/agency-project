@extends('admin.admin_master')

@section('admin_content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Roles Update</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
<div class="row">
    <div class="col-xl-12 mx-auto card p-3">
        <form action="{{ route('update.roles',$roles->id) }}" method="post">
            @csrf
            <div class="form-group mb-3">
                <label for="name">Role Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $roles->name }}">
            </div>
            <button type="submit" class="btn btn-success"> Role Update</button>
        </form>
    </div>
</div>
<!--end row-->

@endsection
