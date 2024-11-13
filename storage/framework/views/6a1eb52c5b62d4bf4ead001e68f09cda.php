
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ABN</th>
                                    <th>Upload Date</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Report Type</th>
                                    <th class="text-center">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>75633936526</td>
                                    <td>31 December 2023</td>
                                    <td class="text-center"><span class="badge bg-success">Success</span></td>
                                    <td class="text-center">Appendix 5B</td>
                                    <td class="text-center"><button class="btn btn-sm btn-outline-success"><i
                                                class="ri-eye-fill align-bottom"></i></button></td>
                                </tr>
                                <tr>
                                    <td>75633936530</td>
                                    <td>31 December 2023</td>
                                    <td class="text-center"><span class="badge bg-danger">Failed</span></td>
                                    <td class="text-center">Appendix 3X</td>
                                    <td class="text-center"><button class="btn btn-sm btn-outline-success"><i
                                                class="ri-eye-fill align-bottom"></i></button></td>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\Laravel\pdf_extract\resources\views/cl/all-reports.blade.php ENDPATH**/ ?>