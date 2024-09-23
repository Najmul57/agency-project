@extends('admin.admin_master')

@push('css')
    <link href="{{ asset('backend') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <style>
        span.select2.select2-container.select2-container--default.select2-container--above {
            width: 100% !important;
        }

        .form-group.mb-3 .select2 {
            width: 100% !important;
        }
    </style>
@endpush

@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"> Content</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('primium.content.list') }}" class="btn btn-info"> Content List</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th>Country Name</th>
                    <td>{{ ucfirst($data->country->name) }}</td>
                </tr>
                <tr>
                    <th>University Name</th>
                    <td>{{ ucfirst($data->university->name) }}</td>
                </tr>
                <tr>
                    <th>Program Type</th>
                    <td>{{ ucfirst($data->program->name) }}</td>
                </tr>
                <tr>
                    <th>Department Name</th>
                    <td>{{ ucfirst($data->universityCourse->name) }}</td>
                </tr>
                <tr>
                    <th>Course Name</th>
                    <td>{{ ucfirst($data->course->name) }}</td>
                </tr>
                <tr>
                    <th>Program Overview</th>
                    <td>{!! $data->overview !!}</td>
                </tr>
                <tr>
                    <th>Eligibility Criteria</th>
                    <td>{!! $data->criteria !!}</td>
                </tr>
                <tr>
                    <th>Scholarship</th>
                    <td>{!! $data->scholarship !!}</td>
                </tr>
                <tr>
                    <th>Career Path</th>
                    <td>{!! $data->career !!}</td>
                </tr>
                <tr>
                    <th>Programme Fee</th>
                    <td>{!! $data->fee !!}</td>
                </tr>
                <tr>
                    <th>Financial Assistance</th>
                    <td>{!! $data->assistance !!}</td>
                </tr>
                <tr>
                    <th>Frequently Asked Questions (FAQ's)</th>
                    <td>{!! $data->faq !!}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
