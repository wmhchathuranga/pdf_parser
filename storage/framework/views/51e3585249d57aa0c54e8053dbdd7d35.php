<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body d-flex justify-content-end">
                    <div class="col-3 col-lg-4 pe-3">
                        <select class="form-control my-auto" data-choices name="choices-single-default"
                            id="choices-single-default" wire:change="changeCompany($event.target.value)">
                            <option value="">Search by ABN</option>
                            <!--[if BLOCK]><![endif]--><?php if($companies != null): ?>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($company['abn']); ?>"
                                        <?php echo e($selectedCompany == $company['abn'] ? 'selected' : ''); ?>>
                                        <?php echo e($company['company_name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12"></div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive pb-4">
                    <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ABN</th>
                                <th>Company Name</th>
                                <th>Quarter ended (“current quarter”)</th>
                                <th>Upload Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--[if BLOCK]><![endif]--><?php if($allReports != null): ?>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $allReports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($report['abn']); ?></td>
                                        <td><?php echo e($report['company_name']); ?></td>
                                        <td><?php echo e($report['quarter_ending']); ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($report['created_at'])->format('d F Y H:i')); ?></td>
                                        <td class="text-center">
                                            <a target="_blank" href="<?php echo e(route('client.single-report', $report['id'])); ?>"
                                                class="btn btn-sm btn-outline-success"><i
                                                    class="ri-eye-fill align-bottom"></i></a>
                                            <a target="_blank" href="<?php echo e(route('client.report-edit', $report['id'])); ?>"
                                                class="btn btn-sm btn-outline-primary"><i
                                                    class="ri-pencil-fill align-bottom"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
<?php /**PATH E:\Projects\Laravel\pdf_extract\resources\views/livewire/fetch-report.blade.php ENDPATH**/ ?>