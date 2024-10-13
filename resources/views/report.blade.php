@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">PDF Report Details</h1>

        <!-- General Information -->
        <h2 class="mb-3">General Information</h2>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Quarter Ending</th>
                    <td>{{ $pdfReport->quarter_ending }}</td>
                </tr>
                <tr>
                    <th>Company Name</th>
                    <td>{{ $pdfReport->company_name }}</td>
                </tr>
                <tr>
                    <th>ABN</th>
                    <td>{{ $pdfReport->abn }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Cash Flows from Operating Activities -->
        <h2 class="mt-4 mb-3">Cash Flows from Operating Activities</h2>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Details</th>
                    <th>Current Quarter</th>
                    <th>Year to Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Receipts from Customers</td>
                    <td>{{ $pdfReport->operatingDetails->receipts_from_customers_c_q }}</td>
                    <td>{{ $pdfReport->operatingDetails->receipts_from_customers_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Payments for Exploration & Evaluation</td>
                    <td>{{ $pdfReport->operatingDetails->payments_exploration_evaluation_c_q }}</td>
                    <td>{{ $pdfReport->operatingDetails->payments_exploration_evaluation_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Payments for Development</td>
                    <td>{{ $pdfReport->operatingDetails->payments_development_c_q }}</td>
                    <td>{{ $pdfReport->operatingDetails->payments_development_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Payments for Production</td>
                    <td>{{ $pdfReport->operatingDetails->payments_production_c_q }}</td>
                    <td>{{ $pdfReport->operatingDetails->payments_production_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Payments for Staff Costs</td>
                    <td>{{ $pdfReport->operatingDetails->payments_staff_costs_c_q }}</td>
                    <td>{{ $pdfReport->operatingDetails->payments_staff_costs_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Payments for Admin Costs</td>
                    <td>{{ $pdfReport->operatingDetails->payments_admin_costs_c_q }}</td>
                    <td>{{ $pdfReport->operatingDetails->payments_admin_costs_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Dividends Received</td>
                    <td>{{ $pdfReport->operatingDetails->dividends_received_c_q }}</td>
                    <td>{{ $pdfReport->operatingDetails->dividends_received_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Interest Received</td>
                    <td>{{ $pdfReport->operatingDetails->interest_received_c_q }}</td>
                    <td>{{ $pdfReport->operatingDetails->interest_received_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Interest Paid</td>
                    <td>{{ $pdfReport->operatingDetails->interest_paid_c_q }}</td>
                    <td>{{ $pdfReport->operatingDetails->interest_paid_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Income Tax Paid</td>
                    <td>{{ $pdfReport->operatingDetails->income_tax_paid_c_q }}</td>
                    <td>{{ $pdfReport->operatingDetails->income_tax_paid_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Government Tax Paid</td>
                    <td>{{ $pdfReport->operatingDetails->government_tax_paid_c_q }}</td>
                    <td>{{ $pdfReport->operatingDetails->government_tax_paid_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Other</td>
                    <td>{{ $pdfReport->operatingDetails->other_c_q }}</td>
                    <td>{{ $pdfReport->operatingDetails->other_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Net Cash from Operating Activities</td>
                    <td>{{ $pdfReport->operatingDetails->net_cash_from_operating_c_q }}</td>
                    <td>{{ $pdfReport->operatingDetails->net_cash_from_operating_y_t_d }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Cash Flows from Investing Activities -->
        <h2 class="text-xl font-semibold mt-4">Cash Flows from Investing Activities</h2>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Activity</th>
                    <th>Current Quarter</th>
                    <th>Year to Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Payments for Entities</td>
                    <td>{{ $pdfReport->investingDetails->payments_for_entities_c_q }}</td>
                    <td>{{ $pdfReport->investingDetails->payments_for_entities_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Payments for Tenements</td>
                    <td>{{ $pdfReport->investingDetails->payments_for_tenements_c_q }}</td>
                    <td>{{ $pdfReport->investingDetails->payments_for_tenements_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Payments for Property</td>
                    <td>{{ $pdfReport->investingDetails->payments_for_property_c_q }}</td>
                    <td>{{ $pdfReport->investingDetails->payments_for_property_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Payments for Exploration and Evaluation</td>
                    <td>{{ $pdfReport->investingDetails->payments_for_exploration_evaluation_c_q }}</td>
                    <td>{{ $pdfReport->investingDetails->payments_for_exploration_evaluation_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Payments for Investment</td>
                    <td>{{ $pdfReport->investingDetails->payments_for_investment_c_q }}</td>
                    <td>{{ $pdfReport->investingDetails->payments_for_investment_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Payments for Other</td>
                    <td>{{ $pdfReport->investingDetails->payments_for_other_c_q }}</td>
                    <td>{{ $pdfReport->investingDetails->payments_for_other_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Proceeds from Entities</td>
                    <td>{{ $pdfReport->investingDetails->proceeds_from_entities_c_q }}</td>
                    <td>{{ $pdfReport->investingDetails->proceeds_from_entities_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Proceeds from Tenements</td>
                    <td>{{ $pdfReport->investingDetails->proceeds_from_tenements_c_q }}</td>
                    <td>{{ $pdfReport->investingDetails->proceeds_from_tenements_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Proceeds from Property</td>
                    <td>{{ $pdfReport->investingDetails->proceeds_from_property_c_q }}</td>
                    <td>{{ $pdfReport->investingDetails->proceeds_from_property_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Proceeds from Investment</td>
                    <td>{{ $pdfReport->investingDetails->proceeds_from_investment_c_q }}</td>
                    <td>{{ $pdfReport->investingDetails->proceeds_from_investment_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Proceeds from Other</td>
                    <td>{{ $pdfReport->investingDetails->proceeds_from_other_c_q }}</td>
                    <td>{{ $pdfReport->investingDetails->proceeds_from_other_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Cash Flow from Loans</td>
                    <td>{{ $pdfReport->investingDetails->cash_flow_from_loans_c_q }}</td>
                    <td>{{ $pdfReport->investingDetails->cash_flow_from_loans_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Dividends Received</td>
                    <td>{{ $pdfReport->investingDetails->dividends_received_2_c_q }}</td>
                    <td>{{ $pdfReport->investingDetails->dividends_received_2_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Other</td>
                    <td>{{ $pdfReport->investingDetails->other_2_c_q }}</td>
                    <td>{{ $pdfReport->investingDetails->other_2_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Net Cash from Investing Activities</td>
                    <td>{{ $pdfReport->investingDetails->net_cash_from_investing_c_q }}</td>
                    <td>{{ $pdfReport->investingDetails->net_cash_from_investing_y_t_d }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Cash Flows from Financing Activities -->
        <h2 class="text-xl font-semibold mt-4">Cash Flows from Financing Activities</h2>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Activity</th>
                    <th>Current Quarter</th>
                    <th>Year to Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Proceeds from Equity</td>
                    <td>{{ $pdfReport->financingDetails->proceeds_from_equity_c_q }}</td>
                    <td>{{ $pdfReport->financingDetails->proceeds_from_equity_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Proceeds from Debt</td>
                    <td>{{ $pdfReport->financingDetails->proceeds_from_debt_c_q }}</td>
                    <td>{{ $pdfReport->financingDetails->proceeds_from_debt_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Proceeds from Exercise of Options</td>
                    <td>{{ $pdfReport->financingDetails->proceeds_from_exercise_c_q }}</td>
                    <td>{{ $pdfReport->financingDetails->proceeds_from_exercise_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Transaction Costs for Securities</td>
                    <td>{{ $pdfReport->financingDetails->transaction_costs_for_securities_c_q }}</td>
                    <td>{{ $pdfReport->financingDetails->transaction_costs_for_securities_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Proceeds from Borrowing</td>
                    <td>{{ $pdfReport->financingDetails->proceeds_from_borrowing_c_q }}</td>
                    <td>{{ $pdfReport->financingDetails->proceeds_from_borrowing_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Repayments of Borrowing</td>
                    <td>{{ $pdfReport->financingDetails->repayments_of_borrowing_c_q }}</td>
                    <td>{{ $pdfReport->financingDetails->repayments_of_borrowing_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Transaction Costs for Borrowing</td>
                    <td>{{ $pdfReport->financingDetails->transaction_costs_for_borrowing_c_q }}</td>
                    <td>{{ $pdfReport->financingDetails->transaction_costs_for_borrowing_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Dividends Paid</td>
                    <td>{{ $pdfReport->financingDetails->dividends_paid_c_q }}</td>
                    <td>{{ $pdfReport->financingDetails->dividends_paid_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Other Financing Activities</td>
                    <td>{{ $pdfReport->financingDetails->other_3_c_q }}</td>
                    <td>{{ $pdfReport->financingDetails->other_3_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Net Cash from Financing Activities</td>
                    <td>{{ $pdfReport->financingDetails->net_cash_from_financing_c_q }}</td>
                    <td>{{ $pdfReport->financingDetails->net_cash_from_financing_y_t_d }}</td>
                </tr>
            </tbody>
        </table>

        {{-- Net increase / (decrease) in cash --}}

        <h2 class="text-xl font-semibold mt-4">Cash Flow Summary</h2>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Cash Flow Category</th>
                    <th>Current Quarter</th>
                    <th>Year to Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Beginning Cash</td>
                    <td>{{ $pdfReport->cashDetails->beginning_cash_c_q }}</td>
                    <td>{{ $pdfReport->cashDetails->begining_cash_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Operating Cash Flow</td>
                    <td>{{ $pdfReport->cashDetails->operating_cash_flow_c_q }}</td>
                    <td>{{ $pdfReport->cashDetails->operating_cash_flow_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Investing Cash Flow</td>
                    <td>{{ $pdfReport->cashDetails->investing_cash_flow_c_q }}</td>
                    <td>{{ $pdfReport->cashDetails->investing_cash_flow_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Financing Cash Flow</td>
                    <td>{{ $pdfReport->cashDetails->financing_cash_flow_c_q }}</td>
                    <td>{{ $pdfReport->cashDetails->financing_cash_flow_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Effect of Movement on Cash</td>
                    <td>{{ $pdfReport->cashDetails->effect_of_movement_c_q }}</td>
                    <td>{{ $pdfReport->cashDetails->effect_of_movement_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Ending Cash</td>
                    <td>{{ $pdfReport->cashDetails->end_cash_c_q }}</td>
                    <td>{{ $pdfReport->cashDetails->end_cash_y_t_d }}</td>
                </tr>
            </tbody>
        </table>

        {{-- Reconciliation of cash and cash equivalents --}}

        <h2 class="text-xl font-semibold mt-4">Reconciliation of Cash and Cash Equivalents</h2>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Category</th>
                    <th>Current Quarter</th>
                    <th>Year to Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Bank Balance</td>
                    <td>{{ $pdfReport->cashDetails->bank_balance_c_q }}</td>
                    <td>{{ $pdfReport->cashDetails->bank_balance_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Call Deposits</td>
                    <td>{{ $pdfReport->cashDetails->call_deposits_c_q }}</td>
                    <td>{{ $pdfReport->cashDetails->call_deposits_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Bank Overdrafts</td>
                    <td>{{ $pdfReport->cashDetails->bank_overdrafts_c_q }}</td>
                    <td>{{ $pdfReport->cashDetails->bank_overdrafts_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Other</td>
                    <td>{{ $pdfReport->cashDetails->other_4_c_q }}</td>
                    <td>{{ $pdfReport->cashDetails->other_4_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Cash Equivalents at End of Period</td>
                    <td>{{ $pdfReport->cashDetails->cash_equivalents_end_period_c_q }}</td>
                    <td>{{ $pdfReport->cashDetails->cash_equivalents_end_period_y_t_d }}</td>
                </tr>
            </tbody>
        </table>


        {{-- Payments to Related Parties --}}

        <h2 class="text-xl font-semibold mt-4">Payments to Related Parties</h2>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Category</th>
                    <th>Current Quarter</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Aggregated Payment 1</td>
                    <td>{{ $pdfReport->cashDetails->aggregated_1_c_q }}</td>
                </tr>
                <tr>
                    <td>Aggregated Payment 2</td>
                    <td>{{ $pdfReport->cashDetails->aggregated_2_c_q }}</td>
                </tr>
            </tbody>
        </table>

        {{-- Financing facilities --}}

        <h2 class="text-xl font-semibold mt-4">Financing and Credit Facilities</h2>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Category</th>
                    <th>Current Quarter (C-Q)</th>
                    <th>Year to Date (Y-T-D)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Loans</td>
                    <td>{{ $pdfReport->cashDetails->loans_c_q }}</td>
                    <td>{{ $pdfReport->cashDetails->loans_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Credit Standby Arrangements</td>
                    <td>{{ $pdfReport->cashDetails->credit_standby_c_q }}</td>
                    <td>{{ $pdfReport->cashDetails->credit_standby_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Other Financing</td>
                    <td>{{ $pdfReport->cashDetails->other_5_c_q }}</td>
                    <td>{{ $pdfReport->cashDetails->other_5_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Total Financing</td>
                    <td>{{ $pdfReport->cashDetails->total_financing_c_q }}</td>
                    <td>{{ $pdfReport->cashDetails->total_financing_y_t_d }}</td>
                </tr>
                <tr>
                    <td>Unused Financing Facilities</td>
                    <td colspan="2">{{ $pdfReport->cashDetails->unused_financing_facilities_y_t_d }}</td>
                </tr>
            </tbody>
        </table>

        {{-- Future operations --}}

        <h2 class="text-xl font-semibold mt-4">Cash Flow and Funding</h2>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Category</th>
                    <th>Current Quarter (C-Q)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Net Cash from Operating Activities</td>
                    <td>{{ $pdfReport->cashDetails->net_cash_operating_c_q }}</td>
                </tr>
                <tr>
                    <td>Payments for Exploration & Evaluation</td>
                    <td>{{ $pdfReport->cashDetails->future_payments_for_exploration_evaluation_c_q }}</td>
                </tr>
                <tr>
                    <td>Total Relevant Payments</td>
                    <td>{{ $pdfReport->cashDetails->total_relevant_payments_c_q }}</td>
                </tr>
                <tr>
                    <td>Future Cash Equivalents (End of Period)</td>
                    <td>{{ $pdfReport->cashDetails->future_cash_equivalents_end_period_c_q }}</td>
                </tr>
                <tr>
                    <td>Unused Financing Facilities (End of Period)</td>
                    <td>{{ $pdfReport->cashDetails->unused_financing_facilities_end_period_c_q }}</td>
                </tr>
                <tr>
                    <td>Total Available Funding</td>
                    <td>{{ $pdfReport->cashDetails->total_available_funding_c_q }}</td>
                </tr>
                <tr>
                    <td>Estimated Quarterly Funding</td>
                    <td>{{ $pdfReport->cashDetails->estimated_quarterly_funding_c_q }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
