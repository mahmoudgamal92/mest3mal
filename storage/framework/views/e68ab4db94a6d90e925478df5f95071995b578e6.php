


<?php $__env->startSection('content'); ?>



<!-- breadcrumb -->
<nav aria-label="breadcrumb" class="breadcrumb-wrap">
    <div class="container">

        <ol class="breadcrumb bg-transparent">
            <li class="breadcrumb-item"><a href="#"></a></li>
            <li class="breadcrumb-item"><a href="#"><?php echo e(trans('front.home')); ?></a></li>
            <li class="breadcrumb-item"><a href="#"><?php echo e(VarByLang(@$show->depart->name,GetLanguage())); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e($title); ?></li>
        </ol>

    </div>
</nav>
<!-- single prodcut page -->
<div class="single-prodcut-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-12">
                <?php echo $__env->make('front.layout.messages', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="row">
                    <div class="col-lg-6">
                        <?php if($show->images != null): ?>
                        <div class="single-slider d-lg-flex">
                            <div class="main-container order-lg-2 mb-3">
                                <div class="slider slider-main">
                                    <?php $__currentLoopData = explode('|', $show->images); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div>
                                        <img src="<?php echo e(ShowImage($image)); ?>">
                                    </div>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <div class="nav-container mr-3 other-lg-1">
                                <div class="slider-nav">
                                    <?php $__currentLoopData = explode('|', $show->images); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div>
                                            <img src="<?php echo e(ShowImage($image)); ?>">
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-6">
                        <h2 class="sinpro-title">
                           <?php echo e($show->title); ?>

                        </h2>
                        <div>
                            <span class="publish-date"><?php echo e($show->created_at->diffForHumans()); ?></span>
                        </div>

                        <h2 class="prodcut-price mt-3 mb-3"><?php echo e($show->price); ?>

                            <?php if(Auth::check()): ?>
                                <?php if($show->user_id != auth()->id()): ?>
                                    <?php if( $show->status == 'active'): ?>
                            <a href="<?php echo e(url('user/add/new/order/'.$show->id)); ?>" style="float: <?php echo e(GetLanguage()=='ar'?'left':'right'); ?>;color: white;font-size: initial;" class="custom-btn"> <i class="fa fa-shopping-cart"></i> <?php echo e(trans('front.send_order_message')); ?></a>
                                    <?php elseif($show->status == 'done'): ?>
                                        <span style="top: 0px;padding: 3px;" class="badge-custom badge-comppleted"><?php echo e(trans('front.sold')); ?></span>
                                    <?php endif; ?>

                                <?php endif; ?>
                            <?php else: ?>
                                <a type="button"  data-toggle="modal" data-target="#loginmodal"  style="float: <?php echo e(GetLanguage()=='ar'?'left':'right'); ?>;color: white;font-size: initial;" class="custom-btn"> <i class="fa fa-shopping-cart"></i> <?php echo e(trans('front.send_order_message')); ?></a>

                            <?php endif; ?>
                        </h2>





                        <div class="prodcut-attr table-responsive">
                            <table class="table table-striped sigle-prod-table">
                                <tbody>
                                <tr>
                                    <td class="attr-title"><?php echo e(trans('orbscope.country')); ?></td>
                                    <td class="attr-value"><?php echo e(VarByLang(@$show->city->name,GetLanguage())); ?></td>
                                    <td class="attr-title"><?php echo e(trans('orbscope.city')); ?></td>
                                    <td class="attr-value"><?php echo e(VarByLang(@$show->state->name,GetLanguage())); ?></td>
                                </tr>

                                <tr>
                                    <?php if(!empty($show->surface_area)): ?>
                                        <td class="attr-title"><?php echo e(trans('front.surface_area')); ?></td>
                                        <td class="attr-value"><?php echo e($show->surface_area); ?></td>
                                    <?php endif; ?>
                                    <?php if(!empty($show->number_halls)): ?>
                                        <td class="attr-title"><?php echo e(trans('front.number_halls')); ?></td>
                                        <td class="attr-value"><?php echo e($show->number_halls); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if(!empty($show->number_bathrooms)): ?>
                                        <td class="attr-title"><?php echo e(trans('front.number_bathrooms')); ?></td>
                                        <td class="attr-value"><?php echo e($show->number_bathrooms); ?></td>
                                    <?php endif; ?>
                                    <?php if(!empty($show->bedrooms)): ?>
                                        <td class="attr-title"><?php echo e(trans('front.Bedrooms')); ?></td>
                                        <td class="attr-value"><?php echo e($show->bedrooms); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if(!empty($show->age)): ?>
                                        <td class="attr-title"><?php echo e(trans('front.age')); ?></td>
                                        <td class="attr-value"><?php echo e($show->age); ?></td>
                                    <?php endif; ?>
                                    <?php if(!empty($show->model)): ?>
                                        <td class="attr-title"><?php echo e(trans('front.model')); ?></td>
                                        <td class="attr-value"><?php echo e($show->model); ?></td>
                                    <?php endif; ?>

                                </tr>
                                <tr>
                                    <?php if(!empty($show->car_type)): ?>
                                        <td class="attr-title"><?php echo e(trans('front.Car_conditions')); ?></td>
                                        <td class="attr-value"><?php echo e($show->car_type); ?></td>
                                    <?php endif; ?>
                                    <?php if(!empty($show->car_gear)): ?>
                                        <td class="attr-title"><?php echo e(trans('front.car_gear')); ?></td>
                                        <td class="attr-value"><?php echo e(trans('front.'.$show->car_gear)); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr class="attr-tags">
                                    <?php if(!empty($show->engine_type)): ?>
                                        <td class="attr-title"><?php echo e(trans('front.engine_type')); ?></td>
                                        <td class="attr-value"><?php echo e(trans('front.'.$show->engine_type)); ?></td>
                                    <?php endif; ?>
                                    <?php if(!empty($show->drive_system)): ?>
                                        <td class="attr-title"><?php echo e(trans('front.drive_system')); ?></td>
                                        <td class="attr-value"><?php echo e(trans('front.'.$show->drive_system)); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr class="attr-tags">
                                    <?php if(!empty($show->seats_number)): ?>
                                        <td class="attr-title"><?php echo e(trans('front.Number_seats')); ?></td>
                                        <td class="attr-value"><?php echo e($show->seats_number); ?></td>
                                    <?php endif; ?>
                                    <?php if(!empty($show->address)): ?>
                                        <td class="attr-title"><?php echo e(trans('orbscope.address')); ?></td>
                                        <td class="attr-value"><a target="_blank" href="<?php echo e($show->address); ?>"><?php echo e(trans('orbscope.click_here')); ?></a></td>
                                    <?php endif; ?>
                                </tr>
                                <tr class="attr-tags">
                                    <?php if(count(@$show->services)>0): ?>
                                        <td class="attr-title"><?php echo e(trans('orbscope.services')); ?></td>
                                        <td class="attr-value">
                                            <?php $__currentLoopData = @$show->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $se): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e(VarByLang(@$se->service_name->name,GetLanguage())); ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                                    <?php endif; ?>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-12">
                        <h2 class="prodcut-titles"><?php echo e(trans('orbscope.description')); ?></h2>
                        <p class="desc-text">
                            <?php echo e($show->details); ?>

                        </p>
                        <!--
                        <div class="single-location">
                            <h4 class="loc-title">موقع الإعلانات</h4>
                            <p class="loc-name">الدمام ، الشرق</p>
                            <div class="map-wrapper">

                            </div>
                        </div>-->
                        <div class="prodcut-comment">


                            <div class="seller-social">
                            <p class="text-center"><?php echo e(trans('front.Share_with_your_friend')); ?></p>
                            <ul class="footer-social-2 text-center mb-0" style="display: inline-flex;
    margin-right: 40%;">


                                <?php echo Share::page(url('ad/'.$show->id.'/'.$show->title),$show->title)
                                          ->facebook()
                                          ->twitter()
                                          ->whatsapp()
                                          ->linkedin( $show->title ); ?>


                                <div class="social-links">

                                <li><a  onclick="copyToClipboard('#p1')" id="p1" data-action="<?php echo e(url()->current()); ?>" title="نسخ"><i class="fas fa-link"></i></a></li>
                                </div>
                            </ul>
                            </div>



                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <?php if(Auth::check()): ?>
                    <?php if(Favorites($show->id)=='add'): ?>
                <a id="<?php echo e($show->id); ?>"  class="custom-btn btn-prodcut-fav d-block text-center mb-4 add_favorite" ><i class="far fa-heart mr-2"></i>
                    <?php echo e(trans('front.add_to_favorites')); ?></a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?php echo e(url('/login')); ?>"  class="custom-btn btn-prodcut-fav d-block text-center mb-4" ><i class="far fa-heart mr-2"></i>
                        <?php echo e(trans('front.add_to_favorites')); ?></a>
                <?php endif; ?>

                <div class="seller-info-prod rounded p-3 mt-4">
                    <p class="text-center"><?php echo e(trans('front.seller_information')); ?></p>
                    <div class="media mb-3">
                        <div class="position-relative">
                            <img src="<?php echo e(ShowImage(@$show->user->image)); ?>" class="mr-3 rounded-circle acc-avatar-image" alt="image">
                        </div>
                        <div class="media-body abdul-123">
                            <h6 class="mt-0 mb-0"><?php echo e(@$show->user->name); ?> <span></span>
                            </h6>
                            <span class="font12"><?php echo e(trans('front.member')); ?> <?php echo e(@$show->user->created_at->diffForHumans()); ?></span>

                        </div>
                    </div>
                    <div style="margin-<?php echo e(GetLanguage()=='ar'?'right':'left'); ?>: 32px;" class="media mb-3 align-items-center">
                        <?php echo stars(user_rate($show->user_id)); ?>

                    </div>
                    <div class="media mb-3 align-items-center">
                        <i class="fas fa-phone-alt mr-2"></i>
                        <div class="media-body call_number">
                            <h6 class="mt-0 mb-0"><?php echo e(@$show->user->phone); ?></span>
                            </h6>

                        </div>

                    </div>

                <!--
                    <p class="abdul_gmail"><i class="fas fa-at"></i> عبدالرحمن@gmail.com</p>-->

                    <div class="seller-contact-btn">
                        <?php if(Auth::check()): ?>
                            <?php if(auth()->id()!=$show->user_id): ?>
                        <a style="position: inherit;" class="custom-btn btn-prodcut-seller d-block text-center mb-2" href="<?php echo e(url('/user/contact/'.@$show->user->id)); ?>">
                            <?php echo e(trans('front.send_message')); ?>

                        </a>
                            <?php endif; ?>
                        <?php else: ?>
                            <a  style="position: inherit;" class="custom-btn btn-prodcut-seller d-block text-center mb-2" href="<?php echo e(url('/login')); ?>">
                                <?php echo e(trans('front.send_message')); ?>

                            </a>

                        <?php endif; ?>

                    </div>
                </div>
                    <!--
                <div class="seller-social p-3 mt-4 mb-3">
                    <p class="text-center"><?php echo e(trans('front.Share_with_your_friend')); ?></p>
                    <ul class="footer-social-2 text-center mb-0">



                    </ul>
                </div>-->
                <p class="seller-prod-id mb-0"><?php echo e(trans('front.ad_number')); ?>: <?php echo e($show->ad_number); ?></p>

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="related-ads-heading">
                    <h4><?php echo e(trans('front.related_ads')); ?></h4>
                </div>
            </div>
        </div>
        <div>
            <div class="products_456 d-flex flex-wrap">

                    <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="product-wrapper">
                            <div class="products_003"> <!-- start of grid product -->
                                <div class="featured-image-2" style="cursor: pointer;" onclick="window.location='<?php echo e(url('/ad/'.$ad->id.'/'.str_replace(' ', '_', $ad->title))); ?>'">
                                    <img style="height: 125px;" src="<?php echo e(ShowImage($ad->main_image)); ?>" alt="image">
                                </div>
                                <div class="featured_text-2">
                                    <ul class="price price_3">
                                        <li class="price_1"><?php echo e($ad->price); ?></li>
                                        <li class="yesterday yesterday_3 text-right"><?php echo e($ad->created_at->diffForHumans()); ?></li>
                                    </ul>
                                    <p style="cursor: pointer;" onclick="window.location='<?php echo e(url('/ad/'.$ad->id.'/'.str_replace(' ', '_', $ad->title))); ?>'"><?php echo e($ad->title); ?></p>
                                    <ul class="rating rating_3 d-flex justify-content-between">
                                        <li><i class="fa fa-user"></i><?php echo e(@$ad->user->name); ?></li>
                                        <li  class="rating_list rating_list3 rating_4 text-right">
                                            <?php echo stars(user_rate($ad->user_id)); ?>

                                        </li>
                                    </ul>
                                    <p class="arabic_text"><i class="fas fa-map-marker-alt"></i><?php echo e(VarByLang(@$ad->city->name,GetLanguage())); ?> <?php echo e(VarByLang(@$ad->state->name,GetLanguage())); ?></p>
                                </div>
                            </div>
                        </div> <!-- prodcut close -->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>

    </div>
</div>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>

        $(document).on('click', '.add_favorite', function () {

            var ad_id = $(this).attr('id');
            $.ajax({
                url: '<?php echo e(url('add_to_favorites/ajax')); ?>',
                dataType: 'html',
                type: 'post',
                data: {_token: '<?php echo e(csrf_token()); ?>', ad_id: ad_id},
                beforeSend: function () {

                }, success: function (data) {
                    $(".add_favorite").remove();
                    // $('select[name="cat_id"]').val("<?php echo e(old('cat_id')); ?>").select2();
                }
            });
        });

        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).attr('data-action')).select();
            document.execCommand("copy");
            $temp.remove();
        }

    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>