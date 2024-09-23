@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Letter</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('letter.create') }}" class="btn btn-info">Add Letter</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive p-3">
                <table class="table table-striped table-bordered example2">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Offer Letter</th>
                            <th>Admission Letter</th>
                            <th>Visa Letter</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($letters as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ ucfirst($row->user->name ?? '') }}</td>
                                <td>
                                    @if (!empty($row->offer_letter))
                                        <a href="{{ asset('upload/letter/' . $row->offer_letter) }}" target="_blank">
                                            {{ $row->offer_letter }} <!-- Display the file name as the link text -->
                                        </a>
                                        <a href="{{ route('offer.destroy.letter', $row->id) }}" class="text-danger">X</a>
                                    @else
                                        <p>No offer letter available</p>
                                    @endif
                                </td>

                                <td>
                                    @if (!empty($row->admission_letter))
                                        <a href="{{ asset('upload/letter/' . $row->admission_letter) }}" target="_blank">
                                            {{ $row->admission_letter }} <!-- Display the file name as the link text -->
                                        </a>
                                        <a href="{{ route('admission.destroy.letter', $row->id) }}"
                                            class="text-danger">X</a>
                                    @else
                                        <p>No admission letter available</p>
                                    @endif
                                </td>

                                <td>
                                    @if (!empty($row->visa_process_letter))
                                        <a href="{{ asset('upload/letter/' . $row->visa_process_letter) }}"
                                            target="_blank">
                                            {{ $row->visa_process_letter }} <!-- Display the file name as the link text -->
                                        </a>
                                        <a href="{{ route('visa.destroy.letter', $row->id) }}" class="text-danger">X</a>
                                    @else
                                        <p>No visa process letter available</p>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('letter.edit', $row->id) }}" class="btn btn-info btn-sm"><i
                                            class="bx bx-edit"></i></a>
                                    <a href="{{ route('letter.destroy', $row->id) }}" id="delete"
                                        class="btn btn-danger btn-sm"><i class="bx bx-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Offer Letter</th>
                            <th>Admission Letter</th>
                            <th>Visa Letter</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
