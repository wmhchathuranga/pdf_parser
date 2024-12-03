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
            <h2 class="text-center mt-3 mb-0">Appendix 3Y</h2>
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
                            {{-- <td>{{ $reportData['abn'] }}</td>
                            <td class="text-center">{{ $reportData['company_name'] }}</td>
                            <td class="text-center">{{ $reportData['name_of_director'] }}</td>
                            <td class="text-center">{{ $reportData['date_of_appointment'] }}</td> --}}
                            <td>75 633 936 536</td>
                            <td class="text-center">Australian Gold and Copper Ltd (ASX:AGC)</td>
                            <td class="text-center">Zhang Yong</td>
                            <td class="text-center">2 January 2024</td>
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
                        {{-- href="{{ route('client.report-edit-3x', ['id' => $reportData['id']]) }}"> --}}
                        href="">
                        Edit <i class="mdi mdi-pencil"></i></a>
                </div>
            </div>

            {{-- Part 1 --}}
            <div class="card">
                <div class="card-header">
                    <p class="fs-14 mb-0 text-muted fw-light">Change of director’s relevant interests in securities</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dt-responsive nowrap align-middle mdl-data-table"
                            data-editable="true">
                            <tbody>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Direct or indirect interest </th>
                                    {{-- <td class="col-6 text-center">
                                        {{ in_array(strtolower($reportData['part3s'][0]['detail_of_contract']), ['n/a', 'nil', 'null']) ? '-' : $reportData['part3s'][0]['detail_of_contract'] }}
                                    </td> --}}
                                    <td class="col-6 text-center">Indirect</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Nature of indirect interest (including registered holder)</th>
                                    <td class="col-6 text-center">
                                        GeoZen Resources Group Co., Limited (formerly Delin Mining Group Cooperation Limited)
                                        <br><br>
                                        (Director and beneficiary)
                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Date of change</th>
                                    <td class="col-6 text-center">6 August 2024</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">No. of securities held prior to change</th>
                                    <td class="col-6 text-center">122,222,222 Fully Paid Ordinary Shares</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Class</th>
                                    <td class="col-6 text-center">Fully Paid Ordinary Shares</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Number acquired </th>
                                    <td class="col-6 text-center">18,906,250</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Number disposed</th>
                                    <td class="col-6 text-center">-</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Value/Consideration</th>
                                    <td class="col-6 text-center">$6,050,000</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">No. of securities held after change</th>
                                    <td class="col-6 text-center">141,128,472 Fully Paid Ordinary Shares</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Nature of change</th>
                                    <td class="col-6 text-center">
                                        Share Placement
                                        <br><br>
                                        (approved at EGM held 12 July 2024)
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
                    <p class="fs-14 mb-0 text-muted fw-light">Change of director’s interests in contracts</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dt-responsive nowrap align-middle mdl-data-table"
                            data-editable="true">
                            <tbody>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Detail of contract</th>
                                    {{-- <td class="col-6 text-center">
                                        {{ in_array(strtolower($reportData['part3s'][0]['detail_of_contract']), ['n/a', 'nil', 'null']) ? '-' : $reportData['part3s'][0]['detail_of_contract'] }}
                                    </td> --}}
                                    <td class="col-6 text-center">-</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Nature of interest</th>
                                    <td class="col-6 text-center">-</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Name of registered holder (if issued securities)</th>
                                    <td class="col-6 text-center">-</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Date of change</th>
                                    <td class="col-6 text-center">-</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">No. and class of securities to which interest related prior to change</th>
                                    <td class="col-6 text-center">-</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Interest acquired</th>
                                    <td class="col-6 text-center">-</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Interest disposed</th>
                                    <td class="col-6 text-center">-</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Value/Consideration</th>
                                    <td class="col-6 text-center">-</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Interest after change</th>
                                    <td class="col-6 text-center">-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Part 3 --}}
            <div class="card">
                <div class="card-header">
                    <p class="fs-14 mb-0 text-muted fw-light">+Closed period</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dt-responsive nowrap align-middle mdl-data-table"
                            data-editable="true">
                            <tbody>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Were the interests in the securities or contracts detailed
                                        above traded during a +closed period where prior written
                                        clearance was required?</th>
                                    {{-- <td class="col-6 text-center">
                                        {{ in_array(strtolower($reportData['part3s'][0]['detail_of_contract']), ['n/a', 'nil', 'null']) ? '-' : $reportData['part3s'][0]['detail_of_contract'] }}
                                    </td> --}}
                                    <td class="col-6 text-center">No</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">If so, was prior written clearance provided to allow the trade
                                        to proceed during this period?</th>
                                    <td class="col-6 text-center">-</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">If prior written clearance was provided, on what date was this
                                        provided?</th>
                                    <td class="col-6 text-center">-</td>
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
