<div>
    {{-- <div class="col-lg-12">
        <div class="card">
            <div class="card-body d-flex justify-content-end">
                <div class="col">
                    <div class="row justify-content-end">
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
    </div> --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body d-flex justify-content-end">
                    <div class="col-3 col-lg-4 pe-3">
                        <select class="form-control my-auto" name="choices-single-default" id="choices-single-default"
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
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="report-table-3x" class="display table table-bordered">
                            <thead>
                                <tr>
                                    {{-- <th rowspan="2" class="text-center align-items-center">Action</th> --}}
                                    <th rowspan="2" class="text-center align-items-center">Appointment Dates</th>
                                    <th rowspan="2" class="text-center align-items-center">Director</th>
                                    {{-- <th rowspan="2" class="text-center align-items-center">Company Name</th> --}}
                                    <th rowspan="2" class="text-center align-items-center">Stock Code</th>
                                    <th rowspan="2" class="text-center align-items-center">Stock Exchange</th>
                                    <th rowspan="2" class="text-center align-items-center"
                                        style="border-right:solid 2px #380092;">ABN</th>

                                    <th colspan="2" class="text-center table-dark text-white"
                                        style="border-right:solid 2px #380092;min-width: 250px;">Part 1</th>
                                    <th colspan="4" class="text-center table-dark text-white"
                                        style="border-right:solid 2px #380092;min-width: 300px;">Part 2</th>
                                    <th colspan="5" class="text-center table-dark text-white"
                                        style="border-right:solid 2px #380092;min-width: 400px;">Part 3</th>
                                </tr>

                                <tr>
                                    <th class="text-center">Number</th>
                                    <th class="text-center" style="border-right:solid 2px #380092;">Class of securities
                                    </th>
                                    <th class="text-center">Holder</th>
                                    <th class="text-center">Nature of interest</th>
                                    <th class="text-center">Number</th>
                                    <th class="text-center" style="border-right:solid 2px #380092;">Class of securities
                                    </th>
                                    <th class="text-center">Detail of contract</th>
                                    <th class="text-center">Nature of interest</th>
                                    <th class="text-center">Name of registered holder (if issued securities)</th>

                                    <th class="text-center">Number</th>
                                    <th class="text-center" style="border-right:solid 2px #380092;">Class of securities
                                        to which interest relates</th>

                                </tr>
                            </thead>

                            <tbody>
                                @if ($allReports != null)
                                    @foreach ($allReports as $report)
                                        @php
                                            $maxRowCount = max(
                                                1,
                                                count($report['part1s'] ?? []),
                                                count($report['part2s'] ?? []),
                                                count($report['part3s'] ?? []),
                                            );
                                        @endphp

                                        @for ($i = 0; $i < $maxRowCount; $i++)
                                            <tr>
                                                {{-- <td class="text-center">
                                                    <a href="{{ route('user.single-report-3x', $report['id']) }}"
                                                        class="btn btn-sm btn-secondary">View</a>
                                                </td> --}}
                                                <td class="text-center">{{ $report['date_of_appointment'] }}</td>
                                                <td class="text-center" style="min-width: 130px; max-width: 250px;">
                                                    {{ $report['name_of_director'] }}</td>
                                                {{-- <td class="text-center" style="min-width: 200px; max-width: 250px;" data-bs-toggle="tooltip"
                                                    title="{{ $report['company_name'] }}">
                                                    {{ Str::limit($report['company_name'], 20, '...') }}</td> --}}
                                                <td class="text-center">
                                                    {{ $report['stock_code'] == '' ? '-' : $report['stock_code'] }}</td>
                                                <td class="text-center">
                                                    {{ $report['stock_exchange'] == '' ? '-' : $report['stock_exchange'] }}
                                                </td>
                                                <td class="text-center {{ $report['abn_verified'] == '0' ? 'text-danger' : '' }}"
                                                    style="border-right: solid 2px #380092;min-width: 110px;max-width: 150px;">
                                                    {{ $report['abn'] }}
                                                </td>

                                                {{-- part1s  --}}
                                                <td class="text-center" style="min-width: 200px; max-width: 250px;">
                                                    @if (isset($report['part1s'][$i]))
                                                        @php
                                                            $matches = [];
                                                            if (
                                                                preg_match(
                                                                    '/^([\d,]+)\s+(.+)$/',
                                                                    $report['part1s'][$i]['number_class_of_securities'],
                                                                    $matches,
                                                                )
                                                            ) {
                                                                $number = $matches[1];
                                                            } else {
                                                                $number = '-';
                                                            }
                                                        @endphp
                                                        <span>{{ $number }}</span>
                                                    @else
                                                        <span>-</span>
                                                    @endif
                                                </td>

                                                <td class="text-center"
                                                    style="min-width: 200px; max-width: 250px; border-right: solid 2px #380092;">
                                                    @if (isset($report['part1s'][$i]))
                                                        @php
                                                            $matches = [];
                                                            if (
                                                                preg_match(
                                                                    '/^([\d,]+)\s+(.+)$/',
                                                                    $report['part1s'][$i]['number_class_of_securities'],
                                                                    $matches,
                                                                )
                                                            ) {
                                                                $class_O_S = $matches[2];
                                                            } else {
                                                                $class_O_S = '-';
                                                            }
                                                        @endphp
                                                        <span data-bs-toggle="tooltip" title="{{ $class_O_S }}">
                                                            {{ Str::limit($class_O_S, 30, '...') }}
                                                        </span>
                                                    @else
                                                        <span>-</span>
                                                    @endif
                                                </td>

                                                {{-- part2s  --}}
                                                <td class="text-center" style="min-width: 200px; max-width: 250px">
                                                    @if (isset($report['part2s'][$i]))
                                                        @php
                                                            $name = strtolower($report['part2s'][$i]['name_of_holder_nature_of_interest']);

                                                            if (in_array($name, ['n/a', 'nil', 'null'])) {
                                                                $holder_name = '-';
                                                            } else {
                                                                // Remove text in brackets and echo the result
                                                                preg_match('/^(.*?)\s*\(([^)]+)\)$/', $report['part2s'][$i]['name_of_holder_nature_of_interest'], $matches);
                                                                if (!empty($matches)) {
                                                                    $holder_name = trim($matches[1]);
                                                                }
                                                            }
                                                        @endphp
                                                        <span data-bs-toggle="tooltip"
                                                            title="{{ $holder_name }}">
                                                            {{ Str::limit($holder_name, 30, '...') }}
                                                            {{-- {{ in_array(strtolower($report['part2s'][$i]['name_of_holder_nature_of_interest']), ['n/a', 'nil', 'null']) ? '-' : Str::limit($report['part2s'][$i]['name_of_holder_nature_of_interest'], 30, '...') }} --}}
                                                        </span>
                                                    @else
                                                        <span>-</span>
                                                    @endif
                                                </td>
                                                
                                                <td class="text-center" style="min-width: 200px; max-width: 250px">
                                                    @if (isset($report['part2s'][$i]))
                                                        @php
                                                            $name = strtolower($report['part2s'][$i]['name_of_holder_nature_of_interest']);

                                                            if (in_array($name, ['n/a', 'nil', 'null'])) {
                                                                $nature_of_interest = '-';
                                                            } else {
                                                                // Remove text in brackets and echo the result
                                                                preg_match('/^(.*?)\s*\(([^)]+)\)$/', $report['part2s'][$i]['name_of_holder_nature_of_interest'], $matches);
                                                                if (!empty($matches)) {
                                                                    $nature_of_interest = trim($matches[2]);
                                                                }
                                                            }
                                                        @endphp
                                                        <span data-bs-toggle="tooltip"
                                                            title="{{ $nature_of_interest }}">
                                                            {{ Str::limit($nature_of_interest, 30, '...') }}
                                                            {{-- {{ in_array(strtolower($report['part2s'][$i]['name_of_holder_nature_of_interest']), ['n/a', 'nil', 'null']) ? '-' : Str::limit($report['part2s'][$i]['name_of_holder_nature_of_interest'], 30, '...') }} --}}
                                                        </span>
                                                    @else
                                                        <span>-</span>
                                                    @endif
                                                </td>

                                                <td class="text-center" style="width: 350px; max-width: 450px;">
                                                    @if (isset($report['part2s'][$i]))
                                                        @php
                                                            // Handle invalid securities values
                                                            $securities = strtolower(
                                                                $report['part2s'][$i]['number_class_of_securities'],
                                                            );
                                                            if (in_array($securities, ['n/a', 'nil', 'null'])) {
                                                                $displayValue = '-';
                                                            } else {
                                                                $matches = [];
                                                                if (
                                                                    preg_match(
                                                                        '/^([\d,]+)\s+(.+)$/',
                                                                        $securities,
                                                                        $matches,
                                                                    )
                                                                ) {
                                                                    $displayValue = $matches[1]; // Extract the numeric part
                                                                } else {
                                                                    $displayValue = $securities; // Fallback to the original value
                                                                }
                                                            }
                                                        @endphp
                                                        <span>{{ $displayValue }}</span>
                                                    @else
                                                        <span>-</span>
                                                    @endif
                                                </td>

                                                <td class="text-center"
                                                    style="min-width: 200px; max-width: 250px; border-right: solid 2px #380092;">
                                                    @if (isset($report['part2s'][$i]))
                                                        @php
                                                            // Handle invalid securities values
                                                            $securities = strtolower(
                                                                $report['part2s'][$i]['number_class_of_securities'],
                                                            );
                                                            if (in_array($securities, ['n/a', 'nil', 'null'])) {
                                                                $displayValue = '-';
                                                            } else {
                                                                $matches = [];
                                                                if (
                                                                    preg_match(
                                                                        '/^([\d,]+)\s+(.+)$/',
                                                                        $securities,
                                                                        $matches,
                                                                    )
                                                                ) {
                                                                    $displayValue = $matches[2]; // Extract the numeric part
                                                                } else {
                                                                    $displayValue = $securities; // Fallback to the original value
                                                                }
                                                            }
                                                        @endphp
                                                        <span data-bs-toggle="tooltip"
                                                            title="{{ $displayValue }}">{{ Str::limit($displayValue, 30, '...') }}</span>
                                                    @else
                                                        <span>-</span>
                                                    @endif
                                                </td>

                                                {{-- part3s  --}}
                                                <td class="text-center" style="min-width: 200px; max-width: 250px"
                                                    data-bs-toggle="tooltip"
                                                    title="{{ in_array(strtolower($report['part3s'][0]['detail_of_contract']), ['n/a', 'nil', 'null']) ? '-' : $report['part3s'][0]['detail_of_contract'] }}">
                                                    {{ in_array(strtolower($report['part3s'][0]['detail_of_contract']), ['n/a', 'nil', 'null']) ? '-' : Str::limit($report['part3s'][0]['detail_of_contract'], 50, '...') }}
                                                </td>
                                                <td class="text-center" style="min-width: 200px; max-width: 250px"
                                                    data-bs-toggle="tooltip"
                                                    title="{{ in_array(strtolower($report['part3s'][0]['nature_of_interest']), ['n/a', 'nil', 'null']) ? '-' : $report['part3s'][0]['nature_of_interest'] }}">
                                                    {{ in_array(strtolower($report['part3s'][0]['nature_of_interest']), ['n/a', 'nil', 'null']) ? '-' : Str::limit($report['part3s'][0]['nature_of_interest'], 50, '...') }}
                                                </td>
                                                <td class="text-center" style="min-width: 200px; max-width: 250px"
                                                    data-bs-toggle="tooltip"
                                                    title="{{ in_array(strtolower($report['part3s'][0]['name_of_registered_holder']), ['n/a', 'nil', 'null']) ? '-' : $report['part3s'][0]['name_of_registered_holder'] }}">
                                                    {{ in_array(strtolower($report['part3s'][0]['name_of_registered_holder']), ['n/a', 'nil', 'null']) ? '-' : Str::limit($report['part3s'][0]['name_of_registered_holder'], 50, '...') }}
                                                </td>

                                                <td class="text-center" style="min-width: 200px; max-width: 250px;">
                                                    @if (isset($report['part3s'][$i]))
                                                        @php
                                                            // Handle invalid securities values
                                                            $securities = strtolower(
                                                                $report['part3s'][$i][
                                                                    'no_and_class_of_securities_to_which_interest_relates'
                                                                ],
                                                            );
                                                            if (in_array($securities, ['n/a', 'nil', 'null'])) {
                                                                $displayValue = '-';
                                                            } else {
                                                                $matches = [];
                                                                if (
                                                                    preg_match(
                                                                        '/^([\d,]+)\s+(.+)$/',
                                                                        $securities,
                                                                        $matches,
                                                                    )
                                                                ) {
                                                                    $displayValue = $matches[1]; // Extract the numeric part
                                                                } else {
                                                                    $displayValue = $securities; // Fallback to the original value
                                                                }
                                                            }
                                                        @endphp
                                                        <span>{{ $displayValue }}</span>
                                                    @else
                                                        <span>-</span>
                                                    @endif
                                                </td>
                                                <td class="text-center"
                                                    style="min-width: 200px; max-width: 250px; border-right: solid 2px #380092;">
                                                    @if (isset($report['part3s'][$i]))
                                                        @php
                                                            // Handle invalid securities values
                                                            $securities = strtolower(
                                                                $report['part3s'][$i][
                                                                    'no_and_class_of_securities_to_which_interest_relates'
                                                                ],
                                                            );
                                                            if (in_array($securities, ['n/a', 'nil', 'null'])) {
                                                                $displayValue = '-';
                                                            } else {
                                                                $matches = [];
                                                                if (
                                                                    preg_match(
                                                                        '/^([\d,]+)\s+(.+)$/',
                                                                        $securities,
                                                                        $matches,
                                                                    )
                                                                ) {
                                                                    $displayValue = $matches[2]; // Extract the numeric part
                                                                } else {
                                                                    $displayValue = $securities; // Fallback to the original value
                                                                }
                                                            }
                                                        @endphp
                                                        <span data-bs-toggle="tooltip"
                                                            title="{{ $displayValue }}">{{ Str::limit($displayValue, 30, '...') }}</span>
                                                    @else
                                                        <span>-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endfor
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

    <script>
        function inizializeDataTable() {
            let buttonsDataTables = new DataTable('#report-table-3x', {
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'print'],
                scrollX: true, // Enable horizontal scrolling
                fixedColumns: {
                    leftColumns: 5 // Fix the first 4 columns
                },
                pageLength: 8,
                order: [
                    [0, 'desc']
                ],
            });
        }
    </script>

    @script
        <script>
            $wire.on('refreshTable', () => {
                // alert('hello');
                if ($.fn.DataTable.isDataTable('#buttons-datatables')) {
                    console.log('Table is already initialized');
                    $('#buttons-datatables').DataTable().destroy();
                    setTimeout(() => {
                        inizializeDataTable();
                        eventListenersAdd();
                    }, 1500);
                    return;
                }

                setTimeout(() => {
                    inizializeDataTable();
                }, 1000);
            });
        </script>
    @endscript

</div>
