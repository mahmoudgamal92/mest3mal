

<?php $__env->startSection('content'); ?>


    <div class="main-section bg-main account-myads">
        <div class="container">
            <div class="row align-items-start">
            <?php echo $__env->make('front.user.menu_side', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- account-sidebar/-->


                <div class="col-lg-9 col-md-9 col-12 account-content-wrapper">
                    <div class="account-content-wrap summery-content">

                        <div class="col-12 products-main list-grid-prodcuts">
                            <div class="products_456 d-flex flex-wrap">
                                <?php if(count($ads)>0): ?>
                                <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="product-wrapper">
                                        <div class="products_003"> <!-- start of grid product -->
                                            <div class="featured-image-2"  >
                                                <img style="height: 125px;" src="<?php echo e(ShowImage($ad->main_image)); ?>" alt="image">
                                                <ul class="heart_icon heat_icon3 heart_icon4">
                                                    <li><a id="<?php echo e($ad->id); ?>" class="delete_ad"><i style="color: #c90003;" class="fa fa-trash" aria-hidden="true"></i></a></li>

                                                </ul>
                                            </div>
                                            <div class="featured_text-2">
                                                <ul class="price price_3">
                                                    <li class="price_1"><?php echo e($ad->price); ?></li>
                                                    <li class="yesterday yesterday_3 text-right"><?php echo e($ad->created_at->diffForHumans()); ?></li>
                                                </ul>
                                                <p style="cursor: pointer;" onclick="window.location='<?php echo e(url('/ad/'.$ad->id.'/'.str_replace(' ', '_', $ad->title))); ?>'"><?php echo e($ad->title); ?></p>
                                                <ul class="rating rating_3 d-flex justify-content-between">
                                                    <li><i class="fa fa-user"></i><?php echo e(@$ad->user->name); ?></li>
                                                </ul>
                                                <p class="arabic_text"><i class="fas fa-map-marker-alt"></i><?php echo e(VarByLang(@$ad->city->name,GetLanguage())); ?> <?php echo e(VarByLang(@$ad->state->name,GetLanguage())); ?></p>
                                            </div>
                                        </div>
                                    </div> <!-- prodcut close -->
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div class="alert-wrapper" id="alert-success" style="background-color: gainsboro;">
                                        <div id="success">

                                            <div class="wrapper" style="background-color: rgba(157,255,157,0.68);text-align: center" >
                                               <p>NO DATA</p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div><!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

    <script>

        $(document).on('click', '.delete_ad', function () {

            var ad_id = $(this).attr('id');
            $(this).parents('.product-wrapper').remove();
            $.ajax({
                url: '<?php echo e(url('delete_favorites/ajax')); ?>',
                dataType: 'html',
                type: 'post',
                data: {_token: '<?php echo e(csrf_token()); ?>', ad_id: ad_id},
                beforeSend: function () {

                }, success: function (data) {
                    //$(this).parents('.product-wrapper').remove();
                }
            });
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>