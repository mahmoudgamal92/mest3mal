<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="<?php echo e(GetDirection()); ?>">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?php echo e(@SettingsByLang('name',GetLanguage() )); ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="<?php echo e(@SettingsByLang('description',GetLanguage() )); ?>" name="description" />
        <meta content="<?php echo e(@SettingsByLang('keywords',GetLanguage() )); ?>" name="keywords" />
        <meta content="OrbScope Co." name="author" />

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <?php echo Html::style('orbscope/admin/assets/global/plugins/font-awesome/css/font-awesome.min.css'); ?>

        <?php echo Html::style('orbscope/admin/assets/global/plugins/simple-line-icons/simple-line-icons.min.css'); ?>

        <?php echo Html::style('orbscope/admin/assets/global/css/components.min.css'); ?>



        <link href="<?php echo e(url('orbscope/admin')); ?>/assets/global/plugins/bootstrap/css/bootstrap<?php echo e(GetLangAdds()); ?>.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo e(url('orbscope/admin')); ?>/assets/global/plugins/bootstrap-switch/css/bootstrap-switch<?php echo e(GetLangAdds()); ?>.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo e(url('orbscope/admin')); ?>/assets/global/css/components<?php echo e(GetLangAdds()); ?>.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo e(url('orbscope/admin')); ?>/assets/global/css/plugins<?php echo e(GetLangAdds()); ?>.min.css" rel="stylesheet" type="text/css"/>
        <?php echo $__env->make(AdminTheme().'/login_color'.GetLangAdds(), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>


        <?php echo Html::style('orbscope/admin/assets/global/plugins/select2/css/select2.min.css'); ?>

        <?php echo Html::style('orbscope/admin/assets/global/plugins/select2/css/select2-bootstrap.min.css'); ?>

        <?php echo Html::style('orbscope/admin/assets/global/plugins/bootstrap-sweetalert/sweetalert.css'); ?>

        <?php echo Html::style('orbscope/admin/assets/global/custom.css'); ?>



        <link rel="shortcut icon" href="<?php echo e(ShowImage(GetSettings()->icon)); ?>" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="<?php echo e(url(AdminPath())); ?>">
                <img style="height: 100px;" src="<?php echo e(ShowImage(GetSettings()->logo)); ?>" alt="" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" method="post">
                <?php echo csrf_field(); ?>

                <h3 class="form-title font-green" style="float: <?php if(GetLanguage() == 'en'): ?> left <?php else: ?> right <?php endif; ?> "><?php echo e(trans('orbscope.login')); ?></h3>
                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9"><?php echo e(trans('orbscope.email')); ?></label>
                    <input <?php if($errors->has('email')): ?> style="border-color: #e73d4a" <?php endif; ?> class="form-control form-control-solid" type="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(trans('orbscope.email')); ?>" name="email" />
                    <?php if($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                    <label class="control-label visible-ie8 visible-ie9"><?php echo e(trans('orbscope.password')); ?></label>
                    <input <?php if($errors->has('password')): ?> style="border-color: #e73d4a" <?php endif; ?> class="form-control form-control-solid" type="password" autocomplete="off" placeholder="<?php echo e(trans('orbscope.password')); ?>" name="password" />
                    <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn green uppercase"><?php echo e(trans('orbscope.login')); ?></button>
                </div>

            </form>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="forget-form" action="<?php echo e(route('password.email')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <h3 class="font-green"><?php echo e(trans('orbscope.forget_password')); ?></h3>
                <p> <?php echo e(trans('orbscope.forget_message')); ?> </p>
                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="<?php echo e(trans('orbscope.email')); ?>" name="email" />
                    <?php if($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn green btn-outline"><?php echo e(trans('orbscope.back')); ?></button>
                    <button type="submit" class="btn btn-success uppercase pull-right"><?php echo e(trans('orbscope.submit_password')); ?></button>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->
        </div>
        <div class="copyright"> All Copyrights Reserved  © <a href="#" style="text-decoration: none">مستعمل</a>   2022 - <?php echo date('Y', strtotime('+1 year')); ?> . cms </div>
        <!--[if lt IE 9]>
        <?php echo Html::script('orbscope/admin/assets/global/plugins/respond.min.js'); ?>

        <?php echo Html::script('orbscope/admin/assets/global/plugins/excanvas.min.js'); ?>

        <?php echo Html::script('orbscope/admin/assets/global/plugins/ie8.fix.min.js'); ?>

        <![endif]-->

        <!-- BEGIN CORE PLUGINS -->
        <?php echo Html::script('orbscope/admin/assets/global/plugins/jquery.min.js'); ?>

        <?php echo Html::script('orbscope/admin/assets/global/plugins/bootstrap/js/bootstrap.min.js'); ?>

        <?php echo Html::script('orbscope/admin/assets/global/plugins/js.cookie.min.js'); ?>

        <?php echo Html::script('orbscope/admin/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>

        <?php echo Html::script('orbscope/admin/assets/global/plugins/jquery.blockui.min.js'); ?>

        <?php echo Html::script('orbscope/admin/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>

        <!-- END CORE PLUGINS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <?php echo Html::script('orbscope/admin/assets/global/plugins/jquery-validation/js/jquery.validate.min.js'); ?>

        <?php echo Html::script('orbscope/admin/assets/global/plugins/jquery-validation/js/additional-methods.min.js'); ?>

        <?php echo Html::script('orbscope/admin/assets/global/plugins/select2/js/select2.full.min.js'); ?>

        <?php echo Html::script('orbscope/admin/assets/global/scripts/app.min.js'); ?>

        <?php echo Html::script('orbscope/admin/assets/pages/scripts/login.js'); ?>

        <?php echo Html::script('orbscope/admin/assets/global/plugins/bootstrap-sweetalert/sweetalert.js'); ?>

        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->

        <script>
            <?php if(session()->has('success')): ?>
                swal({
                    title                  : "<?php echo e(trans('orbscope.success')); ?>",
                    text                   : "<?php echo e(session()->get('success')); ?>",
                    type                   : "success",
                    customClass            : "sweet-alert showSweetAlert",
                    confirmButtonClass     : "btn-success",
                    cancelButtonClass      : "btn-success",
                    closeOnCancel          : true,
                    confirmButtonText      : "<?php echo e(trans('orbscope.close')); ?>",
                    cancelButtonText       : "<?php echo e(trans('orbscope.close')); ?>",
                    timer                  : "4000"
                });
            <?php endif; ?>
            <?php if(session()->has('info')): ?>
                swal({
                title                  : "<?php echo e(trans('orbscope.info')); ?>",
                text                   : "<?php echo e(session()->get('info')); ?>",
                type                   : "info",
                customClass            : "sweet-alert showSweetAlert",
                confirmButtonClass     : "btn-info",
                cancelButtonClass      : "btn-info",
                closeOnCancel          : true,
                confirmButtonText      : "<?php echo e(trans('orbscope.close')); ?>",
                cancelButtonText       : "<?php echo e(trans('orbscope.close')); ?>",
                timer                  : "4000"
            });
            <?php endif; ?>
            <?php if(session()->has('warning')): ?>
                swal({
                title                  : "<?php echo e(trans('orbscope.warning')); ?>",
                text                   : "<?php echo e(session()->get('warning')); ?>",
                type                   : "warning",
                customClass            : "sweet-alert showSweetAlert",
                confirmButtonClass     : "btn-warning",
                cancelButtonClass      : "btn-warning",
                closeOnCancel          : true,
                confirmButtonText      : "<?php echo e(trans('orbscope.close')); ?>",
                cancelButtonText       : "<?php echo e(trans('orbscope.close')); ?>",
                timer                  : "4000"
            });
            <?php endif; ?>
            <?php if(session()->has('error')): ?>
                swal({
                    title                  : "<?php echo e(trans('orbscope.error')); ?>",
                    text                   : "<?php echo e(session()->get('error')); ?>",
                    type                   : "error",
                    customClass            : "sweet-alert showSweetAlert",
                    confirmButtonClass     : "btn-danger",
                    cancelButtonClass      : "btn-danger",
                    closeOnCancel          : true,
                    confirmButtonText      : "<?php echo e(trans('orbscope.close')); ?>",
                    cancelButtonText       : "<?php echo e(trans('orbscope.close')); ?>",
                    timer                  : "4000"
                });
            <?php endif; ?>

        </script>
    </body>

</html>