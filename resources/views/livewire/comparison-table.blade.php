<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body d-flex justify-content-end">
                    <div class="col-3 col-lg-4 pe-3">
                        <select class="form-control my-auto" name="choices-single-default" id="choices-single-default"
                            wire:change="changeCompany($event.target.value)">
                            <option value="" disabled>Search by ABN</option>
                            @if ($companies != null)
                                @foreach ($companies as $company)
                                    <option value="{{ $company['abn'] }}"
                                        {{ $selectedCompany == $company['abn'] ? 'selected' : '' }}>
                                        {{ $company['company_name'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-auto pe-3">
                        <select class="form-select my-auto" wire:change="changeTableTopic($event.target.value)">
                            <option value="all" {{ $tableTopic == 'all' ? 'selected' : '' }}>All</option>
                            <option value="0" {{ $tableTopic == '0' ? 'selected' : '' }}>1 - Cash flows from
                                operating
                                activities</option>
                            <option value="1" {{ $tableTopic == '1' ? 'selected' : '' }}>2 - Cash flows from
                                investing
                                activities</option>
                            <option value="2" {{ $tableTopic == '2' ? 'selected' : '' }}>3 - Cash flows from
                                financing
                                activities</option>
                            <option value="3" {{ $tableTopic == '3' ? 'selected' : '' }}>4 - Cash flow details
                            </option>
                            <option value="4" {{ $tableTopic == '4' ? 'selected' : '' }}>5 - Reconciliation details
                            </option>
                            <option value="5" {{ $tableTopic == '5' ? 'selected' : '' }}>6 - Related party payments
                            </option>
                            <option value="6" {{ $tableTopic == '6' ? 'selected' : '' }}>7 - Financing facilities
                            </option>
                            <option value="7" {{ $tableTopic == '7' ? 'selected' : '' }}>8 - Estimated cash
                                availabilities</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <select class="form-select my-auto" wire:change="changetimeType($event.target.value)">
                            @if ($tableTopic == '5' || $tableTopic == '6' || $tableTopic == '7')
                                <option value="1" {{ $timeType == '1' ? 'selected' : '' }}>Quarterly</option>
                            @else
                                <option value="0" {{ $timeType == '0' ? 'selected' : '' }}>Quarterly & Year to
                                    date</option>
                                <option value="1" {{ $timeType == '1' ? 'selected' : '' }}>Quarterly</option>
                                <option value="2" {{ $timeType == '2' ? 'selected' : '' }}>Year to date</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="floating-button">
        <a id="btn_save" onclick="saveData()" class="btn btn-primary waves-effect"><i
                class="mdi mdi-content-save-outline"></i></a>
        <style>
            .floating-button {
                position: fixed;
                bottom: 80px;
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive pb-4">
                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th colspan="4" class="bg-white"
                                        style="left: 0px; position: sticky; border-right:solid 2px #380092;"></th>
                                    @if ($tableTopic == 'all' || $tableTopic == '0')
                                        <th colspan="28" class="text-center align-middle table-dark text-white">1 -
                                            Cash Flows from
                                            Operating
                                            Activities</th>
                                    @endif
                                    @if ($tableTopic == 'all' || $tableTopic == '1')
                                        <th colspan="32" class="text-center align-middle table-dark text-white">2 -
                                            Cash Flows from
                                            Investing
                                            Activities</th>
                                    @endif
                                    @if ($tableTopic == 'all' || $tableTopic == '2')
                                        <th colspan="22" class="text-center align-middle table-dark text-white">3 -
                                            Cash Flows from
                                            Financing
                                            Activities</th>
                                    @endif
                                    @if ($tableTopic == 'all' || $tableTopic == '3')
                                        <th colspan="14" class="text-center align-middle table-dark text-white">4 -
                                            Cash Flow
                                            Summary</th>
                                    @endif
                                    @if ($tableTopic == 'all' || $tableTopic == '4')
                                        <th colspan="12" class="text-center align-middle table-dark text-white">5 -
                                            Reconciliation
                                            of Cash and Cash
                                            Equivalents</th>
                                    @endif
                                    @if ($tableTopic == 'all' || $tableTopic == '5')
                                        <th colspan="3" class="text-center align-middle table-dark text-white">6 -
                                            Payments to
                                            Related Parties
                                        </th>
                                    @endif
                                    @if ($tableTopic == 'all' || $tableTopic == '6')
                                        <th colspan="10" class="text-center align-middle table-dark text-white">7 -
                                            Financing and
                                            Credit Facilities
                                        </th>
                                    @endif
                                    @if ($tableTopic == 'all' || $tableTopic == '7')
                                        <th colspan="7" class="text-center align-middle table-dark text-white">8 -
                                            Cash Flow and
                                            Funding</th>
                                    @endif
                                </tr>
                                <tr>
                                    <th rowspan="2">Action</th>
                                    <th rowspan="2">Quarter Ending</th>
                                    <th rowspan="2">Name of Entity</th>
                                    <th rowspan="2" style="border-right:solid 2px #380092;">ABN</th>

                                    @if ($tableTopic == 'all' || $tableTopic == '0')
                                        <th class="text-center align-middle" colspan="2">Receipts from Customers</th>
                                        <th class="text-center align-middle" colspan="2">Payments for Exploration &
                                            Evaluation
                                        </th>
                                        <th class="text-center align-middle" colspan="2">Payments for Development
                                        </th>
                                        <th class="text-center align-middle" colspan="2">Payments for Production</th>
                                        <th class="text-center align-middle" colspan="2">Payments for Staff Costs
                                        </th>
                                        <th class="text-center align-middle" colspan="2">Payments for Admin Costs
                                        </th>
                                        <th class="text-center align-middle" colspan="2">Dividends Received</th>
                                        <th class="text-center align-middle" colspan="2">Interest Received</th>
                                        <th class="text-center align-middle" colspan="2">Interest Paid</th>
                                        <th class="text-center align-middle" colspan="2">Income Tax Paid</th>
                                        <th class="text-center align-middle" colspan="2">Government Tax Paid</th>
                                        <th class="text-center align-middle" colspan="2">Other</th>
                                        <th class="text-center align-middle" colspan="2">Net Cash from Operating
                                            Activities</th>
                                        <th class="text-center align-middle table-light" colspan="2"
                                            style="border-right:solid 2px #380092;">
                                            Adjustments</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '1')
                                        <th class="text-center align-middle" colspan="2">Payments for Entities</th>
                                        <th class="text-center align-middle" colspan="2">Payments for Tenements</th>
                                        <th class="text-center align-middle" colspan="2">Payments for Property</th>
                                        <th class="text-center align-middle" colspan="2">Payments for Exploration
                                            and
                                            Evaluation
                                        </th>
                                        <th class="text-center align-middle" colspan="2">Payments for Investment
                                        </th>
                                        <th class="text-center align-middle" colspan="2">Payments for Other</th>
                                        <th class="text-center align-middle" colspan="2">Proceeds from Entities
                                        </th>
                                        <th class="text-center align-middle" colspan="2">Proceeds from Tenements
                                        </th>
                                        <th class="text-center align-middle" colspan="2">Proceeds from Property
                                        </th>
                                        <th class="text-center align-middle" colspan="2">Proceeds from Investment
                                        </th>
                                        <th class="text-center align-middle" colspan="2">Proceeds from Other</th>
                                        <th class="text-center align-middle" colspan="2">Cash Flow from Loans</th>
                                        <th class="text-center align-middle" colspan="2">Dividends Received</th>
                                        <th class="text-center align-middle" colspan="2">Other</th>
                                        <th class="text-center align-middle" colspan="2">Net Cash from Investing
                                            Activitie</th>
                                        <th class="text-center align-middle table-light" colspan="2"
                                            style="border-right:solid 2px #380092;">Adjustments</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '2')
                                        <th class="text-center align-middle" colspan="2">Proceeds from Equity</th>
                                        <th class="text-center align-middle" colspan="2">Proceeds from Debt</th>
                                        <th class="text-center align-middle" colspan="2">Proceeds from Exercise of
                                            Options</th>
                                        <th class="text-center align-middle" colspan="2">Transaction Costs for
                                            Securities</th>
                                        <th class="text-center align-middle" colspan="2">Proceeds from Borrowing
                                        </th>
                                        <th class="text-center align-middle" colspan="2">Repayments of Borrowing
                                        </th>
                                        <th class="text-center align-middle" colspan="2">Transaction Costs for
                                            Borrowing</th>
                                        <th class="text-center align-middle" colspan="2">Dividends Paid</th>
                                        <th class="text-center align-middle" colspan="2">Other Financing Activities
                                        </th>
                                        <th class="text-center align-middle" colspan="2">Net Cash from Financing
                                            Activities</th>
                                        <th class="text-center align-middle table-light" colspan="2"
                                            style="border-right:solid 2px #380092;">Adjustments</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '3')
                                        <th class="text-center align-middle" colspan="2">Beginning Cash</th>
                                        <th class="text-center align-middle" colspan="2">Operating Cash Flow</th>
                                        <th class="text-center align-middle" colspan="2">Investing Cash Flow</th>
                                        <th class="text-center align-middle" colspan="2">Financing Cash Flow</th>
                                        <th class="text-center align-middle" colspan="2">Effect of Movement on Cash
                                        </th>
                                        <th class="text-center align-middle" colspan="2">Ending Cash</th>
                                        <th class="text-center align-middle table-light" colspan="2"
                                            style="border-right:solid 2px #380092;">Adjustments</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '4')
                                        <th class="text-center align-middle" colspan="2">Bank Balance</th>
                                        <th class="text-center align-middle" colspan="2">Call Deposits</th>
                                        <th class="text-center align-middle" colspan="2">Bank Overdrafts</th>
                                        <th class="text-center align-middle" colspan="2">Other</th>
                                        <th class="text-center align-middle" colspan="2">Cash Equivalents at End of
                                            Period</th>
                                        <th class="text-center align-middle table-light" colspan="2"
                                            style="border-right:solid 2px #380092;">Adjustments</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '5')
                                        <th class="text-center align-middle" colspan="1">Aggregated Payment 1</th>
                                        <th class="text-center align-middle" colspan="1">Aggregated Payment 2</th>
                                        <th class="text-center align-middle table-light" colspan="1"
                                            style="border-right:solid 2px #380092;">Adjustments</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '6')
                                        <th class="text-center align-middle" colspan="2">Loans</th>
                                        <th class="text-center align-middle" colspan="2">Credit Standby
                                            Arrangements</th>
                                        <th class="text-center align-middle" colspan="2">Other Financing</th>
                                        <th class="text-center align-middle" colspan="2">Total Financing</th>
                                        <th class="text-center align-middle" colspan="1"
                                            style="border-right:solid 2px #380092;">Unused Financing Facilities</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '7')
                                        <th class="text-center align-middle align-middle" colspan="7">
                                            <span>$A’000</span>
                                        </th>
                                    @endif


                                </tr>
                                <tr>
                                    @if ($tableTopic == 'all' || $tableTopic == '0')
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th style="min-width: 60px" class="table-light">Current quarter</th>
                                        <th class="table-light"
                                            style="min-width: 60px; border-right:solid 2px #380092;">Year to date
                                        </th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '1')
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th style="min-width: 60px;" class="table-light">Current quarter</th>
                                        <th class="table-light"
                                            style="min-width: 60px;border-right:solid 2px #380092;">Year to date
                                        </th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '2')
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th style="min-width: 60px;" class="table-light">Current quarter</th>
                                        <th class="table-light"
                                            style="min-width: 60px; border-right:solid 2px #380092;">Year to date
                                        </th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '3')
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th style="min-width: 60px;" class="table-light">Current quarter</th>
                                        <th class="table-light"
                                            style="min-width: 60px; border-right:solid 2px #380092;">Year to date
                                        </th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '4')
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th style="min-width: 60px;" class="table-light">Current quarter</th>
                                        <th class="table-light"
                                            style="min-width: 60px;border-right:solid 2px #380092;">Year to date
                                        </th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '5')
                                        <th>Current quarter</th>
                                        <th>Current quarter</th>
                                        {{-- <th>Year to date</th> --}}
                                        <th class="table-light"
                                            style="min-width: 60px;border-right:solid 2px #380092;">Current
                                            quarter</th>
                                        {{-- <th style="border-right:solid 2px #380092;">Year to date</th> --}}
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '6')
                                        <th style="width: 60px !important;">Total facility amount at quarter end</th>
                                        {{--  c_Q --}}
                                        <th style="width: 60px !important;">Amount drawn at quarter end</th>
                                        {{--  y_t_d --}}
                                        <th style="width: 60px !important;">Total facility amount at quarter end</th>
                                        <th style="width: 60px !important;">Amount drawn at quarter end</th>
                                        <th style="width: 60px !important;">Total facility amount at quarter end</th>
                                        <th style="width: 60px !important;">Amount drawn at quarter end</th>
                                        <th style="width: 60px !important;">Total facility amount at quarter end</th>
                                        <th>Amount drawn at quarter end</th>

                                        <th class="text-center align-middle" style="border-right:solid 2px #380092;">
                                            At quarter end
                                        </th> {{--  y_t_d --}}
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '7')
                                        <th class="text-center align-middle" colspan="1">Net Cash from Operating
                                            Activities</th>
                                        <th class="text-center align-middle" colspan="1">Payments for
                                            Exploration & Evaluation</th>
                                        <th class="text-center align-middle" colspan="1">Total Relevant Payments
                                        </th>
                                        <th class="text-center align-middle" colspan="1">Future Cash Equivalents
                                            (End of Period)</th>
                                        <th class="text-center align-middle" colspan="1">Unused Financing
                                            Facilities (End of Period)</th>
                                        <th class="text-center align-middle" colspan="1">Total Available Funding
                                        </th>
                                        <th class="text-center align-middle" colspan="1">Estimated Quarterly
                                            Funding</th>
                                        {{-- <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th>
                                        <th>Current quarter</th>
                                        <th>Year to date</th> --}}
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if ($allReports != null)
                                    @foreach ($allReports as $index => $report)
                                        <tr>
                                            <td class="text-center align-middle"><a
                                                    href="{{ route('client.single-report', $report['id']) }}"
                                                    class="btn btn-sm btn-secondary">view</a></td>
                                            <td>{{ $report['quarter_ending'] }}</td>
                                            <td>{{ $report['company_name'] }}</td>
                                            <td style="border-right:solid 2px #380092;">{{ $report['abn'] }}</td>

                                            {{-- Operating Details Columns --}}
                                            @if ($tableTopic == 'all' || $tableTopic == '0')
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['receipts_from_customers_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['receipts_from_customers_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['payments_exploration_evaluation_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['payments_exploration_evaluation_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['payments_development_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['payments_development_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['payments_production_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['payments_production_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['payments_staff_costs_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['payments_staff_costs_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['payments_admin_costs_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['payments_admin_costs_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['dividends_received_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['dividends_received_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['interest_received_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['interest_received_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['interest_paid_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['interest_paid_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['income_tax_paid_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['income_tax_paid_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['government_tax_paid_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['government_tax_paid_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['other_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['other_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['net_cash_from_operating_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['operating_details'][0]['net_cash_from_operating_y_t_d'] ?? '-' }}
                                                </td>
                                                <td data-name="{{ $index }}-operating_details-adjustments_c_q"
                                                    class="text-end table-light">
                                                    {{ $report['operating_details'][0]['adjustments_c_q'] ?? '-' }}
                                                </td>
                                                <td data-name="{{ $index }}-operating_details-adjustments_y_t_d"
                                                    class="text-end table-light"
                                                    style="border-right:solid 2px #380092;">
                                                    {{ $report['operating_details'][0]['adjustments_y_t_d'] ?? '-' }}
                                                </td>
                                            @endif

                                            {{-- Investing Details Columns --}}
                                            @if ($tableTopic == 'all' || $tableTopic == '1')
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['payments_for_entities_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['payments_for_entities_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['payments_for_tenements_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['payments_for_tenements_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['payments_for_property_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['payments_for_property_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['payments_for_exploration_evaluation_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['payments_for_exploration_evaluation_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['payments_for_investment_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['payments_for_investment_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['payments_for_other_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['payments_for_other_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['proceeds_from_entities_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['proceeds_from_entities_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['proceeds_from_tenements_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['proceeds_from_tenements_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['proceeds_from_property_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['proceeds_from_property_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['proceeds_from_investment_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['proceeds_from_investment_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['proceeds_from_other_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['proceeds_from_other_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['cash_flow_from_loans_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['cash_flow_from_loans_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['dividends_received_2_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['dividends_received_2_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['other_2_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['other_2_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['net_cash_from_investing_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['investing_details'][0]['net_cash_from_investing_y_t_d'] ?? '-' }}
                                                </td>
                                                <td data-name="{{ $index }}-investing_details-adjustments_c_q"
                                                    class="text-end table-light">
                                                    {{ $report['investing_details'][0]['adjustments_c_q'] ?? '-' }}
                                                </td>
                                                <td data-name="{{ $index }}-investing_details-adjustments_y_t_d"
                                                    class="text-end table-light"
                                                    style="border-right:solid 2px #380092;">
                                                    {{ $report['investing_details'][0]['adjustments_y_t_d'] ?? '-' }}
                                                </td>
                                            @endif

                                            {{-- financing_details --}}
                                            @if ($tableTopic == 'all' || $tableTopic == '2')
                                                <td class="text-end">
                                                    {{ $report['financing_details'][0]['proceeds_from_equity_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_details'][0]['proceeds_from_equity_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_details'][0]['proceeds_from_debt_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_details'][0]['proceeds_from_debt_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_details'][0]['proceeds_from_exercise_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_details'][0]['proceeds_from_exercise_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_details'][0]['transaction_costs_for_securities_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_details'][0]['transaction_costs_for_securities_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_details'][0]['proceeds_from_borrowing_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_details'][0]['proceeds_from_borrowing_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_details'][0]['repayments_of_borrowing_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_details'][0]['repayments_of_borrowing_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_details'][0]['transaction_costs_for_borrowing_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_details'][0]['transaction_costs_for_borrowing_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_details'][0]['dividends_paid_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_details'][0]['dividends_paid_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_details'][0]['other_3_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_details'][0]['other_3_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_details'][0]['net_cash_from_financing_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_details'][0]['net_cash_from_financing_y_t_d'] ?? '-' }}
                                                </td>
                                                <td data-name="{{ $index }}-financing_details-adjustments_c_q"
                                                    class="text-end table-light">
                                                    {{ $report['financing_details'][0]['adjustments_c_q'] ?? '-' }}
                                                </td>
                                                <td data-name="{{ $index }}-financing_details-adjustments_y_t_d"
                                                    class="text-end table-light"
                                                    style="border-right:solid 2px #380092;">
                                                    {{ $report['financing_details'][0]['adjustments_y_t_d'] ?? '-' }}
                                                </td>
                                            @endif

                                            {{-- cash_details --}}
                                            @if ($tableTopic == 'all' || $tableTopic == '3')
                                                <td class="text-end">
                                                    {{ $report['cash_details'][0]['beginning_cash_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['cash_details'][0]['beginning_cash_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['cash_details'][0]['operating_cash_flow_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['cash_details'][0]['operating_cash_flow_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['cash_details'][0]['investing_cash_flow_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['cash_details'][0]['investing_cash_flow_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['cash_details'][0]['financing_cash_flow_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['cash_details'][0]['financing_cash_flow_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['cash_details'][0]['effect_of_movement_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['cash_details'][0]['effect_of_movement_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['cash_details'][0]['end_cash_c_q'] ?? '-' }}</td>
                                                <td class="text-end">
                                                    {{ $report['cash_details'][0]['end_cash_y_t_d'] ?? '-' }}
                                                </td>
                                                <td data-name="{{ $index }}-cash_details-adjustments_c_q"
                                                    class="text-end table-light">
                                                    {{ $report['cash_details'][0]['adjustments_c_q'] ?? '-' }}
                                                </td>
                                                <td data-name="{{ $index }}-cash_details-adjustments_y_t_d"
                                                    class="text-end table-light"
                                                    style="border-right:solid 2px #380092;">
                                                    {{ $report['cash_details'][0]['adjustments_y_t_d'] ?? '-' }}
                                                </td>
                                            @endif

                                            {{-- reconciliation_details --}}
                                            @if ($tableTopic == 'all' || $tableTopic == '4')
                                                <td class="text-end">
                                                    {{ $report['reconciliation_details'][0]['bank_balance_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['reconciliation_details'][0]['bank_balance_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['reconciliation_details'][0]['call_deposits_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['reconciliation_details'][0]['call_deposits_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['reconciliation_details'][0]['bank_overdrafts_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['reconciliation_details'][0]['bank_overdrafts_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['reconciliation_details'][0]['other_4_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['reconciliation_details'][0]['other_4_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['reconciliation_details'][0]['cash_equivalents_end_period_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['reconciliation_details'][0]['cash_equivalents_end_period_y_t_d'] ?? '-' }}
                                                </td>
                                                <td data-name="{{ $index }}-reconciliation_details-adjustments_c_q"
                                                    class="text-end table-light">
                                                    {{ $report['reconciliation_details'][0]['adjustments_c_q'] ?? '-' }}
                                                </td>
                                                <td data-name="{{ $index }}-reconciliation_details-adjustments_y_t_d"
                                                    class="text-end table-light"
                                                    style="border-right:solid 2px #380092;">
                                                    {{ $report['reconciliation_details'][0]['adjustments_y_t_d'] ?? '-' }}
                                                </td>
                                            @endif

                                            {{-- related_party_payments --}}
                                            @if ($tableTopic == 'all' || $tableTopic == '5')
                                                <td class="text-end">
                                                    {{ $report['related_party_payments'][0]['aggregated_1_c_q'] ?? '-' }}
                                                </td>
                                                {{-- <td class="text-end">--</td> --}}
                                                <td class="text-end">
                                                    {{ $report['related_party_payments'][0]['aggregated_2_c_q'] ?? '-' }}
                                                </td>
                                                {{-- <td class="text-end" style="border-right:solid 2px #380092;">--</td> --}}
                                                <td data-name="{{ $index }}-related_party_payments-adjustments_c_q"
                                                    class="text-end table-light"
                                                    style="border-right:solid 2px #380092;">
                                                    {{ $report['related_party_payments'][0]['adjustments_c_q'] ?? '-' }}
                                                </td>
                                            @endif

                                            {{-- financing_facilities --}}
                                            @if ($tableTopic == 'all' || $tableTopic == '6')
                                                <td class="text-end">
                                                    {{ $report['financing_facilities'][0]['loans_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_facilities'][0]['loans_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_facilities'][0]['credit_standby_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_facilities'][0]['credit_standby_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_facilities'][0]['other_5_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_facilities'][0]['other_5_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_facilities'][0]['total_financing_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $report['financing_facilities'][0]['total_financing_y_t_d'] ?? '-' }}
                                                </td>
                                                <td class="text-end" style="border-right:solid 2px #380092;">
                                                    {{ $report['financing_facilities'][0]['unused_financing_facilities_y_t_d'] ?? '-' }}
                                                </td>
                                            @endif

                                            {{-- estimated_cash_availabilities --}}
                                            @if ($tableTopic == 'all' || $tableTopic == '7')
                                                <td class="text-end">
                                                    {{ $report['estimated_cash_availabilities'][0]['net_cash_operating_c_q'] ?? '-' }}
                                                </td>

                                                <td class="text-end">
                                                    {{ $report['estimated_cash_availabilities'][0]['future_payments_for_exploration_evaluation_c_q'] ?? '-' }}
                                                </td>

                                                <td class="text-end">
                                                    {{ $report['estimated_cash_availabilities'][0]['total_relevant_payments_c_q'] ?? '-' }}
                                                </td>

                                                <td class="text-end">
                                                    {{ $report['estimated_cash_availabilities'][0]['future_cash_equivalents_end_period_c_q'] ?? '-' }}
                                                </td>

                                                <td class="text-end">
                                                    {{ $report['estimated_cash_availabilities'][0]['unused_financing_facilities_end_period_c_q'] ?? '-' }}
                                                </td>

                                                <td class="text-end">
                                                    {{ $report['estimated_cash_availabilities'][0]['total_available_funding_c_q'] ?? '-' }}
                                                </td>

                                                <td class="text-end">
                                                    {{ $report['estimated_cash_availabilities'][0]['estimated_quarterly_funding_c_q'] ?? '-' }}
                                                </td>
                                            @endif

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .dataTables_wrapper .dataTables_scroll .dataTables_scrollBody {
            overflow: auto;
        }

        .dataTables_wrapper .dataTables_scroll .dataTables_scrollHeadInner {
            width: 100% !important;
        }

        th {
            align-items: "middle";
            text-align: center;
        }

        /* .dataTables_wrapper .dataTables_scroll .dataTables_scrollHeadInner th {
            white-space: nowrap;
        } */
    </style>

    <script>
        let reportsData;
        eventListenersAdd();

        function eventListenersAdd() {
            var tds = document.getElementsByTagName("td");
            for (var i = 0; i < tds.length; i++) {
                if (tds[i].getAttribute('data-name')) {
                    tds[i].addEventListener("dblclick", editCellValue);
                }
            }

        }

        let is_report_dataloaded = false;

        function editCellValue() {

            if (is_report_dataloaded == false) {
                reportsData = @this.allReports; //parse json
                is_report_dataloaded = true;
            }
            // check this.innerHTML already has a input tag 
            if (this.querySelector("input")) {
                return;
            }
            this.innerHTML =
                "<input class='form-control-sm m-0 text-center border-0' style='max-width:60px;' type='text' value='" +
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
                    // has_edit = true;
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

            function valueCheck(inputTag) {
                console.log(inputTag.parentNode.getAttribute('data-name'));

                if (/^-?\d*(\.\d+)?$|^-$/.test(inputTag.value)) {
                    // console.log('json updated' + inputTag.value);

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
                splitDataName = dataName.split('-');
                reportIndex = splitDataName[0];
                tableName = splitDataName[1];
                cellName = splitDataName[2];
                reportsData[reportIndex][tableName][0][cellName] = value;
                // check already has in editedReportsArray 
                // if not push in
                // if yes update in
                // console.log(reportsData[reportIndex]);
                // console.log(reportIndex);
                $has_report = false;
                for (let i = 0; i < editedReportsArray.length; i++) {
                    let element = editedReportsArray[i];
                    if (element['id'] == reportsData[reportIndex]['id']) {
                        element[tableName][0][cellName] = value;
                        $has_report = true;
                        break; // Exit the loop once the condition is met
                    }
                }

                console.log(editedReportsArray);

                if ($has_report == false) {
                    editedReportsArray.push(reportsData[reportIndex]);
                }
                // if (editedReportsArray.indexOf(reportsData[reportIndex][id]) == -1) {
                //     editedReportsArray.push(reportsData[reportIndex]);
                // } else {
                //     let index = editedReportsArray.indexOf(reportsData[reportIndex]);
                //     editedReportsArray[index] = reportsData[reportIndex];
                // }
                // console.log(tableName, cellName, value);
                // console.log(editedReportsArray);
                // console.log(reportData);
            }
        }

        // let has_edit = false;
        document.getElementById('btn_save').style.display = 'none';

        let editedReportsArray = [];

        function saveData() {
            // console.log(JSON.stringify(reportData));
            Swal.fire({
                title: "Saving Reports...",
                text: 'That thing is still around?',
                html: '<i class="text-success mdi mdi-spin mdi-loading fs-48"></i>',
                // icon: 'question',
                // confirmButtonClass: 'btn btn-primary w-xs mt-2',
                // buttonsStyling: false,
                showCloseButton: false,
                showConfirmButton: false
            })
            var request = new XMLHttpRequest();
            request.open("POST", "{{ route('client.save-report') }}");
            request.setRequestHeader("Content-Type", "application/json");
            request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
            request.send(JSON.stringify(editedReportsArray));
            // console.log(JSON.stringify(editedReportsArray));


            request.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // alert("Report Saved Successfully");
                    console.log(this.responseText);

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Saved',
                        showConfirmButton: false,
                        timer: 3000,
                        showCloseButton: true
                    });
                    // has_edit = false;
                    document.getElementById('btn_save').style.display = 'none';
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Something went wrong',
                        showConfirmButton: false,
                        timer: 3000,
                        showCloseButton: true
                    });
                }
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            };
        }
    </script>

    @script
        <script>
            $wire.on('refreshTable', () => {
                // alert('hello');
                if ($.fn.DataTable.isDataTable('#buttons-datatables')) {
                    console.log('Table is already initialized');
                    $('#buttons-datatables').DataTable().destroy();
                    setTimeout(() => {
                        inizializeDataTable();
                    }, 1500);
                    return;
                }

                setTimeout(() => {

                    inizializeDataTable();
                }, 1500);

            });

            function inizializeDataTable() {
                let buttonsDataTables = new DataTable('#buttons-datatables', {
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'print'],
                    scrollX: true, // Enable horizontal scrolling
                    fixedColumns: {
                        leftColumns: 4 // Fix the first 4 columns
                    },
                    pageLength: 4,
                    order: [
                        [1, 'desc']
                    ],
                });
            }
        </script>
    @endscript


</div>
