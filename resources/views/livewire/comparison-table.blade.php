<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body d-flex justify-content-end">
                    <div class="col-3 col-lg-4 pe-3">
                        <select onchange="refreshTableJs()" class="form-control my-auto" data-choices
                            name="choices-single-default" id="choices-single-default"
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
                    <div class="col-auto">
                        <select onchange="refreshTableJs()" class="form-select my-auto"
                            wire:change="changeTableTopic($event.target.value)">
                            <option value="all" {{ $tableTopic == 'all' ? 'selected' : '' }}>All</option>
                            <option value="0" {{ $tableTopic == '0' ? 'selected' : '' }}>Cash flows from operating
                                activities</option>
                            <option value="1" {{ $tableTopic == '1' ? 'selected' : '' }}>Cash flows from investing
                                activities</option>
                            <option value="2" {{ $tableTopic == '2' ? 'selected' : '' }}>Cash flows from financing
                                activities</option>
                            <option value="3" {{ $tableTopic == '3' ? 'selected' : '' }}>Cash flow details</option>
                            <option value="4" {{ $tableTopic == '4' ? 'selected' : '' }}>Reconciliation details
                            </option>
                            <option value="5" {{ $tableTopic == '5' ? 'selected' : '' }}>Related party payments
                            </option>
                            <option value="6" {{ $tableTopic == '6' ? 'selected' : '' }}>Financing facilities
                            </option>
                            <option value="7" {{ $tableTopic == '7' ? 'selected' : '' }}>Estimated cash
                                availabilities</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive pb-4">
                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th colspan="4" class="bg-white" style="left: 0px; position: sticky;"></th>
                                    @if ($tableTopic == 'all' || $tableTopic == '0')
                                        <th colspan="26" class="text-center table-dark text-white">Cash Flows from Operating
                                            Activities</th>
                                    @endif
                                    @if ($tableTopic == 'all' || $tableTopic == '1')
                                        <th colspan="30" class="text-center table-dark text-white">Cash Flows from Investing
                                            Activities</th>
                                    @endif
                                    @if ($tableTopic == 'all' || $tableTopic == '2')
                                        <th colspan="20" class="text-center table-dark text-white">Cash Flows from Financing
                                            Activities</th>
                                    @endif
                                    @if ($tableTopic == 'all' || $tableTopic == '3')
                                        <th colspan="12" class="text-center table-dark text-white">Cash Flow Summary</th>
                                    @endif
                                    @if ($tableTopic == 'all' || $tableTopic == '4')
                                        <th colspan="10" class="text-center table-dark text-white">Reconciliation of Cash and Cash
                                            Equivalents</th>
                                    @endif
                                    @if ($tableTopic == 'all' || $tableTopic == '5')
                                        <th colspan="4" class="text-center table-dark text-white">Payments to Related Parties
                                        </th>
                                    @endif
                                    @if ($tableTopic == 'all' || $tableTopic == '6')
                                        <th colspan="10" class="text-center table-dark text-white">Financing and Credit Facilities
                                        </th>
                                    @endif
                                    @if ($tableTopic == 'all' || $tableTopic == '7')
                                        <th colspan="14" class="text-center table-dark text-white">Cash Flow and Funding</th>
                                    @endif
                                </tr>
                                <tr>
                                    <th rowspan="2">Action</th>
                                    <th rowspan="2">Quarter Ending</th>
                                    <th rowspan="2">Name of Entity</th>
                                    <th rowspan="2" class="">ABN</th>

                                    @if ($tableTopic == 'all' || $tableTopic == '0')
                                        <th colspan="2">Receipts from Customers</th>
                                        <th colspan="2">Payments for Exploration & Evaluation</th>
                                        <th colspan="2">Payments for Development</th>
                                        <th colspan="2">Payments for Production</th>
                                        <th colspan="2">Payments for Staff Costs</th>
                                        <th colspan="2">Payments for Admin Costs</th>
                                        <th colspan="2">Dividends Received</th>
                                        <th colspan="2">Interest Received</th>
                                        <th colspan="2">Interest Paid</th>
                                        <th colspan="2">Income Tax Paid</th>
                                        <th colspan="2">Government Tax Paid</th>
                                        <th colspan="2">Other</th>
                                        <th colspan="2" style="border-right:solid 2px #380092;">Net Cash from Operating Activities</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '1')
                                        <th colspan="2">Payments for Entities</th>
                                        <th colspan="2">Payments for Tenements</th>
                                        <th colspan="2">Payments for Property</th>
                                        <th colspan="2">Payments for Exploration and Evaluation</th>
                                        <th colspan="2">Payments for Investment</th>
                                        <th colspan="2">Payments for Other</th>
                                        <th colspan="2">Proceeds from Entities</th>
                                        <th colspan="2">Proceeds from Tenements</th>
                                        <th colspan="2">Proceeds from Property</th>
                                        <th colspan="2">Proceeds from Investment</th>
                                        <th colspan="2">Proceeds from Other</th>
                                        <th colspan="2">Cash Flow from Loans</th>
                                        <th colspan="2">Dividends Received</th>
                                        <th colspan="2">Other</th>
                                        <th colspan="2" style="border-right:solid 2px #380092;">Net Cash from Investing Activitie</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '2')
                                        <th colspan="2">Proceeds from Equity</th>
                                        <th colspan="2">Proceeds from Debt</th>
                                        <th colspan="2">Proceeds from Exercise of Options</th>
                                        <th colspan="2">Transaction Costs for Securities</th>
                                        <th colspan="2">Proceeds from Borrowing</th>
                                        <th colspan="2">Repayments of Borrowing</th>
                                        <th colspan="2">Transaction Costs for Borrowing</th>
                                        <th colspan="2">Dividends Paid</th>
                                        <th colspan="2">Other Financing Activities</th>
                                        <th colspan="2" style="border-right:solid 2px #380092;">Net Cash from Financing Activities</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '3')
                                        <th colspan="2">Beginning Cash</th>
                                        <th colspan="2">Operating Cash Flow</th>
                                        <th colspan="2">Investing Cash Flow</th>
                                        <th colspan="2">Financing Cash Flow</th>
                                        <th colspan="2">Effect of Movement on Cash</th>
                                        <th colspan="2" style="border-right:solid 2px #380092;">Ending Cash</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '4')
                                        <th colspan="2">Bank Balance</th>
                                        <th colspan="2">Call Deposits</th>
                                        <th colspan="2">Bank Overdrafts</th>
                                        <th colspan="2">Other</th>
                                        <th colspan="2" style="border-right:solid 2px #380092;">Cash Equivalents at End of Period</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '5')
                                        <th colspan="2">Aggregated Payment 1</th>
                                        <th colspan="2" style="border-right:solid 2px #380092;">Aggregated Payment 2</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '6')
                                        <th colspan="2">Loans</th>
                                        <th colspan="2">Credit Standby Arrangements</th>
                                        <th colspan="2">Other Financing</th>
                                        <th colspan="2">Total Financing</th>
                                        <th colspan="2" style="border-right:solid 2px #380092;">Unused Financing Facilities</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '7')
                                        <th colspan="2">Net Cash from Operating Activities</th>
                                        <th colspan="2">Payments for Exploration & Evaluation</th>
                                        <th colspan="2">Total Relevant Payments</th>
                                        <th colspan="2">Future Cash Equivalents (End of Period)</th>
                                        <th colspan="2">Unused Financing Facilities (End of Period)</th>
                                        <th colspan="2">Total Available Funding</th>
                                        <th colspan="2">Estimated Quarterly Funding</th>
                                    @endif


                                </tr>
                                <tr>
                                    @if ($tableTopic == 'all' || $tableTopic == '0')
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th style="border-right:solid 2px #380092;">Year to date (6 months) $A’000</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '1')
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th style="border-right:solid 2px #380092;">Year to date (6 months) $A’000</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '2')
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th style="border-right:solid 2px #380092;">Year to date (6 months) $A’000</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '3')
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th style="border-right:solid 2px #380092;">Year to date (6 months) $A’000</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '4')
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th style="border-right:solid 2px #380092;">Year to date (6 months) $A’000</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '5')
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th style="border-right:solid 2px #380092;">Year to date (6 months) $A’000</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '6')
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th style="border-right:solid 2px #380092;">Year to date (6 months) $A’000</th>
                                    @endif

                                    @if ($tableTopic == 'all' || $tableTopic == '7')
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                        <th>Current quarter $A’000</th>
                                        <th>Year to date (6 months) $A’000</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if ($allReports != null)
                                    @foreach ($allReports as $report)
                                        <tr>
                                            <td class="text-center"><a href="{{ route('client.single-report', $report['id']) }}"
                                                    class="btn btn-sm btn-secondary">view</a></td>
                                            <td>{{ $report['quarter_ending'] }}</td>
                                            <td>{{ $report['company_name'] }}</td>
                                            <td>{{ $report['abn'] }}</td>

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
                                                <td class="text-end" style="border-right:solid 2px #380092;">
                                                    {{ $report['operating_details'][0]['net_cash_from_operating_y_t_d'] ?? '-' }}
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
                                                <td class="text-end" style="border-right:solid 2px #380092;">
                                                    {{ $report['investing_details'][0]['net_cash_from_investing_y_t_d'] ?? '-' }}
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
                                                <td class="text-end" style="border-right:solid 2px #380092;">
                                                    {{ $report['financing_details'][0]['net_cash_from_financing_y_t_d'] ?? '-' }}
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
                                                <td class="text-end" style="border-right:solid 2px #380092;">
                                                    {{ $report['cash_details'][0]['end_cash_y_t_d'] ?? '-' }}
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
                                                <td class="text-end" style="border-right:solid 2px #380092;">
                                                    {{ $report['reconciliation_details'][0]['cash_equivalents_end_period_y_t_d'] ?? '-' }}
                                                </td>
                                            @endif

                                            {{-- related_party_payments --}}
                                            @if ($tableTopic == 'all' || $tableTopic == '5')
                                                <td class="text-end">
                                                    {{ $report['related_party_payments'][0]['aggregated_1_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">--</td>
                                                <td class="text-end">
                                                    {{ $report['related_party_payments'][0]['aggregated_2_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end" style="border-right:solid 2px #380092;">--</td>
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
                                                <td class="text-end">--</td>
                                                <td class="text-end" style="border-right:solid 2px #380092;">
                                                    {{ $report['financing_facilities'][0]['unused_financing_facilities_y_t_d'] ?? '-' }}
                                                </td>
                                            @endif

                                            {{-- estimated_cash_availabilities --}}
                                            @if ($tableTopic == 'all' || $tableTopic == '7')
                                                <td class="text-end">
                                                    {{ $report['estimated_cash_availabilities'][0]['net_cash_operating_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">--</td>

                                                <td class="text-end">
                                                    {{ $report['estimated_cash_availabilities'][0]['future_payments_for_exploration_evaluation_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">--</td>

                                                <td class="text-end">
                                                    {{ $report['estimated_cash_availabilities'][0]['total_relevant_payments_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">--</td>

                                                <td class="text-end">
                                                    {{ $report['estimated_cash_availabilities'][0]['future_cash_equivalents_end_period_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">--</td>

                                                <td class="text-end">
                                                    {{ $report['estimated_cash_availabilities'][0]['unused_financing_facilities_end_period_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">--</td>

                                                <td class="text-end">
                                                    {{ $report['estimated_cash_availabilities'][0]['total_available_funding_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">--</td>

                                                <td class="text-end">
                                                    {{ $report['estimated_cash_availabilities'][0]['estimated_quarterly_funding_c_q'] ?? '-' }}
                                                </td>
                                                <td class="text-end">--</td>
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

        /* .dataTables_wrapper .dataTables_scroll .dataTables_scrollHeadInner th {
            white-space: nowrap;
        } */
    </style>


</div>
