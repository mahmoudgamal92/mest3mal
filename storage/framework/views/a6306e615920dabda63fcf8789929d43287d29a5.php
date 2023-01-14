
<?php $__env->startSection('content'); ?>



    <!-- breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-wrap">
        <div class="container">

            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="#"></a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><?php echo e(trans('front.home')); ?></a></li>
                <?php if(isset($state)): ?>
                    <li class="breadcrumb-item"><a href="#"><?php echo e(VarByLang($state->name,GetLanguage())); ?></a></li>
                <?php endif; ?>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e($title); ?></li>
            </ol>

        </div>
    </nav>
    <!--products page -->
    <div class="main-products pt-3 pb-5">
        <div class="container">
            <div class="row m-0">
                <div class="custom-bg-pd col-md-3 col-xl-2 left_side_009">

                        <div class="prodcut-search">


                                <div class="collapse show">
                                    <div class="category-side-123">
                                        <ul class="categories-sort4">
                                            <?php $__currentLoopData = \App\Orbscope\Models\Country::where('status','active')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li> <a href="<?php echo e(url('auctions/state/'.$c->id.'/'.VarByLang($c->name,GetLanguage()))); ?>"><?php echo e(VarByLang($c->name,GetLanguage())); ?></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </div>

                        </div> <!-- end of brand -->

                </div> <!-- end of product sidebar -->
                <div class="col-md-9 col-xl-10 products-cate-123">


                    <div class="col-12 products-main list-grid-prodcuts">
                        <div class="products_456 d-flex flex-wrap">
                            <?php $__currentLoopData = $auctions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="product-wrapper">
                                    <div class="products_003"> <!-- start of grid product -->
                                        <div class="featured-image-2" style="cursor: pointer;" onclick="window.location='<?php echo e(url('/auction/'.$ad->id.'/'.str_replace(' ', '_', $ad->title))); ?>'">
                                            <img style="height: 125px;" src="<?php echo e(ShowImage($ad->main_image)); ?>" alt="image">
                                        </div>
                                        <div class="featured_text-2">
                                            <ul class="price price_3">
                                                <li class="price_1"><?php echo e(trans('front.number_offers')); ?> : <?php echo e($ad->offers->count()); ?> </li>
                                                <li class="yesterday yesterday_3 text-right"><?php echo e($ad->created_at->diffForHumans()); ?></li>
                                            </ul>
                                            <p style="cursor: pointer;" onclick="window.location='<?php echo e(url('/auction/'.$ad->id.'/'.str_replace(' ', '_', $ad->title))); ?>'"><?php echo e($ad->title); ?></p>
                                            <ul class="rating rating_3 d-flex justify-content-between">
                                                <li><i class="fa fa-user"></i><?php echo e(@$ad->user->name); ?></li>
                                            </ul>
                                            <p class="arabic_text"><i class="fas fa-map-marker-alt"></i><?php echo e(VarByLang(@$ad->city->name,GetLanguage())); ?> <?php echo e(VarByLang(@$ad->state->name,GetLanguage())); ?></p>
                                        </div>
                                    </div>
                                </div> <!-- prodcut close -->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                        <?php echo e($auctions->links()); ?>

                    </div><!-- end col -->
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>