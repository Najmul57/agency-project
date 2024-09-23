@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Roles Create</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-12 mx-auto card p-3">
            <form action="{{ route('roles.permission.store') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="group_name">Select Role</label>
                    <select name="role_id" id="group_name" class="form-select">
                        <option hidden selected>Select Role</option>
                        @foreach ($role as $item)
                            <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="permissionAll">
                    <label class="form-check-label" for="permissionAll">
                        Permission All
                    </label>
                </div>
                <hr>

                <div class="row">
                    @foreach ($permission_group as $group)
                        <div class="col-xl-4 col-md-6 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header bg-danger">
                                    <input type="checkbox" id="{{ $group->group_name }}" name="{{ $group->group_name }}"
                                        value="{{ $group->group_name }}">
                                    <label for="{{ $group->group_name }}"
                                        class="text-white">{{ $group->group_name }}</label>
                                </div>
                                <div class="card-body">
                                    @php
                                        $permissions = App\Models\User::getPermissionByGroupName($group->group_name);
                                    @endphp
                                    @foreach ($permissions as $permission)
                                        <div class="form-check">
                                            <input class="form-check-input" name="permission[]" type="checkbox"
                                                value="{{ $permission->id }}" id="permissionCheck{{ $permission->id }}">
                                            <label class="form-check-label" for="permissionCheck{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- @foreach ($permission_group as $group)
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">

                            </h6>
                        </div>
                        <div class="col-sm-9">
                            @php
                                $permissions = App\Models\User::getPermissionByGroupName($group->group_name);
                            @endphp
                            @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" name="permission[]" type="checkbox"
                                        value="{{ $permission->id }}" id="permissionCheck{{ $permission->id }}">
                                    <label class="form-check-label" for="permissionCheck{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach --}}
                <button type="submit" class="btn btn-success"> Role Create</button>
            </form>
        </div>
    </div>
    <!--end row-->

    <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
    <script type="text/javascript">
        $('#permissionAll').click(function() {
            if ($(this).is(':checked')) {
                $('input[type=checkbox]').prop('checked', true);
            } else {
                $('input[type=checkbox]').prop('checked', false);
            }
        })
    </script>
@endsection
