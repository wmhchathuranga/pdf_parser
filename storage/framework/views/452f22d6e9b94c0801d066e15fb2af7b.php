
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.file-uploads'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('build/libs/dropzone/dropzone.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(URL::asset('build/libs/filepond/filepond.min.css')); ?>" type="text/css" />
    <link rel="stylesheet"
        href="<?php echo e(URL::asset('build/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Forms
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            File Upload
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">

        <div class="col-12">
            <?php if(isset($success)): ?>
                <div class="alert alert-success pb-0" id="success-alert">
                    <ul>
                        <li>PDF Uploaded Successfully</li>
                    </ul>
                </div>
                <script>
                    setTimeout(() => {
                        document.getElementById('success-alert').style.display = 'none';
                    }, 3000);
                </script>
            <?php endif; ?>

            <?php if(isset($error)): ?>
                <div class="alert alert-danger pb-0" id="error-alert">
                    <ul>
                        <li><?php echo e(session('error')); ?></li>
                    </ul>
                </div>
                <script>
                    setTimeout(() => {
                        document.getElementById('error-alert').style.display = 'none';
                    }, 3000);
                </script>
            <?php endif; ?>

            <form action="<?php echo e(route('client.upload-pdf')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">APPENDIX 5B UPLOAD</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <p class="text-muted">Upload a PDF file to the system for further processing.</p>

                            <div class="">
                                <input class="form-control" name="pdf" type="file" multiple="multiple">
                            </div>

                            <div class="pt-4 text-end">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Upload</button>
                            </div>
                            <!-- end dropzon-preview -->
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('build/libs/dropzone/dropzone-min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/libs/filepond/filepond.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js')); ?>">
    </script>
    <script
        src="<?php echo e(URL::asset('build/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js')); ?>">
    </script>
    <script
        src="<?php echo e(URL::asset('build/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js')); ?>">
    </script>
    <script src="<?php echo e(URL::asset('build/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js')); ?>"></script>

    <script src="<?php echo e(URL::asset('build/js/pages/form-file-upload.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\Laravel\pdf_extract\resources\views/cl/appendix-5b-upload.blade.php ENDPATH**/ ?>