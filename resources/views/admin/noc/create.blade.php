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
                    <li class="breadcrumb-item active" aria-current="page">Upload NOC File</li>
                </ol>
            </nav>
        </div>
    </div>

    @php
        $users = \App\Models\User::where('role_id', 2)->get();
    @endphp

    <div class="card">
        <div class="card-body">
            <form action="{{ route('noc.pdf.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="user">Student List</label>
                    <select name="user_id" id="user_id" class="select2 form-select">
                        <option selected disabled>Select Student</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}-{{ $user->system_id }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="pdf">Noc File</label>
                    <input type="file" id="pdf" name="pdf" class="form-control" placeholder="upload file">
                    <span><strong class="text-danger">Note :</strong>Upload only PDF File.</span>
                </div>
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>
        </div>
    </div>

    @php
        $ticket = \App\Models\NocPdf::latest()->get();
    @endphp
    <div class="card">
        <h4 class="p-3 mb-0">Uploaded NOC for Students <span class="total_count">{{ $ticket->count() }}</span></h4>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ticket as $key => $data)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $data->user->system_id ?? '' }}</td>
                                <td>{{ ucfirst($data->user->name ?? '') }}</td>
                                <td>{{ ucfirst($data->user->email ?? '') }}</td>
                                <td>{{ ucfirst($data->user->phone ?? '') }}</td>
                                <td>{{ $data->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('download.nocfile', $data->pdf) }}"
                                        class="btn btn-sm btn-primary">Download</a>
                                    <a href="{{ route('noc.pdf.destroy', $data->id) }}" class="btn btn-sm btn-danger"
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
