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
                                    <th rowspan="2" class="text-center align-items-center">Action</th>
                                    <th rowspan="2" class="text-center align-items-center">Appointment Dates</th>
                                    <th rowspan="2" class="text-center align-items-center">Director</th>
                                    <th rowspan="2" class="text-center align-items-center">Company Name</th>
                                    <th rowspan="2" class="text-center align-items-center">Stock Code</th>
                                    <th rowspan="2" class="text-center align-items-center">Stock Exchange</th>
                                    <th rowspan="2" class="text-center align-items-center"
                                        style="border-right:solid 2px #380092;">ABN</th>

                                    <th colspan="2" class="text-center table-dark text-white"
                                        style="border-right:solid 2px #380092;min-width: 250px;">Director’s relevant
                                        interests in securities of which the director is the registered holder</th>
                                    <th colspan="3" class="text-center table-dark text-white"
                                        style="border-right:solid 2px #380092;min-width: 300px;">Director’s relevant
                                        interests in securities of which the director is not the registered holder</th>
                                    <th colspan="5" class="text-center table-dark text-white"
                                        style="border-right:solid 2px #380092;min-width: 400px;"> Director’s interests
                                        in contracts</th>
                                </tr>

                                <tr>
                                    <th class="text-center">Number</th>
                                    <th class="text-center" style="border-right:solid 2px #380092;">Class of securities
                                    </th>
                                    <th class="text-center">Holder & nature of interest</th>
                                    <th class="text-center">Number</th>
                                    <th class="text-center" style="border-right:solid 2px #380092;">class of Securities
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
                                        <tr>
                                            <td class="text-center">
                                                <a href="{{ route('client.single-report-3x', $report['id']) }}"
                                                    class="btn btn-sm btn-secondary">View</a>
                                            </td>
                                            <td class="text-center">{{ $report['date_of_appointment'] }}</td>
                                            <td>{{ $report['name_of_director'] }}</td>
                                            <td>
                                                @php
                                                    $companyName = preg_split('/\(/', $report['company_name']);
                                                @endphp
                                                {{ $companyName[0] }}</td>
                                            <td class="text-center">
                                                {{ $report['stock_code'] == '' ? '-' : $report['stock_code'] }}</td>
                                            <td class="text-center">
                                                {{ $report['stock_exchange'] == '' ? '-' : $report['stock_exchange'] }}
                                            </td>
                                            <td class="text-center" style="border-right: solid 2px #380092;">
                                                {{ $report['abn'] }}
                                            </td>

                                            <td class="text-center" style="min-width: 200px; max-width: 250px;">
                                                @for ($i = 0; $i < count($report['part1s']); $i++)
                                                    @php
                                                        if (
                                                            preg_match(
                                                                '/^([\d,]+)\s+(.+)$/',
                                                                $report['part1s'][$i]['number_class_of_securities'],
                                                                $matches,
                                                            )
                                                        );
                                                    @endphp
                                                    {{ $matches[1] ?? '-' }}
                                                    <br><br>
                                                @endfor
                                            </td>

                                            <td class="text-center"
                                                style="min-width: 200px; max-width: 250px; border-right: solid 2px #380092;"
                                                >
                                                @for ($i = 0; $i < count($report['part1s']); $i++)
                                                    @php
                                                        if (
                                                            preg_match(
                                                                '/^([\d,]+)\s+(.+)$/',
                                                                $report['part1s'][$i]['number_class_of_securities'],
                                                                $matches,
                                                            )
                                                        );
                                                    @endphp
                                                    {{ $matches[2] ?? '-' }}
                                                    <br><br>
                                                @endfor
                                            </td>
                                            
                                            <td class="text-center" style="min-width: 200px; max-width: 250px"
                                                data-bs-toggle="tooltip"
                                                title="{{ implode(', ', array_map(fn($p) => in_array(strtolower($p['name_of_holder_nature_of_interest']), ['n/a', 'nil', 'null']) ? '-' : $p['name_of_holder_nature_of_interest'], $report['part2s'])) }}">
                                                @for ($i = 0; $i < count($report['part2s']); $i++)
                                                    {{ in_array(strtolower($report['part2s'][$i]['name_of_holder_nature_of_interest']), ['n/a', 'nil', 'null']) ? '-' : Str::limit($report['part2s'][$i]['name_of_holder_nature_of_interest'], 30, '...') }}
                                                    <br><br>
                                                @endfor
                                            </td>
                                            <td class="text-center" style="width: 350px; max-width: 450px;"
                                                data-bs-toggle="tooltip"
                                                title="{{ implode(', ', array_map(fn($p) => in_array(strtolower($p['number_class_of_securities']), ['n/a', 'nil', 'null']) ? '-' : $p['number_class_of_securities'], $report['part2s'])) }}">
                                                @for ($i = 0; $i < count($report['part2s']); $i++)
                                                    @php
                                                        $v = in_array(
                                                            strtolower(
                                                                $report['part2s'][$i]['number_class_of_securities'],
                                                            ),
                                                            ['n/a', 'nil', 'null'],
                                                        )
                                                            ? '-'
                                                            : $report['part2s'][$i]['number_class_of_securities'];
                                                        $v1 = preg_match('/^([\d,]+)\s+(.+)$/', $v, $text);
                                                    @endphp
                                                    {{ $text[1] ?? '-' }}
                                                    <br><br>
                                                @endfor
                                            </td>

                                            <td class="text-center"
                                                style="min-width: 200px; max-width: 250px; border-right: solid 2px #380092;"
                                                data-bs-toggle="tooltip"
                                                title="{{ implode(', ', array_map(fn($p) => in_array(strtolower($p['number_class_of_securities']), ['n/a', 'nil', 'null']) ? '-' : $p['number_class_of_securities'], $report['part2s'])) }}">
                                                @for ($i = 0; $i < count($report['part2s']); $i++)
                                                    @php
                                                        $v = in_array(
                                                            strtolower(
                                                                $report['part2s'][$i]['number_class_of_securities'],
                                                            ),
                                                            ['n/a', 'nil', 'null'],
                                                        )
                                                            ? '-'
                                                            : $report['part2s'][$i]['number_class_of_securities'];
                                                        $v1 = preg_match('/^([\d,]+)\s+(.+)$/', $v, $text);
                                                    @endphp
                                                    {{ $text[2] ?? '-' }}
                                                    <br><br>
                                                @endfor
                                            </td>

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
                                                @php
                                                    $v = in_array(
                                                        strtolower(
                                                            $report['part3s'][0][
                                                                'no_and_class_of_securities_to_which_interest_relates'
                                                            ],
                                                        ),
                                                        ['n/a', 'nil', 'null'],
                                                    )
                                                        ? '-'
                                                        : strtolower(
                                                            $report['part3s'][0][
                                                                'no_and_class_of_securities_to_which_interest_relates'
                                                            ],
                                                        );
                                                    $v1 = preg_match('/^([\d,]+)\s+(.+)$/', $v, $text);
                                                @endphp
                                                {{ $text[1] ?? '-' }}
                                            </td>
                                            <td class="text-center"
                                                style="min-width: 200px; max-width: 250px; border-right: solid 2px #380092;"
                                                data-bs-toggle="tooltip"
                                                title="{{ in_array(strtolower($report['part3s'][0]['no_and_class_of_securities_to_which_interest_relates']), ['n/a', 'nil', 'null']) ? '-' : $report['part3s'][0]['no_and_class_of_securities_to_which_interest_relates'] }}">
                                                @php
                                                    $v = in_array(
                                                        strtolower(
                                                            $report['part3s'][0][
                                                                'no_and_class_of_securities_to_which_interest_relates'
                                                            ],
                                                        ),
                                                        ['n/a', 'nil', 'null'],
                                                    )
                                                        ? '-'
                                                        : strtolower(
                                                            $report['part3s'][0][
                                                                'no_and_class_of_securities_to_which_interest_relates'
                                                            ],
                                                        );
                                                    $v1 = preg_match('/^([\d,]+)\s+(.+)$/', $v, $text);
                                                @endphp
                                                {{ $text[2] ?? '-' }}
                                            </td>
                                        </tr>
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
                    leftColumns: 7 // Fix the first 4 columns
                },
                pageLength: 4,
                order: [
                    [1, 'desc']
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
