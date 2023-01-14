
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>



    <div class="main-section bg-main category-bg">
        <div class="container">



            <div class="row">
                <div class="col-12">

                    <div class="catgory_list">

                        <div class="col-lg-12">
                            <div class="cate_heading">
                                <h3><?php echo e(trans('front.What_do_advertise')); ?></h3>
                                <h5 style="padding-bottom: 15px;"><?php echo e(trans('front.chose_cat')); ?></h5>
                            </div>
                        </div>

                        <?php $__currentLoopData = $departs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $depart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="media media-1">
                                <img src="<?php echo e(ShowImage($depart->image)); ?>" class="align-self-start mr-3" alt="image">
                                <div class="media-body medai-body-1">
                                    <h5 class="mt-0"><a class="main_cat" id="<?php echo e($depart->id); ?>" href="#"><?php echo e(VarByLang($depart->name,GetLanguage())); ?></a></h5>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div><!-- end col -->
            </div><!-- end row -->


        </div>
    </div>

 <?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>


    <script>

        $(document).on('click', '.main_cat', function () {

            var main_cat = $(this).attr('id');
            $.ajax({
                url: '<?php echo e(url('category/ajax')); ?>',
                dataType: 'html',
                type: 'post',
                data: {_token: '<?php echo e(csrf_token()); ?>', main_cat: main_cat},
                beforeSend: function () {
                    //$('.city_data').removeClass('hidden');
                }, success: function (data) {
                    $('.catgory_list').html(data);
                   // $('select[name="cat_id"]').val("<?php echo e(old('cat_id')); ?>").select2();
                }
            });
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>