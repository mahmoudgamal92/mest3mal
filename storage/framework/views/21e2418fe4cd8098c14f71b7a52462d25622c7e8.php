<!doctype html>
<html lang="<?php echo e(GetLanguage()); ?>">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="UTF-8">
    <meta name="keywords" content="<?php echo e(VarByLang(GetSettings()->keywords, GetLanguage())); ?>">
    <meta name="description" content="<?php echo e(VarByLang(GetSettings()->footer_desc, GetLanguage())); ?>">
    <meta name="author" content="alweseemy">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php if(isset($title)): ?> <?php echo e($title); ?> || <?php echo e(VarByLang(GetSettings()->name, GetLanguage())); ?> <?php else: ?><?php echo e(VarByLang(GetSettings()->name, GetLanguage())); ?><?php endif; ?></title>
    <link href="<?php echo e(asset('uploads/'.GetSettings()->icon)); ?>" rel="shortcut icon" type="image/png">


    <link rel="stylesheet" href="<?php echo e(url('orbscope/front')); ?>/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo e(url('orbscope/front')); ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo e(url('orbscope/front')); ?>/css/slick.css">
    <link rel="stylesheet" href="<?php echo e(url('orbscope/front')); ?>/css/style.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <!-- Custome css -
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    ---->
    <?php echo $__env->yieldContent('css'); ?>
    <style>
        @media  screen and (max-width: 600px) {
            .mini_ads {
                display: contents !important;
            }
        }
    </style>

</head>
<body>
<!-- top header and main header -->
<div class="row col-12 top-header align-items-center m-0">
    <div class="col-10 top-header-left">
        <a href="<?php echo e(url('/terms_conditions')); ?>"><?php echo e(trans('orbscope.terms_conditions')); ?></a>
        <a href="<?php echo e(url('/How_does_work')); ?>"><?php echo e(trans('front.How_does_work')); ?></a>
    </div>
    <div class="col-2 top-header-right langue_text d-flex justify-content-end">
        <div class="dropdown">
            <select onchange="window.location.href = this.value" class="btn btn-link dropdown-toggle control locale-switcher styled-select">
                <option value="?currency=USD" selected="selected"><?php echo e(trans('orbscope.language')); ?></option>
                <option value="<?php echo e(url('/lang/en')); ?>">الإنجليزية</option>
                <option value="<?php echo e(url('/lang/ar')); ?>">عربى</option>
            </select>
            <i class="fas fa-sort-down"></i>
        </div>

    </div>
