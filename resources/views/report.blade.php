<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Report Details</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mx-auto mt-5">
        <h1 class="text-2xl font-bold mb-4">PDF Report Details</h1>
        
        <h2 class="text-xl font-semibold">General Information</h2>
        <ul class="list-disc pl-5">
            <li><strong>Quarter Ending:</strong> {{ $pdfReport->quarter_ending }}</li>
            <li><strong>Company Name:</strong> {{ $pdfReport->company_name }}</li>
            <li><strong>ABN:</strong> {{ $pdfReport->abn }}</li>
        </ul>

        <h2 class="text-xl font-semibold mt-4">Cash Flows from Operating Activities</h2>
        <ul class="list-disc pl-5">
            <li><strong>Receipts from Customers (Current Quarter):</strong> {{ $pdfReport->operatingDetails->receipts_from_customers_c_q }}</li>
            <li><strong>Receipts from Customers (Year to Date):</strong> {{ $pdfReport->operatingDetails->receipts_from_customers_y_t_d }}</li>
            <li><strong>Payments for Exploration & Evaluation (Current Quarter):</strong> {{ $pdfReport->operatingDetails->payments_exploration_evaluation_c_q }}</li>
            <li><strong>Payments for Exploration & Evaluation (Year to Date):</strong> {{ $pdfReport->operatingDetails->payments_exploration_evaluation_y_t_d }}</li>
            <li><strong>Payments for Development (Current Quarter):</strong> {{ $pdfReport->operatingDetails->payments_development_c_q }}</li>
            <li><strong>Payments for Development (Year to Date):</strong> {{ $pdfReport->operatingDetails->payments_development_y_t_d }}</li>
            <li><strong>Payments for Production (Current Quarter):</strong> {{ $pdfReport->operatingDetails->payments_production_c_q }}</li>
            <li><strong>Payments for Production (Year to Date):</strong> {{ $pdfReport->operatingDetails->payments_production_y_t_d }}</li>
            <li><strong>Payments for Staff Costs (Current Quarter):</strong> {{ $pdfReport->operatingDetails->payments_staff_costs_c_q }}</li>
            <li><strong>Payments for Staff Costs (Year to Date):</strong> {{ $pdfReport->operatingDetails->payments_staff_costs_y_t_d }}</li>
            <li><strong>Payments for Admin Costs (Current Quarter):</strong> {{ $pdfReport->operatingDetails->payments_admin_costs_c_q }}</li>
            <li><strong>Payments for Admin Costs (Year to Date):</strong> {{ $pdfReport->operatingDetails->payments_admin_costs_y_t_d }}</li>
            <li><strong>Dividends Received (Current Quarter):</strong> {{ $pdfReport->operatingDetails->dividends_received_c_q }}</li>
            <li><strong>Dividends Received (Year to Date):</strong> {{ $pdfReport->operatingDetails->dividends_received_y_t_d }}</li>
            <li><strong>Interest Received (Current Quarter):</strong> {{ $pdfReport->operatingDetails->interest_received_c_q }}</li>
            <li><strong>Interest Received (Year to Date):</strong> {{ $pdfReport->operatingDetails->interest_received_y_t_d }}</li>
            <li><strong>Interest Paid (Current Quarter):</strong> {{ $pdfReport->operatingDetails->interest_paid_c_q }}</li>
            <li><strong>Interest Paid (Year to Date):</strong> {{ $pdfReport->operatingDetails->interest_paid_y_t_d }}</li>
            <li><strong>Income Tax Paid (Current Quarter):</strong> {{ $pdfReport->operatingDetails->income_tax_paid_c_q }}</li>
            <li><strong>Income Tax Paid (Year to Date):</strong> {{ $pdfReport->operatingDetails->income_tax_paid_y_t_d }}</li>
            <li><strong>Government Tax Paid (Current Quarter):</strong> {{ $pdfReport->operatingDetails->government_tax_paid_c_q }}</li>
            <li><strong>Government Tax Paid (Year to Date):</strong> {{ $pdfReport->operatingDetails->government_tax_paid_y_t_d }}</li>
            <li><strong>Other (Current Quarter):</strong> {{ $pdfReport->operatingDetails->other_c_q }}</li>
            <li><strong>Other (Year to Date):</strong> {{ $pdfReport->operatingDetails->other_y_t_d }}</li>
            <li><strong>Net Cash from Operating Activities (Current Quarter):</strong> {{ $pdfReport->operatingDetails->net_cash_from_operating_c_q }}</li>
            <li><strong>Net Cash from Operating Activities (Year to Date):</strong> {{ $pdfReport->operatingDetails->net_cash_from_operating_y_t_d }}</li>
        </ul>

        <h2 class="text-xl font-semibold mt-4">Cash Flows from Investing Activities</h2>
        <ul class="list-disc pl-5">
            <li><strong>Payments for Entities (Current Quarter):</strong> {{ $pdfReport->investingDetails->payments_for_entities_c_q }}</li>
            <li><strong>Payments for Entities (Year to Date):</strong> {{ $pdfReport->investingDetails->payments_for_entities_y_t_d }}</li>
            <li><strong>Payments for Tenements (Current Quarter):</strong> {{ $pdfReport->investingDetails->payments_for_tenements_c_q }}</li>
            <li><strong>Payments for Tenements (Year to Date):</strong> {{ $pdfReport->investingDetails->payments_for_tenements_y_t_d }}</li>
            <li><strong>Payments for Property (Current Quarter):</strong> {{ $pdfReport->investingDetails->payments_for_property_c_q }}</li>
            <li><strong>Payments for Property (Year to Date):</strong> {{ $pdfReport->investingDetails->payments_for_property_y_t_d }}</li>
            <li><strong>Payments for Exploration & Evaluation (Current Quarter):</strong> {{ $pdfReport->investingDetails->payments_for_exploration_evaluation_c_q }}</li>
            <li><strong>Payments for Exploration & Evaluation (Year to Date):</strong> {{ $pdfReport->investingDetails->payments_for_exploration_evaluation_y_t_d }}</li>
            <li><strong>Payments for Investment (Current Quarter):</strong> {{ $pdfReport->investingDetails->payments_for_investment_c_q }}</li>
            <li><strong>Payments for Investment (Year to Date):</strong> {{ $pdfReport->investingDetails->payments_for_investment_y_t_d }}</li>
            <li><strong>Payments for Other (Current Quarter):</strong> {{ $pdfReport->investingDetails->payments_for_other_c_q }}</li>
            <li><strong>Payments for Other (Year to Date):</strong> {{ $pdfReport->investingDetails->payments_for_other_y_t_d }}</li>
            <li><strong>Proceeds from Entities (Current Quarter):</strong> {{ $pdfReport->investingDetails->proceeds_from_entities_c_q }}</li>
            <li><strong>Proceeds from Entities (Year to Date):</strong> {{ $pdfReport->investingDetails->proceeds_from_entities_y_t_d }}</li>
            <li><strong>Proceeds from Tenements (Current Quarter):</strong> {{ $pdfReport->investingDetails->proceeds_from_tenements_c_q }}</li>
            <li><strong>Proceeds from Tenements (Year to Date):</strong> {{ $pdfReport->investingDetails->proceeds_from_tenements_y_t_d }}</li>
            <li><strong>Proceeds from Property (Current Quarter):</strong> {{ $pdfReport->investingDetails->proceeds_from_property_c_q }}</li>
            <li><strong>Proceeds from Property (Year to Date):</strong> {{ $pdfReport->investingDetails->proceeds_from_property_y_t_d }}</li>
            <li><strong>Proceeds from Investment (Current Quarter):</strong> {{ $pdfReport->investingDetails->proceeds_from_investment_c_q }}</li>
            <li><strong>Proceeds from Investment (Year to Date):</strong> {{ $pdfReport->investingDetails->proceeds_from_investment_y_t_d }}</li>
            <li><strong>Proceeds from Other (Current Quarter):</strong> {{ $pdfReport->investingDetails->proceeds_from_other_c_q }}</li>
            <li><strong>Proceeds from Other (Year to Date):</strong> {{ $pdfReport->investingDetails->proceeds_from_other_y_t_d }}</li>
            <li><strong>Cash Flow from Loans (Current Quarter):</strong> {{ $pdfReport->investingDetails->cash_flow_from_loans_c_q }}</li>
            <li><strong>Cash Flow from Loans (Year to Date):</strong> {{ $pdfReport->investingDetails->cash_flow_from_loans_y_t_d }}</li>
            <li><strong>Dividends Received (Current Quarter):</strong> {{ $pdfReport->investingDetails->dividends_received_2_c_q }}</li>
            <li><strong>Dividends Received (Year to Date):</strong> {{ $pdfReport->investingDetails->dividends_received_2_y_t_d }}</li>
            <li><strong>Other (Current Quarter):</strong> {{ $pdfReport->investingDetails->other_2_c_q }}</li>
            <li><strong>Other (Year to Date):</strong> {{ $pdfReport->investingDetails->other_2_y_t_d }}</li>
            <li><strong>Net Cash from Investing Activities (Current Quarter):</strong> {{ $pdfReport->investingDetails->net_cash_from_investing_c_q }}</li>
            <li><strong>Net Cash from Investing Activities (Year to Date):</strong> {{ $pdfReport->investingDetails->net_cash_from_investing_y_t_d }}</li>
        </ul>

        <h2 class="text-xl font-semibold mt-4">Cash Flows from Financing Activities</h2>
        <ul class="list-disc pl-5">
            <li><strong>Proceeds from Equity (Current Quarter):</strong> {{ $pdfReport->financingDetails->proceeds_from_equity_c_q }}</li>
            <li><strong>Proceeds from Equity (Year to Date):</strong> {{ $pdfReport->financingDetails->proceeds_from_equity_y_t_d }}</li>
            <li><strong>Proceeds from Debt (Current Quarter):</strong> {{ $pdfReport->financingDetails->proceeds_from_debt_c_q }}</li>
            <li><strong>Proceeds from Debt (Year to Date):</strong> {{ $pdfReport->financingDetails->proceeds_from_debt_y_t_d }}</li>
            <li><strong>Proceeds from Exercise (Current Quarter):</strong> {{ $pdfReport->financingDetails->proceeds_from_exercise_c_q }}</li>
            <li><strong>Proceeds from Exercise (Year to Date):</strong> {{ $pdfReport->financingDetails->proceeds_from_exercise_y_t_d }}</li>
            <li><strong>Transaction Costs for Securities (Current Quarter):</strong> {{ $pdfReport->financingDetails->transaction_costs_for_securities_c_q }}</li>
            <li><strong>Transaction Costs for Securities (Year to Date):</strong> {{ $pdfReport->financingDetails->transaction_costs_for_securities_y_t_d }}</li>
            <li><strong>Proceeds from Borrowing (Current Quarter):</strong> {{ $pdfReport->financingDetails->proceeds_from_borrowing_c_q }}</li>
            <li><strong>Proceeds from Borrowing (Year to Date):</strong> {{ $pdfReport->financingDetails->proceeds_from_borrowing_y_t_d }}</li>
            <li><strong>Repayments of Borrowing (Current Quarter):</strong> {{ $pdfReport->financingDetails->repayments_of_borrowing_c_q }}</li>
            <li><strong>Repayments of Borrowing (Year to Date):</strong> {{ $pdfReport->financingDetails->repayments_of_borrowing_y_t_d }}</li>
            <li><strong>Transaction Costs for Borrowing (Current Quarter):</strong> {{ $pdfReport->financingDetails->transaction_costs_for_borrowing_c_q }}</li>
            <li><strong>Transaction Costs for Borrowing (Year to Date):</strong> {{ $pdfReport->financingDetails->transaction_costs_for_borrowing_y_t_d }}</li>
            <li><strong>Dividends Paid (Current Quarter):</strong> {{ $pdfReport->financingDetails->dividends_paid_c_q }}</li>
            <li><strong>Dividends Paid (Year to Date):</strong> {{ $pdfReport->financingDetails->dividends_paid_y_t_d }}</li>
            <li><strong>Other (Current Quarter):</strong> {{ $pdfReport->financingDetails->other_3_c_q }}</li>
            <li><strong>Other (Year to Date):</strong> {{ $pdfReport->financingDetails->other_3_y_t_d }}</li>
            <li><strong>Net Cash from Financing Activities (Current Quarter):</strong> {{ $pdfReport->financingDetails->net_cash_from_financing_c_q }}</li>
            <li><strong>Net Cash from Financing Activities (Year to Date):</strong> {{ $pdfReport->financingDetails->net_cash_from_financing_y_t_d }}</li>
        </ul>

        <h2 class="text-xl font-semibold mt-4">Net Increase / Decrease in Cash</h2>
        <ul class="list-disc pl-5">
            <li><strong>Beginning Cash (Current Quarter):</strong> {{ $pdfReport->cashDetails->beginning_cash_c_q }}</li>
            <li><strong>Beginning Cash (Year to Date):</strong> {{ $pdfReport->cashDetails->beginning_cash_y_t_d }}</li>
            <li><strong>Operating Cash Flow (Current Quarter):</strong> {{ $pdfReport->cashDetails->operating_cash_flow_c_q }}</li>
            <li><strong>Operating Cash Flow (Year to Date):</strong> {{ $pdfReport->cashDetails->operating_cash_flow_y_t_d }}</li>
            <li><strong>Investing Cash Flow (Current Quarter):</strong> {{ $pdfReport->cashDetails->investing_cash_flow_c_q }}</li>
            <li><strong>Investing Cash Flow (Year to Date):</strong> {{ $pdfReport->cashDetails->investing_cash_flow_y_t_d }}</li>
            <li><strong>Financing Cash Flow (Current Quarter):</strong> {{ $pdfReport->cashDetails->financing_cash_flow_c_q }}</li>
            <li><strong>Financing Cash Flow (Year to Date):</strong> {{ $pdfReport->cashDetails->financing_cash_flow_y_t_d }}</li>
            <li><strong>Effect of Movement (Current Quarter):</strong> {{ $pdfReport->cashDetails->effect_of_movement_c_q }}</li>
            <li><strong>Effect of Movement (Year to Date):</strong> {{ $pdfReport->cashDetails->effect_of_movement_y_t_d }}</li>
            <li><strong>End Cash (Current Quarter):</strong> {{ $pdfReport->cashDetails->end_cash_c_q }}</li>
            <li><strong>End Cash (Year to Date):</strong> {{ $pdfReport->cashDetails->end_cash_y_t_d }}</li>
            <li><strong>Bank Balance (Current Quarter):</strong> {{ $pdfReport->cashDetails->bank_balance_c_q }}</li>
            <li><strong>Bank Balance (Year to Date):</strong> {{ $pdfReport->cashDetails->bank_balance_y_t_d }}</li>
            <li><strong>Call Deposits (Current Quarter):</strong> {{ $pdfReport->cashDetails->call_deposits_c_q }}</li>
            <li><strong>Call Deposits (Year to Date):</strong> {{ $pdfReport->cashDetails->call_deposits_y_t_d }}</li>
            <li><strong>Bank Overdrafts (Current Quarter):</strong> {{ $pdfReport->cashDetails->bank_overdrafts_c_q }}</li>
            <li><strong>Bank Overdrafts (Year to Date):</strong> {{ $pdfReport->cashDetails->bank_overdrafts_y_t_d }}</li>
            <li><strong>Other (Current Quarter):</strong> {{ $pdfReport->cashDetails->other_4_c_q }}</li>
            <li><strong>Other (Year to Date):</strong> {{ $pdfReport->cashDetails->other_4_y_t_d }}</li>
            <li><strong>Cash Equivalents End Period (Current Quarter):</strong> {{ $pdfReport->cashDetails->cash_equivalents_end_period_c_q }}</li>
            <li><strong>Cash Equivalents End Period (Year to Date):</strong> {{ $pdfReport->cashDetails->cash_equivalents_end_period_y_t_d }}</li>
        </ul>
    </div>
</body>
</html>