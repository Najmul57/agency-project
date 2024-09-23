@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Team Create</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admiin.team') }}" class="btn btn-info">Team List</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.team.update', $team->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ $team->name }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="position">Position</label>
                    <input type="text" name="position" class="form-control @error('position') is-invalid @enderror"
                        value="{{ $team->position }}">
                    @error('position')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="facebook">Facebook</label>
                    <input type="text" name="facebook" class="form-control" value="{{ $team->facebook }}">
                </div>
                <div class="form-group mb-3">
                    <label for="youtube">Youtube</label>
                    <input type="text" name="youtube" class="form-control" value="{{ $team->youtube }}">
                </div>
                <div class="form-group mb-3">
                    <label for="instagram">Instagram</label>
                    <input type="text" name="instagram" class="form-control " value="{{ $team->instagram }}">
                </div>
                <div class="form-group mb-3">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" name="whatsapp" class="form-control" value="{{ $team->whatsapp }}">
                </div>
                <div class="form-group">
                    <label for="image">Photo</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                        id="image">
                    <span><strong class="text-danger">Note: </strong>Dimention 324 x 324</span> <br>
                    <!-- Add id="banner" here -->
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>
        </div>
    </div>
@endsection
