<div class="col-lg-12">
    <div class="cate_heading">
        <h3><?php echo e(trans('front.What_do_advertise')); ?></h3>
        <h5 style="padding-bottom: 15px;"><?php echo e(trans('front.chose_cat')); ?></h5>
    </div>
</div>
        <div class="col-md-8 category-wrapper custom-bg-nobd">
            <ul class="cat-nav mb-0 nav nav-tabs d-block border-0">
                <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $depart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item">
                        <a href="<?php echo e(url('user/select/category/'.$depart->id)); ?>" class="d-block position-relative"  >
                            <i class="fas fa-bars" aria-hidden="true"></i> <?php echo e(VarByLang($depart->name,GetLanguage())); ?> </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </ul>
        </div>






