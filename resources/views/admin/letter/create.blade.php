@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Letter Create</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('letter.admin') }}" class="btn btn-info">Letter List</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('letter.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="user_id">User:</label>
                            <select class="multiple-select" name="user_id">
                                <option selected hidden>Select User</option>
                                @foreach ($users as $row)
                                    <option value="{{ $row->id }}">
                                        {{ $row->name ?? 'Unknown User' }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label for="offer_letter">Offer Letter</label>
                            <input type="file" name="offer_letter"
                                class="form-control mb-3 @error('offer_letter') is-invalid @enderror" id="offer_letter">
                            @error('offer_letter')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label for="admission_letter">Admission Letter</label>
                            <input type="file" name="admission_letter"
                                class="form-control mb-3 @error('admission_letter') is-invalid @enderror"
                                id="admission_letter">
                            @error('admission_letter')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label for="visa_process_letter">Visa Letter</label>
                            <input type="file" name="visa_process_letter"
                                class="form-control mb-3 @error('visa_process_letter') is-invalid @enderror"
                                id="visa_process_letter">
                            @error('visa_process_letter')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            //offer letter
            $('#offer').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showoffer').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]); // Change ['0'] to [0]
            });
            //offer letter
            $('#admission').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showadmission').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]); // Change ['0'] to [0]
            });
            //visa letter
            $('#visa').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#visashow').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]); // Change ['0'] to [0]
            });
        });
    </script>
@endsection
