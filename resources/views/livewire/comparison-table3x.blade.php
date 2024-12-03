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
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="report-table-3x" class="display table table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center align-items-center">Action</th>
                                    <th rowspan="2" class="text-center align-items-center">Appointment Dates</th>
                                    <th rowspan="2" class="text-center align-items-center">Director</th>
                                    <th rowspan="2" class="text-center align-items-center">Company Name</th>
                                    <th rowspan="2" class="text-center align-items-center"
                                        style="border-right:solid 2px #380092;">ABN</th>

                                    <th colspan="1" class="text-center table-dark text-white"
                                        style="border-right:solid 2px #380092;">Director’s relevant
                                        interests in securities of which the director is the registered holder</th>
                                    <th colspan="2" class="text-center table-dark text-white"
                                        style="border-right:solid 2px #380092;">Director’s relevant
                                        interests in securities of which the director is not the registered holder</th>
                                    <th colspan="4" class="text-center table-dark text-white"
                                        style="border-right:solid 2px #380092;"> Director’s interests
                                        in contracts</th>
                                </tr>

                                <tr>
                                    <th class="text-center" style="border-right:solid 2px #380092;">Number & class of
                                        securities</th>
                                    <th class="text-center">Holder & nature of interest</th>
                                    <th class="text-center" style="border-right:solid 2px #380092;">Number & class of
                                        Securities</th>
                                    <th class="text-center">Detail of contract</th>
                                    <th class="text-center">Nature of interest</th>
                                    <th class="text-center">Name of registered holder (if issued securities)</th>
                                    <th class="text-center" style="border-right:solid 2px #380092;">No. and class of
                                        securities to which interest relates</th>

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
                                            <td>{{ $report['company_name'] }}</td>
                                            <td class="text-center" style="border-right: solid 2px #380092;">
                                                {{ $report['abn'] }}
                                            </td>
                                            <td class="text-center"
                                                style="width: 200px; max-width: 250px; border-right: solid 2px #380092;"
                                                data-bs-toggle="tooltip"
                                                title="{{ in_array(strtolower($report['part1s'][0]['number_class_of_securities']), ['n/a', 'nil', 'null']) ? '-' : $report['part1s'][0]['number_class_of_securities'] }}">
                                                {{ in_array(strtolower($report['part1s'][0]['number_class_of_securities']), ['n/a', 'nil', 'null']) ? '-' : Str::limit($report['part1s'][0]['number_class_of_securities'], 50, '...') }}
                                            </td>
                                            <td class="text-center" style="width: 200px; max-width: 250px"
                                                data-bs-toggle="tooltip"
                                                title="{{ implode(', ', array_map(fn($p) => in_array(strtolower($p['name_of_holder_nature_of_interest']), ['n/a', 'nil', 'null']) ? '-' : $p['name_of_holder_nature_of_interest'], $report['part2s'])) }}">
                                                @for ($i = 0; $i < count($report['part2s']); $i++)
                                                    {{ in_array(strtolower($report['part2s'][$i]['name_of_holder_nature_of_interest']), ['n/a', 'nil', 'null']) ? '-' : Str::limit($report['part2s'][$i]['name_of_holder_nature_of_interest'], 50, '...') }}
                                                    <br><br>
                                                @endfor
                                            </td>
                                            <td class="text-center"
                                                style="width: 200px; max-width: 250px; border-right: solid 2px #380092;"
                                                data-bs-toggle="tooltip"
                                                title="{{ implode(', ', array_map(fn($p) => in_array(strtolower($p['number_class_of_securities']), ['n/a', 'nil', 'null']) ? '-' : $p['number_class_of_securities'], $report['part2s'])) }}">
                                                @for ($i = 0; $i < count($report['part2s']); $i++)
                                                    {{ in_array(strtolower($report['part2s'][$i]['number_class_of_securities']), ['n/a', 'nil', 'null']) ? '-' : Str::limit($report['part2s'][$i]['number_class_of_securities'], 50, '...') }}
                                                    <br><br>
                                                @endfor
                                            </td>
                                            <td class="text-center" style="width: 200px; max-width: 250px"
                                                data-bs-toggle="tooltip"
                                                title="{{ in_array(strtolower($report['part3s'][0]['detail_of_contract']), ['n/a', 'nil', 'null']) ? '-' : $report['part3s'][0]['detail_of_contract'] }}">
                                                {{ in_array(strtolower($report['part3s'][0]['detail_of_contract']), ['n/a', 'nil', 'null']) ? '-' : Str::limit($report['part3s'][0]['detail_of_contract'], 50, '...') }}
                                            </td>
                                            <td class="text-center" style="width: 200px; max-width: 250px"
                                                data-bs-toggle="tooltip"
                                                title="{{ in_array(strtolower($report['part3s'][0]['nature_of_interest']), ['n/a', 'nil', 'null']) ? '-' : $report['part3s'][0]['nature_of_interest'] }}">
                                                {{ in_array(strtolower($report['part3s'][0]['nature_of_interest']), ['n/a', 'nil', 'null']) ? '-' : Str::limit($report['part3s'][0]['nature_of_interest'], 50, '...') }}
                                            </td>
                                            <td class="text-center" style="width: 200px; max-width: 250px"
                                                data-bs-toggle="tooltip"
                                                title="{{ in_array(strtolower($report['part3s'][0]['name_of_registered_holder']), ['n/a', 'nil', 'null']) ? '-' : $report['part3s'][0]['name_of_registered_holder'] }}">
                                                {{ in_array(strtolower($report['part3s'][0]['name_of_registered_holder']), ['n/a', 'nil', 'null']) ? '-' : Str::limit($report['part3s'][0]['name_of_registered_holder'], 50, '...') }}
                                            </td>
                                            <td class="text-center"
                                                style="width: 200px; max-width: 250px; border-right: solid 2px #380092;"
                                                data-bs-toggle="tooltip"
                                                title="{{ in_array(strtolower($report['part3s'][0]['no_and_class_of_securities_to_which_interest_relates']), ['n/a', 'nil', 'null']) ? '-' : $report['part3s'][0]['no_and_class_of_securities_to_which_interest_relates'] }}">
                                                {{ in_array(strtolower($report['part3s'][0]['no_and_class_of_securities_to_which_interest_relates']), ['n/a', 'nil', 'null']) ? '-' : Str::limit($report['part3s'][0]['no_and_class_of_securities_to_which_interest_relates'], 50, '...') }}
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


</div>
