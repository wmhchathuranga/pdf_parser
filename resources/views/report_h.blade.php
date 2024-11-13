@extends('layouts.app')

@section('title', 'Report Details')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">PDF Report Details - Horizontal Layout</h1>

    <!-- Horizontal Table -->
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Quarter Ending</th>
                <th>Name of Entity</th>
                <th>ABN</th>
                <th>Receipts from Customers</th>
                <th>Payments for Exploration & Evaluation</th>
                <th>Payments for Development</th>
                <th>Payments for Production</th>
                <th>Payments for Staff Costs</th>
                <th>Payments for Admin Costs</th>
                <th>Dividends Received</th>
                <th>Interest Received</th>
                <th>Interest Paid</th>
                <th>Income Tax Paid</th>
                <th>Government Tax Paid</th>
                <th>Other</th>
                <th>Net Cash from Operating Activities</th>
                <th>Investing Cash Flow</th>
                <th>Financing Cash Flow</th>
                <th>Effect of Movement on Cash</th>
                <th>Ending Cash</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through the report data -->
            <tr>
                <td>{{ $pdfReport->quarter_ending }}</td>
                <td>{{ $pdfReport->company_name }}</td>
                <td>{{ $pdfReport->abn }}</td>

                <!-- Receipts from Customers -->
                <td>
                    Current: {{ $pdfReport->operatingDetails->receipts_from_customers_c_q }} <br>
                    Year to Date: {{ $pdfReport->operatingDetails->receipts_from_customers_y_t_d }}
                </td>

                <!-- Payments for Exploration & Evaluation -->
                <td>
                    Current: {{ $pdfReport->operatingDetails->payments_exploration_evaluation_c_q }} <br>
                    Year to Date: {{ $pdfReport->operatingDetails->payments_exploration_evaluation_y_t_d }}
                </td>

                <!-- Payments for Development -->
                <td>
                    Current: {{ $pdfReport->operatingDetails->payments_development_c_q }} <br>
                    Year to Date: {{ $pdfReport->operatingDetails->payments_development_y_t_d }}
                </td>

                <!-- Payments for Production -->
                <td>
                    Current: {{ $pdfReport->operatingDetails->payments_production_c_q }} <br>
                    Year to Date: {{ $pdfReport->operatingDetails->payments_production_y_t_d }}
                </td>

                <!-- Payments for Staff Costs -->
                <td>
                    Current: {{ $pdfReport->operatingDetails->payments_staff_costs_c_q }} <br>
                    Year to Date: {{ $pdfReport->operatingDetails->payments_staff_costs_y_t_d }}
                </td>

                <!-- Payments for Admin Costs -->
                <td>
                    Current: {{ $pdfReport->operatingDetails->payments_admin_costs_c_q }} <br>
                    Year to Date: {{ $pdfReport->operatingDetails->payments_admin_costs_y_t_d }}
                </td>

                <!-- Dividends Received -->
                <td>
                    Current: {{ $pdfReport->operatingDetails->dividends_received_c_q }} <br>
                    Year to Date: {{ $pdfReport->operatingDetails->dividends_received_y_t_d }}
                </td>

                <!-- Interest Received -->
                <td>
                    Current: {{ $pdfReport->operatingDetails->interest_received_c_q }} <br>
                    Year to Date: {{ $pdfReport->operatingDetails->interest_received_y_t_d }}
                </td>

                <!-- Interest Paid -->
                <td>
                    Current: {{ $pdfReport->operatingDetails->interest_paid_c_q }} <br>
                    Year to Date: {{ $pdfReport->operatingDetails->interest_paid_y_t_d }}
                </td>

                <!-- Income Tax Paid -->
                <td>
                    Current: {{ $pdfReport->operatingDetails->income_tax_paid_c_q }} <br>
                    Year to Date: {{ $pdfReport->operatingDetails->income_tax_paid_y_t_d }}
                </td>

                <!-- Government Tax Paid -->
                <td>
                    Current: {{ $pdfReport->operatingDetails->government_tax_paid_c_q }} <br>
                    Year to Date: {{ $pdfReport->operatingDetails->government_tax_paid_y_t_d }}
                </td>

                <!-- Other -->
                <td>
                    Current: {{ $pdfReport->operatingDetails->other_c_q }} <br>
                    Year to Date: {{ $pdfReport->operatingDetails->other_y_t_d }}
                </td>

                <!-- Net Cash from Operating Activities -->
                <td>
                    Current: {{ $pdfReport->operatingDetails->net_cash_from_operating_c_q }} <br>
                    Year to Date: {{ $pdfReport->operatingDetails->net_cash_from_operating_y_t_d }}
                </td>

                <!-- Investing Cash Flow -->
                <td>
                    Current: {{ $pdfReport->cashDetails->investing_cash_flow_c_q }} <br>
                    Year to Date: {{ $pdfReport->cashDetails->investing_cash_flow_y_t_d }}
                </td>

                <!-- Financing Cash Flow -->
                <td>
                    Current: {{ $pdfReport->cashDetails->financing_cash_flow_c_q }} <br>
                    Year to Date: {{ $pdfReport->cashDetails->financing_cash_flow_y_t_d }}
                </td>

                <!-- Effect of Movement on Cash -->
                <td>
                    Current: {{ $pdfReport->cashDetails->effect_of_movement_c_q }} <br>
                    Year to Date: {{ $pdfReport->cashDetails->effect_of_movement_y_t_d }}
                </td>

                <!-- Ending Cash -->
                <td>
                    Current: {{ $pdfReport->cashDetails->end_cash_c_q }} <br>
                    Year to Date: {{ $pdfReport->cashDetails->end_cash_y_t_d }}
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection