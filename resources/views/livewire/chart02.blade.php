<div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body d-flex justify-content-end">
                            <div class="col-3 col-lg-4 pe-3">
                                <select class="form-control my-auto" name="choices-single-default"
                                    id="choices-single-default" wire:change="changeCompany($event.target.value)">
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
                            <div class="col-auto pe-3">
                                {{-- year picker  --}}
                                <select class="form-select my-auto" id="year-picker" onchange="inizializeChart()">
                                    @php
                                        $currentYear = date('Y'); // Get the current year
                                        for ($year = 2021; $year <= $currentYear; $year++) {
                                            echo "<option value='$year'>$year</option>";
                                        }
                                    @endphp
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h4 class="card-title mb-0">Basic Bar Chart</h4> --}}
                            <select name="reportTables" id="report-tables" class="form-select" style="max-width: 300px"
                                onchange="inizializeChart()">
                                <option value="operating_details">1 - Cash flows from operating activities</option>
                                <option value="investing_details">2 - Cash flows from investing activities</option>
                                <option value="financing_details">3 - Cash flows from financing activities</option>
                                <option value="cash_details">4 - Cash flow details</option>
                                <option value="reconciliation_details">5 - Reconciliation details</option>
                                <option value="related_party_payments">6 - Related party payments</option>
                                <option value="financing_facilities">7 - Financing facilities</option>
                                <option value="estimated_cash_availabilities">8 - Estimated cash availabilities</option>
                            </select>
                        </div>

                        <div class="card-body">
                            <div id="bar_chart" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <script>
        let reportsData;

        var barTopics;
        var barValues;
        var tableName;
        var year;

        function inizializeChart() {
            tableName = getTableName();
            year = getYear();
            barTopics = getBarTopics();
            barValues = getBarValues();

            barTopics = barTopics.map(topic => {
                return topic
                    .split('_') // Split by underscores
                    .map(word => word.charAt(0).toUpperCase() + word.slice(1)) // Capitalize each word
                    .join(' '); // Join the words with spaces
            });

            var options = {
                chart: {
                    height: 350,
                    type: 'bar',
                    toolbar: {
                        show: false,
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    data: barValues
                }],
                colors: ["#60d297"],
                grid: {
                    borderColor: '#f1f1f1',
                },
                xaxis: {
                    categories: barTopics,
                }
            }

            // var options = {
            //     series: [{
            //         data: barValues
            //     }],
            //     chart: {
            //         type: 'bar',
            //         height: 350,
            //         toolbar: {
            //             show: true,
            //         }
            //     },
            //     plotOptions: {
            //         bar: {
            //             barHeight: '100%',
            //             distributed: true,
            //             horizontal: true,
            //             dataLabels: {
            //                 position: 'bottom'
            //             },
            //         }
            //     },
            //     colors: ['#4b38b3', '#3577f1', '#45cb85', '#299cdb', '#ffbe0b', '#9497a4', '#212529'],
            //     dataLabels: {
            //         enabled: true,
            //         textAnchor: 'start',
            //         style: {
            //             colors: ['#191919']
            //         },
            //         formatter: function(val, opt) {
            //             return opt.w.globals.labels[opt.dataPointIndex] + "  :  " + val
            //         },
            //         offsetX: 0,
            //         dropShadow: {
            //             enabled: false
            //         }
            //     },
            //     stroke: {
            //         width: 1,
            //         colors: ['#fff']
            //     },
            //     xaxis: {
            //         categories: barTopics,
            //     },
            //     yaxis: {
            //         labels: {
            //             show: false
            //         }
            //     },
            //     // title: {
            //     //     text: 'Custom DataLabels',
            //     //     align: 'center',
            //     //     floating: true,
            //     //     style: {
            //     //         fontWeight: 500,
            //     //     },
            //     // },
            //     // subtitle: {
            //     //     text: 'Category Names as DataLabels inside bars',
            //     //     align: 'center',
            //     // },
            //     tooltip: {
            //         theme: 'dark',
            //         x: {
            //             show: false
            //         },
            //         y: {
            //             title: {
            //                 formatter: function() {
            //                     return ''
            //                 }
            //             }
            //         }
            //     }
            // };

            document.getElementById('bar_chart').innerHTML = '';
            var chart = new ApexCharts(document.querySelector("#bar_chart"), options);
            chart.render();
        }



        function getBarTopics() {
            var table = document.getElementById('report-tables');

            switch (table.value) {
                case "operating_details":
                    return [
                        'receipts_from_customers',
                        'payments_exploration_evaluation',
                        'payments_development',
                        'payments_production',
                        'payments_staff_costs',
                        'payments_admin_costs',
                        'dividends_received',
                        'interest_received',
                        'interest_paid',
                        'income_tax_paid',
                        'government_tax_paid',
                        'other',
                        'net_cash_from_operating'
                    ];
                case "investing_details":
                    return [
                        'payments_for_entities',
                        'payments_for_tenements',
                        'payments_for_property',
                        'payments_for_exploration_evaluation',
                        'payments_for_investment',
                        'payments_for_other',
                        'proceeds_from_entities',
                        'proceeds_from_tenements',
                        'proceeds_from_property',
                        'proceeds_from_investment',
                        'proceeds_from_other',
                        'cash_flow_from_loans',
                        'dividends_received_2',
                        'net_cash_from_investing'
                    ];
                case "financing_details":
                    return [
                        'proceeds_from_equity',
                        'proceeds_from_debt',
                        'proceeds_from_exercise',
                        'transaction_costs_for_securities',
                        'proceeds_from_borrowing',
                        'repayments_of_borrowing',
                        'transaction_costs_for_borrowing',
                        'dividends_paid',
                        'other_3',
                        'net_cash_from_financing'
                    ];
                case "cash_details":
                    return [
                        'beginning_cash',
                        'operating_cash_flow',
                        'investing_cash_flow',
                        'financing_cash_flow',
                        'effect_of_movement',
                        'end_cash'
                    ];
                case "reconciliation_details":
                    return [
                        'bank_balance',
                        'call_deposits',
                        'bank_overdrafts',
                        'other_4',
                        'cash_equivalents_end_period'
                    ];
                case "related_party_payments":
                    return [
                        'aggregated_1',
                        'aggregated_2'
                    ];
                case "financing_facilities":
                    return [
                        'loans',
                        'credit_standby',
                        'other_5',
                        'total_financing',
                        'unused_financing_facilities'
                    ];
                case "estimated_cash_availabilities":
                    return [
                        'net_cash_operating',
                        'future_payments_for_exploration_evaluation',
                        'total_relevant_payments',
                        'future_cash_equivalents_end_period',
                        'unused_financing_facilities_end_period',
                        'total_available_funding',
                        'estimated_quarterly_funding'
                    ];
                default:
                    return [];
            }
        }

        function getBarValues() {
            let selectedYearReports = [];
            reportsData.forEach((report, index) => {
                let quarterEnding = report['quarter_ending']
                if (quarterEnding.includes(year)) {
                    selectedYearReports.push(report);
                }
            });

            let averageValues = [];
            barTopics.forEach((topic, index) => {
                let topicName = topic + '_c_q';
                let sum = 0;
                selectedYearReports.forEach((report, index) => {
                    // console.log(report[tableName][0][topicName]);
                    sum += parseFloat(report[tableName][0][topicName]) || 0;
                });
                console.log(topic, sum / selectedYearReports.length);
                averageValues.push(sum / selectedYearReports.length);
            });

            return averageValues;
        }

        function getTableName() {
            return document.getElementById('report-tables').value;
        }

        function getYear() {
            return document.getElementById('year-picker').value;
        }
    </script>

    @script
        <script>
            $wire.on('refreshChart', (data) => {
                reportsData = data['reportsData'];
                inizializeChart();
            })
        </script>
    @endscript

</div>
