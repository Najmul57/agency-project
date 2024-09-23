@extends('user.user_master')

@section('user__content')
<div class="card radius-10">
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('store.feedback', ['id' => auth()->user()->id]) }}" method="post">
            @csrf
            <div class="form-group">
                <textarea name="feedback" id="feedback" class="form-control" placeholder="enter your feedback" cols="30"
                    rows="5"></textarea>
            </div>
            <button type="submit" id="submitButton" class="btn btn-info mt-3">Submit</button>
        </form>
    </div>
</div>

@endsection
