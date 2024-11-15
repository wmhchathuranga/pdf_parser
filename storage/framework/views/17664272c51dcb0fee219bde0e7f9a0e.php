
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
            Reports
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            All Reports
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>


    <div class="row">
        <div class="col-lg-12">
            <div class="mb-3">
                <h2 class="">Quarterly Reports</h2>
                <p class="text-muted mb-0">Browse through our quarterly reports and view details about each
                    company’s financial status.
                </p>
            </div>
            <div class="card">
                <div class="card-body d-flex justify-content-end">
                    <div class="col-3 col-lg-4 pe-5">
                        <div class="row">
                            <div class="col">
                                <input type="date" class="col-auto form-control" id="exampleInputdate">
                            </div>
                            <div class="col-auto py-2">
                                <span> to </span>
                            </div>
                            <div class="col">
                                <input type="date" class="col-auto form-control" id="exampleInputdate">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-lg-4 pe-3">
                        <select class="form-control my-auto" data-choices name="choices-single-default"
                            id="choices-single-default">
                            <option value="">Search by ABN</option>
                            <option value="Choice 1">Choice 1</option>
                            <option value="Choice 2">Choice 2</option>
                            <option value="Choice 3">Choice 3</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-light btn-icon waves-effect"><i class="mdi mdi-magnify lg"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    

                    <div class="table-responsive pb-4">
                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th colspan="4"></th>
                                    <th colspan="26" class="table-dark text-white">Cash Flows from Operating Activities</th>
                                    <th colspan="30" class="table-dark text-white">Cash Flows from Investing Activities</th>
                                    <th colspan="20" class="table-dark text-white">Cash Flows from Financing Activities</th>
                                    <th colspan="12" class="table-dark text-white">Cash Flow Summary</th>
                                    <th colspan="10" class="table-dark text-white">Reconciliation of Cash and Cash Equivalents</th>
                                    <th colspan="4" class="table-dark text-white">Payments to Related Parties</th>
                                    <th colspan="10" class="table-dark text-white">Financing and Credit Facilities</th>
                                    <th colspan="14" class="table-dark text-white">Cash Flow and Funding</th>
                                </tr>
                                <tr>
                                    <th rowspan="2">Action</th>
                                    <th rowspan="2">Quarter Ending</th>
                                    <th rowspan="2">Name of Entity</th>
                                    <th rowspan="2">ABN</th>


                                    <th colspan="2">Dividends Received</th>
                                    <th colspan="2">Government Tax Paid</th>
                                    <th colspan="2">Income Tax Paid</th>
                                    <th colspan="2">Interest Paid</th>
                                    <th colspan="2">Interest Received</th>
                                    <th colspan="2">Net Cash from Operating Activities</th>
                                    <th colspan="2">Other</th>
                                    <th colspan="2">Payments for Admin Costs</th>
                                    <th colspan="2">Payments for Development</th>
                                    <th colspan="2">Payments for Exploration & Evaluation</th>
                                    <th colspan="2">Payments for Production</th>
                                    <th colspan="2">Payments for Staff Costs</th>
                                    <th colspan="2">Receipts from Customers</th>

                                    <th colspan="2">Cash Flow from Loans</th>
                                    <th colspan="2">Dividends Received</th>
                                    <th colspan="2">Net Cash from Investing Activitie</th>
                                    <th colspan="2">Other</th>
                                    <th colspan="2">Payments for Entities</th>
                                    <th colspan="2">Payments for Exploration and Evaluation</th>
                                    <th colspan="2">Payments for Investment</th>
                                    <th colspan="2">Payments for Other</th>
                                    <th colspan="2">Payments for Property</th>
                                    <th colspan="2">Payments for Tenements</th>
                                    <th colspan="2">Proceeds from Entities</th>
                                    <th colspan="2">Proceeds from Investment</th>
                                    <th colspan="2">Proceeds from Other</th>
                                    <th colspan="2">Proceeds from Property</th>
                                    <th colspan="2">Proceeds from Tenements</th>

                                    <th colspan="2">Dividends Paid</th>
                                    <th colspan="2">Net Cash from Financing Activities</th>
                                    <th colspan="2">Other Financing Activities</th>
                                    <th colspan="2">Proceeds from Borrowing</th>
                                    <th colspan="2">Proceeds from Debt</th>
                                    <th colspan="2">Proceeds from Equity</th>
                                    <th colspan="2">Proceeds from Exercise of Options</th>
                                    <th colspan="2">Repayments of Borrowing</th>
                                    <th colspan="2">Transaction Costs for Borrowing</th>
                                    <th colspan="2">Transaction Costs for Securities</th>

                                    <th colspan="2">Beginning Cash</th>
                                    <th colspan="2">Effect of Movement on Cash</th>
                                    <th colspan="2">Ending Cash</th>
                                    <th colspan="2">Financing Cash Flow</th>
                                    <th colspan="2">Investing Cash Flow</th>
                                    <th colspan="2">Operating Cash Flow</th>

                                    <th colspan="2">Bank Balance</th>
                                    <th colspan="2">Bank Overdrafts</th>
                                    <th colspan="2">Call Deposits</th>
                                    <th colspan="2">Cash Equivalents at End of Period</th>
                                    <th colspan="2">Other</th>

                                    <th colspan="2">Aggregated Payment 1</th>
                                    <th colspan="2">Aggregated Payment 2</th>

                                    <th colspan="2">Loans</th>
                                    <th colspan="2">Credit Standby Arrangements</th>
                                    <th colspan="2">Other Financing</th>
                                    <th colspan="2">Total Financing</th>
                                    <th colspan="2">Unused Financing Facilities</th>

                                    <th colspan="2">Net Cash from Operating Activities</th>
                                    <th colspan="2">Payments for Exploration & Evaluation</th>
                                    <th colspan="2">Total Relevant Payments</th>
                                    <th colspan="2">Future Cash Equivalents (End of Period)</th>
                                    <th colspan="2">Unused Financing Facilities (End of Period)</th>
                                    <th colspan="2">Total Available Funding</th>
                                    <th colspan="2">Estimated Quarterly Funding</th>


                                </tr>
                                <tr>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><a href="report" class="btn btn-sm btn-secondary">view</a></td>
                                    <td>30 June 2023</td>
                                    <td>Australian Gold and Copper Limited</td>
                                    <td>75633936526</td>

                                    <td></td>
                                    <td></td>
                                    <td>-66</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-66</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-66</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-43</td>
                                    <td>-174</td>
                                    <td>-87</td>
                                    <td>-397</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-66</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-66</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-66</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-43</td>
                                    <td>-174</td>
                                    <td>-87</td>
                                    <td>-397</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-66</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-66</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-66</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-43</td>
                                    <td>-174</td>
                                    <td>-87</td>
                                    <td>-397</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-66</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-66</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-66</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-43</td>
                                    <td>-174</td>
                                    <td>-87</td>
                                    <td>-397</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-66</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-66</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-43</td>
                                    <td>-174</td>
                                    <td>-87</td>
                                    <td>-397</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><a href="report" class="btn btn-sm btn-secondary">view</a></td>
                                    <td>31 December 2023</td>
                                    <td>Australian Gold and Copper Limited</td>
                                    <td>75633936528</td>

                                    <td></td>
                                    <td></td>
                                    <td>-47</td>
                                    <td>-94</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-47</td>
                                    <td>-94</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-114</td>
                                    <td>-220</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-47</td>
                                    <td>-94</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-47</td>
                                    <td>-94</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-114</td>
                                    <td>-220</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-47</td>
                                    <td>-94</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-47</td>
                                    <td>-94</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-114</td>
                                    <td>-220</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-47</td>
                                    <td>-94</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-47</td>
                                    <td>-94</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-114</td>
                                    <td>-220</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-47</td>
                                    <td>-94</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-114</td>
                                    <td>-220</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
        //buttons examples
        let buttonsDataTables = new DataTable('#buttons-datatables', {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print', 'pdf'
            ],
            paging: false
        });
    </script>

    

    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\Laravel\pdf_extract\resources\views/ad/all-reports.blade.php ENDPATH**/ ?>