


<?php $__env->startSection('content'); ?>
    <style>
        #timer {
            font-size: 2.4em;
            font-weight: 400;
            color: #FC783F;
            display: inline-flex;
            padding: 10px
        }


        span {
            color: #40c6f1;
            display: block;
            font-size: .65em;
            font-weight: 400;
        }



    </style>



    <!-- breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-wrap">
        <div class="container">

            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="#"></a></li>
                <li class="breadcrumb-item"><a href="#"><?php echo e(trans('front.home')); ?></a></li>
                <li class="breadcrumb-item"><a href="#"><?php echo e(trans('front.Auctions')); ?></a></li>
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

                            <h2 class="prodcut-price mt-3 mb-3"><?php echo e(trans('front.number_offers')); ?> : <?php echo e(@$show->offers->count()); ?></h2>


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
                                        <?php if(!empty($show->address)): ?>
                                            <td class="attr-title"><?php echo e(trans('orbscope.address')); ?></td>
                                            <td class="attr-value"><?php echo e($show->address); ?></td>
                                        <?php endif; ?>
                                    </tr>

                                    </tbody>
                                </table>

                            </div>
                            <?php if($show->status=='active'): ?>
                                <div  id="timer"></div>
                            <?php else: ?>
                                <h4 style="color: red;"><?php echo e(trans('log.'.$show->status)); ?></h4>
                            <?php endif; ?>
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


                                <?php if(Auth::check()): ?>
                               <?php if(check_offers($show->id)==0): ?>
                               <form method="post" action="<?php echo e(url('user/add_offer/'.$show->id)); ?>">
                                   <?php echo e(csrf_field()); ?>

                                   <div class="form-group">
                                       <input type="number" required name="amount" class="form-control" id="exampleFormControlTextarea1"  placeholder="<?php echo e(trans('front.add_offers')); ?>">
                                   </div>
                                   <button type="submit" class="btn custom-btn w-150 submit-btn-123"><?php echo e(trans('orbscope.add')); ?></button>
                               </form>
                               <?php endif; ?>
                                <?php endif; ?>
                                <br/>
                                <h2 class="prodcut-titles"><?php echo e(trans('front.offers')); ?></h2>
                               <div class="pro-comment-list bg-light p-4 mt-4 mb-4">
                                   <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $of): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <div class="media mb-3" style="background: aliceblue;padding: 10px;">
                                       <img src="<?php echo e(ShowImage(@$of->user->image)); ?>" class="mr-3 rounded-circle acc-avatar-image" alt="...">
                                       <div class="media-body single-prod-body">
                                           <h6 class="mt-0"><?php echo e(@$of->user->name); ?> <span><?php echo e($of->created_at->diffForHumans()); ?></span>
                                           </h6>
                                           <p><strong><?php echo e(trans('orbscope.amount_money')); ?> : <?php echo e($of->amount); ?> </strong></p>
                                           <?php if(Auth::check()): ?>
                                           <?php if(auth()->id()==$show->user_id): ?>
                                           <a href="<?php echo e(url('/user/contact/'.$of->user_id)); ?>" style="color: white;background-color: #34ACE0;" class="custom-btn  d-block text-center">تواصل مع صاحب العرض</a>
                                           <?php endif; ?>
                                           <?php endif; ?>
                                       </div>
                                   </div>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   <?php if(count($offers)==0): ?>

                                      <?php echo e(trans('front.no_offers')); ?>

                                   <?php endif; ?>
                               </div>
                                <?php echo e($offers->links()); ?>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">

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
                        <div class="media mb-3 align-items-center">
                            <i class="fas fa-phone-alt mr-2"></i>
                            <div class="media-body call_number">
                                <h6 class="mt-0 mb-0"><?php echo e(@$show->user->phone); ?>

                                </h6>
                                <!--
                                <spsn class="font12">انقر لإظهار رقم الهاتف</spsn>-->
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
                    <div class="seller-social p-3 mt-4 mb-3">
                        <p class="text-center"><?php echo e(trans('front.Share_with_your_friend')); ?></p>
                        <ul class="footer-social-2 text-center mb-0">


                            <?php echo Share::page(url('ad/'.$show->id.'/'.$show->title),$show->title)
                                      ->facebook()
                                      ->twitter()

                                      ->linkedin( $show->title ); ?>

                        </ul>
                    </div>
                    <p class="seller-prod-id mb-0"><?php echo e(trans('front.auction_ID')); ?>: <?php echo e($show->auction_number); ?></p>

                </div>
            </div>

        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        function updateTimer() {
            future  = Date.parse("<?php echo e($show->end_date); ?>");
            now     = new Date($.now());
            diff    = future - now;

            days  = Math.floor( diff / (1000*60*60*24) );
            hours = Math.floor( diff / (1000*60*60) );
            mins  = Math.floor( diff / (1000*60) );
            secs  = Math.floor( diff / 1000 );

            d = days;
            h = hours - days  * 24;
            m = mins  - hours * 60;
            s = secs  - mins  * 60;

            document.getElementById("timer")
                .innerHTML =
                '<div style="margin:10px;">' + d + '<br><span><?php echo e(trans('front.day')); ?></span></div>' +
                '<div style="margin:10px;">' + h + '<br><span><?php echo e(trans('front.hour')); ?></span></div>' +
                '<div style="margin:10px;">' + m + '<br><span><?php echo e(trans('front.minute')); ?></span></div>' +
                '<div style="margin:10px;">' + s + '<br><span><?php echo e(trans('front.second')); ?></span></div>' ;
        }
        setInterval('updateTimer()', 1000 );

    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>