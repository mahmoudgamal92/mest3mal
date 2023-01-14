<?php if(count($errors) > 0): ?>
    <div class="alert alert-danger" dir="<?php echo e(GetDirection()); ?>">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>






<script>
    <?php if(session()->has('success')): ?>
swal({
        title                  : "<?php echo e(trans('orbscope.success')); ?>",
        text                   : "<?php echo e(session()->get('success')); ?>",
        type                   : "success",
        customClass            : "sweet-alert showSweetAlert",
        confirmButtonClass     : "btn-success",
        cancelButtonClass      : "btn-success",
        closeOnCancel          : true,
        confirmButtonText      : "<?php echo e(trans('orbscope.close')); ?>",
        cancelButtonText       : "<?php echo e(trans('orbscope.close')); ?>",
        timer                  : "3000"
    });
    <?php endif; ?>
    <?php if(session()->has('info')): ?>
swal({
        title                  : "<?php echo e(trans('orbscope.info')); ?>",
        text                   : "<?php echo e(session()->get('info')); ?>",
        type                   : "info",
        customClass            : "sweet-alert showSweetAlert",
        confirmButtonClass     : "btn-info",
        cancelButtonClass      : "btn-info",
        closeOnCancel          : true,
        confirmButtonText      : "<?php echo e(trans('orbscope.close')); ?>",
        cancelButtonText       : "<?php echo e(trans('orbscope.close')); ?>",
        timer                  : "3000"
    });
    <?php endif; ?>
    <?php if(session()->has('warning')): ?>
swal({
        title                  : "<?php echo e(trans('orbscope.warning')); ?>",
        text                   : "<?php echo e(session()->get('warning')); ?>",
        type                   : "warning",
        customClass            : "sweet-alert showSweetAlert",
        confirmButtonClass     : "btn-warning",
        cancelButtonClass      : "btn-warning",
        closeOnCancel          : true,
        confirmButtonText      : "<?php echo e(trans('orbscope.close')); ?>",
        cancelButtonText       : "<?php echo e(trans('orbscope.close')); ?>",
        timer                  : "3000"
    });
    <?php endif; ?>
    <?php if(session()->has('error')): ?>
swal({
        title                  : "<?php echo e(trans('orbscope.error')); ?>",
        text                   : "<?php echo e(session()->get('error')); ?>",
        type                   : "error",
        customClass            : "sweet-alert showSweetAlert",
        confirmButtonClass     : "btn-danger",
        cancelButtonClass      : "btn-danger",
        closeOnCancel          : true,
        confirmButtonText      : "<?php echo e(trans('orbscope.close')); ?>",
        cancelButtonText       : "<?php echo e(trans('orbscope.close')); ?>",
        timer                  : "3000"
    });
    <?php endif; ?>

</script>