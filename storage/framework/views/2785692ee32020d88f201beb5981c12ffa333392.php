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


    <div class="login-wraper overlay-hide">
        <div class="container" style="text-align: <?php echo e(GetLanguage()=='ar'?'right':''); ?>;">
            <div class="row  justify-content-center" style="background-color: aliceblue;">
                <div class="col-md-4" >
                    <div class="login-sections b-radius-10 bx-shadow register-steps " style="background-color: #5bbce724;margin-top: 40px;padding: 10px;" >
                        <p> <?php echo e(trans('orbscope.pledge')); ?>    </p>
                        <p><?php echo e(trans('orbscope.the_commission_trust')); ?>  </p>
                        <p><?php echo e(trans('orbscope.because_outside')); ?> </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="login-sections b-radius-10 bx-shadow register-steps " style="margin-top: 20px;margin-bottom: 20px;">

                        <?php echo $__env->make('front.layout.messages', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <form  action="<?php echo e(url('/register')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <label><h4><?php echo e(trans('orbscope.name')); ?></h4></label>
                            <div class="field-form">  <input class="form-control" type="text" required value="<?php echo e(old('name')); ?>" name="name" placeholder="<?php echo e(trans('orbscope.name')); ?>" > </div>
                            <label><h4><?php echo e(trans('orbscope.email')); ?></h4></label>
                            <div class="field-form"> <input  class="form-control" type="email" required value="<?php echo e(old('email')); ?>" name="email" placeholder="example@gmail.com" > </div>
                            <label><h4><?php echo e(trans('orbscope.mobile')); ?></h4></label>
                            <div class="field-form"> <input class="form-control" type="number" required value="<?php echo e(old('phone')); ?>" name="phone"  > </div>
                            <label><h4><?php echo e(trans('orbscope.password')); ?></h4></label>
                            <div class="field-form">  <input class="form-control" type="password" required name="password"  > </div>
                            <label><h4><?php echo e(trans('orbscope.password_confirmation')); ?></h4></label>
                            <div class="field-form">  <input type="password" class="form-control" required name="password_confirmation"  > </div>
                            <br/>
                            <div class="col-md-12" style="display: inline-flex;">
                            <div class="col-md-2">
                            <input type="checkbox" class="form-control" style="margin-top: 7px;" required name="condation"  >
                            </div>
                            <div class="col-md-10">
                            <label> <h6><?php echo e(trans('orbscope.accept_condation')); ?> <a target="_blank" href="<?php echo e(url('/terms_conditions')); ?>"><?php echo e(trans('orbscope.terms_conditions')); ?></a></h6>  </label>
                            </div>
                            </div>

                            <br/>
                            <button type="submit" class="btn btn-green full-btns register-now register-now-next" style="background-color: #34ACE0;color: white;" ><?php echo e(trans('orbscope.register')); ?></button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('front.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>