
<?php $__env->startSection('content'); ?>

    <div class='row'>
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark"><?php echo e(trans('orbscope.profile')); ?></span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#" data-original-title="<?php echo e(trans('orbscope.full-screen')); ?>" title="<?php echo e(trans('orbscope.full-screen')); ?>"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="<?php echo e(url(AdminPath().'/ghange_pass')); ?>" class="form-horizontal form-row-seperated" method="post">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-md-12 name">
                                <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                                    <label class="col-md-2 control-label" for="ar_name"><?php echo e(trans('orbscope.name')); ?> <span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-10">
                                        <?php echo Form::text('name',auth()->user()->name,['class'=>'form-control','id'=>'name','placeholder'=>trans('orbscope.name'), 'required']); ?>

                                        <i class="fa fa-spinner fa-spin loading hidden"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 name">
                                <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                    <label class="col-md-2 control-label" for="en_name"><?php echo e(trans('orbscope.password')); ?> </label>
                                    <div class="col-md-10">
                                        <input type="password" name="password" class="form-control" placeholder="<?php echo e(trans('orbscope.password')); ?>">
                                        <?php if($errors->has('password')): ?>
                                            <span class="help-block">
                                                <strong style="color: red"><?php echo e($errors->first('password')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 name">
                                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                    <label class="col-md-2 control-label" for="ar_name"><?php echo e(trans('orbscope.email')); ?> <span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-10">
                                        <?php echo Form::email('email',auth()->user()->email,['class'=>'form-control','id'=>'name','placeholder'=>trans('orbscope.email'), 'required']); ?>

                                        <i class="fa fa-spinner fa-spin loading hidden"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 name">
                                <div class="form-group<?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                                    <label class="col-md-2 control-label" for="ar_name"><?php echo e(trans('orbscope.phone')); ?> </label>
                                    <div class="col-md-10">
                                        <?php echo Form::text('phone',auth()->user()->phone,['class'=>'form-control','id'=>'phone','placeholder'=>trans('orbscope.phone')]); ?>

                                        <i class="fa fa-spinner fa-spin loading hidden"></i>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-block blue"><?php echo e(trans('orbscope.edit')); ?> <i class="fa fa-edit"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make(AdminCore(), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>