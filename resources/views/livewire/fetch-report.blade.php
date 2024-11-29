<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body d-flex justify-content-end">
                <div class="col-auto">
                    <div class="row">
                        <div class="col-auto">
                            <button type="button" class="btn btn-success btn-label waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#pdfUploadModal"><i
                                    class="bx bx-upload label-icon align-middle fs-16 me-2"></i> Upload</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row justify-content-end">
                        <div class="col-3 col-lg-4 pe-3">
                            <select onchange="refreshTableJs()" class="form-control my-auto" wire:change="changeCompany($event.target.value)">
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
                                wire:change="changeStatus($event.target.value)">
                                <option value="all" {{ $selectedStatus == 'all' ? 'selected' : '' }}>All</option>
                                <option value="0" {{ $selectedStatus == '0' ? 'selected' : '' }}>Failed</option>
                                <option value="1" {{ $selectedStatus == '1' ? 'selected' : '' }}>Complete</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive pb-4">
                    <table id="all-reports-table" class="display table table-bordered" style="width:100%"
                        wire:key="all-reports-table">
                        <thead>
                            <tr>
                                <th>ABN</th>
                                <th>Company Name</th>
                                <th class="text-center">Quarter ended</th>
                                <th class="text-center">Upload Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($allReports != null)
                                @foreach ($allReports as $report)
                                    @if ($selectedStatus == 'all' || $selectedStatus == $report['is_upload_completed'])
                                        <tr>
                                            <td>{{ $report['abn'] }}</td>
                                            <td>{{ $report['company_name'] }}</td>
                                            <td class="text-center">{{ $report['quarter_ending'] }}</td>
                                            {{-- <td>{{ \Carbon\Carbon::parse($report['created_at'])->format('d F Y H:i') }}</td> --}}
                                            <td class="text-center">
                                                @if ($report['is_upload_completed'])
                                                    <span class="badge bg-success">Complete</span>
                                                @else
                                                    <span class="badge bg-danger">Failed</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <a target="_blank"
                                                    href="{{ route('client.single-report', $report['id']) }}"
                                                    class="btn btn-sm btn-outline-success"><i
                                                        class="ri-eye-fill align-bottom"></i></a>
                                                <a target="_blank"
                                                    href="{{ route('client.report-edit', $report['id']) }}"
                                                    class="btn btn-sm btn-outline-primary"><i
                                                        class="ri-pencil-fill align-bottom"></i></a>
                                                {{-- delete button  --}}
                                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteConfirmationModal"
                                                    onclick="setReportId({{ $report['id'] }})">
                                                    <i class="ri-delete-bin-fill align-bottom"></i>
                                                </button>

                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade position-fixed" id="deleteConfirmationModal" tabindex="-1"
        aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <lord-icon src="https://cdn.lordicon.com/hrqwmuhr.json" trigger="loop"
                        colors="primary:#121331,secondary:#08a88a" style="width:120px;height:120px">
                    </lord-icon>
                    <div class="mt-4">
                        <h4 class="mb-3">Are you sure you want to delete this report?</h4>
                        <p class="text-muted mb-4">This action cannot be undone.</p>
                        <div class="hstack gap-2 justify-content-center">
                            <button type="button" onclick="destroyDeleteId()" class="btn btn-light"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="button" id="confirmDeleteBtn" class="btn btn-danger" onclick="hideModal()"
                                wire:click="deleteReport(document.getElementById('confirmDeleteBtn').value)">
                                Yes, Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        setReportId = (id) => {
            document.getElementById('confirmDeleteBtn').value = id;
        }

        function destroyDeleteId() {
            document.getElementById('confirmDeleteBtn').value = '';
        }

        function hideModal() {
            const modalElement = document.getElementById('deleteConfirmationModal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            modalInstance.hide(); // Use Bootstrap's method to hide the modal
        }
    </script>

    @script
        <script>
            $wire.on('refreshTable', () => {
                // alert('hello');
                if ($.fn.DataTable.isDataTable('#all-reports-table')) {
                    console.log('Table is already initialized');
                    $('#all-reports-table').DataTable().destroy();
                    setTimeout(() => {
                        inizializeDataTable();
                    }, 1000);
                    return;
                }
                // console.log('initializing table');

                inizializeDataTable();

            });

            function inizializeDataTable() {
                new DataTable('#all-reports-table', {
                    dom: 'Bfrtip',
                    order: [
                        [2, 'desc']
                    ],
                    pageLength: 12,
                });
            }
        </script>
    @endscript

</div>
