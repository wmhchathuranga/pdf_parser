<table id="buttons-datatables" class="display table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>ABN</th>
            <th>Company Name</th>
            <th>Upload Date</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jsonData as $report)

            <tr>
                <td>{{ $report['abn'] }}</td>
                <td>{{ $report['company_name'] }}</td>
                <td>{{ $report['quarter_ending'] }}</td>
                <td class="text-center">
                    <a target="_blank" href="{{ route('client.single-report', $report['id']) }}" class="btn btn-sm btn-outline-success"><i class="ri-eye-fill align-bottom"></i></a>
                    <a target="_blank" href="{{ route('client.report-edit', $report['id']) }}" class="btn btn-sm btn-outline-primary"><i class="ri-pencil-fill align-bottom"></i></a>
                </td>
            </tr>
            
        @endforeach
        
    </tbody>
</table>
