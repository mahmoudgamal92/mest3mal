<!DOCTYPE html>
<!--[if IE 8]>
<html lang="<?php echo e(GetLanguage()); ?>" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="<?php echo e(GetLanguage()); ?>" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="<?php echo e(GetLanguage()); ?>" dir="<?php echo e(GetDirection()); ?>">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title><?php if(!empty($title)): ?> <?php echo e($title); ?> || <?php echo e(@SettingsByLang('name',GetLanguage())); ?>  <?php else: ?> <?php echo e(@SettingsByLang('name',GetLanguage())); ?>  <?php endif; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="alweseemy Co." name="author"/>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <?php echo $__env->make(AdminCss(), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make(AdminJs(), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->yieldContent('css'); ?>
    <?php echo $__env->yieldContent('js'); ?>


</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<!-- BEGIN HEADER -->

<div class="page-wrapper">
    <!-- BEGIN HEADER -->

<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">

        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <?php if(auth()->user()->type=='admin'): ?>
            <a href="<?php echo e(url('/admin')); ?>">
            <?php else: ?>
                    <a href="<?php echo e(url('/teacher/dashbord')); ?>">
            <?php endif; ?>
                <h3><?php echo e(@SettingsByLang('name',GetLanguage())); ?></h3> </a>
            <div class="menu-toggler sidebar-toggler">
                <span></span>
            </div>
        </div>
        <!-- END LOGO -->

        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>


        <!-- BEGIN PAGE TOP -->
        <div class="page-top">

            <!-- BEGIN HEADER SEARCH BOX -->

            <!-- END HEADER SEARCH BOX -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                <span></span>
            </a>

            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">

                    <li class="separator hide"> </li>
                    <li>
                    <?php if(GetLanguage() == "ar"): ?>
                        <a style="font-weight: bold;" href="<?php echo e(url(AdminPath().'/lang/en')); ?>">English</a>
                    <?php else: ?>
                        <a style="font-weight: bold;" href="<?php echo e(url(AdminPath().'/lang/ar')); ?>">عربي</a>
                    <?php endif; ?>
                    </li>


                <!-- END INBOX DROPDOWN -->

                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="<?php echo e(url('orbscope/admin')); ?>/assets/layouts/layout/img/avatar3_small.jpg" />
                            <span class="username username-hide-on-mobile"> <?php echo e(auth()->user()->name); ?> </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">

                            <li>
                                <a href="<?php echo e(url(AdminPath().'/profile')); ?>">
                                    <i class="icon-user"></i><?php echo e(trans('orbscope.profile')); ?> </a>
                            </li>

                            <li>
                                <a href="<?php echo e(url(AdminPath().'/logout')); ?>">
                                    <i class="icon-key"></i><?php echo e(trans('orbscope.logout')); ?> </a>
                            </li>

                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <?php if(auth()->user()->type=='admin'): ?>
                    <li class="dropdown dropdown-quick-sidebar-toggler">
                        <a href="<?php echo e(url(AdminPath().'/logout')); ?>" class="dropdown-toggle">
                            <i class="icon-logout"></i>
                        </a>
                    </li>
                    <?php else: ?>
                        <li class="dropdown dropdown-quick-sidebar-toggler">
                        <a href="<?php echo e(url('/logout')); ?>" class="dropdown-toggle">
                            <i class="icon-logout"></i>
                        </a>
                        </li>
                    <?php endif; ?>



                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->

        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->

<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->

<div class="page-container">

<!-- BEGIN SIDEBAR -->
