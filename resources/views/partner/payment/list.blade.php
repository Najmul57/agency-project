@extends('partner.layouts.partner_master')

@section('partner__content')
    <div class="card">
        <h4
            style="padding-bottom: 0;
                                margin-bottom: 0;
                                padding-left: 15px;
                                padding-top: 15px;">
            Transition Histroy</h4>
        <div class="card-body">
            <div class="table-responsive">
                <table class="example2 table table-striped table-bordered">
                    <tbody>
                        @php
                            $data = \App\Models\Payfees::all();
                            $users = \App\Models\User::where('role_id', 2)
                                ->where('referance', auth()->user()->email)
                                ->get();
                        @endphp
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered example2" id="example2">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Receipt No</th>
                                                <th>Name</th>
                                                <th>Receipt Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <tfoot>
                                            <tr>
                                                <th>SL</th>
                                                <th>Receipt No</th>
                                                <th>Name</th>
                                                <th>Receipt Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
