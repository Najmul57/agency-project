@extends('admin.admin_master')

@section('admin_content')
    <style>
        img {
            max-width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Content List <span
                            class="total_count">{{ $data->count() }}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('primium.content.create') }}" class="btn btn-info">Add Content</a>
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
                            {{-- <th>Overview</th>
                            <th>Criteria</th> --}}
                            <th>Course</th>
                            <th>Department</th>
                            <th>Program</th>
                            <th>University</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                {{-- <td>{!! \Illuminate\Support\Str::words($row->overview, 5, '...') !!}</td>
                                <td>{!! \Illuminate\Support\Str::words($row->criteria, 5, '...') !!}</td> --}}
                                <td>{{ ucfirst($row->universityCourse->name ?? '') }}</td>
                                <td>{{ ucfirst($row->course->name ?? '') }}</td>
                                <td>{{ ucfirst($row->program->name ?? '') }}</td>
                                <td>{{ ucfirst($row->university->name ?? '') }}</td>
                                <td>{{ ucfirst($row->country->name ?? '') }}</td>
                                <td>
                                    @if ($row->status == 1)
                                        <a href="{{ route('primium.content.inactive', $row->id) }}" id="inactive"
                                            class="btn btn-sm btn-success">Active</a>
                                    @else
                                        <a href="{{ route('primium.content.active', $row->id) }}" id="active"
                                            class="btn btn-sm btn-danger">Inactive</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('primium.content.show', $row->id) }}"
                                        class="btn btn-sm btn-primary"><i class='bx bx-show'></i></a>
                                    <a href="{{ route('primium.content.edit', $row->id) }}" class="btn btn-sm btn-info"><i
                                            class='bx bx-edit'></i></a>
                                    <a href="{{ route('primium.content.destroy', $row->id) }}" id="delete"
                                        class="btn btn-sm btn-danger"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            {{-- <th>Overview</th>
                            <th>Criteria</th> --}}
                            <th>Course</th>
                            <th>Department</th>
                            <th>Program</th>
                            <th>University</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
