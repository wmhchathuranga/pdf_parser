@extends('layouts.master')
@section('title')
    @lang('translation.datatables')
@endsection
@section('css')
    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Charts
        @endslot
        @slot('title')
            Charts
        @endslot
    @endcomponent

    {{-- @php
        try {
            $response = Http::withHeaders([
                'Authorization' => env('API_TOKEN'),
            ])->get(env('API_URL') . '/api/companies');

            if ($response->successful()) {
                // dd($response->json());
                $companiesArray = $response->json();
                // dd($companiesArray);
            } else {
                throw new Exception('Failed to fetch companies');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    @endphp --}}


    <div class="row">
        <div class="col-12 pb-3">
            <div class="bg-dark p-2">
                <h3 class="text-white text-capitalize">Customizable line graph</h3>
            </div>
        </div>
    </div>

    @livewire('single-pdf-chart')

    {{-- <form class="row g-3 pb-5 pt-4" action="{{ route('client.analyse-chart') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="col-sm-4">
            <select class="form-control" name="abn">
                <option value="">Select Company</option>
                @foreach ($companiesArray as $company)
                    <option value="{{ $company['abn'] }}" {{ old('abn') == $company['abn'] ? 'selected' : '' }}>
                        {{ $company['company_name'] }}
                    </option>
                @endforeach
            </select>
            @error('abn')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-sm-3">
            <div class="input-group">
                <input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-input active"
                    name="dateRange" value="{{ old('dateRange') }}" data-default-date="01 Jan, 2022 to 01 Jan, 2024"
                    data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" readonly="readonly">
                <div class="input-group-text bg-primary border-primary text-white">
                    <i class="ri-calendar-2-line"></i>
                </div>
            </div>
            @error('dateRange')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>


        <div class="col-sm-4"><select class="form-control" name="topic">
                <option value="">Select Topic</option>
                
                <optgroup label="Cash flows from operating activities">
                    <option value="0-receipts_from_customers"
                        {{ old('topic') == '0-receipts_from_customers' ? 'selected' : '' }}>Receipts From Customers</option>
                    <option value="0-payments_exploration_evaluation">Payments Exploration Evaluation</option>
                    <option value="0-payments_development">Payments Development</option>
                    <option value="0-payments_production"> Payments Production</option>
                    <option value="0-payments_staff_costs">Payments Staff Costs</option>
                    <option value="0-payments_admin_costs">Payments Admin Costs</option>
                    <option value="0-dividends_received"> Dividends Received</option>
                    <option value="0-interest_received"> Interest Received</option>
                    <option value="0-interest_paid">Interest Paid</option>
                    <option value="0-income_tax_paid">Income Tax Paid</option>
                    <option value="0-government_tax_paid">Government Tax Paid</option>
                    <option value="0-other">Other</option>
                    <option value="0-net_cash_from_operating">Net Cash From Operating</option>

                </optgroup>

                
                <optgroup label="Cash flows from investing activities">
                    <option value="1-payments_for_entities">Payments For Entities</option>
                    <option value="1-payments_for_tenements">Payments For Tenements</option>
                    <option value="1-payments_for_property">Payments For Property</option>
                    <option value="1-payments_for_exploration_evaluation">Payments For Exploration Evaluation</option>
                    <option value="1-payments_for_investment">Payments For Investment</option>
                    <option value="1-payments_for_other"> Payments For Other</option>
                    <option value="1-proceeds_from_entities">Proceeds From Entities </option>
                    <option value="1-proceeds_from_tenements">Proceeds From Tenements</option>
                    <option value="1-proceeds_from_property">Proceeds From Property</option>
                    <option value="1-proceeds_from_investment">Proceeds From Investment</option>
                    <option value="1-proceeds_from_other">Proceeds From Other</option>
                    <option value="1-cash_flow_from_loans">Cash Flow From Loans</option>
                    <option value="1-dividends_received_2">Dividends Received</option>
                    <option value="1-other_2">Other</option>
                    <option value="1-net_cash_from_investing">Net Cash From Investing
                    </option>

                </optgroup>

                
                <optgroup label="Cash flows from financing activities">
                    <option value="2-proceeds_from_equity">Proceeds From Equity</option>
                    <option value="2-proceeds_from_debt"> Proceeds From Debt</option>
                    <option value="2-proceeds_from_exercise">Proceeds From Exercise</option>
                    <option value="2-transaction_costs_for_securities">Transaction Costs For Securities</option>
                    <option value="2-proceeds_from_borrowing">Proceeds From Borrowing</option>
                    <option value="2-repayments_of_borrowing">Repayments Of Borrowing</option>
                    <option value="2-transaction_costs_for_borrowing">Transaction Costs For Borrowing</option>
                    <option value="2-dividends_paid">Dividends Paid</option>
                    <option value="2-other_3">Other</option>
                    <option value="2-net_cash_from_financing">Net Cash From Financing
                    </option>

                </optgroup>

                
                <optgroup label="Cash flow details">
                    <option value="3-beginning_cash">Beginning Cash</option>
                    <option value="3-operating_cash_flow">Operating Cash Flow</option>
                    <option value="3-investing_cash_flow">Investing Cash Flow</option>
                    <option value="3-financing_cash_flow">Financing Cash Flow</option>
                    <option value="3-effect_of_movement">Effect Of Movement</option>
                    <option value="3-end_cash">End Cash</option>

                </optgroup>

                
                <optgroup label="Reconciliation details">
                    <option value="4-bank_balance">Bank Balance</option>
                    <option value="4-call_deposits">Call Deposits</option>
                    <option value="4-bank_overdrafts">Bank Overdrafts</option>
                    <option value="4-other_4">Other</option>
                    <option value="4-cash_equivalents_end_period">Cash Equivalents End Period</option>
                </optgroup>

                
                <optgroup label="Related party payments">
                    <option value="5-aggregated_1">Aggregated 1</option>
                    <option value="5-aggregated_2">Aggregated 2</option>
                </optgroup>

                
                <optgroup label="Financing facilities">
                    <option value="6-loans">Loans</option>
                    <option value="6-credit_standby">Credit Standby</option>
                    <option value="6-other_5">Other</option>
                    <option value="6-total_financing">Total Financing</option>
                    <option value="6-unused_financing_facilities">Unused Financing Facilities</option>
                </optgroup>

                
                <optgroup label="Estimated cash availabilities">
                    <option value="7-net_cash_operating">Net Cash Operating</option>
                    <option value="7-future_payments_for_exploration_evaluation">Future Payments For Exploration Evaluation
                    </option>
                    <option value="7-total_relevant_payments">Total Relevant Payments</option>
                    <option value="7-future_cash_equivalents_end_period">Future Cash Equivalents End Period</option>
                    <option value="7-unused_financing_facilities_end_period">Unused Financing Facilities End Period
                    </option>
                    <option value="7-total_available_funding">Total Available Funding</option>
                    <option value="7-estimated_quarterly_funding">Estimated Quarterly Funding</option>

                </optgroup>
            </select>
            @error('topic')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-outline-danger px-4"><i class="mdi mdi-poll"></i></button>
        </div>
    </form>



    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"></h4>
                    <div id="chart">
                        <div class="card-body">
                            <div id="line_chart_datalabel"
                                data-colors='["--vz-primary", "--vz-success", "--vz-danger",
                                "--vz-warning", "--vz-info", "--vz-dark", "--vz-secondary", "--vz-light"]'
                                class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    
@endsection
@section('script')
    {{-- <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script> --}}
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/dayjs.min.js') }}"></script>
    <script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/plugin/quarterOfYear.min.js') }}">
    </script>


    {{-- <script src="{{ URL::asset('build/libs/choicesjs/choices.min.js') }}"></script> --}}

    <script>
        // var chartOptions = [{
        //         "name": "Dividends Received",
        //         "data": [26, 24, 32, 36, 33, 31, 33]
        //     },
        //     {
        //         "name": "Government Tax Paid",
        //         "data": [14, 11, 16, 12, 17, 13, 12]
        //     },
        //     {
        //         "name": "Income Tax Paid",
        //         "data": [20, 18, 22, 25, 21, 20, 22, 67, 26, 58]
        //     },
        //     {
        //         "name": "Interest Paid",
        //         "data": [10, 8, 11, 9, 10, 8, 9]
        //     },
        //     {
        //         "name": "Interest Received",
        //         "data": [15, 14, 16, 18, 17, 15, 16]
        //     },
        //     {
        //         "name": "Net Cash from Operating Activities",
        //         "data": [30, 28, 35, 32, 33, 31, 29]
        //     },
        //     {
        //         "name": "Payments for Admin Costs",
        //         "data": [12, 10, 14, 13, 11, 9, 10]
        //     },
        //     {
        //         "name": "Payments for Development",
        //         "data": [22, 20, 25, 23, 21, 19, 20]
        //     },
        //     {
        //         "name": "Payments for Exploration & Evaluation",
        //         "data": [18, 15, 19, 17, 16, 14, 15]
        //     },
        //     {
        //         "name": "Other",
        //         "data": [8, 7, 10, 9, 8, 6, 7]
        //     }
        // ];


        // function sendDataRequest() {
        //     const inputs = {
        //         abn: document.getElementById('abn'),
        //         dateRange: document.getElementById('dateRange'),
        //         topic: document.getElementById('topic')
        //     };

        //     let isValid = true;

        //     // Validate inputs
        //     Object.entries(inputs).forEach(([key, element]) => {
        //         if (!element.value.trim()) {
        //             element.classList.add('is-invalid');
        //             element.classList.remove('is-valid');
        //             isValid = false;
        //         } else {
        //             element.classList.add('is-valid');
        //             element.classList.remove('is-invalid');
        //         }
        //     });

        //     if (!isValid) {
        //         return; // Stop execution if any input is invalid
        //     }

        //     // Access values one by one
        //     let abn = inputs.abn.value;
        //     let dateRange = inputs.dateRange.value;
        //     let topic = inputs.topic.value;

        //     let dateStart = dateRange.split(' to ')[0];
        //     let dateEnd = dateRange.split(' to ')[1];
        //     let tableIndex = topic.split('-')[0];
        //     let columnName = topic.split('-')[1];

        //     let requestBody = {
        //         "abn": abn,
        //         "date_start": dateStart,
        //         "date_end": dateEnd,
        //         "table_index": tableIndex,
        //         "columns": [columnName + "_c_q", columnName + "_y_t_d"],
        //     };

        //     // send request 
        //     const API_URL = "https://your-api-url.com"; // Replace with the actual API URL
        //     const API_TOKEN = "your-api-token"; // Replace with the actual API token

        //     const xhr = new XMLHttpRequest();
        //     xhr.open('POST', `${API_URL}/api/chart/1`, true); // Use the full API URL
        //     xhr.setRequestHeader('Content-Type', 'application/json');
        //     xhr.setRequestHeader('Authorization', `Bearer ${API_TOKEN}`); // Add the Authorization header

        //     xhr.onreadystatechange = function() {
        //         if (xhr.readyState === XMLHttpRequest.DONE) {
        //             if (xhr.status === 200) {
        //                 const response = JSON.parse(xhr.responseText);
        //                 drawChart(response.data); // Assuming `drawChart` is a defined function
        //             } else {
        //                 console.error(`Error: ${xhr.status}`, xhr.responseText);
        //             }
        //         }
        //     };

        //     // Replace `requestBody` with the actual data object to send
        //     xhr.send(JSON.stringify(requestBody));



        // }



        // function drawChart(dataArray) {

        //     var options = {
        //         chart: {
        //             height: 380,
        //             type: 'line',
        //             zoom: {
        //                 enabled: false
        //             },
        //             toolbar: {
        //                 show: false
        //             }
        //         },
        //         colors: linechartDatalabelColors,
        //         dataLabels: {
        //             enabled: false,
        //         },
        //         stroke: {
        //             width: [3, 3],
        //             curve: 'straight'
        //         },
        //         series: [], // Will be populated dynamically
        //         title: {
        //             text: '',
        //             align: 'left',
        //             style: {
        //                 fontWeight: 500,
        //             },
        //         },
        //         grid: {
        //             row: {
        //                 colors: ['transparent', 'transparent'], // takes an array which will be repeated on rows
        //                 opacity: 0.2
        //             },
        //             borderColor: '#f1f1f1'
        //         },
        //         markers: {
        //             style: 'inverted',
        //             size: 6
        //         },
        //         xaxis: {
        //             categories: [], // Will be populated with dataArray.x_axis
        //             title: {
        //                 text: 'Month'
        //             }
        //         },
        //         yaxis: {
        //             title: {
        //                 text: 'Values'
        //             },
        //             min: 5,
        //         },
        //         legend: {
        //             position: 'top',
        //             horizontalAlign: 'right',
        //             floating: true,
        //             offsetY: -25,
        //             offsetX: -5
        //         },
        //         responsive: [{
        //             breakpoint: 600,
        //             options: {
        //                 chart: {
        //                     toolbar: {
        //                         show: false
        //                     }
        //                 },
        //                 legend: {
        //                     show: false
        //                 },
        //             }
        //         }]
        //     };

        //     series = [];
        //     options.xaxis.categories = dataArray.x_axis || [];
        //     for (let key in dataArray) {
        //         if (key !== "x_axis") { // Exclude x_axis from the series data
        //             series.push({
        //                 name: key.replace(/_/g, ' '), // Replace underscores with spaces for readability
        //                 data: dataArray[key].map(Number)
        //             });
        //         }
        //     }
        //     options.series = series;
        //     console.log(options.series[0].data);

        //     // Clear previous chart and render the new one

        //     document.getElementById("line_chart_datalabel").innerHTML = "";
        //     var chart = new ApexCharts(
        //         document.querySelector("#line_chart_datalabel"),
        //         options
        //     );
        //     chart.render();
        // }

        // function drawChart(selectTag) {
        //     var options = {
        //         chart: {
        //             height: 380,
        //             type: 'line',
        //             zoom: {
        //                 enabled: false
        //             },
        //             toolbar: {
        //                 show: false
        //             }
        //         },
        //         colors: linechartDatalabelColors,
        //         dataLabels: {
        //             enabled: false,
        //         },
        //         stroke: {
        //             width: [3, 3],
        //             curve: 'straight'
        //         },
        //         series: [],
        //         title: {
        //             text: '',
        //             align: 'left',
        //             style: {
        //                 fontWeight: 500,
        //             },
        //         },
        //         grid: {
        //             row: {
        //                 colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
        //                 opacity: 0.2
        //             },
        //             borderColor: '#f1f1f1'
        //         },
        //         markers: {
        //             style: 'inverted',
        //             size: 6
        //         },
        //         xaxis: {
        //             categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        //             title: {
        //                 text: 'Month'
        //             }
        //         },
        //         yaxis: {
        //             title: {
        //                 text: 'Values'
        //             },
        //             min: 5,
        //             // max: 40
        //         },
        //         legend: {
        //             position: 'top',
        //             horizontalAlign: 'right',
        //             floating: true,
        //             offsetY: -25,
        //             offsetX: -5
        //         },
        //         responsive: [{
        //             breakpoint: 600,
        //             options: {
        //                 chart: {
        //                     toolbar: {
        //                         show: false
        //                     }
        //                 },
        //                 legend: {
        //                     show: false
        //                 },
        //             }
        //         }]
        //     }

        //     series = [];
        //     Array.from(selectTag.children).forEach(element => {
        //         series.push(
        //             chartOptions[element.value]
        //         )

        //     });

        //     options.series = series;

        //     document.getElementById("line_chart_datalabel").innerHTML = "";
        //     var chart = new ApexCharts(
        //         document.querySelector("#line_chart_datalabel"),
        //         options
        //     );
        //     chart.render();

        //     // console.log(options);

        // }

        function getChartColorsArray(chartId) {
            if (document.getElementById(chartId) !== null) {
                var colors = document.getElementById(chartId).getAttribute("data-colors");
                if (colors) {
                    colors = JSON.parse(colors);
                    return colors.map(function(value) {
                        var newValue = value.replace(" ", "");
                        if (newValue.indexOf(",") === -1) {
                            var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                            if (color) return color;
                            else return newValue;;
                        } else {
                            var val = value.split(',');
                            if (val.length == 2) {
                                var rgbaColor = getComputedStyle(document.documentElement).getPropertyValue(val[0]);
                                rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
                                return rgbaColor;
                            } else {
                                return newValue;
                            }
                        }
                    });
                }
            }
        }

        //  Line chart datalabel
        var linechartDatalabelColors = getChartColorsArray("line_chart_datalabel");
        // if (linechartDatalabelColors) {
        //     var options = {
        //         chart: {
        //             height: 380,
        //             type: 'line',
        //             zoom: {
        //                 enabled: false
        //             },
        //             toolbar: {
        //                 show: false
        //             }
        //         },
        //         colors: linechartDatalabelColors,
        //         dataLabels: {
        //             enabled: false,
        //         },
        //         stroke: {
        //             width: [3, 3],
        //             curve: 'straight'
        //         },
        //         series: [],
        //         title: {
        //             text: '',
        //             align: 'left',
        //             style: {
        //                 fontWeight: 500,
        //             },
        //         },
        //         grid: {
        //             row: {
        //                 colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
        //                 opacity: 0.2
        //             },
        //             borderColor: '#f1f1f1'
        //         },
        //         markers: {
        //             style: 'inverted',
        //             size: 6
        //         },
        //         xaxis: {
        //             categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        //             title: {
        //                 text: 'Month'
        //             }
        //         },
        //         yaxis: {
        //             title: {
        //                 text: 'value'
        //             },
        //             min: 5,
        //             max: 40
        //         },
        //         legend: {
        //             position: 'top',
        //             horizontalAlign: 'right',
        //             floating: true,
        //             offsetY: -25,
        //             offsetX: -5
        //         },
        //         responsive: [{
        //             breakpoint: 600,
        //             options: {
        //                 chart: {
        //                     toolbar: {
        //                         show: false
        //                     }
        //                 },
        //                 legend: {
        //                     show: false
        //                 },
        //             }
        //         }]
        //     }

        //     var chart = new ApexCharts(
        //         document.querySelector("#line_chart_datalabel"),
        //         options
        //     );
        //     chart.render();
        // }
    </script>


    {{-- <script src="{{ URL::asset('build/js/pages/apexcharts-column.init.js') }}"></script> --}}
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
