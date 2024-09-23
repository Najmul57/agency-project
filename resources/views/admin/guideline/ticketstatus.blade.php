@extends('admin.admin_master')
<style>
    span.select2.select2-container.select2-container--default.select2-container--focus {
        width: 100% !important;
    }

    .modal-body {
        overflow-wrap: break-word;
        word-wrap: break-word;
        white-space: normal;
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
                    <li class="breadcrumb-item active" aria-current="page">Ticket Status</li>
                </ol>
            </nav>
        </div>
    </div>

    @php
        $users = \App\Models\User::where('role_id', 2)->get();
    @endphp

    <div class="card">
        <div class="card-body">
            <form action="{{ route('ticket.status.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="user">User List</label>
                    <select name="user_id" id="user_id" class="select2 form-select" required>
                        <option selected disabled>Select Student</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}-{{ $user->system_id }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label for="offer_letter">Status</label>
                    <textarea name="description" id="summernote" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>
        </div>
    </div>

    @php
        $status = \App\Models\TicketStatus::with('user')->latest()->get();
    @endphp
    <div class="card">
        <h4 class="p-3 mb-0">Ticket Status <span class="total_count">{{ $status->count() }}</span></h4>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered example2">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>System Id</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            use Illuminate\Support\Str;
                        @endphp

                        @foreach ($status as $key => $data)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $data->user->system_id ?? '' }}</td>
                                <td>{{ ucfirst(strip_tags($data->user->name ?? '')) }}</td>
                                <td>{{ $data->description ? Str::limit(strip_tags($data->description), 50) : '' }}</td>
                                <td style="text-align: center">
                                    <a href="javscript:void(0)" data-bs-toggle="modal"
                                        data-bs-target="#modal{{ $data->id }}" class="btn btn-sm btn-success">View</a>
                                    <a href="{{ route('ticket.status.destroy', $data->id) }}" class="btn btn-sm btn-danger"
                                        id="delete">Delete</a>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="modal{{ $data->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                {{ ucwords($data->user->name ?? '') }}
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {!! $data->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>System Id</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th style="text-align: center">Action</th>
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

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
@endsection