</div><!-- top header close  -->
<div class="row main-header py-4 align-items-center m-0">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="logo-section">
            <nav id="sidebar" class="d-flex justify-content-between">
                <a href="<?php echo e(url('/')); ?>"><img  class="min_logo" src="<?php echo e(ShowImage(GetSettings()->logo)); ?>"></a>
                <span type="button" class="btn collapge-menu d-none d-lg-block popover-icon"
                      tabindex="0" type="button" data-popover-content="#account-categories" data-toggle="popover" data-placement="bottom">
                  <a class="avatar-wrapper d-flex">
                    <i class="fas fa-bars"></i>
                  </a>
                </span>
                <div id="account-categories" class="d-none">
                    <div class="popover-body">
                        <div class="modelcontent">
                            <div class="col-12 p-0">
                                <div class="menu_cate_list popover-custom">
                                    <ul>
                                        <?php $__currentLoopData = $departs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e(url('main/'.$de->id.'/'.str_replace(' ', '_', VarByLang($de->name,GetLanguage())))); ?>"><img src="<?php echo e(ShowImage($de->image)); ?>"><?php echo e(VarByLang($de->name,GetLanguage())); ?></a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <span type="button" id="sidebarCollapse" class="collapge-menu btn d-lg-none">
                  <i class="fas fa-bars"></i>
                </span>
                <ul class="list-unstyled components">
                    <div id="close-nav" class="p-3 text-right w-100 text-light">
                        <i class="fas fa-times"></i>
                    </div>
                    <?php $__currentLoopData = $departs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(url('main/'.$de->id.'/'.str_replace(' ', '_', VarByLang($de->name,GetLanguage())))); ?>"><img src="<?php echo e(ShowImage($de->image)); ?>"><?php echo e(VarByLang($de->name,GetLanguage())); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <div class="nav-overlay"></div>
            </nav>
        </div>
    </div>
    <div class="col-md-5 col-sm-12 d-none d-lg-block">
        <div class="row align-items-center header-filter">
            <form class="col-md-8 col-sm-12" action="<?php echo e(url('/search')); ?>" method="get">
                <div class="form-group categories-sort d-flex justify-content-center">
                    <input name="title" type="search" class="form-control" placeholder="<?php echo e(trans('orbscope.search')); ?>">
                    <select name="depart_id" id="inputState" class="form-control">
                        <option value=""><?php echo e(trans('front.select_cat')); ?></option>
                        <?php $__currentLoopData = $departs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($de->id); ?>"><?php echo e(VarByLang($de->name,GetLanguage())); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <div class="col-md-4 col-sm-12">

                <a class="custom-btn" href="<?php echo e(url('/auctions')); ?>"><img src="<?php echo e(url('orbscope/front')); ?>/img/notification-icon.png" alt="image"><?php echo e(trans('front.Auctions')); ?></a>

            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12 mt-sm-0 ml-0 account-wrap row justify-content-between align-items-center">


        <?php if(Auth::check()): ?>
        <div class="wishlist-head">
            <span onclick="window.location='<?php echo e(url('/user/favorite_ads')); ?>'"  class="popover-icon"
                  tabindex="0" data-popover-content="#account-favorite" data-toggle="popover" data-placement="bottom">
                <a class="avatar-wrapper d-flex">
                  <i class="fas fa-heart"></i>
                </a>
              </span>
            <div id="account-favorite" style="display:none;">

            </div>
        </div>
        <div class="messages-head">
            <span  class="popover-icon"
                   tabindex="0" data-popover-content="#account-notification" data-toggle="popover" data-placement="bottom">
                <a class="avatar-wrapper d-flex">
                  <i class="fas fa-bell"></i>
                    <span style="color: black;background-color: #34ACE0;border-radius: 50%;font-size: 85%;position: absolute;bottom: 15px;" class="badge badge-light"><?php echo e(auth()->user()->unreadNotifications->count()); ?></span>
                </a>
              </span>
            <div id="account-notification" style="display:none;">
                <div class="popover-body">
                    <div class="popover-custom acc-notification">
                        <h5 class="acc-title"><?php echo e(trans('front.attention')); ?></h5>
                        <div class="acc-alert">
                            <ul>
                                <?php $__currentLoopData = auth()->user()->Notifications->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(url($mes->data['url'])); ?>"><?php echo e(GetLanguage()=='ar'?$mes->data['ar']:$mes->data['en']); ?></a></li>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sign-in-links">

            <div class="account-links">

                <div class="account-wrapper">
                    <a class="avatar-wrapper d-flex" tabindex="0" type="button" class="popover-icon" data-popover-content="#account-menu" data-toggle="popover" data-placement="bottom">
                        <img class="account-avatar" src="<?php echo e(url('orbscope/front')); ?>/img/user-icon3.png">
                        <span class="account-arrow"><i class="fas fa-sort-down" aria-hidden="true"></i></span>
                    </a>
                    <div id="account-menu" style="display:none;">
                        <div class="popover-body">
                            <div class="acc-links popover-custom">
                                <ul style="text-align: <?php echo e(GetLanguage()=='ar'?'right':''); ?>">
                                    <li><a href="<?php echo e(url('/user/profile')); ?>"><?php echo e(trans('orbscope.profile')); ?></a></li>
                                    <li><a href="<?php echo e(url('/user/add_ads')); ?>"><?php echo e(trans('orbscope.add')); ?> <?php echo e(trans('front.ad')); ?></a></li>
                                    <li><a href="<?php echo e(url('/user/all_ads')); ?>"><?php echo e(trans('front.My_Ads')); ?></a></li>
                                    <li><a href="<?php echo e(url('/user/chat')); ?>"><?php echo e(trans('front.messages')); ?> </a></li>
                                    <li><a href="<?php echo e(route('logout')); ?>"><?php echo e(trans('orbscope.logout')); ?> </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php else: ?>
            <a type="button" class="" data-toggle="modal" data-target="#loginmodal">
                <i class="fas fa-user" aria-hidden="true"></i>      <?php echo e(trans('front.Sign_Join')); ?>

            </a>
        <?php endif; ?>
    </div>
