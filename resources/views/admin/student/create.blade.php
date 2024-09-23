@extends('admin.admin_master')

<style>
    span.select2.select2-container.select2-container--default.select2-container--focus {
        width: 100% !important;
    }


    .pickup_email.najmul_email {
        position: absolute;
        z-index: 9;
        width: 200px;
        background: #fff;
        top: 100%;
        padding: 10px;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        border: 1px solid #ddd;
        transition: all .5s ease-in-out;
    }

    .pickup_email.najmul_email button {
        border: 1px solid #fc561a;
        margin: 2px 0;
        border-radius: 5px;
        width: 100%
    }

    .offer button {
        width: 200px;
    }

    .pickup_email.najmul_email button a {
        color: #000;
        font-size: 14px;
        display: block;
        width: 100%;
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
                    <li class="breadcrumb-item active" aria-current="page">Upload Student Ticket</li>
                </ol>
            </nav>
        </div>
    </div>

    @php
        $users = \App\Models\User::where('role_id', 2)->get();
    @endphp

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.ticket.store') }}" method="post" enctype="multipart/form-data">
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
                    <label for="ticket">Upload Ticket</label>
                    <input type="file" id="ticket" name="ticket" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>
        </div>
    </div>

    @php
        $ticket = \App\Models\StudentTicket::all();
    @endphp
    @php
        $universiity = \App\Models\PrimiumUniversity::where('status', 1)->get();
    @endphp
    <div class="card">
        <h4 class="p-3 mb-0">Uploaded Ticket for Students <span class="total_count">{{ $ticket->count() }}</span></h4>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered example2">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>System ID</th>
                            <th style="width: 150px">Name</th>
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
                                <td>{{ $data->user->system_id ?? ' ' }}</td>
                                <td>{{ ucfirst($data->user->name ?? '') }}</td>
                                <td>{{ ucfirst($data->user->email ?? '') }}</td>
                                <td>{{ ucfirst($data->user->phone ?? '') }}</td>
                                <td>{{ $data->created_at->format('d M Y') }}</td>
                                <td>
                                    <a class="btn btn-primary"
                                        href="{{ route('admin.student.ticket.download', ['id' => $data->id]) }}">Download</a>
                                    <a class="btn btn-danger"
                                        href="{{ route('admin.student.ticket.destroy', ['id' => $data->id]) }}"
                                        id="delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
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


    <script>
        $(document).ready(function() {
            // Function to hide pickup_email elements
            function hidePickupEmails() {
                $('.pickup_email').hide();
            }

            // Click event for .pickupButton
            $('.pickupButton').click(function() {
                var $card = $(this).closest('.card');
                var $pickupEmail = $card.find('.pickup_email');

                // Hide other pickup_email elements
                $('.pickup_email').not($pickupEmail).hide();

                $pickupEmail.toggle();
            });

            // Click event for .emailToggle
            $('.emailToggle').click(function(e) {
                e.preventDefault();

                var $emailDiv = $(this).next('div');

                // Hide other pickup_email elements
                $('.pickup_email').not($emailDiv).hide();

                $emailDiv.toggle();
            });

            // Click event for body to hide .pickup_email
            $('body').click(function(e) {
                // Check if the click is not inside .pickup_email
                if (!$(e.target).closest('.pickup_email').length && !$(e.target).hasClass('pickupButton')) {
                    hidePickupEmails();
                }
            });

        });
    </script>
@endsection
