
<?php $__env->startSection('content'); ?>
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject bold uppercase font-dark">
                    <?php echo e($title); ?>

                </span>
            </div>

        </div>
        <div class="portlet-body">

            <div class="row">

                <!-----
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 green" href="<?php echo e(url('/admin/department')); ?>">
                        <div class="visual">
                            <i class="fa fa-list"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="<?php echo e(\App\Orbscope\Models\Department::all()->count()); ?>"></span>
                            </div>
                            <div class="desc"><?php echo e(trans('orbscope.departments')); ?> </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 green" href="<?php echo e(url('/admin/category')); ?>">
                        <div class="visual">
                            <i class="fa fa-list"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="<?php echo e(\App\Orbscope\Models\Category::all()->count()); ?>"></span>
                            </div>
                            <div class="desc"><?php echo e(trans('orbscope.categorys')); ?> </div>
                        </div>
                    </a>
                </div>



                <div class="row">
                    <div class="row widget-row" style="margin-top: 140px;
    margin-right: 10px;margin-left: 10px;">
                        <div class="col-md-4">

                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                <a href="<?php echo e(url('/admin/users')); ?>">
                                    <h4 class="widget-thumb-heading"><?php echo e(trans('orbscope.users')); ?></h4>
                                    <div class="widget-thumb-wrap">
                                        <img style="float: right;" src="<?php echo e(url('orbscope/admin/images/man.png')); ?>">
                                        <div class="widget-thumb-body">
                                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php echo e(\App\User::where('type','!=','admin')->count()); ?>"></span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>

                    </div>


                </div>



               -->







            </div>
            <br>

            <br>
        </div>
    </div>
    <!-- END PAGE HEAD-->
    <!-- END QUICK NAV -->
    <script src="<?php echo e(url('orbscope/admin')); ?>/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('orbscope/admin')); ?>/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo e(url('orbscope/admin')); ?>/assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

    <script>
        $(document).ready(function()
        {
            $('#clickmewow').click(function()
            {
                $('#radio1003').attr('checked', 'checked');
            });
        })
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make(AdminCore(), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>