<?php $__env->startSection('css'); ?>
    <?php if(GetLanguage()=='ar'): ?>
        <style>
            input{
                text-align: right;
            }
        </style>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>



        <!-- start hero-header -->



        <div class="login-wraper" style="background:url(<?php echo e(url('orbscope/front')); ?>/images/login-page.jpg);">
            <?php echo $__env->make('front.layout.messages', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="container"  style="text-align: <?php echo e(GetLanguage()=='ar'?'right':''); ?>;">
                <div class="row align-items-center justify-content-center" style="background-color: aliceblue;">

                    <div class="col-sm-12 col-md-7 col-lg-5"> <br/>

                        <div class="login-sections b-radius-10 bx-shadow ">
                            <h1><?php echo e(trans('orbscope.login')); ?></h1>
                            <br/>
                            <form  role="form" method="POST" action="<?php echo e(url('/login')); ?>">
                                <?php echo e(csrf_field()); ?>

                                <label><h4><?php echo e(trans('orbscope.email')); ?></h4></label>
                                <div class="field-form">  <input   class="form-control"  id="email" placeholder="<?php echo e(trans('orbscope.email')); ?>" type="email"  name="email" value="<?php echo e(old('email')); ?>">

                                    <?php if($errors->has('email')): ?>
                                        <span class="help-block">
                                               <strong><?php echo e($errors->first('email')); ?></strong>
                                                 </span>
                                    <?php endif; ?> </div>
                                <label><h4><?php echo e(trans('orbscope.password')); ?></h4></label>
                                <div class="field-form">

                                    <input id="password" type="password" placeholder="<?php echo e(trans('orbscope.password')); ?>" class="form-control" name="password">

                                    <?php if($errors->has('password')): ?>
                                        <span class="help-block">
                                                           <strong><?php echo e($errors->first('password')); ?></strong>
                                                       </span>
                                    <?php endif; ?>

                                </div>
                                <div class="field-form-half">
                                    <!--
                                    <a href="<?php echo e(route('password.request')); ?>"><?php echo e(trans('orbscope.forget_password')); ?></a>-->
                                    <a href="<?php echo e(url('forget-password')); ?>"><?php echo e(trans('orbscope.forget_password')); ?></a>
                                </div>
                                <br/>
                                <button style="background-color: #0275d8;" type="submit" class="btn btn-green full-btns" ><?php echo e(trans('orbscope.login')); ?></button>
                            </form>
                            <br/>
                        </div>
                    </div>

                </div>
            </div>
        </div>






        <!-- end hero-header -->



<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>