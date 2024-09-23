@extends('admin.admin_master')

<style>
    span.select2.select2-container.select2-container--default.select2-container--focus {
        width: 100% !important;
    }
</style>

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Upload Verify Report</li>
                </ol>
            </nav>
        </div>
    </div>

    @php
        $users = \App\Models\User::where('role_id', 2)->get();
    @endphp

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.report.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="user">User List</label>
                    <select name="user_id" id="user_id" class="select2 form-select">
                        <option selected disabled>Select Student</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}-{{ $user->system_id }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="report">Upload Report</label>
                    <input type="file" id="report" name="report" class="form-control">
                </div>
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>
        </div>
    </div>

    @php
        $data = \App\Models\DocumentUpload::all();
    @endphp
    <div class="card">
        <h4 class="p-3 mb-0">Uploaded Verify Document for Students <span class="total_count">{{ $data->count() }}</span>
        </h4>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered example2">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>System Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->user->system_id ?? '' }}</td>
                                <td>{{ ucfirst($item->user->name ?? '') }}</td>
                                <td>{{ ucfirst($item->user->email ?? '') }}</td>
                                <td>{{ ucfirst($item->user->phone ?? '') }}</td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.student.report.download', ['id' => $item->id]) }}"
                                        class=" btn-sm d-block mb-2
                                        btn-success">Download</a>

                                    <a href="{{ route('admin.student.report.destroy', ['id' => $item->id]) }}"
                                        class=" btn-sm
                                        btn-danger"
                                        id="delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>System Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/select2/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
