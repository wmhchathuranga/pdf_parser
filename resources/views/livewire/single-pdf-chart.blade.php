<div>
    <div class="row g-3 pb-5 pt-4">
        <div class="col-sm-4">
            {{-- data-choices name="choices-single-default"
                id="choices-single-default-1"  --}}
            <select class="form-control" id="abn" onchange="removeAlert()" wire:model.defer="selectedCompany">
                <option value="">Select Company</option>
                @if ($companies != null)
                    @foreach ($companies as $company)
                        <option value="{{ $company['abn'] }}">{{ $company['company_name'] }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col-sm-3">
            <div class="input-group">
                <input onchange="removeAlert()" wire:model.defer="selectedDateRange" type="text" id="dateRange"
                    class="form-control border-0 dash-filter-picker shadow flatpickr-input active"
                    value="{{ $selectedDateRange }}" {{-- data-default-date="01 Jan 2024 to 31 Jan 2024" --}} data-provider="flatpickr"
                    data-range-date="true" data-date-format="d M, Y" readonly="readonly">
                <div class="input-group-text bg-primary border-primary text-white">
                    <i class="ri-calendar-2-line"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            {{-- data-choices name="choices-single-default" id="choices-single-default"  --}}
            <select onchange="removeAlert()" class="form-control" wire:model.defer="selectedTopic" id="topic">
                <option value="">Select Topic</option>
                {{-- tb  01 --}}
                <optgroup label="Cash flows from operating activities">
                    <option value="0-receipts_from_customers"
                        {{ $selectedTopic == 'receipts_from_customers' ? 'selected' : '' }}>Receipts From Customers
                    </option>
                    <option value="0-payments_exploration_evaluation"
                        {{ $selectedTopic == 'payments_exploration_evaluation' ? 'selected' : '' }}>Payments Exploration
                        Evaluation</option>
                    <option value="0-payments_development"
                        {{ $selectedTopic == 'payments_development' ? 'selected' : '' }}>Payments Development</option>
                    <option value="0-payments_production"
                        {{ $selectedTopic == 'payments_production' ? 'selected' : '' }}>
                        Payments Production</option>
                    <option value="0-payments_staff_costs"
                        {{ $selectedTopic == 'payments_staff_costs' ? 'selected' : '' }}>Payments Staff Costs</option>
                    <option value="0-payments_admin_costs"
                        {{ $selectedTopic == 'payments_admin_costs' ? 'selected' : '' }}>Payments Admin Costs</option>
                    <option value="0-dividends_received" {{ $selectedTopic == 'dividends_received' ? 'selected' : '' }}>
                        Dividends Received</option>
                    <option value="0-interest_received" {{ $selectedTopic == 'interest_received' ? 'selected' : '' }}>
                        Interest Received</option>
                    <option value="0-interest_paid" {{ $selectedTopic == 'interest_paid' ? 'selected' : '' }}>Interest
                        Paid</option>
                    <option value="0-income_tax_paid" {{ $selectedTopic == 'income_tax_paid' ? 'selected' : '' }}>
                        Income
                        Tax Paid</option>
                    <option value="0-government_tax_paid"
                        {{ $selectedTopic == 'government_tax_paid' ? 'selected' : '' }}>Government Tax Paid</option>
                    <option value="0-other" {{ $selectedTopic == 'other' ? 'selected' : '' }}>Other</option>
                    <option value="0-net_cash_from_operating"
                        {{ $selectedTopic == 'net_cash_from_operating' ? 'selected' : '' }}>Net Cash From Operating
                    </option>

                </optgroup>

                {{-- tb 02 --}}
                <optgroup label="Cash flows from investing activities">
                    <option value="1-payments_for_entities"
                        {{ $selectedTopic == 'payments_for_entities' ? 'selected' : '' }}>Payments For Entities
                    </option>
                    <option value="1-payments_for_tenements"
                        {{ $selectedTopic == 'payments_for_tenements' ? 'selected' : '' }}>Payments For Tenements
                    </option>
                    <option value="1-payments_for_property"
                        {{ $selectedTopic == 'payments_for_property' ? 'selected' : '' }}>Payments For Property
                    </option>
                    <option value="1-payments_for_exploration_evaluation"
                        {{ $selectedTopic == 'payments_for_exploration_evaluation' ? 'selected' : '' }}>Payments For
                        Exploration Evaluation</option>
                    <option value="1-payments_for_investment"
                        {{ $selectedTopic == 'payments_for_investment' ? 'selected' : '' }}>Payments For Investment
                    </option>
                    <option value="1-payments_for_other"
                        {{ $selectedTopic == 'payments_for_other' ? 'selected' : '' }}>
                        Payments For Other</option>
                    <option value="1-proceeds_from_entities"
                        {{ $selectedTopic == 'proceeds_from_entities' ? 'selected' : '' }}>Proceeds From Entities
                    </option>
                    <option value="1-proceeds_from_tenements"
                        {{ $selectedTopic == 'proceeds_from_tenements' ? 'selected' : '' }}>Proceeds From Tenements
                    </option>
                    <option value="1-proceeds_from_property"
                        {{ $selectedTopic == 'proceeds_from_property' ? 'selected' : '' }}>Proceeds From Property
                    </option>
                    <option value="1-proceeds_from_investment"
                        {{ $selectedTopic == 'proceeds_from_investment' ? 'selected' : '' }}>Proceeds From Investment
                    </option>
                    <option value="1-proceeds_from_other"
                        {{ $selectedTopic == 'proceeds_from_other' ? 'selected' : '' }}>Proceeds From Other</option>
                    <option value="1-cash_flow_from_loans"
                        {{ $selectedTopic == 'cash_flow_from_loans' ? 'selected' : '' }}>Cash Flow From Loans</option>
                    <option value="1-dividends_received_2"
                        {{ $selectedTopic == 'dividends_received_2' ? 'selected' : '' }}>Dividends Received</option>
                    <option value="1-other_2" {{ $selectedTopic == 'other_2' ? 'selected' : '' }}>Other</option>
                    <option value="1-net_cash_from_investing"
                        {{ $selectedTopic == 'net_cash_from_investing' ? 'selected' : '' }}>Net Cash From Investing
                    </option>

                </optgroup>

                {{-- tb 03 --}}
                <optgroup label="Cash flows from financing activities">
                    <option value="2-proceeds_from_equity"
                        {{ $selectedTopic == 'proceeds_from_equity' ? 'selected' : '' }}>Proceeds From Equity</option>
                    <option value="2-proceeds_from_debt"
                        {{ $selectedTopic == 'proceeds_from_debt' ? 'selected' : '' }}>
                        Proceeds From Debt</option>
                    <option value="2-proceeds_from_exercise"
                        {{ $selectedTopic == 'proceeds_from_exercise' ? 'selected' : '' }}>Proceeds From Exercise
                    </option>
                    <option value="2-transaction_costs_for_securities"
                        {{ $selectedTopic == 'transaction_costs_for_securities' ? 'selected' : '' }}>Transaction Costs
                        For Securities</option>
                    <option value="2-proceeds_from_borrowing"
                        {{ $selectedTopic == 'proceeds_from_borrowing' ? 'selected' : '' }}>Proceeds From Borrowing
                    </option>
                    <option value="2-repayments_of_borrowing"
                        {{ $selectedTopic == 'repayments_of_borrowing' ? 'selected' : '' }}>Repayments Of Borrowing
                    </option>
                    <option value="2-transaction_costs_for_borrowing"
                        {{ $selectedTopic == 'transaction_costs_for_borrowing' ? 'selected' : '' }}>Transaction Costs
                        For Borrowing</option>
                    <option value="2-dividends_paid" {{ $selectedTopic == 'dividends_paid' ? 'selected' : '' }}>
                        Dividends
                        Paid</option>
                    <option value="2-other_3" {{ $selectedTopic == 'other_3' ? 'selected' : '' }}>Other</option>
                    <option value="2-net_cash_from_financing"
                        {{ $selectedTopic == 'net_cash_from_financing' ? 'selected' : '' }}>Net Cash From Financing
                    </option>

                </optgroup>

                {{-- tb 04 --}}
                <optgroup label="Cash flow details">
                    <option value="3-beginning_cash" {{ $selectedTopic == 'beginning_cash' ? 'selected' : '' }}>
                        Beginning
                        Cash</option>
                    <option value="3-operating_cash_flow"
                        {{ $selectedTopic == 'operating_cash_flow' ? 'selected' : '' }}>Operating Cash Flow</option>
                    <option value="3-investing_cash_flow"
                        {{ $selectedTopic == 'investing_cash_flow' ? 'selected' : '' }}>Investing Cash Flow</option>
                    <option value="3-financing_cash_flow"
                        {{ $selectedTopic == 'financing_cash_flow' ? 'selected' : '' }}>Financing Cash Flow</option>
                    <option value="3-effect_of_movement"
                        {{ $selectedTopic == 'effect_of_movement' ? 'selected' : '' }}>
                        Effect Of Movement</option>
                    <option value="3-end_cash" {{ $selectedTopic == 'end_cash' ? 'selected' : '' }}>End Cash</option>

                </optgroup>

                {{-- tb 05 --}}
                <optgroup label="Reconciliation details">
                    <option value="4-bank_balance" {{ $selectedTopic == 'bank_balance' ? 'selected' : '' }}>Bank
                        Balance
                    </option>
                    <option value="4-call_deposits" {{ $selectedTopic == 'call_deposits' ? 'selected' : '' }}>Call
                        Deposits</option>
                    <option value="4-bank_overdrafts" {{ $selectedTopic == 'bank_overdrafts' ? 'selected' : '' }}>Bank
                        Overdrafts</option>
                    <option value="4-other_4" {{ $selectedTopic == 'other_4' ? 'selected' : '' }}>Other</option>
                    <option value="4-cash_equivalents_end_period"
                        {{ $selectedTopic == 'cash_equivalents_end_period' ? 'selected' : '' }}>Cash Equivalents End
                        Period</option>
                </optgroup>

                {{-- tb 06 --}}
                <optgroup label="Related party payments">
                    <option value="5-aggregated_1" {{ $selectedTopic == 'aggregated_1' ? 'selected' : '' }}>Aggregated
                        1
                    </option>
                    <option value="5-aggregated_2" {{ $selectedTopic == 'aggregated_2' ? 'selected' : '' }}>Aggregated
                        2
                    </option>
                </optgroup>

                {{-- tb 07 --}}
                <optgroup label="Financing facilities">
                    <option value="6-loans" {{ $selectedTopic == 'loans' ? 'selected' : '' }}>Loans</option>
                    <option value="6-credit_standby" {{ $selectedTopic == 'credit_standby' ? 'selected' : '' }}>Credit
                        Standby</option>
                    <option value="6-other_5" {{ $selectedTopic == 'other_5' ? 'selected' : '' }}>Other</option>
                    <option value="6-total_financing" {{ $selectedTopic == 'total_financing' ? 'selected' : '' }}>Total
                        Financing</option>
                    <option value="6-unused_financing_facilities"
                        {{ $selectedTopic == 'unused_financing_facilities' ? 'selected' : '' }}>Unused Financing
                        Facilities</option>
                </optgroup>

                {{-- tb 08 --}}
                <optgroup label="Estimated cash availabilities">
                    <option value="7-net_cash_operating"
                        {{ $selectedTopic == 'net_cash_operating' ? 'selected' : '' }}>
                        Net Cash Operating</option>
                    <option value="7-future_payments_for_exploration_evaluation"
                        {{ $selectedTopic == 'future_payments_for_exploration_evaluation' ? 'selected' : '' }}>Future
                        Payments For Exploration Evaluation</option>
                    <option value="7-total_relevant_payments"
                        {{ $selectedTopic == 'total_relevant_payments' ? 'selected' : '' }}>Total Relevant Payments
                    </option>
                    <option value="7-future_cash_equivalents_end_period"
                        {{ $selectedTopic == 'future_cash_equivalents_end_period' ? 'selected' : '' }}>Future Cash
                        Equivalents End Period</option>
                    <option value="7-unused_financing_facilities_end_period"
                        {{ $selectedTopic == 'unused_financing_facilities_end_period' ? 'selected' : '' }}>Unused
                        Financing Facilities End Period</option>
                    <option value="7-total_available_funding"
                        {{ $selectedTopic == 'total_available_funding' ? 'selected' : '' }}>Total Available Funding
                    </option>
                    <option value="7-estimated_quarterly_funding"
                        {{ $selectedTopic == 'estimated_quarterly_funding' ? 'selected' : '' }}>Estimated Quarterly
                        Funding</option>

                </optgroup>
            </select>

        </div>

        <div class="col-auto">
            {{-- <button class="btn btn-primary" onclick="clearChart()">Clear</button> --}}
            <button class="btn btn-outline-danger px-4" id="btn_analyze" wire:click="analyzeChart()"><i
                    class="mdi mdi-poll"></i></button>
        </div>

    </div>

    @if (session('error'))
        <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @if ($tableIndex != '')
                            {{ $tables[$tableIndex] }}
                        @endif
                    </h4>
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
    </div>


    <script>
        function removeAlert() {
            var alert = document.getElementById('error-alert');
            if (alert) {
                alert.classList.remove('show'); // Hides Bootstrap's fade show effect
                alert.addEventListener('transitionend', () => alert
                    .remove()); // Removes the alert after the fade-out transition
            }
        }

        document.getElementById('btn_analyze').addEventListener('click', function() {
            setTimeout(() => {
                drawChart(@this.chartData);
            }, 2000);
        });

        window.addEventListener('livewire:initialized', function() {
            drawChart();
        });

        function drawChart(chartData) {
            var chartData = @this.chartData;
            var options = {
                chart: {
                    height: 380,
                    type: 'line',
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#0ab39c', '#f46a6a', '#f1b44c', '#556ee6', '#34c38f', '#50a5f1', '#f1b44c', '#0ab39c'],
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: [3, 3],
                    curve: 'straight'
                },
                series: [], // Will be populated dynamically
                title: {
                    text: '',
                    align: 'left',
                    style: {
                        fontWeight: 500,
                    },
                },
                grid: {
                    row: {
                        colors: ['transparent', 'transparent'], // takes an array which will be repeated on rows
                        opacity: 0.2
                    },
                    borderColor: '#f1f1f1'
                },
                markers: {
                    style: 'inverted',
                    size: 6
                },
                xaxis: {
                    categories: [], // Will be populated with chartData.x_axis
                    title: {
                        text: 'Quarter Ends',
                    }
                },
                yaxis: {
                    title: {
                        text: 'Values'
                    },
                    min: 5,
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    floating: true,
                    offsetY: -25,
                    offsetX: -5
                },
                responsive: [{
                    breakpoint: 600,
                    options: {
                        chart: {
                            toolbar: {
                                show: false
                            }
                        },
                        legend: {
                            show: false
                        },
                    }
                }]
            };

            series = [];
            options.xaxis.categories = chartData.x_axis || [];
            for (let key in chartData) {
                if (key !== "x_axis") { // Exclude x_axis from the series data
                    series.push({
                        name: key.replace(/_/g, ' '), // Replace underscores with spaces for readability
                        data: chartData[key].map(Number)
                    });
                }
            }
            options.series = series;
            // console.log(options.series[0].data);

            // Clear previous chart and render the new one
            if (chart) {
                chart.destroy();
            }
            document.getElementById("line_chart_datalabel").innerHTML = "";
            var chart = new ApexCharts(
                document.querySelector("#line_chart_datalabel"),
                options
            );
            chart.render();
        }
    </script>


</div>
