
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
    <style media="screen">
        .icon-select-box, .icon-select-box option {
            font-family: 'FontAwesome', 'sans-serif' !important;
        }
    </style>

    <div class='row'>
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-title">

                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark"><?php echo e($title); ?></span>
                    </div>

                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="<?php echo e(url(AdminPath().'/category')); ?>"
                           data-toggle="tooltip" title="<?php echo e(trans('orbscope.show-all')); ?>   <?php echo e(trans('category')); ?>">
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

                        <?php echo Form::open(['files'=>true,'route'=>'category.store','class'=>'form-horizontal form-row-seperated']); ?>

                        <div class="row">


                            <div class="form-group<?php echo e($errors->has('ar_name') ? ' has-error' : ''); ?>">
                                <label class="col-md-3 control-label" for="ar_name"><?php echo e(trans('orbscope.ar-name')); ?> <span class="required" aria-required="true"> * </span></label>

                                <div class="col-md-9">
                                    <?php echo Form::text('ar_name',old('ar_name'),['class'=>'form-control','id'=>'ar_name','placeholder'=>trans('orbscope.ar-name'),'required']); ?>

                                    <i class="fa fa-spinner fa-spin loading hidden"></i>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('en_name') ? ' has-error' : ''); ?>">
                                <label class="col-md-3 control-label" for="en_name"><?php echo e(trans('orbscope.en-name')); ?> <span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-9">
                                    <?php echo Form::text('en_name',old('en_name'),['class'=>'form-control','id'=>'en_name','placeholder'=>trans('orbscope.en-name'),'required'=>'required']); ?>

                                    <?php if($errors->has('en_name')): ?>
                                        <span class="help-block">
                                        <strong style="color: red"><?php echo e($errors->first('en_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo e(trans('orbscope.department')); ?> <span class="required" aria-required="true"> * </span> </label>
                                <div class="col-md-9">

                                    <select name="depart_id" id="depart_id" class="form-control select2" data-placeholder="<?php echo e(trans('orbscope.department')); ?>" required>
                                        <option></option>
                                        <?php $__currentLoopData = \App\Orbscope\Models\Department::where('status','active')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cont): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($cont->id); ?>"><?php echo e(VarByLang($cont->name,GetLanguage())); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>


                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo Form::label('image',trans('orbscope.image'),['class'=>'col-md-3 control-label','for'=>'image']); ?>

                                <div class="col-md-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview fileinput-exists thumbnail"
                                             style="max-width: 200px; max-height: 150px;">
                                        </div>
                                        <div>
                                    <span class="btn default btn-file">
                                         <span class="fileinput-new"> <?php echo e(trans('orbscope.select-image')); ?></span>
                                         <span class="fileinput-exists"> <?php echo e(trans('orbscope.change')); ?> </span>
                                         <input type="file" name="flag" id="flag" accept=".image/jpeg,.png,.jpg,.bmp,.gif,.svg">
                                    </span>
                                            <a href="javascript:;" class="btn red fileinput-exists"
                                               data-dismiss="fileinput"> <?php echo e(trans('orbscope.remove')); ?>

                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-md-3 control-label" for="status"><?php echo e(trans('orbscope.status')); ?> </label>
                                <div class="col-md-9">
                                    <input type="hidden" name="status" id="CheckBoxValue" value="inactive">
                                    <input type="checkbox"  name="status" id="status" class="make-switch" data-on-text="<?php echo e(trans('orbscope.active')); ?>" data-off-text="<?php echo e(trans('orbscope.inactive')); ?>" value="active">
                                </div>
                            </div>




                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn blue"><?php echo e(trans('orbscope.add')); ?> <?php echo e(trans('orbscope.category')); ?></button>
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

    <script>
        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });

        <?php if(old('icon')): ?>
            $(document).ready(function() {
                $('.select2').select2({width: '100%'});

                $('.icon-select-box').each(function() {
                    var value = $(this).attr("featVal");
                    $(this).find('option[value='+ value +']').attr("selected", "selected");
                });
            });
        <?php endif; ?>
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(AdminCore(), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>