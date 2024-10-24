@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"> Cashbook</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"> Cashbook List <span
                            class="total_count">{{ $data->count() }}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                    <a href="{{ route('create.expensive') }}" class="btn btn-info">Add Cashbook</a>
              
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
                            <th>Title</th>
                            <th>Deposit</th>
                            <th>Expense</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalDeposit = 0;
                        @endphp
                        @php
                            $totalExpense = 0;
                        @endphp
                        @foreach ($data as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $row->title }}</td>
                                <td>
                                    @if ($row->type == 1)
                                        {{ $row->amount }}
                                        @php
                                            $totalDeposit += $row->amount;
                                        @endphp
                                    @endif
                                </td>
                                <td>
                                    @if ($row->type == 2)
                                        {{ $row->amount }}
                                        @php
                                            $totalExpense += $row->amount;
                                        @endphp
                                    @endif
                                </td>
                                <td>{{ $row->user->name }}</td>
                                <td>
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#expensiveModal{{ $row->id }}"
                                            class="btn btn-sm btn-primary" data-message="{{ $row->description }}">View</a>
                                    
                                        <a href="{{ route('edit.expensive', $row->id) }}"
                                            class="btn btn-sm btn-info">Edit</a>
                                        <a href="{{ route('destroy.expensive', $row->id) }}" id="delete"
                                            class="btn btn-sm btn-danger">Delete</a>
                                 
                                </td>
                            </tr>
                        @endforeach
                        <div class="d-flex gap-1 flex-wrap">
                            <p><strong>Deposit:</strong> <span class="btn btn-sm btn-info">{{ $totalDeposit }}</span>
                            </p>
                            <p><strong>Expense:</strong> <span class="btn btn-sm btn-success">{{ $totalExpense }}</span>
                            </p>
                            <p><strong>Total Amount:</strong> <span @php
$tatalAmount=$totalDeposit - $totalExpense; @endphp
                                    class="btn btn-sm btn-primary">{{ $tatalAmount }}</span></p>
                        </div>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Title</th>
                            <th>Deposit</th>
                            <th>Expense</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    @foreach ($data as $expense)
        <div class="modal fade" id="expensiveModal{{ $expense->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cashbook Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('a[data-bs-toggle="modal"]').on('click', function(event) {
                var message = $(this).data('message');
                var modal = $(event.target).attr('data-bs-target');

                $(modal + ' .modal-body').html('<p>' + message + '</p>');
            });
        });
    </script>
@endsection
