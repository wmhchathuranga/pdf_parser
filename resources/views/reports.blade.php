<!-- resources/views/reports.blade.php -->
<table border="1">
    <tr>
        <th>Quarter Ending</th>
        <th>Company Name</th>
        <th>ABN</th>
        <th>Receipts from Customers</th>
        <th>Staff Costs</th>
        <th>Admin Costs</th>
        <th>Cash Equivalents End Period</th>
    </tr>
    @foreach($reports as $report)
    <tr>
        <td>{{ $report->quarter_ending }}</td>
        <td>{{ $report->company_name }}</td>
        <td>{{ $report->abn }}</td>
        <td>{{ $report->receipts_from_customers }}</td>
        <td>{{ $report->payments_staff_costs }}</td>
        <td>{{ $report->payments_admin_costs }}</td>
        <td>{{ $report->cash_equivalents_end_period }}</td>
    </tr>
    @endforeach
</table>