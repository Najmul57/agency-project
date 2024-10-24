@extends('admin.admin_master')

@section('admin_content')
    <style>
        .modal-body {
            overflow-wrap: break-word;
            word-wrap: break-word;
            white-space: normal;
        }
    </style>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Student Feedback List <span
                            class="total_count">{{ $data->count() }}</span></li>
                </ol>
            </nav>
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
                            <th style="width: 50px">Review</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ isset($row->user) ? ucfirst($row->user->name) . ' - ' . $row->user->system_id : '' }}
                                </td>
                                <td>{{ Str::words($row->feedback, 10, '...') }}</td>
                                <td>
                                    @if ($row->status == 1)
                                            <a href="{{ route('feedback.inactive', $row->id) }}" id="inactive"
                                                class="btn btn-sm btn-success">Active</a>
                                    @else
                                            <a href="{{ route('feedback.active', $row->id) }}" id="active"
                                                class="btn btn-sm btn-danger">Inactive</a>
                                        
                                    @endif
                                </td>
                                <td>
                                        {{-- <a href="javascript:void(0)" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#feedback" data-feedback="{{ $row->feedback }}"> <i
                                                class="bx bx-show-alt"></i></a> --}}
                                        <a href="javascript:void(0)" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#modal{{ $row->id }}"> <i class="bx bx-show-alt"></i></a>
                                 
                                        <a id="delete" href="{{ route('feedback.destroy', $row->id) }}"
                                            class="btn btn-sm btn-danger"><i class='bx bx-trash'></i></a>
                                   
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="modal{{ $row->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                {{ isset($row->user) ? ucfirst($row->user->name) . ' - ' . $row->user->system_id : '' }}
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {!! $row->feedback !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Review</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    {{-- <div class="modal fade" id="feedback" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Student Review</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body-content">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#feedback').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var feedback = button.data('feedback'); // Extract feedback from data-* attributes

                // Update the modal body content
                $('#modal-body-content').html('<p>' + feedback + '</p>');
            });
        });
    </script> --}}
@endsection
