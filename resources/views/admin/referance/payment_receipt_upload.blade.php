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
                    <li class="breadcrumb-item active" aria-current="page">Payment Receipt Upload </li>
                </ol>
            </nav>
        </div>
    </div>

    @php
        $users = \App\Models\User::where('role_id', 2)->latest()->get();
    @endphp

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.paymentreceipt.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="referace_user_id">User List</label>
                    <select name="referace_user_id" id="referace_user_id" class="select2 form-select">
                        <option selected disabled>Select Student</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }} - {{ $user->system_id }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="receipt">Upload Receipt</label>
                    <input type="file" id="receipt" name="receipt" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>
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
