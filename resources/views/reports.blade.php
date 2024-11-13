<!-- resources/views/reports.blade.php -->

@extends('layouts.app')

@section('title', 'Reports')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Quarterly Reports</h1>
    <p class="text-center mb-5">Browse through our quarterly reports and view details about each company’s financial status.</p>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Quarter Ending</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">ABN</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td>{{ $report->quarter_ending }}</td>
                    <td>{{ $report->company_name }}</td>
                    <td>{{ $report->abn }}</td>
                    <td>
                        <a target="_blank" href="{{ route('report', $report->id) }}" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection