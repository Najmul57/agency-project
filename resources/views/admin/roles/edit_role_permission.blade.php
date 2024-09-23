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
            <form action="{{ route('roles.permission.update', $role->id) }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="group_name">Select Role</label>
                    <input type="text" name="name" class="form-control" value="{{ $role->name }}">
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
                                    @php
                                        $permissions = App\Models\User::getPermissionByGroupName($group->group_name);
                                    @endphp
                                    <h6 class="mb-0">
                                        <input type="checkbox" id="{{ $group->group_name }}" name="{{ $group->group_name }}"
                                            value="{{ $group->group_name }}"
                                            {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                        <label for="{{ $group->group_name }}"
                                            class="text-white">{{ $group->group_name }}</label>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    @foreach ($permissions as $permission)
                                        <div class="form-check">
                                            <input class="form-check-input" name="permission[]"
                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                type="checkbox" value="{{ $permission->name }}"
                                                id="permissionCheck{{ $permission->id }}">
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
                            @php
                                $permissions = App\Models\User::getPermissionByGroupName($group->group_name);
                            @endphp
                            <h6 class="mb-0">
                                <input type="checkbox" id="{{ $group->group_name }}" name="{{ $group->group_name }}"
                                    value="{{ $group->group_name }}"
                                    {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                <label for="{{ $group->group_name }}">{{ $group->group_name }}</label>
                            </h6>
                        </div>
                        <div class="col-sm-9">
                            @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" name="permission[]"
                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} type="checkbox"
                                        value="{{ $permission->name }}" id="permissionCheck{{ $permission->id }}">
                                    <label class="form-check-label" for="permissionCheck{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach --}}
                <button type="submit" class="btn btn-success"> Role Update</button>
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
