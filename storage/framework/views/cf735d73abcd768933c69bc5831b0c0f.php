<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/logo-dark.png')); ?>" alt="" height="36">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/logo-light.png')); ?>" alt="" height="36">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    

    
    <?php if(Auth::user()->user_role_id == 1): ?>
    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span><?php echo app('translator')->get('translation.menu'); ?>
                    </span>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('dev-all-reports')); ?>">
                        <i class="mdi mdi-file-pdf-box"></i> <span>All Reports</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('dev-all-clients')); ?>">
                        <i class="mdi mdi-group"></i> <span>All clients</span>
                    </a>
                </li>

                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <?php endif; ?>

    
    <?php if(Auth::user()->user_role_id == 2): ?>
    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span><?php echo app('translator')->get('translation.menu'); ?>
                    </span>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('ad-all-reports')); ?>">
                        <i class="mdi mdi-file-pdf-box"></i> <span>All Reports</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('ad-all-clients')); ?>">
                        <i class="mdi mdi-group"></i> <span>All clients</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <?php endif; ?>

    
    <?php if(Auth::user()->user_role_id == 3): ?>
        <div id="scrollbar">
            <div class="container-fluid">

                <div id="two-column-menu">
                </div>
                <ul class="navbar-nav" id="navbar-nav">
                    <li class="menu-title"><span><?php echo app('translator')->get('translation.menu'); ?>
                        </span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(route('cl-appendix-5b-upload')); ?>">
                            <i class="mdi mdi-file-pdf-box"></i> <span>Appendix 5B</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(route('cl-appendix-3x-upload')); ?>">
                            <i class="mdi mdi-file-pdf-box"></i> <span>Appendix 3X</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(route('cl-all-reports')); ?>">
                            <i class="mdi mdi-file-document"></i> <span>All Reports</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(route('cl-comperission-table')); ?>">
                            <i class="mdi mdi-table"></i> <span>Comperission Table</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#analytics-charts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="analytics-charts">
                            <i class="mdi mdi-chart-arc"></i> <span>Analytics</span>
                        </a>
                        <div class="collapse menu-dropdown" id="analytics-charts">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('cl-single-pdf-chart')); ?>" class="nav-link">Single PDF Chart</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    

                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    <?php endif; ?>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
<?php /**PATH E:\Projects\Laravel\pdf_extract\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>