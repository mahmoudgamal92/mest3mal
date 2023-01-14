

<?php $__env->startSection('content'); ?>


    <div class="main-section bg-main account-myads">
        <?php echo $__env->make('front.layout.messages', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="container">
            <div class="row align-items-start">
                <?php echo $__env->make('front.user.menu_side', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <!-- account-sidebar/-->


                <div class="col-lg-9 col-md-9 col-12 account-content-wrapper">
                    <div class="account-content-wrap summery-content">
                        <div class="myads-wrapper d-flex">
                            <div class="ads-wrap active-ads mr-5 text-center">
                                <p class="ads-number mb-0"><?php echo e(\App\Orbscope\Models\Auction::where('user_id',auth()->id())->where('status','active')->count()); ?></p>
                                <p class="ads-text mb-1"><?php echo e(trans('front.Your_active_acutions')); ?></p>
                            </div>

                            <div class="ads-wrap  text-center">

                                    <a href="<?php echo e(url('/user/add_auction')); ?>" class="btn submit-btn-radius"><?php echo e(trans('orbscope.add')); ?> <?php echo e(trans('front.auction')); ?></a>

                            </div>
                        </div>
                        <div class="filter-ads-summary mt-5">
                            <div class="row">



                            </div>
                            <div class="myads-data">
                                <div class="table-responsive">
                                    <table class="table table-striped accont-myads-table">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center;" scope="col"><?php echo e(trans('front.auction_ID')); ?></th>
                                            <th style="text-align: center;" scope="col"><?php echo e(trans('orbscope.title')); ?></th>
                                            <th style="text-align: center;" scope="col"><?php echo e(trans('orbscope.details')); ?></th>
                                            <th style="text-align: center;" scope="col"><?php echo e(trans('orbscope.end_date')); ?></th>
                                            <th style="text-align: center;" scope="col"><?php echo e(trans('front.action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                       <?php $__currentLoopData = $auctions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($ad->auction_number); ?></td>
                                            <td><?php echo e($ad->title); ?></td>
                                            <td><?php echo e(str_limit($ad->details,100)); ?></td>
                                            <td>
                                                <?php echo e($ad->end_date); ?>

                                            </td>

                                            <td>

                                                <a href="<?php echo e(url('/user/edit/auction/'.$ad->id)); ?>" class="save-ads-data">
                                                    <i class="fas fa-edit"></i>
</a>
                                                <br/>
                                                <a href="<?php echo e(url('/auction/'.$ad->id.'/'.$ad->title)); ?>">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <br/>
                                                <a onclick="return confirm('Are you sure you want to Delete?');" href="<?php echo e(url('user/delete/auction/'.$ad->id)); ?>" class="remove-ads-data">
                                    <i class="fas fa-trash"></i>
</a>
                                            </td>
                                        </tr>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <nav aria-label="Page navigation" class="mr-3">
                                    <ul class="pagination">
                                        <?php echo e($auctions->links()); ?>

                                    </ul>
                                </nav>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>