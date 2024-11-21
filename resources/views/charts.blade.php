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

    <div class="row">
        <div class="col-12 pb-3">
            <div class="bg-dark p-2">
                <h3 class="text-white text-capitalize">Customizable line graph</h3>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-12 py-5">
            <div class="row">
                <div class="col-12">
                    <div class="col-6">
                        <div class="mb-3">
                            <select onchange="drawChart(this)" class="form-control" id="choices-multiple-remove-button"
                                data-choices data-choices-removeItem name="choices-multiple-remove-button" multiple>
                                <option value="0">Dividends Received</option>
                                <option value="1">Government Tax Paid</option>
                                <option value="2">Income Tax Paid</option>
                                <option value="3">Interest Paid</option>
                                <option value="4">Interest Received</option>
                                <option value="5">Net Cash from Operating Activities</option>
                                <option value="6">Payments for Admin Costs</option>
                                <option value="7">Payments for Development</option>
                                <option value="8">Payments for Exploration & Evaluation</option>
                                <option value="9">Other</option>
                            </select>
                            <button class="btn btn-primary" onclick="clearChart()">clear</button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-auto">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-input active"
                            data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y"
                            data-deafult-date="01 Jan 2022 to 31 Jan 2022" readonly="readonly">
                        <div class="input-group-text bg-primary border-primary text-white">
                            <i class="ri-calendar-2-line"></i>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div> --}}

    {{-- <div class="row">
        <div class="col-12 py-5">
            <div class="row">
                <!-- Dropdown with Clear Button -->
                <div class="col-6">
                    <div class="mb-3">
                        <select onchange="drawChart(this)" class="form-control" id="choices-multiple-remove-button"
                            data-choices data-choices-removeItem name="choices-multiple-remove-button" multiple>
                            <option value="0">Dividends Received</option>
                            <option value="1">Government Tax Paid</option>
                            <option value="2">Income Tax Paid</option>
                            <option value="3">Interest Paid</option>
                            <option value="4">Interest Received</option>
                            <option value="5">Net Cash from Operating Activities</option>
                            <option value="6">Payments for Admin Costs</option>
                            <option value="7">Payments for Development</option>
                            <option value="8">Payments for Exploration & Evaluation</option>
                            <option value="9">Other</option>
                        </select>
                        <button class="btn btn-primary" onclick="clearChart()">Clear</button>
                    </div>
                </div>

                <!-- Date Picker -->
                <div class="col-sm-auto">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-input active"
                            data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y"
                            data-default-date="01 Jan 2024 to 31 Jan 2024" readonly="readonly">
                        <div class="input-group-text bg-primary border-primary text-white">
                            <i class="ri-calendar-2-line"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}




    <div class="row g-3 pb-5 pt-4">
        <div class="col-sm-6">
            <select onchange="drawChart(this)" class="form-control" id="choices-multiple-remove-button" data-choices
                data-choices-removeItem name="choices-multiple-remove-button" multiple>
                <option value="0">Dividends Received</option>
                <option value="1">Government Tax Paid</option>
                <option value="2">Income Tax Paid</option>
                <option value="3">Interest Paid</option>
                <option value="4">Interest Received</option>
                <option value="5">Net Cash from Operating Activities</option>
                <option value="6">Payments for Admin Costs</option>
                <option value="7">Payments for Development</option>
                <option value="8">Payments for Exploration & Evaluation</option>
                <option value="9">Other</option>
            </select>
        </div><!--end col-->
        <div class="col-auto">
            <button class="btn btn-primary" onclick="clearChart()">Clear</button>
        </div><!--end col-->
        <div class="col-sm-4">
            <div class="input-group">
                <input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-input active"
                    data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y"
                    data-default-date="01 Jan 2024 to 31 Jan 2024" readonly="readonly">
                <div class="input-group-text bg-primary border-primary text-white">
                    <i class="ri-calendar-2-line"></i>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->




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
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/dayjs.min.js') }}"></script>
    <script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/plugin/quarterOfYear.min.js') }}">
    </script>


    <script src="{{ URL::asset('build/libs/choicesjs/choices.min.js') }}"></script>

    <script>
        var chartOptions = [{
                "name": "Dividends Received",
                "data": [26, 24, 32, 36, 33, 31, 33]
            },
            {
                "name": "Government Tax Paid",
                "data": [14, 11, 16, 12, 17, 13, 12]
            },
            {
                "name": "Income Tax Paid",
                "data": [20, 18, 22, 25, 21, 20, 22, 67, 26, 58]
            },
            {
                "name": "Interest Paid",
                "data": [10, 8, 11, 9, 10, 8, 9]
            },
            {
                "name": "Interest Received",
                "data": [15, 14, 16, 18, 17, 15, 16]
            },
            {
                "name": "Net Cash from Operating Activities",
                "data": [30, 28, 35, 32, 33, 31, 29]
            },
            {
                "name": "Payments for Admin Costs",
                "data": [12, 10, 14, 13, 11, 9, 10]
            },
            {
                "name": "Payments for Development",
                "data": [22, 20, 25, 23, 21, 19, 20]
            },
            {
                "name": "Payments for Exploration & Evaluation",
                "data": [18, 15, 19, 17, 16, 14, 15]
            },
            {
                "name": "Other",
                "data": [8, 7, 10, 9, 8, 6, 7]
            }
        ];

        function drawChart(selectTag) {
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
                colors: linechartDatalabelColors,
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: [3, 3],
                    curve: 'straight'
                },
                series: [],
                title: {
                    text: '',
                    align: 'left',
                    style: {
                        fontWeight: 500,
                    },
                },
                grid: {
                    row: {
                        colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.2
                    },
                    borderColor: '#f1f1f1'
                },
                markers: {
                    style: 'inverted',
                    size: 6
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    title: {
                        text: 'Month'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Values'
                    },
                    min: 5,
                    // max: 40
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
            }

            series = [];
            Array.from(selectTag.children).forEach(element => {
                series.push(
                    chartOptions[element.value]
                )

            });

            options.series = series;

            document.getElementById("line_chart_datalabel").innerHTML = "";
            var chart = new ApexCharts(
                document.querySelector("#line_chart_datalabel"),
                options
            );
            chart.render();

            // console.log(options);

        }

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
        if (linechartDatalabelColors) {
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
                colors: linechartDatalabelColors,
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: [3, 3],
                    curve: 'straight'
                },
                series: [],
                title: {
                    text: '',
                    align: 'left',
                    style: {
                        fontWeight: 500,
                    },
                },
                grid: {
                    row: {
                        colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.2
                    },
                    borderColor: '#f1f1f1'
                },
                markers: {
                    style: 'inverted',
                    size: 6
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    title: {
                        text: 'Month'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Temperature'
                    },
                    min: 5,
                    max: 40
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
            }

            var chart = new ApexCharts(
                document.querySelector("#line_chart_datalabel"),
                options
            );
            chart.render();
        }


        function clearChart() {
            alert("clearChart");
            document.querySelector(".choices__list.choices__list--multiple").innerHTML = "";
            drawChart();
        }

    </script>
    {{-- <script src="{{ URL::asset('build/js/pages/apexcharts-column.init.js') }}"></script> --}}
    
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
