<!-- resources/views/reports.blade.php -->
<table border="1">
    <tr>
        <th>Quarter Ending</th>
        <th>Company Name</th>
        <th>ABN</th>
        <th>Action</th>
    </tr>
    @foreach($reports as $report)
    <tr>
        <td>{{ $report->quarter_ending }}</td>
        <td>{{ $report->company_name }}</td>
        <td>{{ $report->abn }}</td>
        <td><a target="_blank" href="{{ route('report', $report->id) }}">View</td>
    </tr>
    @endforeach
</table>