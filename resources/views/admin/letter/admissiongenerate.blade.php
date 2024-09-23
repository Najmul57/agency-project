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
                    <li class="breadcrumb-item active" aria-current="page"> Admission Letter Generate</li>
                </ol>
            </nav>
        </div>
    </div>

    @php
        $users = \App\Models\User::where('role_id', 2)->get();
    @endphp

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.admission.letter.generate.store') }}" method="post">
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

                <div class="form-group">
                    <label for="">Admission Fees</label>
                    <input type="number" name="admissionFees" class="form-control" placeholder="admission fee" required>
                </div>
                <div class="form-group">
                    <label for="">Tuition Fees</label>
                    <input type="number" name="tuitionFees" class="form-control" placeholder="tuition fee" required>
                </div>
                <div class="form-group">
                    <label for="">Other Fees</label>
                    <input type="number" name="otherFees" class="form-control" placeholder="other fee" required>
                </div>
                <div class="form-group">
                    <label for="">University ID</label>
                    <input type="text" name="universityId" class="form-control" placeholder="University ID" required>
                </div>
                <div class="form-group">
                    <label for="">Referance ID</label>
                    <input type="text" name="referanceId" class="form-control" placeholder="referance ID" required>
                </div>

                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>
        </div>
    </div>
    @php
        $pdf = \App\Models\UniversityAdmissionLetter::latest()->get();
    @endphp

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered example2">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>System Id</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pdf as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $row->user->system_id ?? '' }}</td>
                                <td>
                                    <a id="delete" href="{{ route('admin.admission.letter.generate.delete', $row->id) }}"
                                        class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>System Id</th>
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
