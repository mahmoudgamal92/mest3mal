<?php if(count($errors) > 0): ?>
    <div class="alert alert-danger" dir="<?php echo e(GetDirection()); ?>">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<?php if(session()->has('message')): ?>

    <div class="alert alert-success" dir="ar">
        <ul>
            لقد تم ارسال الرسالة شكرا لتواصلكم
        </ul>
    </div>
<?php endif; ?>

<?php if(session()->has('register')): ?>
    <div class="alert-wrapper" id="alert-success" style="background-color: gainsboro;">
        <div id="success">

            <div class="wrapper" style="background-color: lightgreen">
                <p>  لقد تم التسجيل سيتم التواصل لاحقا وشكرا.</p>
            </div>
        </div>
    </div>

    <?php endif; ?>
<?php if(session()->has('success')): ?>
    <script>
        swal({
            title: '<?php echo e(trans('orbscope.success')); ?>',
            type: 'success',
            icon: 'success',
            timer: 2000
        });
    </script>

<?php endif; ?>
<?php if(session()->has('message_reset_send')): ?>
    <script>
        swal({
            title: 'تم ارسال الرسالة الي البريد الخاص بك !',
            type: 'success',
            icon: 'success',
            timer: 2000
        });
    </script>

<?php endif; ?>
<?php if(session()->has('password_has_ghange')): ?>
    <script>
        swal({
            title: 'تم تغير كلمة السر بنجاح',
            type: 'success',
            icon: 'success',
            timer: 2000
        });
    </script>

<?php endif; ?>
<?php if(session()->has('email_error')): ?>
    <script>
        swal({
            title: '<?php echo e(trans('front.email_error')); ?>',
            type: 'error',
            icon: 'error',
            timer: 2000
        });
    </script>

<?php endif; ?>

<?php if(session()->has('noblance')): ?>
    <script>
        swal({
            title: '<?php echo e(trans('front.noblance')); ?>',
            type: 'error',
            icon: 'error',
            timer: 2000
        });
    </script>

<?php endif; ?>
<?php if(session()->has('time_end')): ?>
    <script>
        swal({
            title: '<?php echo e(trans('front.time_end')); ?>',
            type: 'error',
            icon: 'error',
            timer: 2000
        });
    </script>

<?php endif; ?>
<?php if(session()->has('cant_delete')): ?>
    <script>
        swal({
            title: '<?php echo e(trans('front.cant_delete')); ?>',
            type: 'error',
            icon: 'error',
            timer: 2000
        });
    </script>

<?php endif; ?>


<?php if(session()->has('updated')): ?>
    <script>
        swal({
            title: '<?php echo e(trans('orbscope.updated')); ?>',
            type: 'success',
            html: true,
            timer: 2000
        });
    </script>
<?php endif; ?>

<?php if(session()->has('success_order')): ?>
    <div class="alert-wrapper" id="alert-success" style="background-color: gainsboro;">
        <div id="success">

            <div class="wrapper" style="background-color: rgba(157,255,157,0.68);text-align: center" >
                <p style="color: green;"><?php echo e(trans('front.success_order')); ?></p>
            </div>
        </div>
    </div>

<?php endif; ?>





<?php if(session()->has('success_profile')): ?>
    <div class="alert-wrapper" id="alert-success" style="background-color: gainsboro;">
        <div id="success">

            <div class="wrapper" style="background-color: lightgreen">
                <p> تم التعديل.</p>
            </div>
        </div>
    </div>
<?php endif; ?>



