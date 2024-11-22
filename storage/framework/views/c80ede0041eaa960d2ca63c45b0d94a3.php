
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.datatables'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Charts
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Charts
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-12 pb-3">
            <div class="bg-dark p-2">
                <h3 class="text-white text-capitalize">Customizable line graph</h3>
            </div>
        </div>
    </div>

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('single-pdf-chart');

$__html = app('livewire')->mount($__name, $__params, 'lw-3967523406-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

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

    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    
    <script src="<?php echo e(URL::asset('build/libs/apexcharts/apexcharts.min.js')); ?>"></script>

    <script src="<?php echo e(URL::asset('https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/dayjs.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/plugin/quarterOfYear.min.js')); ?>">
    </script>


    

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

        window.addEventListener('call-chart-draw-function', function(event) {
            // alert("ok");
            drawChart(event.detail[0].data);
        });

        function drawChart(dataArray) {

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
                    categories: [], // Will be populated with dataArray.x_axis
                    title: {
                        text: 'Month'
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
            options.xaxis.categories = dataArray.x_axis || [];
            for (let key in dataArray) {
                if (key !== "x_axis") { // Exclude x_axis from the series data
                    series.push({
                        name: key.replace(/_/g, ' '), // Replace underscores with spaces for readability
                        data: dataArray[key].map(Number)
                    });
                }
            }
            options.series = series;
            console.log(options.series[0].data);

            // Clear previous chart and render the new one
            
            document.getElementById("line_chart_datalabel").innerHTML = "";
            var chart = new ApexCharts(
                document.querySelector("#line_chart_datalabel"),
                options
            );
            chart.render();
        }



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


    
    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\Laravel\pdf_extract\resources\views/cl/single-pdf-chart.blade.php ENDPATH**/ ?>