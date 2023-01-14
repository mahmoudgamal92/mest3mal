
<?php $__env->startSection('content'); ?>
    <link href="<?php echo e(url('orbscope/admin')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
          type="text/css"/>
    <script src="<?php echo e(url('orbscope/admin')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"
            type="text/javascript"></script>
    <link href="<?php echo e(url('orbscope/admin')); ?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(url('orbscope/admin')); ?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo e(url('orbscope/admin')); ?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('orbscope/admin')); ?>/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <link href="<?php echo e(url('orbscope/admin')); ?>/assets/global/plugins/jquery-multi-select/css/multi-select<?php echo e(GetLangAdds()); ?>.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo e(url('orbscope/admin')); ?>/assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('orbscope/admin')); ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="<?php echo e(url('orbscope/admin')); ?>/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <link href="<?php echo e(url('orbscope/admin')); ?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(url('orbscope/admin')); ?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <div class='row'>
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark"><?php echo e($title); ?></span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#" data-original-title="<?php echo e(trans('orbscope.full-screen')); ?>" title="<?php echo e(trans('orbscope.full-screen')); ?>"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="<?php echo e(route('settings.edit')); ?>" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-md-12 name">
                                <div class="form-group<?php echo e($errors->has('ar_name') ? ' has-error' : ''); ?>">
                                    <label class="col-md-2 control-label" for="ar_name"><?php echo e(trans('orbscope.ar-name')); ?> <span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-10">
                                        <?php echo Form::text('ar_name',VarByLang($show->name, 'ar'),['class'=>'form-control','id'=>'ar_name','placeholder'=>trans('orbscope.ar-name'), 'required']); ?>

                                        <i class="fa fa-spinner fa-spin loading hidden"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 name">
                                <div class="form-group<?php echo e($errors->has('en_name') ? ' has-error' : ''); ?>">
                                    <label class="col-md-2 control-label" for="en_name"><?php echo e(trans('orbscope.en-name')); ?> <span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-10">
                                        <?php echo Form::text('en_name',VarByLang($show->name, 'en'),['class'=>'form-control','id'=>'en_name','placeholder'=>trans('orbscope.en-name'), 'required']); ?>

                                        <?php if($errors->has('en_name')): ?>
                                            <span class="help-block">
                                                <strong style="color: red"><?php echo e($errors->first('en_name')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-12 email">
                                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                    <label class="col-md-2 control-label" for="email"><?php echo e(trans('orbscope.email')); ?></label>
                                    <div class="col-md-4">
                                        <?php echo Form::email('email', $show->email,['class'=>'form-control','id'=>'email','placeholder'=>trans('orbscope.email')]); ?>

                                        <?php if($errors->has('email')): ?>
                                            <span class="help-block">
                                                <strong style="color: red"><?php echo e($errors->first('email')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <label class="col-md-2 control-label" for="phone"><?php echo e(trans('orbscope.phone')); ?> </label>
                                    <div class="col-md-4">
                                        <?php echo Form::number('phone',$show->phone,['class'=>'form-control','id'=>'phone','placeholder'=>trans('orbscope.phone')]); ?>

                                        <?php if($errors->has('phone')): ?>
                                            <span class="help-block">
                                                <strong style="color: red"><?php echo e($errors->first('phone')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mobile">
                                <div class="form-group<?php echo e($errors->has('mobile') ? ' has-error' : ''); ?>">
                                    <label class="col-md-2 control-label" for="mobile"><?php echo e(trans('orbscope.mobile')); ?> </label>
                                    <div class="col-md-10">
                                        <?php echo Form::text('mobile', $show->mobile, ['class'=>'form-control','id'=>'mobile','placeholder'=>trans('orbscope.mobile')]); ?>

                                        <?php if($errors->has('mobile')): ?>
                                            <span class="help-block">
                                                <strong style="color: red"><?php echo e($errors->first('mobile')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-12 ">
                                <div class="form-group<?php echo e($errors->has('proccessing_fee') ? ' has-error' : ''); ?>">
                                    <label class="col-md-2 control-label" for="ar_address"><?php echo e(trans('front.Proccessing_Fee')); ?> </label>

                                    <div class="col-md-10">
                                        <input type="number" step="any" class="form-control" name="proccessing_fee" value="<?php echo e($show->proccessing_fee); ?>" required>
                                        <i class="fa fa-spinner fa-spin loading hidden"></i>
                                    </div>

                                </div>
                            </div>



                            <div class="col-md-12 description">
                                <div class="form-group<?php echo e($errors->has('ar_description') ? ' has-error' : ''); ?>">
                                    <label class="col-md-2 control-label" for="ar_description"><?php echo e(trans('orbscope.terms_conditions')); ?> AR</label>
                                    <div class="col-md-10">
                                        <?php echo Form::textarea('ar_description',@VarByLang($show->description,'ar'),['class'=>'form-control','id'=>'ar_description','rows'=>'3']); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 description">
                                <div class="form-group<?php echo e($errors->has('en_description') ? ' has-error' : ''); ?>">
                                    <label class="col-md-2 control-label" for="en_description"><?php echo e(trans('orbscope.terms_conditions')); ?> EN</label>
                                    <div class="col-md-10">
                                        <?php echo Form::textarea('en_description',@VarByLang($show->description,'en'),['class'=>'form-control','id'=>'en_description','rows'=>'3']); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 description">
                                <div class="form-group<?php echo e($errors->has('ar_description') ? ' has-error' : ''); ?>">
                                    <label class="col-md-2 control-label" for="ar_description"><?php echo e(trans('front.How_does_work')); ?> AR</label>
                                    <div class="col-md-10">
                                        <?php echo Form::textarea('ar_How_does_work',@VarByLang($show->How_does_work,'ar'),['class'=>'form-control','id'=>'ar_description','rows'=>'3']); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 description">
                                <div class="form-group<?php echo e($errors->has('en_description') ? ' has-error' : ''); ?>">
                                    <label class="col-md-2 control-label" for="en_description"><?php echo e(trans('front.How_does_work')); ?> EN</label>
                                    <div class="col-md-10">
                                        <?php echo Form::textarea('en_How_does_work',@VarByLang($show->How_does_work,'en'),['class'=>'form-control','id'=>'en_description','rows'=>'3']); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mobile">

                                    <label class="col-md-2 control-label" for="login_color"><?php echo e(trans('orbscope.login_color')); ?> </label>
                                    <div class="col-md-4">
                                        <?php echo Form::color('login_color',$show->login_color,['class'=>'form-control','id'=>'login_color','placeholder'=>trans('orbscope.login_color')]); ?>

                                        <?php if($errors->has('login_color')): ?>
                                            <span class="help-block">
                                                <strong style="color: red"><?php echo e($errors->first('login_color')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 logo">
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="logo"><?php echo e(trans('orbscope.logo')); ?> </label>
                                    <div class="col-md-4">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="<?php echo e(ShowImage($show->logo)); ?>" />
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                            </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new"> <?php echo e(trans('orbscope.select-image')); ?></span>
                                                    <span class="fileinput-exists"> <?php echo e(trans('orbscope.change')); ?> </span>
                                                    <input type="file" name="logo" id="logo" accept=".image/jpeg,.png,.jpg,.bmp,.gif">
                                                </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> <?php echo e(trans('orbscope.remove')); ?>

                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <label class="col-md-2 control-label" for="icon"><?php echo e(trans('orbscope.icon')); ?> </label>
                                    <div class="col-md-4">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="<?php echo e(ShowImage($show->icon)); ?>" />
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                            </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new"> <?php echo e(trans('orbscope.select-image')); ?></span>
                                                    <span class="fileinput-exists"> <?php echo e(trans('orbscope.change')); ?> </span>
                                                    <input type="file" name="icon_image" id="icon" accept=".image/jpeg,.png,.jpg,.bmp,.gif,.ico">
                                                </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> <?php echo e(trans('orbscope.remove')); ?>

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <div class="col-md-12 logo">
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="logo">الصورة الرئيسية </label>
                                <div class="col-md-4">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="<?php echo e(ShowImage($show->home_image)); ?>" />
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                        </div>
                                        <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new"> <?php echo e(trans('orbscope.select-image')); ?></span>
                                                    <span class="fileinput-exists"> <?php echo e(trans('orbscope.change')); ?> </span>
                                                    <input type="file" name="home_image" id="home_image" accept=".image/jpeg,.png,.jpg,.bmp,.gif">
                                                </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> <?php echo e(trans('orbscope.remove')); ?>

                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="col-md-12 keywords">
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="keywords">عنوان الصفحة الرئيسية</label>
                                <div class="col-md-5">
                                    <input type="text" name="home_pageTitle_ar" id="home_pageTitle" placeholder="العنوان بالعربي" class="form-control" value="<?php echo e(@VarByLang($show->home_pageTitle,'ar')); ?>">
                                </div>

                                <div class="col-md-5">
                                    <input type="text" name="home_pageTitle_en" id="home_pageTitle_en" placeholder="العنوان بالانجليزي" class="form-control" value="<?php echo e(@VarByLang($show->home_pageTitle,'en')); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 footer_desc">
                            <div class="form-group<?php echo e($errors->has('footer_desc') ? ' has-error' : ''); ?>">
                                <label class="col-md-2 control-label" for="footer_desc">وصف عنوان الصفحة الرئيسية<span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-5">
                                    <?php echo Form::textarea('home_pageDesc_ar',VarByLang($show->home_pageDesc, 'ar'),['class'=>'form-control','id'=>'home_pageDesc_ar','placeholder'=>'الوصف بالعربية']); ?>

                                    <i class="fa fa-spinner fa-spin loading hidden"></i>
                                </div>
                                <div class="col-md-5">
                                    <?php echo Form::textarea('home_pageDesc_en',VarByLang($show->home_pageDesc, 'en'),['class'=>'form-control','id'=>'home_pageDesc','placeholder'=>'الوصف بالانجليزية']); ?>

                                    <i class="fa fa-spinner fa-spin loading hidden"></i>
                                </div>
                            </div>
                        </div>

                            <div class="col-md-12 keywords">
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="keywords"><?php echo e(trans('orbscope.keywords')); ?></label>
                                    <div class="col-md-5">
                                        <input type="text" name="ar_keywords" id="ar_keywords" placeholder="<?php echo e(trans('orbscope.ar_keywords')); ?>" class="form-control" value="<?php echo e(@VarByLang($show->keywords,'ar')); ?>">
                                    </div>

                                    <div class="col-md-5">
                                        <input type="text" name="en_keywords" id="en_keywords" placeholder="<?php echo e(trans('orbscope.en_keywords')); ?>" class="form-control" value="<?php echo e(@VarByLang($show->keywords,'en')); ?>">
                                    </div>
                                </div>
                            </div>


                        <div class="col-md-12 footer_desc">
                            <div class="form-group<?php echo e($errors->has('footer_desc') ? ' has-error' : ''); ?>">
                                <label class="col-md-2 control-label" for="footer_desc"><?php echo e(trans('orbscope.footer_desc')); ?><span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-5">
                                    <?php echo Form::textarea('footer_desc_ar',VarByLang($show->footer_desc, 'ar'),['class'=>'form-control','id'=>'footer_desc_ar','placeholder'=>trans('orbscope.footer_desc_ar')]); ?>

                                    <i class="fa fa-spinner fa-spin loading hidden"></i>
                                </div>
                                <div class="col-md-5">
                                    <?php echo Form::textarea('footer_desc_en',VarByLang($show->footer_desc, 'en'),['class'=>'form-control','id'=>'footer_desc_en','placeholder'=>trans('orbscope.footer_desc_en')]); ?>

                                    <i class="fa fa-spinner fa-spin loading hidden"></i>
                                </div>
                            </div>
                        </div>



                            <div class="col-md-12 language">
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="language"><?php echo e(trans('orbscope.language')); ?></label>
                                    <div class="col-md-10">
                                        <select class="form-control select2" data-placeholder="<?php echo e(trans('orbscope.language')); ?>" name="language">
                                            <option value=""></option>
                                            <option value="ar" <?php echo e($show->language == 'ar' ? ' selected' : ''); ?>><?php echo e(trans('orbscope.arabic')); ?></option>
                                            <option value="en" <?php echo e($show->language == 'en' ? ' selected' : ''); ?>><?php echo e(trans('orbscope.english')); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>




                            <div class="col-md-12 session_timeout">
                                <div class="form-group<?php echo e($errors->has('session_timeout') ? ' has-error' : ''); ?>">
                                    <label class="col-md-2 control-label" for="session_timeout"><?php echo e(trans('orbscope.session_timeout')); ?> (<?php echo e(trans('orbscope.in_seconds')); ?>)</label>
                                    <div class="col-md-10">
                                        <?php echo Form::number('session_timeout',$show->session_timeout,['class'=>'form-control','id'=>'session_timeout','placeholder'=>trans('orbscope.session_timeout')]); ?>

                                        <?php if($errors->has('session_timeout')): ?>
                                            <span class="help-block">
                                                <strong style="color: red"><?php echo e($errors->first('session_timeout')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-12 address">
                                <div class="form-group<?php echo e($errors->has('ar_address') ? ' has-error' : ''); ?>">
                                    <label class="col-md-2 control-label" for="ar_address"><?php echo e(trans('orbscope.address')); ?> </label>

                                    <div class="col-md-5">
                                        <?php echo Form::text('ar_address',@VarByLang($show->address,'ar'),['class'=>'form-control','id'=>'ar_address','placeholder'=>trans('orbscope.ar-address')]); ?>

                                        <i class="fa fa-spinner fa-spin loading hidden"></i>
                                    </div>

                                    <div class="col-md-5">
                                        <?php echo Form::text('en_address',@VarByLang($show->address,'en'),['class'=>'form-control','id'=>'en_address','placeholder'=>trans('orbscope.en-address')]); ?>

                                        <?php if($errors->has('en_name')): ?>
                                            <span class="help-block">
                                        <strong style="color: red"><?php echo e($errors->first('en_name')); ?></strong>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>


                            <div style="margin-bottom: 20px;" class="col-md-12 contact_title">


                                <label class="col-md-2 control-label" for="facebook"><?php echo e(trans('orbscope.facebook')); ?> </label>

                                <div class="col-md-4">
                                    <?php echo Form::url('facebook',$show->facebook,['class'=>'form-control','id'=>'facebook','placeholder'=>trans('orbscope.facebook')]); ?>

                                    <i class="fa fa-spinner fa-spin loading hidden"></i>
                                </div>



                                <label class="col-md-2 control-label" for="facebook"><?php echo e(trans('orbscope.twitter')); ?> </label>


                                <div class="col-md-4">
                                    <?php echo Form::url('twitter',$show->twitter,['class'=>'form-control','id'=>'twitter','placeholder'=>trans('orbscope.twitter')]); ?>

                                    <?php if($errors->has('facebook')): ?>
                                        <span class="help-block">
                                                <strong style="color: red"><?php echo e($errors->first('facebook')); ?></strong>
                                            </span>
                                    <?php endif; ?>
                                </div>

                            </div>

                        <div class="col-md-12 googleplus">

                            <label class="col-md-2 control-label" for="googleplus">انستجرام </label>

                            <div class="col-md-4">
                                <?php echo Form::url('googleplus',$show->googleplus,['class'=>'form-control','id'=>'googleplus','placeholder'=>trans('orbscope.googleplus')]); ?>

                                <i class="fa fa-spinner fa-spin loading hidden"></i>
                            </div>

                            <label class="col-md-2 control-label" for="googleplus"><?php echo e(trans('orbscope.linkedin')); ?> </label>

                            <div class="col-md-4">
                                <?php echo Form::url('linkedin',$show->linkedin,['class'=>'form-control','id'=>'linkedin','placeholder'=>trans('orbscope.linkedin')]); ?>

                                <?php if($errors->has('googleplus')): ?>
                                    <span class="help-block">
                                                <strong style="color: red"><?php echo e($errors->first('googleplus')); ?></strong>
                                            </span>
                                <?php endif; ?>
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
    <script src="<?php echo e(url('/vendor/unisharp/laravel-ckeditor/ckeditor.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });
        $(document).ready(function() {
            $('select').select2({width: '100%'});
        });
        CKEDITOR.replace( 'ar_description', {
            toolbar : 'Basic',
            language: 'ar'
        });
        CKEDITOR.replace( 'en_description', {
            toolbar : 'Basic',
            language: 'en'
        });
        CKEDITOR.replace( 'en_How_does_work', {
            toolbar : 'Basic',
            language: 'en'
        });
        CKEDITOR.replace( 'ar_How_does_work', {
            toolbar : 'Basic',
            language: 'ar'
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(AdminCore(), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>