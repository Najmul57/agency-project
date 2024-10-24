@extends('admin.admin_master')

@section('admin_content')
<style>
    tr td{
        vertical-align: middle
    }
</style>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"> Country List <span
                            class="total_count">{{ $data->count() }}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('primium.country.create') }}" class="btn btn-info">Add Country</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered example2">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ ucfirst($row->name) }}</td>
                                <td>
                                    <img src="{{ asset('upload/country/' . $row->thumbnail) }}" width="100px"
                                        alt="">
                                </td>
                                <td>
                                    @if ($row->status == 1)
                                        <a href="{{ route('primium.country.inactive', $row->id) }}" id="inactive"
                                            class="btn btn-sm btn-success">Active</a>
                                    @else
                                        <a href="{{ route('primium.country.active', $row->id) }}" id="active"
                                            class="btn btn-sm btn-danger">Inactive</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('primium.country.edit', $row->id) }}" title="Update" class="btn btn-sm btn-info"><i
                                            class='bx bx-edit'></i></a>
                                    <a href="{{ route('primium.country.destroy', $row->id) }}"title="Delete"  id="delete"
                                        class="btn btn-sm btn-danger"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
