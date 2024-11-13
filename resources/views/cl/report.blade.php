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

    <div class="row justify-content-center">
        <div class="card col-auto">
            <div class="card-header">
                <h2 class="text-center">Appendix 5B</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Quarter Ending</th>
                            <td>31 March 2024</td>
                        </tr>
                        <tr>
                            <th>Company Name</th>
                            <td>Australian Gold and Copper Ltd</td>
                        </tr>
                        <tr>
                            <th>ABN</th>
                            <td>75 633 936 526</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <h2 class="mt-4 mb-3">Cash Flows from Operating Activities</h2>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="buttons-datatable1" class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr class="table-dark text-white">
                                <th>Details</th>
                                <th>Current Quarter</th>
                                <th>Year to Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Receipts from Customers</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Payments for Exploration &amp; Evaluation</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Payments for Development</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Payments for Production</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Payments for Staff Costs</td>
                                <td>-79</td>
                                <td>-173</td>
                            </tr>
                            <tr>
                                <td>Payments for Admin Costs</td>
                                <td>-191</td>
                                <td>-411</td>
                            </tr>
                            <tr>
                                <td>Dividends Received</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Interest Received</td>
                                <td>98</td>
                                <td>138</td>
                            </tr>
                            <tr>
                                <td>Interest Paid</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Income Tax Paid</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Government Tax Paid</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Other</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Net Cash from Operating Activities</td>
                                <td>-172</td>
                                <td>-446</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <h2 class="mt-4 mb-3">Cash Flows from Investing Activities</h2>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="buttons-datatable2" class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr class="table-dark text-white">
                                <th>Activity</th>
                                <th>Current Quarter</th>
                                <th>Year to Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Payments for Entities</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Payments for Tenements</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Payments for Property</td>
                                <td>-5</td>
                                <td>-5</td>
                            </tr>
                            <tr>
                                <td>Payments for Exploration and Evaluation</td>
                                <td>-704</td>
                                <td>-1115</td>
                            </tr>
                            <tr>
                                <td>Payments for Investment</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Payments for Other</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Entities</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Tenements</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Property</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Investment</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Other</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Cash Flow from Loans</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Dividends Received</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Other</td>
                                <td>-30</td>
                                <td>-30</td>
                            </tr>
                            <tr>
                                <td>Net Cash from Investing Activities</td>
                                <td>-739</td>
                                <td>-1150</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <h2 class="mt-4 mb-3">Cash Flows from Financing Activities</h2>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="buttons-datatable3" class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr class="table-dark text-white">
                                <th>Activity</th>
                                <th>Current Quarter</th>
                                <th>Year to Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Proceeds from Equity</td>
                                <td>-</td>
                                <td>10,100</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Debt</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Exercise of Options</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Transaction Costs for Securities</td>
                                <td>-</td>
                                <td>-25</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Borrowing</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Repayments of Borrowing</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Transaction Costs for Borrowing</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Dividends Paid</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Other Financing Activities</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Net Cash from Financing Activities</td>
                                <td>-</td>
                                <td>10,075</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <h2 class="mt-4 mb-3">Cash Flow Summary</h2>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="buttons-datatable4" class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr class="table-dark text-white">
                                <th>Cash Flow Category</th>
                                <th>Current Quarter</th>
                                <th>Year to Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Beginning Cash</td>
                                <td>11,573</td>
                                <td>2,183</td>
                            </tr>
                            <tr>
                                <td>Operating Cash Flow</td>
                                <td>-172</td>
                                <td>-446</td>
                            </tr>
                            <tr>
                                <td>Investing Cash Flow</td>
                                <td>-739</td>
                                <td>-1150</td>
                            </tr>
                            <tr>
                                <td>Financing Cash Flow</td>
                                <td>-</td>
                                <td>10,075</td>
                            </tr>
                            <tr>
                                <td>Effect of Movement on Cash</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Ending Cash</td>
                                <td>10,662</td>
                                <td>10,662</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <h2 class="mt-4 mb-3">Reconciliation of Cash and Cash Equivalents</h2>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="buttons-datatable5" class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr class="table-dark text-white">
                                <th>Category</th>
                                <th>Current Quarter</th>
                                <th>Year to Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Bank Balance</td>
                                <td>657</td>
                                <td>760</td>
                            </tr>
                            <tr>
                                <td>Call Deposits</td>
                                <td>10,005</td>
                                <td>10,813</td>
                            </tr>
                            <tr>
                                <td>Bank Overdrafts</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Other</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Cash Equivalents at End of Period</td>
                                <td>10,662</td>
                                <td>11,573</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <h2 class="mt-4 mb-3">Payments to Related Parties</h2>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="buttons-datatable6" class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr class="table-dark text-white">
                                <th>Category</th>
                                <th>Current Quarter</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Aggregated Payment 1</td>
                                <td>81</td>
                            </tr>
                            <tr>
                                <td>Aggregated Payment 2</td>
                                <td>90</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <h2 class="mt-4 mb-3">Financing and Credit Facilities</h2>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="buttons-datatable7" class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr class="table-dark text-white">
                                <th>Category</th>
                                <th>Current Quarter (C-Q)</th>
                                <th>Year to Date (Y-T-D)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Loans</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Credit Standby Arrangements</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Other Financing</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Total Financing</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Unused Financing Facilities</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <h2 class="mt-4 mb-3">Cash Flow and Funding</h2>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="buttons-datatable8" class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr class="table-dark text-white">
                                <th>Category</th>
                                <th>Current Quarter (C-Q)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Net Cash from Operating Activities</td>
                                <td>-172</td>
                            </tr>
                            <tr>
                                <td>Payments for Exploration &amp; Evaluation</td>
                                <td>-704</td>
                            </tr>
                            <tr>
                                <td>Total Relevant Payments</td>
                                <td>-876</td>
                            </tr>
                            <tr>
                                <td>Future Cash Equivalents (End of Period)</td>
                                <td>10,662</td>
                            </tr>
                            <tr>
                                <td>Unused Financing Facilities (End of Period)</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Total Available Funding</td>
                                <td>10,662</td>
                            </tr>
                            <tr>
                                <td>Estimated Quarterly Funding</td>
                                <td>12.17</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="row">
        {{-- <h2 class="mt-4 mb-3">Cash Flows from Operating Activities</h2> --}}
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="buttons-datatable1" class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr class="table-dark text-white">
                                <th>Details</th>
                                <th>Current Quarter</th>
                                <th>Year to Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-warning fs-15" colspan="3">Cash Flows from Operating Activities</td>
                            </tr>
                            <tr>
                                <td>Receipts from Customers</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Payments for Exploration &amp; Evaluation</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Payments for Development</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Payments for Production</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Payments for Staff Costs</td>
                                <td>-79</td>
                                <td>-173</td>
                            </tr>
                            <tr>
                                <td>Payments for Admin Costs</td>
                                <td>-191</td>
                                <td>-411</td>
                            </tr>
                            <tr>
                                <td>Dividends Received</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Interest Received</td>
                                <td>98</td>
                                <td>138</td>
                            </tr>
                            <tr>
                                <td>Interest Paid</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Income Tax Paid</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Government Tax Paid</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Other</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Net Cash from Operating Activities</td>
                                <td>-172</td>
                                <td>-446</td>
                            </tr>

                            <tr>
                                <td class="table-warning fs-15" colspan="3">Cash Flows from Investing Activities</td>
                            </tr>

                            <tr>
                                <td>Payments for Entities</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Payments for Tenements</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Payments for Property</td>
                                <td>-5</td>
                                <td>-5</td>
                            </tr>
                            <tr>
                                <td>Payments for Exploration and Evaluation</td>
                                <td>-704</td>
                                <td>-1115</td>
                            </tr>
                            <tr>
                                <td>Payments for Investment</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Payments for Other</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Entities</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Tenements</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Property</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Investment</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Other</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Cash Flow from Loans</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Dividends Received</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Other</td>
                                <td>-30</td>
                                <td>-30</td>
                            </tr>
                            <tr>
                                <td>Net Cash from Investing Activities</td>
                                <td>-739</td>
                                <td>-1150</td>
                            </tr>


                            <tr>
                                <td  class="table-warning fs-15" colspan="3">Cash Flows from Financing Activities</td>
                            </tr>

                            <tr>
                                <td>Proceeds from Equity</td>
                                <td>-</td>
                                <td>10,100</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Debt</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Exercise of Options</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Transaction Costs for Securities</td>
                                <td>-</td>
                                <td>-25</td>
                            </tr>
                            <tr>
                                <td>Proceeds from Borrowing</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Repayments of Borrowing</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Transaction Costs for Borrowing</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Dividends Paid</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Other Financing Activities</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Net Cash from Financing Activities</td>
                                <td>-</td>
                                <td>10,075</td>
                            </tr>

                            <tr>
                                <td class="table-warning fs-15" colspan="3">Cash Flow Summary</td>
                            </tr>

                            <tr>
                                <td>Beginning Cash</td>
                                <td>11,573</td>
                                <td>2,183</td>
                            </tr>
                            <tr>
                                <td>Operating Cash Flow</td>
                                <td>-172</td>
                                <td>-446</td>
                            </tr>
                            <tr>
                                <td>Investing Cash Flow</td>
                                <td>-739</td>
                                <td>-1150</td>
                            </tr>
                            <tr>
                                <td>Financing Cash Flow</td>
                                <td>-</td>
                                <td>10,075</td>
                            </tr>
                            <tr>
                                <td>Effect of Movement on Cash</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Ending Cash</td>
                                <td>10,662</td>
                                <td>10,662</td>
                            </tr>



                            <tr>
                                <td class="table-warning fs-15" colspan="3">Reconciliation of Cash and Cash Equivalents</td>
                            </tr>

                            <tr>
                                <td>Bank Balance</td>
                                <td>657</td>
                                <td>760</td>
                            </tr>
                            <tr>
                                <td>Call Deposits</td>
                                <td>10,005</td>
                                <td>10,813</td>
                            </tr>
                            <tr>
                                <td>Bank Overdrafts</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Other</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Cash Equivalents at End of Period</td>
                                <td>10,662</td>
                                <td>11,573</td>
                            </tr>


                            <tr>
                                <td class="table-warning fs-15" colspan="3">Payments to Related Parties</td>
                            </tr>

                            <tr>
                                <td>Aggregated Payment 1</td>
                                <td>81</td>
                                <td>81</td>
                            </tr>
                            <tr>
                                <td>Aggregated Payment 2</td>
                                <td>90</td>
                                <td>90</td>
                            </tr>

                            <tr>
                                <td class="table-warning fs-15" colspan="3">Financing and Credit Facilities</td>
                            </tr>

                            <tr>
                                <td>Loans</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Credit Standby Arrangements</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Other Financing</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Total Financing</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Unused Financing Facilities</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>

                            <tr>
                                <td class="table-warning fs-15" colspan="3">Cash Flow and Funding</td>
                            </tr>

                            <tr>
                                <td>Net Cash from Operating Activities</td>
                                <td>-172</td>
                                <td>-172</td>
                            </tr>
                            <tr>
                                <td>Payments for Exploration &amp; Evaluation</td>
                                <td>-704</td>
                                <td>-704</td>
                            </tr>
                            <tr>
                                <td>Total Relevant Payments</td>
                                <td>-876</td>
                                <td>-876</td>
                            </tr>
                            <tr>
                                <td>Future Cash Equivalents (End of Period)</td>
                                <td>10,662</td>
                                <td>10,662</td>
                            </tr>
                            <tr>
                                <td>Unused Financing Facilities (End of Period)</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Total Available Funding</td>
                                <td>10,662</td>
                                <td>10,662</td>
                            </tr>
                            <tr>
                                <td>Estimated Quarterly Funding</td>
                                <td>12.17</td>
                                <td>12.17</td>
                            </tr>



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
        //buttons examples
        let buttonsDataTable1 = new DataTable('#buttons-datatable1', {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print', 'pdf'
            ]
        });
        //buttons examples
        let buttonsDataTable2 = new DataTable('#buttons-datatable2', {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print', 'pdf'
            ]
        });
        //buttons examples
        let buttonsDataTable3 = new DataTable('#buttons-datatable3', {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print', 'pdf'
            ]
        });
        //buttons examples
        let buttonsDataTable4 = new DataTable('#buttons-datatable4', {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print', 'pdf'
            ]
        });
        //buttons examples
        let buttonsDataTable5 = new DataTable('#buttons-datatable5', {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print', 'pdf'
            ]
        });
        //buttons examples
        let buttonsDataTable6 = new DataTable('#buttons-datatable6', {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print', 'pdf'
            ]
        });
        //buttons examples
        let buttonsDataTable7 = new DataTable('#buttons-datatable7', {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print', 'pdf'
            ]
        });
        //buttons examples
        let buttonsDataTable8 = new DataTable('#buttons-datatable8', {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print', 'pdf'
            ]
        });
    </script>
    {{-- <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script> --}}

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
