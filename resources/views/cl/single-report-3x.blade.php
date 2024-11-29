@extends('layouts.master')
@section('title')
    @lang('translation.datatables')
@endsection
@section('css')
    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Reports
        @endslot
        @slot('title')
            Report
        @endslot
    @endcomponent

    <style>
        /* table headers */
        th {
            font-size: 14px;
        }
    </style>

    <div class="row justify-content-center">
        <div class="card col-auto">
            <h2 class="text-center mt-3 mb-0">Appendix 3X</h2>
            <div class="card-body">
                <table class="table table-bordered dt-responsive nowrap align-middle mdl-data-table">
                    <thead>
                        <tr>
                            <th>ABN</th>
                            <th class="text-center">Company Name</th>
                            <th class="text-center">Director</th>
                            <th class="text-center">Appointment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $reportData['abn'] }}</td>
                            <td class="text-center">{{ $reportData['company_name'] }}</td>
                            <td class="text-center">{{ $reportData['name_of_director'] }}</td>
                            <td class="text-center">{{ $reportData['date_of_appointment'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="text-end mb-3">
                <div class="">
                    <a class="btn btn-primary waves-effect waves-light" target="_blank"
                        href="{{ route('client.report-edit-3x', ['id' => $reportData['id']]) }}">Edit <i
                            class="mdi mdi-pencil"></i></a>
                </div>
            </div>

            {{-- Part 1 --}}
            <div class="card">
                <div class="card-header">
                    <p class="fs-14 mb-0 text-muted fw-light">Director’s relevant interests in securities of which the
                        director is the
                        registered holder</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dt-responsive nowrap align-middle mdl-data-table"
                            data-editable="true">
                            <tbody>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Number & class of securities</th>
                                    <td class="col-6 text-center">
                                        {{ in_array(strtolower($reportData['part1s'][0]['number_class_of_securities']), ['n/a', 'nil', 'null']) ? '-' : $reportData['part1s'][0]['number_class_of_securities'] }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Part 2 --}}
            <div class="card">
                <div class="card-header">
                    <p class="fs-14 mb-0 text-muted fw-light">Director’s relevant interests in securities of which the
                        director is not
                        the registered holder</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dt-responsive nowrap align-middle mdl-data-table">
                            <thead>
                                <tr>
                                    <th width="50%" class="text-center">Holder & nature of interest</th>
                                    <th width="50%" class="text-center">Number & class of Securities</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reportData['part2s'] as $tr)
                                    <tr>
                                        <td class="text-center">
                                            {{ in_array(strtolower($tr['name_of_holder_nature_of_interest']), ['n/a', 'nil', 'null']) ? '-' : $tr['name_of_holder_nature_of_interest'] }}
                                        </td>
                                        <td class="text-center">
                                            {{ in_array(strtolower($tr['number_class_of_securities']), ['n/a', 'nil', 'null']) ? '-' : $tr['number_class_of_securities'] }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Part 3 --}}
            <div class="card">
                <div class="card-header">
                    <p class="fs-14 mb-0 text-muted fw-light">Director’s interests in contracts</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dt-responsive nowrap align-middle mdl-data-table"
                            data-editable="true">
                            <tbody>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Detail of contract</th>
                                    <td class="col-6 text-center">
                                        {{ in_array(strtolower($reportData['part3s'][0]['detail_of_contract']), ['n/a', 'nil', 'null']) ? '-' : $reportData['part3s'][0]['detail_of_contract'] }}
                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Nature of interest</th>
                                    <td class="col-6 text-center">
                                        {{ in_array(strtolower($reportData['part3s'][0]['nature_of_interest']), ['n/a', 'nil', 'null']) ? '-' : $reportData['part3s'][0]['nature_of_interest'] }}
                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Name of registered holder (if issued securities)</th>
                                    <td class="col-6 text-center">
                                        {{ in_array(strtolower($reportData['part3s'][0]['name_of_registered_holder']), ['n/a', 'nil', 'null']) ? '-' : $reportData['part3s'][0]['name_of_registered_holder'] }}
                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">No. and class of securities to which interest relates</th>
                                    <td class="col-6 text-center">
                                        {{ in_array(strtolower($reportData['part3s'][0]['no_and_class_of_securities_to_which_interest_relates']), ['n/a', 'nil', 'null']) ? '-' : $reportData['part3s'][0]['no_and_class_of_securities_to_which_interest_relates'] }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
@section('script')
    <!-- Link to PDF.js library via CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.6.172/pdf.min.js"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
