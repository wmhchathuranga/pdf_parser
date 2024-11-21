<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body d-flex justify-content-end">
                    <div class="col-3 col-lg-4 pe-3">
                        <select class="form-control my-auto" data-choices name="choices-single-default" id="choices-single-default" wire:change="changeCompany($event.target.value)">
                            <option value="">Search by ABN</option>
                            @if ($companies != null)
                                @foreach ($companies as $company)
                                    <option value="{{ $company['abn'] }}" {{ $selectedCompany == $company['abn'] ? 'selected' : '' }}>{{ $company['company_name'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12"></div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive pb-4">
                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ABN</th>
                                    <th>Company Name</th>
                                    <th>Quarter ended (“current quarter”)</th>
                                    <th>Upload Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allReports as $report)
                        
                                    <tr>
                                        <td>{{ $report['abn'] }}</td>
                                        <td>{{ $report['company_name'] }}</td>
                                        <td>{{ $report['quarter_ending'] }}</td>
                                        <td>{{ \Carbon\Carbon::parse($report['created_at'])->format('d F Y H:i') }}</td>
                                        <td class="text-center">
                                            <a target="_blank" href="{{ route('client.single-report', $report['id']) }}" class="btn btn-sm btn-outline-success"><i class="ri-eye-fill align-bottom"></i></a>
                                            <a target="_blank" href="{{ route('client.report-edit', $report['id']) }}" class="btn btn-sm btn-outline-primary"><i class="ri-pencil-fill align-bottom"></i></a>
                                        </td>
                                    </tr>
                                    
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>


</div>

