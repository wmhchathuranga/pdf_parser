<table id="buttons-datatables" class="display table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>ABN</th>
            <th>Company Name</th>
            <th>Upload Date</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $jsonData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <tr>
                <td><?php echo e($report['abn']); ?></td>
                <td><?php echo e($report['company_name']); ?></td>
                <td><?php echo e($report['quarter_ending']); ?></td>
                <td class="text-center">
                    <a target="_blank" href="<?php echo e(route('client.single-report', $report['id'])); ?>" class="btn btn-sm btn-outline-success"><i class="ri-eye-fill align-bottom"></i></a>
                    <a target="_blank" href="<?php echo e(route('client.report-edit', $report['id'])); ?>" class="btn btn-sm btn-outline-primary"><i class="ri-pencil-fill align-bottom"></i></a>
                </td>
            </tr>
            
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        
    </tbody>
</table>
<?php /**PATH E:\Projects\Laravel\pdf_extract\resources\views/livewire/fetch-report.blade.php ENDPATH**/ ?>