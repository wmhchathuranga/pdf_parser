<div>
    <div class="row g-3 pb-5 pt-4">
        <div class="col-sm-4">
            <select class="form-control" id="choices-multiple-remove-button">
                <option value="0" selected disabled>Company</option>
                <option value="1">company 01</option>
                <option value="2">company 02</option>
                <option value="3">company 03</option>
            </select>
        </div>

        <div class="col-sm-4">
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
        </div>

        <div class="col-auto">
            <button class="btn btn-primary" onclick="clearChart()">Clear</button>
        </div>

        <div class="col-sm-3">
            <div class="input-group">
                <input onchange="getDateRange(this)" type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-input active"
                    data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y"
                    data-default-date="01 Jan 2024 to 31 Jan 2024" readonly="readonly">
                <div class="input-group-text bg-primary border-primary text-white">
                    <i class="ri-calendar-2-line"></i>
                </div>
            </div>
        </div>
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
</div>
<?php /**PATH E:\Projects\Laravel\pdf_extract\resources\views/livewire/single-pdf-chart.blade.php ENDPATH**/ ?>