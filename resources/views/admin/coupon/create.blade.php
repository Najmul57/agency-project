@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Coupon</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.coupon') }}" class="btn btn-info">Coupon List</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('store.coupon') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="code">Code</label>
                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                        placeholder="enter code" required>
                </div>
                <div class="form-group mb-3">
                    <label for="date">Date</label>
                    <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" required>
                </div>
                <div class="form-group mb-3">
                    <label for="type">Type</label>
                    <select name="type" class="form-select">
                        <option selected disabled>Select Type</option>
                        <option value="fixed">Fixed</option>
                        {{-- <option value="percentage">Percentage</option> --}}
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="amount">Amount</label>
                    <input type="text" name="amount" class="form-control @error('amount') is-invalid @enderror"
                        placeholder="enter amount" required>
                </div>
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>
        </div>
    </div>
@endsection