</div>
<!-- header-close -->
<!-- Modal -->
<div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger" dir="<?php echo e(GetDirection()); ?>">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form  method="POST" action="<?php echo e(url('/login')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label for="InputEmail1"><?php echo e(trans('orbscope.email')); ?></label>
                        <input type="email" name="email" class="form-control InputEmail1" required id="InputEmail1" aria-describedby="emailHelp" placeholder="عنوان بريدك الإلكتروني">
                        <small id="emailHelp"  class="form-text text-muted"><?php echo e(trans('front.We_not_share_email_anyone')); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="InputPassword1"><?php echo e(trans('orbscope.password')); ?></label>
                        <div class="password-wrap d-flex">
                            <input type="password" name="password" required class="form-control InputPassword1 border-right-0" id="InputPassword1" placeholder="اكتب كلمة المرور الخاصة بك" data-toggle="password">

                        </div>
                    </div>
                    <br/>
                    <button type="submit" class="btn submit-btn w-100"><?php echo e(trans('orbscope.login')); ?></button>
                </form>
                <div class="other-logins">
                    <p><?php echo e(trans('orbscope.or')); ?></p>
                    <p><?php echo e(trans('front.start_with')); ?></p>
                    <ul class="social-login d-flex justify-content-around">
                        <li>
                            <a href="<?php echo e(url('/register')); ?>">
                                <?php echo e(trans('orbscope.create_account')); ?>

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- mobile filter -->





<?php echo $__env->yieldContent('content'); ?>


<footer class="footer-section">
    <div class="footer-news text-center">
        <h3><?php echo e(trans('front.Keep_lates_informations')); ?></h3>
        <form class="d-flex justify-content-center" action="<?php echo e(url('news/add_email')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <div class="form-group w-100">
                <input type="email" required name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php echo e(trans('orbscope.email')); ?>">
            </div>
            <button type="submit" class="btn submit-btn"><i class="fas fa-paper-plane"></i></button>
        </form>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-12 footer-about">
                <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(ShowImage(GetSettings()->logo)); ?>"></a>
                <p>
                   <?php echo e(VarByLang(GetSettings()->footer_desc,GetLanguage())); ?>

                </p>
                <ul class="footer-social">
                    <li>
                        <a href="<?php echo e(GetSettings()->facebook); ?>"><i class="fab fa-facebook-square"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo e(GetSettings()->twitter); ?>"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo e(GetSettings()->googleplus); ?>"><i class="fab fa-instagram"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-2 col-12 about_links">
                <h5><?php echo e(trans('orbscope.general')); ?></h5>
                <ul class="footer-links">
                    <li><a href="<?php echo e(url('/How_does_work')); ?>"><?php echo e(trans('front.How_does_work')); ?></a></li>
                    <li><a href="<?php echo e(url('/terms_conditions')); ?>"><?php echo e(trans('orbscope.terms_conditions')); ?></a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-12 user_links">
                <h5><?php echo e(trans('front.for_users')); ?></h5>
                <ul class="footer-links">
                    <?php if(Auth::check()): ?>
                        <li><a href="<?php echo e(url('/user/profile')); ?>"><?php echo e(trans('front.Account_settings')); ?></a></li>
                        <li><a href="<?php echo e(url('/user/favorite_ads')); ?>"><?php echo e(trans('front.Wish_List')); ?></a></li>
                    <?php else: ?>
                        <li><a href="<?php echo e(url('/login')); ?>"><?php echo e(trans('orbscope.login')); ?></a></li>
                        <li><a href="<?php echo e(url('/login')); ?>"><?php echo e(trans('orbscope.create_account')); ?></a></li>
                        <li><a href="<?php echo e(url('/login')); ?>"><?php echo e(trans('front.Account_settings')); ?></a></li>
                        <li><a href="<?php echo e(url('/login')); ?>"><?php echo e(trans('front.Wish_List')); ?></a></li>

                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-lg-3 col-12">
                <h5><?php echo e(trans('front.our_app')); ?></h5>
                <ul class="footer-app-link">
                    <li>
                        <a href="#">
                            <img src="<?php echo e(url('orbscope/front')); ?>/img/app-store.jpg">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="<?php echo e(url('orbscope/front')); ?>/img/google-play.jpg">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="copyright row">
            <div class="col-md-6">
                <p>  كل الحقوق محفوظة مستعمل 2022 </p>
            </div>

        </div>
    </div>
</footer>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS

<script src="<?php echo e(url('orbscope/front')); ?>/jquery-3.6.0.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"  ></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<script type="text/javascript" src="<?php echo e(url('orbscope/front')); ?>/js/wow.js"></script>
<script type="text/javascript" src="<?php echo e(url('orbscope/front')); ?>/js/wow.min.js"></script>
<script src="<?php echo e(url('orbscope/front')); ?>/js/a076d05399.js"></script>
<script type="text/javascript" src="<?php echo e(url('orbscope/front')); ?>/js/slick.min.js"></script><script src="<?php echo e(url('orbscope/front')); ?>/js/main.js"></script>
<script>
    $('.popover-icon').on('click',function () {

        $.get('MarkAllSeen',function () {

        })
    });
</script>
<?php echo $__env->yieldContent('js'); ?>
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5d3c39409b94cd38bbe997b2/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
</body>

</html>