
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="text-bg">
                <?php echo VarByLang(GetSettings()->description,GetLanguage()); ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>