
<?php $__env->startSection('content'); ?>
    <link href="<?php echo e(url('orbscope/admin')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo e(url('orbscope/admin')); ?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(url('orbscope/admin')); ?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
          type="text/css" />
    <script src="<?php echo e(url('orbscope/admin')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('orbscope/admin')); ?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('orbscope/admin')); ?>/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>


    <div class='row'>
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-title">

                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark"><?php echo e($title); ?></span>
                    </div>

                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="<?php echo e(url(AdminPath().'/cities')); ?>"
                           data-toggle="tooltip" title="<?php echo e(trans('orbscope.show-all')); ?>   <?php echo e(trans('orbscope.cities')); ?>">
                            <i class="fa fa-list"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
                           data-original-title="<?php echo e(trans('orbscope.full-screen')); ?>"
                           title="<?php echo e(trans('orbscope.full-screen')); ?>">
                        </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="col-md-12">

                        <?php echo Form::open(['files'=>true,'url'=>AdminPath().'/cities/'.$edit->id,'method'=>'put','class'=>'form-horizontal form-row-seperated']); ?>

                        <div class="row">




                            <div class="form-group<?php echo e($errors->has('ar_name') ? ' has-error' : ''); ?>">
                                <label class="col-md-3 control-label" for="ar_name"><?php echo e(trans('orbscope.ar-name')); ?> <span class="required" aria-required="true"> * </span></label>

                                <div class="col-md-9">
                                    <?php echo Form::text('ar_name',VarByLang($edit->name,'ar'),['class'=>'form-control','id'=>'ar_name','placeholder'=>trans('orbscope.ar-name'),'required'=>'required']); ?>

                                    <?php if($errors->has('ar_name')): ?>
                                        <span class="help-block">
                                            <strong style="color: red"><?php echo e($errors->first('ar_name')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('en_name') ? ' has-error' : ''); ?>">
                                <label class="col-md-3 control-label" for="en_name"><?php echo e(trans('orbscope.en-name')); ?> <span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-9">
                                    <?php echo Form::text('en_name',VarByLang($edit->name,'en'),['class'=>'form-control','id'=>'en_name','placeholder'=>trans('orbscope.en-name')]); ?>

                                    <?php if($errors->has('en_name')): ?>
                                        <span class="help-block">
                                        <strong style="color: red"><?php echo e($errors->first('en_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('country_id') ? ' has-error' : ''); ?>">
                                <label class="col-md-3 control-label"><?php echo e(trans('orbscope.country')); ?> <span class="required" aria-required="true"> * </span> </label>
                                <div class="col-md-9">

                                    <select name="country_id" class="form-control country_id select2" data-placeholder="<?php echo e(trans('orbscope.country')); ?>" required>
                                        <option></option>
                                        <?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cont): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($cont->id); ?>" <?php if($cont->id == $edit->country_id): ?> selected <?php endif; ?>><?php echo e(VarByLang($cont->name,GetLanguage())); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('country_id')): ?>
                                            <span class="help-block">
                                                <strong style="color: red"><?php echo e($errors->first('country_id')); ?></strong>
                                            </span>
                                        <?php endif; ?>

                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="status"><?php echo e(trans('orbscope.status')); ?> </label>
                                <div class="col-md-9">
                                    <input type="hidden" name="status" id="CheckBoxValue" value="inactive">
                                    <input type="checkbox"  name="status" id="status" class="make-switch" data-on-text="<?php echo e(trans('orbscope.active')); ?>" data-off-text="<?php echo e(trans('orbscope.inactive')); ?>" value="active" <?php if($edit->status == 'active'): ?> checked <?php endif; ?>>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="show_website"><?php echo e(trans('orbscope.show_website')); ?></label>
                                <div class="col-md-9">
                                    <input type="hidden" name="show_website" id="CheckBoxValue" value="hidden">
                                    <input type="checkbox" name="show_website" id="show_website" class="make-switch" data-on-text="<?php echo e(trans('orbscope.show')); ?>" data-off-text="<?php echo e(trans('orbscope.hide')); ?>" value="show"  <?php if($edit->show_website == 'show'): ?> checked <?php endif; ?>>
                                </div>
                                </div>


                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn blue"><?php echo e(trans('orbscope.edit')); ?> <?php echo e(trans('orbscope.cities')); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>


                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make(AdminCore(), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>