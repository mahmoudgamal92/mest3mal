
<?php if($status=='active'): ?>
    <span class="label label-success"> <?php echo e(trans('orbscope.'.$status)); ?> </span>
    <br/>
    <a href="<?php echo e(url('auctionsmin/status/'.$id.'/auctions/inactive')); ?>" class="btn btn-xs red"> <?php echo e(trans('orbscope.make_not_active')); ?>

        <i class="fa fa-edit"></i>
    </a>
<?php else: ?>

    <span class="label label-danger"> <?php echo e(trans('orbscope.'.$status)); ?> </span>
    <a href="<?php echo e(url('auctionsmin/status/'.$id.'/auctions/active')); ?>" class="btn btn-xs blue"><?php echo e(trans('orbscope.active')); ?>

        <i class="fa fa-edit"></i>
    </a>
<?php endif; ?>
