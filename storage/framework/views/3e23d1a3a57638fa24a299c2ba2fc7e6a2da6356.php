<?php echo $__env->make(AdminHeader(), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make(AdminMenu(), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make(AdminMessages(), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->make(AdminFooter(), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
