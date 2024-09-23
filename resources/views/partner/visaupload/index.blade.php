@extends('partner.layouts.partner_master')

@section('partner__content')
    @php
        $users = \App\Models\User::where('role_id', 2)
            ->where('referance', auth()->user()->email)
            ->get();
    @endphp
    <div class="card p-3">
        <h4>Upload Student Visa Copy </h4>
        <form action="{{ route('upload.visa.copy.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-2">
                <label for="user_id">Student Name</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    <option value="">Student Name</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ ucfirst($user->name) }}-{{ $user->system_id }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="visa_file">Upload Visa File</label>
                <input type="file" class="form-control" name="visa_file" id="visa_file" required>
            </div>
            <button type="submit" class="btn btn-success mt-2">Submit</button>
        </form>
    </div>
@endsection
