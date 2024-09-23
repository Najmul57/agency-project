@extends('admin.admin_master')

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Program Type List <span
                            class="total_count">{{ $data->count() }}</span></li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('programTypeInser.index') }}" class="btn btn-success" style="margin-right: 10px">Program
                    Create</a>
                <a href="{{ route('program.type.create') }}" class="btn btn-info">Add Program Type</a>
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
                            <th>Name</th>
                            <th>Thumbnail</th>
                            <th>University</th>
                            <th>Country</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{ $data }} --}}
                        @foreach ($data as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ ucwords($row->name) }}</td>
                                <td style="text-align: center"><img
                                        src="{{ asset('upload/programtype/' . $row->thumbnail) }}" alt=""
                                        width="100px"></td>
                                <td>
                                    @php
                                        $universityIds = explode(',', $row->university_id);
                                        foreach ($universityIds as $universityId) {
                                            $university = \App\Models\PrimiumUniversity::find($universityId);
                                            if ($university) {
                                                echo ucwords($university->name) . '<br>';
                                            } else {
                                                echo 'Unknown University<br>';
                                            }
                                        }
                                    @endphp
                                </td>
                                <td>
                                    @php
                                        $universityIds = explode(',', $row->university_id);
                                        $countryNames = [];
                                        foreach ($universityIds as $universityId) {
                                            $university = \App\Models\PrimiumUniversity::find($universityId);
                                            if ($university) {
                                                $country = \App\Models\PrimiumCountry::find($university->country_id);
                                                if ($country) {
                                                    $countryNames[] = ucfirst($country->name);
                                                } else {
                                                    $countryNames[] = 'Unknown Country';
                                                }
                                            }
                                        }
                                        echo implode('<br>', array_unique($countryNames));
                                    @endphp
                                </td>
                                <td>
                                    <a href="{{ route('program.type.edit', $row->id) }}" class="btn btn-sm btn-info"><i
                                            class='bx bx-edit'></i></a>
                                    <a href="{{ route('program.type.delete', $row->id) }}" id="delete"
                                        class="btn btn-sm btn-danger"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Thumbnail</th>
                            <th>University</th>
                            <th>Country</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
