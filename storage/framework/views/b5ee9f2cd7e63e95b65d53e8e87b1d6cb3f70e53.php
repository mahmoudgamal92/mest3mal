

<?php $__env->startSection('content'); ?>


    <div class="main-section bg-main account-myads">
        <div class="container">
            <div class="row align-items-start">
            <?php echo $__env->make('front.user.menu_side', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- account-sidebar/-->
                <div class="col-md-9 col-12 account-content-wrapper">
                    <div class="account-content-wrap account-profile2">
                        <div class="col-md-12">
                            <form class="account-info-form" action="<?php echo e(url('user/update/profile')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <h4 class="accheading">ملفي</h4>
                                <div class="row form-group-info">
                                    <div class="col-lg-3 order-md-2 avatar-upload text-center">
                                        <img src="<?php echo e(ShowImage(auth()->user()->image)); ?>" id="preview" class="img-thumbnail">
                                        <input type="file" name="image" class="file" accept="image/*">
                                        <div class="input-group my-3">
                                            <div class="input-group-append m-auto">
                                                <button type="button" class="browse submit-btn"><?php echo e(trans('front.ghange_image')); ?></button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row col-lg-9 col-12 order-md-1">
                                        <div class="form-group col-12 col-md-6 pr-md-0">
                                            <label for="username"><?php echo e(trans('orbscope.name')); ?></label>
                                            <input type="text" required class="form-control" name="name" id="username"  value="<?php echo e($user->name); ?>">
                                        </div>
                                        <div class="form-group col-12 col-md-6 pr-md-0">
                                        </div>
                                        <div class="form-group col-12 col-md-6 pr-md-0">
                                            <label for="accemail"><?php echo e(trans('orbscope.email')); ?></label>
                                            <input type="email" required class="form-control" id="accemail" name="email" value="<?php echo e($user->email); ?>">
                                        </div>
                                        <div class="form-group col-12 col-md-6 pr-md-0">
                                            <label for="accphone"><?php echo e(trans('orbscope.phone')); ?></label>
                                            <input type="number" required class="form-control" id="accphone" value="<?php echo e($user->phone); ?>" name="phone">
                                        </div>
                                        <div class="form-group col-12 col-md-6 pr-md-0">
                                            <label for="accPasword"><?php echo e(trans('orbscope.password')); ?></label>
                                            <input type="password" name="password" class="form-control" id="accPasword" >
                                        </div>
                                        <div class="form-group col-12 col-md-6 pr-md-0">
                                            <label for="ConfirmPasword "><?php echo e(trans('orbscope.password_confirmation')); ?></label>
                                            <input type="password" name="password_confirmation" class="form-control" id="ConfirmPasword " placeholder="">
                                        </div>
                                        <!--
                                        <div class="form-group col-6 col-md-4 pr-md-0">
                                            <label for="accgende ">جنس</label>
                                            <select class="form-control" id="accgender">
                                                <option>رجل</option>
                                                <option>...</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6 col-md-4 pr-md-0">
                                            <label for="birthday">دات الميلاد</label>
                                            <input type="date" id="birthday" class="form-control" name="birthday">
                                        </div>
                                        <div class="form-group col-6 col-md-4 pr-md-0">
                                            <label for="acccountry">بلد</label>
                                            <select class="form-control" id="acccountry">
                                                <option>بلد</option>
                                                <option>...</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6 col-md-4 pr-md-0">
                                            <label for="acccity">مدينة</label>
                                            <select class="form-control" id="acccity">
                                                <option>مدينة</option>
                                                <option>...</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6 col-md-4 pr-md-0">
                                            <label for="acclang">لغاتك</label>
                                            <select class="form-control" id="acclang">
                                                <option>الإنجليزية</option>
                                                <option>...</option>
                                            </select>
                                        </div>-->
                                    </div>
                                </div>
                                <br/>
                                <button type="submit" class="submit-btn">احفظ الملف</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>