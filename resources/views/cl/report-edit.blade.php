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

    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
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

    {{-- <button id="sa-position">click</button> --}}
    <div class="row justify-content-center">
        <div class="card col-auto">
            <h2 class="text-center mt-3 mb-0">Appendix 5B</h2>
            <div class="card-body">
                <table class="table table-bordered dt-responsive nowrap align-middle mdl-data-table">
                    <thead>
                        <tr>
                            <th>ABN</th>
                            <th>Quarter Ending</th>
                            <th>Quarter Ending</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $reportData['abn'] }}</td>
                            <td>{{ $reportData['quarter_ending'] }}</td>
                            <td>{{ $reportData['company_name'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="floating-button">
        <a id="btn_save" onclick="saveData()" class="btn btn-primary waves-effect"><i class="mdi mdi-content-save-outline"></i></a>
        <style>
            .floating-button {
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 1000;
            }

            .floating-button .btn {
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 24px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .floating-button .btn:hover {
                box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
            }
        </style>

    </div>


    <div class="row">
        <div class="card col-6">
            <div class="card-body">
                <div class="">
                    <span>Page: <span id="page-num"></span> / <span id="page-count"></span></span>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <div id="navigation" style="height: 60px;"
                        class="position-absolute w-100 d-flex justify-content-between">
                        <button class="btn btn-primary btn-sm" id="prev-page">
                            << </button>
                                <button class="btn btn-primary btn-sm" id="next-page"> >> </button>
                    </div>
                    <canvas class="form-control" path="{{ env('API_URL') }}/{{ $reportData['pdf'] }}"
                        id="pdf-canvas"></canvas>
                </div>
            </div>
        </div>

        <div class="card col-6">
            <div class="card-body" style="max-height: 950px; overflow-y: scroll">
                <div class="table-responsive">
                    <table id="buttons-datatable1"
                        class="table table-hover table-striped table-bordered dt-responsive nowrap align-middle mdl-data-table"
                        data-editable="true" style="height: 400px">
                        <thead class="thead-dark">
                            <tr class="table-dark text-white" style="max-height: 30px">
                                <th>Consolidated Statement Of cash Flows</th>
                                <th class="text-center">Current Quarter</th>
                                <th class="text-center">Year to Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-light text-center fs-15 " colspan="3">1. Cash Flows from Operating
                                    Activities</td>
                                {{-- <td class="d-none"></td> --}}
                                {{-- <td class="d-none"></td> --}}
                            </tr>

                            <tr>
                                <td>Receipts from Customers</td>
                                <td class="text-center p-0" data-name="operating_details-receipts_from_customers_c_q">
                                    {{ $reportData['operating_details'][0]['receipts_from_customers_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="operating_details-receipts_from_customers_y_t_d">
                                    {{ $reportData['operating_details'][0]['receipts_from_customers_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Payments for Exploration &amp; Evaluation</td>
                                <td class="text-center p-0"
                                    data-name="operating_details-payments_exploration_evaluation_c_q">
                                    {{ $reportData['operating_details'][0]['payments_exploration_evaluation_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0"
                                    data-name="operating_details-payments_exploration_evaluation_y_t_d">
                                    {{ $reportData['operating_details'][0]['payments_exploration_evaluation_y_t_d'] ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Payments for Development</td>
                                <td class="text-center p-0" data-name="operating_details-payments_development_c_q">
                                    {{ $reportData['operating_details'][0]['payments_development_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="operating_details-payments_development_y_t_d">
                                    {{ $reportData['operating_details'][0]['payments_development_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Payments for Production</td>
                                <td class="text-center p-0" data-name="operating_details-payments_production_c_q">
                                    {{ $reportData['operating_details'][0]['payments_production_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="operating_details-payments_production_y_t_d">
                                    {{ $reportData['operating_details'][0]['payments_production_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Payments for Staff Costs</td>
                                <td class="text-center p-0" data-name="operating_details-payments_staff_costs_c_q">
                                    {{ $reportData['operating_details'][0]['payments_staff_costs_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="operating_details-payments_staff_costs_y_t_d">
                                    {{ $reportData['operating_details'][0]['payments_staff_costs_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Payments for Admin Costs</td>
                                <td class="text-center p-0" data-name="operating_details-payments_admin_costs_c_q">
                                    {{ $reportData['operating_details'][0]['payments_admin_costs_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="operating_details-payments_admin_costs_y_t_d">
                                    {{ $reportData['operating_details'][0]['payments_admin_costs_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Dividends Received</td>
                                <td class="text-center p-0" data-name="operating_details-dividends_received_c_q">
                                    {{ $reportData['operating_details'][0]['dividends_received_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="operating_details-dividends_received_y_t_d">
                                    {{ $reportData['operating_details'][0]['dividends_received_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Interest Received</td>
                                <td class="text-center p-0" data-name="operating_details-interest_received_c_q">
                                    {{ $reportData['operating_details'][0]['interest_received_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="operating_details-interest_received_y_t_d">
                                    {{ $reportData['operating_details'][0]['interest_received_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Interest Paid</td>
                                <td class="text-center p-0" data-name="operating_details-interest_paid_c_q">
                                    {{ $reportData['operating_details'][0]['interest_paid_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="operating_details-interest_paid_y_t_d">
                                    {{ $reportData['operating_details'][0]['interest_paid_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Income Tax Paid</td>
                                <td class="text-center p-0" data-name="operating_details-income_tax_paid_c_q">
                                    {{ $reportData['operating_details'][0]['income_tax_paid_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="operating_details-income_tax_paid_y_t_d">
                                    {{ $reportData['operating_details'][0]['income_tax_paid_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Government Tax Paid</td>
                                <td class="text-center p-0" data-name="operating_details-government_tax_paid_c_q">
                                    {{ $reportData['operating_details'][0]['government_tax_paid_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="operating_details-government_tax_paid_y_t_d">
                                    {{ $reportData['operating_details'][0]['government_tax_paid_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Other</td>
                                <td class="text-center p-0" data-name="operating_details-other_c_q">
                                    {{ $reportData['operating_details'][0]['other_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="operating_details-other_y_t_d">
                                    {{ $reportData['operating_details'][0]['other_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Net Cash from Operating Activities</td>
                                <td class="text-center p-0" data-name="operating_details-net_cash_from_operating_c_q">
                                    {{ $reportData['operating_details'][0]['net_cash_from_operating_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="operating_details-net_cash_from_operating_y_t_d">
                                    {{ $reportData['operating_details'][0]['net_cash_from_operating_y_t_d'] ?? '-' }}</td>
                            </tr>



                            <tr>
                                <td class="table-light text-center fs-15" colspan="3">2. Cash Flows from Investing
                                    Activities</td>
                                {{-- <td class="d-none"></td> --}}
                                {{-- <td class="d-none"></td> --}}
                            </tr>

                            <tr>
                                <td>Payments for Entities</td>
                                <td class="text-center p-0" data-name="investing_details-payments_for_entities_c_q">
                                    {{ $reportData['investing_details'][0]['payments_for_entities_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="investing_details-payments_for_entities_y_t_d">
                                    {{ $reportData['investing_details'][0]['payments_for_entities_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Payments for Tenements</td>
                                <td class="text-center p-0" data-name="investing_details-payments_for_tenements_c_q">
                                    {{ $reportData['investing_details'][0]['payments_for_tenements_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="investing_details-payments_for_tenements_y_t_d">
                                    {{ $reportData['investing_details'][0]['payments_for_tenements_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Payments for Property</td>
                                <td class="text-center p-0" data-name="investing_details-payments_for_property_c_q">
                                    {{ $reportData['investing_details'][0]['payments_for_property_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="investing_details-payments_for_property_y_t_d">
                                    {{ $reportData['investing_details'][0]['payments_for_property_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Payments for Exploration Evaluation</td>
                                <td class="text-center p-0"
                                    data-name="investing_details-payments_for_exploration_evaluation_c_q">
                                    {{ $reportData['investing_details'][0]['payments_for_exploration_evaluation_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0"
                                    data-name="investing_details-payments_for_exploration_evaluation_y_t_d">
                                    {{ $reportData['investing_details'][0]['payments_for_exploration_evaluation_y_t_d'] ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Payments for Investment</td>
                                <td class="text-center p-0" data-name="investing_details-payments_for_investment_c_q">
                                    {{ $reportData['investing_details'][0]['payments_for_investment_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="investing_details-payments_for_investment_y_t_d">
                                    {{ $reportData['investing_details'][0]['payments_for_investment_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Payments for Other</td>
                                <td class="text-center p-0" data-name="investing_details-payments_for_other_c_q">
                                    {{ $reportData['investing_details'][0]['payments_for_other_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="investing_details-payments_for_other_y_t_d">
                                    {{ $reportData['investing_details'][0]['payments_for_other_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Entities</td>
                                <td class="text-center p-0" data-name="investing_details-proceeds_from_entities_c_q">
                                    {{ $reportData['investing_details'][0]['proceeds_from_entities_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="investing_details-proceeds_from_entities_y_t_d">
                                    {{ $reportData['investing_details'][0]['proceeds_from_entities_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Tenements</td>
                                <td class="text-center p-0" data-name="investing_details-proceeds_from_tenements_c_q">
                                    {{ $reportData['investing_details'][0]['proceeds_from_tenements_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="investing_details-proceeds_from_tenements_y_t_d">
                                    {{ $reportData['investing_details'][0]['proceeds_from_tenements_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Property</td>
                                <td class="text-center p-0" data-name="investing_details-proceeds_from_property_c_q">
                                    {{ $reportData['investing_details'][0]['proceeds_from_property_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="investing_details-proceeds_from_property_y_t_d">
                                    {{ $reportData['investing_details'][0]['proceeds_from_property_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Investment</td>
                                <td class="text-center p-0" data-name="investing_details-proceeds_from_investment_c_q">
                                    {{ $reportData['investing_details'][0]['proceeds_from_investment_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="investing_details-proceeds_from_investment_y_t_d">
                                    {{ $reportData['investing_details'][0]['proceeds_from_investment_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Other</td>
                                <td class="text-center p-0" data-name="investing_details-proceeds_from_other_c_q">
                                    {{ $reportData['investing_details'][0]['proceeds_from_other_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="investing_details-proceeds_from_other_y_t_d">
                                    {{ $reportData['investing_details'][0]['proceeds_from_other_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Cash Flow from Loans</td>
                                <td class="text-center p-0" data-name="investing_details-cash_flow_from_loans_c_q">
                                    {{ $reportData['investing_details'][0]['cash_flow_from_loans_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="investing_details-cash_flow_from_loans_y_t_d">
                                    {{ $reportData['investing_details'][0]['cash_flow_from_loans_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Dividends Received</td>
                                <td class="text-center p-0" data-name="investing_details-dividends_received_2_c_q">
                                    {{ $reportData['investing_details'][0]['dividends_received_2_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="investing_details-dividends_received_2_y_t_d">
                                    {{ $reportData['investing_details'][0]['dividends_received_2_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Other</td>
                                <td class="text-center p-0" data-name="investing_details-other_2_c_q">
                                    {{ $reportData['investing_details'][0]['other_2_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0" data-name="investing_details-other_2_y_t_d">
                                    {{ $reportData['investing_details'][0]['other_2_y_t_d'] ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Net Cash from Investing</td>
                                <td class="text-center p-0" data-name="investing_details-net_cash_from_investing_c_q">
                                    {{ $reportData['investing_details'][0]['net_cash_from_investing_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="investing_details-net_cash_from_investing_y_t_d">
                                    {{ $reportData['investing_details'][0]['net_cash_from_investing_y_t_d'] ?? '-' }}</td>
                            </tr>



                            <tr>
                                <td class="table-light text-center fs-15" colspan="3">3. Cash Flows from Financing
                                    Activities</td>
                                {{-- <td class="d-none"></td> --}}
                                {{-- <td class="d-none"></td> --}}
                            </tr>

                            <tr>
                                <td>Proceeds from Equity</td>
                                <td class="text-center p-0" data-name="financing_details-proceeds_from_equity_c_q">
                                    {{ $reportData['financing_details'][0]['proceeds_from_equity_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="financing_details-proceeds_from_equity_y_t_d">
                                    {{ $reportData['financing_details'][0]['proceeds_from_equity_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Debt</td>
                                <td class="text-center p-0" data-name="financing_details-proceeds_from_debt_c_q">
                                    {{ $reportData['financing_details'][0]['proceeds_from_debt_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="financing_details-proceeds_from_debt_y_t_d">
                                    {{ $reportData['financing_details'][0]['proceeds_from_debt_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Exercise</td>
                                <td class="text-center p-0" data-name="financing_details-proceeds_from_exercise_c_q">
                                    {{ $reportData['financing_details'][0]['proceeds_from_exercise_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="financing_details-proceeds_from_exercise_y_t_d">
                                    {{ $reportData['financing_details'][0]['proceeds_from_exercise_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Transaction Costs for Securities</td>
                                <td class="text-center p-0"
                                    data-name="financing_details-transaction_costs_for_securities_c_q">
                                    {{ $reportData['financing_details'][0]['transaction_costs_for_securities_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0"
                                    data-name="financing_details-transaction_costs_for_securities_y_t_d">
                                    {{ $reportData['financing_details'][0]['transaction_costs_for_securities_y_t_d'] ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Proceeds from Borrowing</td>
                                <td class="text-center p-0" data-name="financing_details-proceeds_from_borrowing_c_q">
                                    {{ $reportData['financing_details'][0]['proceeds_from_borrowing_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="financing_details-proceeds_from_borrowing_y_t_d">
                                    {{ $reportData['financing_details'][0]['proceeds_from_borrowing_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Repayments of Borrowing</td>
                                <td class="text-center p-0" data-name="financing_details-repayments_of_borrowing_c_q">
                                    {{ $reportData['financing_details'][0]['repayments_of_borrowing_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="financing_details-repayments_of_borrowing_y_t_d">
                                    {{ $reportData['financing_details'][0]['repayments_of_borrowing_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Transaction Costs for Borrowing</td>
                                <td class="text-center p-0"
                                    data-name="financing_details-transaction_costs_for_borrowing_c_q">
                                    {{ $reportData['financing_details'][0]['transaction_costs_for_borrowing_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0"
                                    data-name="financing_details-transaction_costs_for_borrowing_y_t_d">
                                    {{ $reportData['financing_details'][0]['transaction_costs_for_borrowing_y_t_d'] ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Dividends Paid</td>
                                <td class="text-center p-0" data-name="financing_details-dividends_paid_c_q">
                                    {{ $reportData['financing_details'][0]['dividends_paid_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="financing_details-dividends_paid_y_t_d">
                                    {{ $reportData['financing_details'][0]['dividends_paid_y_t_d'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Other</td>
                                <td class="text-center p-0" data-name="financing_details-other_3_c_q">
                                    {{ $reportData['financing_details'][0]['other_3_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0" data-name="financing_details-other_3_y_t_d">
                                    {{ $reportData['financing_details'][0]['other_3_y_t_d'] ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Net Cash from Financing</td>
                                <td class="text-center p-0" data-name="financing_details-net_cash_from_financing_c_q">
                                    {{ $reportData['financing_details'][0]['net_cash_from_financing_c_q'] ?? '-' }}</td>
                                <td class="text-center p-0" data-name="financing_details-net_cash_from_financing_y_t_d">
                                    {{ $reportData['financing_details'][0]['net_cash_from_financing_y_t_d'] ?? '-' }}</td>
                            </tr>




                            <tr>
                                <td class="table-light text-center fs-15" colspan="3">4. Cash Flow Summary</td>
                                {{-- <td class="d-none"></td> --}}
                                {{-- <td class="d-none"></td> --}}
                            </tr>

                            <tr>
                                <td>Beginning Cash</td>
                                <td class="text-center p-0" data-name="cash_details-beginning_cash_c_q">
                                    {{ $reportData['cash_details'][0]['beginning_cash_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0" data-name="cash_details-beginning_cash_y_t_d">
                                    {{ $reportData['cash_details'][0]['beginning_cash_y_t_d'] ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Operating Cash Flow</td>
                                <td class="text-center p-0" data-name="cash_details-operating_cash_flow_c_q">
                                    {{ $reportData['cash_details'][0]['operating_cash_flow_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0" data-name="cash_details-operating_cash_flow_y_t_d">
                                    {{ $reportData['cash_details'][0]['operating_cash_flow_y_t_d'] ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Investing Cash Flow</td>
                                <td class="text-center p-0" data-name="cash_details-investing_cash_flow_c_q">
                                    {{ $reportData['cash_details'][0]['investing_cash_flow_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0" data-name="cash_details-investing_cash_flow_y_t_d">
                                    {{ $reportData['cash_details'][0]['investing_cash_flow_y_t_d'] ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Financing Cash Flow</td>
                                <td class="text-center p-0" data-name="cash_details-financing_cash_flow_c_q">
                                    {{ $reportData['cash_details'][0]['financing_cash_flow_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0" data-name="cash_details-financing_cash_flow_y_t_d">
                                    {{ $reportData['cash_details'][0]['financing_cash_flow_y_t_d'] ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Effect of Movement</td>
                                <td class="text-center p-0" data-name="cash_details-effect_of_movement_c_q">
                                    {{ $reportData['cash_details'][0]['effect_of_movement_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0" data-name="cash_details-effect_of_movement_y_t_d">
                                    {{ $reportData['cash_details'][0]['effect_of_movement_y_t_d'] ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>End Cash</td>
                                <td class="text-center p-0" data-name="cash_details-end_cash_c_q">
                                    {{ $reportData['cash_details'][0]['end_cash_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0" data-name="cash_details-end_cash_y_t_d">
                                    {{ $reportData['cash_details'][0]['end_cash_y_t_d'] ?? '-' }}
                                </td>
                            </tr>





                            <tr>
                                <td class="table-light text-center fs-15" colspan="3">5. Reconciliation of Cash and
                                    Cash
                                    Equivalents
                                </td>
                                {{-- <td class="d-none"></td> --}}
                                {{-- <td class="d-none"></td> --}}
                            </tr>

                            <tr>
                                <td>Bank Balance</td>
                                <td class="text-center p-0" data-name="reconciliation_details-bank_balance_c_q">
                                    {{ $reportData['reconciliation_details'][0]['bank_balance_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0" data-name="reconciliation_details-bank_balance_y_t_d">
                                    {{ $reportData['reconciliation_details'][0]['bank_balance_y_t_d'] ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Call Deposits</td>
                                <td class="text-center p-0" data-name="reconciliation_details-call_deposits_c_q">
                                    {{ $reportData['reconciliation_details'][0]['call_deposits_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0" data-name="reconciliation_details-call_deposits_y_t_d">
                                    {{ $reportData['reconciliation_details'][0]['call_deposits_y_t_d'] ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Bank Overdrafts</td>
                                <td class="text-center p-0" data-name="reconciliation_details-bank_overdrafts_c_q">
                                    {{ $reportData['reconciliation_details'][0]['bank_overdrafts_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0" data-name="reconciliation_details-bank_overdrafts_y_t_d">
                                    {{ $reportData['reconciliation_details'][0]['bank_overdrafts_y_t_d'] ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Other</td>
                                <td class="text-center p-0" data-name="reconciliation_details-other_4_c_q">
                                    {{ $reportData['reconciliation_details'][0]['other_4_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0" data-name="reconciliation_details-other_4_y_t_d">
                                    {{ $reportData['reconciliation_details'][0]['other_4_y_t_d'] ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Cash Equivalents at End of Period</td>
                                <td class="text-center p-0"
                                    data-name="reconciliation_details-cash_equivalents_end_period_c_q">
                                    {{ $reportData['reconciliation_details'][0]['cash_equivalents_end_period_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0"
                                    data-name="reconciliation_details-cash_equivalents_end_period_y_t_d">
                                    {{ $reportData['reconciliation_details'][0]['cash_equivalents_end_period_y_t_d'] ?? '-' }}
                                </td>
                            </tr>




                            <tr>
                                <td class="table-light text-center fs-15" colspan="3">6. Payments to Related Parties
                                </td>
                                {{-- <td class="d-none"></td> --}}
                                {{-- <td class="d-none"></td> --}}
                            </tr>

                            <tr>
                                <td>Aggregated Payment 1</td>
                                <td class="text-center p-0" data-name="related_party_payments-aggregated_1_c_q">
                                    {{ $reportData['related_party_payments'][0]['aggregated_1_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center">--</td>
                            </tr>
                            <tr>
                                <td>Aggregated Payment 2</td>
                                <td class="text-center p-0" data-name="related_party_payments-aggregated_2_c_q">
                                    {{ $reportData['related_party_payments'][0]['aggregated_2_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center">--</td>
                            </tr>


                            <tr>
                                <td class="table-light text-center fs-15" colspan="3">7. Financing and Credit
                                    Facilities
                                </td>
                                {{-- <td class="d-none"></td> --}}
                                {{-- <td class="d-none"></td> --}}
                            </tr>

                            <tr>
                                <td>Loans</td>
                                <td class="text-center p-0" data-name="financing_facilities-loans_c_q">
                                    {{ $reportData['financing_facilities'][0]['loans_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0" data-name="financing_facilities-loans_y_t_d">
                                    {{ $reportData['financing_facilities'][0]['loans_y_t_d'] ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Credit Standby</td>
                                <td class="text-center p-0" data-name="financing_facilities-credit_standby_c_q">
                                    {{ $reportData['financing_facilities'][0]['credit_standby_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0" data-name="financing_facilities-credit_standby_y_t_d">
                                    {{ $reportData['financing_facilities'][0]['credit_standby_y_t_d'] ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Other</td>
                                <td class="text-center p-0" data-name="financing_facilities-other_5_c_q">
                                    {{ $reportData['financing_facilities'][0]['other_5_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0" data-name="financing_facilities-other_5_y_t_d">
                                    {{ $reportData['financing_facilities'][0]['other_5_y_t_d'] ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Total Financing</td>
                                <td class="text-center p-0" data-name="financing_facilities-total_financing_c_q">
                                    {{ $reportData['financing_facilities'][0]['total_financing_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center p-0" data-name="financing_facilities-total_financing_y_t_d">
                                    {{ $reportData['financing_facilities'][0]['total_financing_y_t_d'] ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Unused Financing Facilities</td>
                                <td class="text-center">-</td>
                                <td class="text-center p-0"
                                    data-name="financing_facilities-unused_financing_facilities_y_t_d">
                                    {{ $reportData['financing_facilities'][0]['unused_financing_facilities_y_t_d'] ?? '-' }}
                                </td>
                            </tr>



                            <tr>
                                <td class="table-light text-center fs-15" colspan="3">8. Cash Flow and Funding</td>
                                {{-- <td class="d-none"></td> --}}
                                {{-- <td class="d-none"></td> --}}
                            </tr>

                            <tr>
                                <td>Net Cash from Operating Activities</td>
                                <td class="text-center p-0"
                                    data-name="estimated_cash_availabilities-net_cash_operating_c_q">
                                    {{ $reportData['estimated_cash_availabilities'][0]['net_cash_operating_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center">--</td>
                            </tr>
                            <tr>
                                <td>Future Payments for Exploration and Evaluation</td>
                                <td class="text-center p-0"
                                    data-name="estimated_cash_availabilities-future_payments_for_exploration_evaluation_c_q">
                                    {{ $reportData['estimated_cash_availabilities'][0]['future_payments_for_exploration_evaluation_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center">--</td>
                            </tr>
                            <tr>
                                <td>Total Relevant Payments</td>
                                <td class="text-center p-0"
                                    data-name="estimated_cash_availabilities-total_relevant_payments_c_q">
                                    {{ $reportData['estimated_cash_availabilities'][0]['total_relevant_payments_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center">--</td>
                            </tr>
                            <tr>
                                <td>Future Cash Equivalents (End of Period)</td>
                                <td class="text-center p-0"
                                    data-name="estimated_cash_availabilities-future_cash_equivalents_end_period_c_q">
                                    {{ $reportData['estimated_cash_availabilities'][0]['future_cash_equivalents_end_period_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center">--</td>
                            </tr>
                            <tr>
                                <td>Unused Financing Facilities (End of Period)</td>
                                <td class="text-center p-0"
                                    data-name="estimated_cash_availabilities-unused_financing_facilities_end_period_c_q">
                                    {{ $reportData['estimated_cash_availabilities'][0]['unused_financing_facilities_end_period_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center">--</td>
                            </tr>
                            <tr>
                                <td>Total Available Funding</td>
                                <td class="text-center p-0"
                                    data-name="estimated_cash_availabilities-total_available_funding_c_q">
                                    {{ $reportData['estimated_cash_availabilities'][0]['total_available_funding_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center">--</td>
                            </tr>
                            <tr>
                                <td>Estimated Quarterly Funding</td>
                                <td class="text-center p-0"
                                    data-name="estimated_cash_availabilities-estimated_quarterly_funding_c_q">
                                    {{ $reportData['estimated_cash_availabilities'][0]['estimated_quarterly_funding_c_q'] ?? '-' }}
                                </td>
                                <td class="text-center">--</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <!-- Link to PDF.js library via CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.6.172/pdf.min.js"></script>
    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let htmlTag = document.getElementsByTagName('html')[0];
            htmlTag.setAttribute('data-sidebar-size', 'sm');
        })
    </script>

    <script>
        let pdfDoc = null;
        let pageNum = 1;
        let pageRendering = false;
        let pageNumPending = null;
        const scale = 2;
        let canvas = document.getElementById('pdf-canvas');
        let path = canvas.getAttribute('path');

        let url = path;

        console.log(url);

        const ctx = canvas.getContext('2d');

        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.6.172/pdf.worker.min.js';

        /**
         * Render the current page.
         */
        function renderPage(num) {
            pageRendering = true;

            // Fetch the page
            pdfDoc.getPage(num).then(page => {
                const viewport = page.getViewport({
                    scale
                });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                const renderTask = page.render(renderContext);

                // Wait for rendering to finish
                renderTask.promise.then(() => {
                    pageRendering = false;

                    if (pageNumPending !== null) {
                        // New page rendering is pending
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });

                // Update page counters
                document.getElementById('page-num').textContent = pageNum;
            });
        }

        /**
         * If another page is currently rendering, wait until the rendering is
         * finished. Otherwise, execute immediately.
         */
        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }

        /**
         * Display the previous page.
         */
        function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            queueRenderPage(pageNum);
        }

        /**
         * Display the next page.
         */
        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            queueRenderPage(pageNum);
        }

        // Load the PDF document
        pdfjsLib.getDocument(url).promise.then(pdfDoc_ => {
            pdfDoc = pdfDoc_;
            document.getElementById('page-count').textContent = pdfDoc.numPages;

            // Initial page rendering
            renderPage(pageNum);
        });

        // Button events
        document.getElementById('prev-page').addEventListener('click', onPrevPage);
        document.getElementById('next-page').addEventListener('click', onNextPage);
    </script>

    <script>
        var tds = document.getElementsByTagName("td");
        for (var i = 0; i < tds.length; i++) {
            if (tds[i].getAttribute('data-name')) {
                tds[i].addEventListener("dblclick", editCellValue);
            }
        }

        let reportData = @json($reportData);
        console.log(reportData);
        document.getElementById('btn_save').style.display = 'none';



        function editCellValue() {
            // check this.innerHTML already has a input tag 
            if (this.querySelector("input")) {
                return;
            }
            this.innerHTML =
                "<input class='form-control-sm m-0 text-center border-0' style='max-width:100px;' type='text' value='" +
                getvalue(this.innerHTML) + "' />";

            var oldVallue;

            function getvalue(value) {
                oldVallue = value;
                // remove unnecessary spaces
                return value.replace(/\s+/g, '');
            }
            var input = this.querySelector("input");
            input.select();
            input.focus();
            input.onblur = function() {
                if (is_enter) {
                    return;
                }
                if (valueCheck(this)) {
                    this.parentNode.innerHTML = this.value;
                    let btn = document.getElementById('btn_save').style.display = 'block';
                } else {
                    this.parentNode.innerHTML = oldVallue;
                }

            }

            var is_enter = false;
            // if enter button press 
            input.onkeydown = function(e) {
                if (e.keyCode == 13) {
                    is_enter = true;
                    if (valueCheck(this)) {
                        this.parentNode.innerHTML = this.value;
                        let btn = document.getElementById('btn_save').style.display = 'block';
                    } else {
                        this.parentNode.innerHTML = oldVallue;
                    }
                }
            };

            // when focusout input save cell 
            // input.onblur = function() {
            //     valueCheck(this);
            // };

            function valueCheck(inputTag) {
                if (/^-?\d*(\.\d+)?$|^-$/.test(inputTag.value)) {
                    updateJson(inputTag.parentNode.getAttribute('data-name'), inputTag.value);
                    inputTag.blur();
                    is_enter = false;
                    return true;
                } else {
                    inputTag.value = oldVallue;
                    inputTag.blur();
                    is_enter = false;
                    return false;
                }
            }




            function updateJson(dataName, value) {
                console.log(dataName, value); //t1-receipts_from_customers_c_q 33
                splitDataName = dataName.split('-');
                tableName = splitDataName[0];
                cellName = splitDataName[1];
                reportData[tableName][0][cellName] = value;

                // console.log(reportData);
            }

        }

        function saveData() {
            Swal.fire({
                title: "Saving Report...",
                text: 'That thing is still around?',
                html: '<i class="text-success mdi mdi-spin mdi-loading fs-48"></i>',
                // icon: 'question',
                // confirmButtonClass: 'btn btn-primary w-xs mt-2',
                // buttonsStyling: false,
                showCloseButton: false,
                showConfirmButton: false
            });

            // console.log(JSON.stringify(reportData));
            var request = new XMLHttpRequest();
            request.open("POST", "{{ route('client.save-report') }}");
            request.setRequestHeader("Content-Type", "application/json");
            request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
            request.send(JSON.stringify([reportData]));
            console.log(reportData);


            request.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // alert("Report Saved Successfully");
                    // console.log(this.responseText);

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Report has been saved',
                        showConfirmButton: false,
                        timer: 2500,
                        showCloseButton: true
                    });
                    window.location.reload();
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Something went wrong',
                        showConfirmButton: false,
                        timer: 2500,
                        showCloseButton: true
                    });
                    window.location.reload();
                }
            };
        }
    </script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
