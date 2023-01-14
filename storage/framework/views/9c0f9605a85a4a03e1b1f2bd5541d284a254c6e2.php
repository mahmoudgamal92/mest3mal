<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a  <?php if(url()->current()==url('/user/all_ads')): ?> style="color: #0275d8" <?php endif; ?>  class="nav-link" href="<?php echo e(url('user/all_ads')); ?>" ><?php echo e(trans('front.all_ads')); ?></a>
    </li>
    <li class="nav-item">
        <a <?php if(url()->current()==url('/user/ads_type/active')): ?> style="color: #0275d8" <?php endif; ?> class="nav-link" href="<?php echo e(url('user/ads_type/active')); ?>" ><?php echo e(trans('front.active_ads')); ?></a>
    </li>
    <li class="nav-item">
        <a <?php if(url()->current()==url('/user/ads_type/inactive')): ?> style="color: #0275d8" <?php endif; ?> class="nav-link" href="<?php echo e(url('user/ads_type/inactive')); ?>" ><?php echo e(trans('front.inactive_ads')); ?></a>
    </li>
    <li class="nav-item">
        <a <?php if(url()->current()==url('/user/ads_type/done')): ?> style="color: #0275d8" <?php endif; ?> class="nav-link" href="<?php echo e(url('user/ads_type/done')); ?>" ><?php echo e(trans('front.done_ads')); ?></a>
    </li>
</ul>