

<?php $__env->startSection('content'); ?>


    <div class="main-section bg-main account-myads">
        <?php echo $__env->make('front.layout.messages', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="container">
            <div class="row align-items-start">
            <?php echo $__env->make('front.user.menu_side', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- account-sidebar/-->


                <div class="col-md-9 col-12 account-content-wrapper">
                    <div class="account-content-wrap my-order-content">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a  class="nav-link" href="#allorders" role="tab" data-toggle="tab"><?php echo e(trans('orbscope.show-all')); ?> <?php echo e(trans('front.orders')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#actions" role="tab" data-toggle="tab"><?php echo e(trans('orbscope.order_underway')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#Confirmed" role="tab" data-toggle="tab"><?php echo e(trans('orbscope.order_done')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#Shipped" role="tab" data-toggle="tab"><?php echo e(trans('orbscope.order_cancelled')); ?></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="filter-ads-summary tab-pane fade in active show" role="tabpanel" id="allorders">
                                <div class="top-show-result d-flex justify-content-end align-items-center mt-3 mb-3">

                                </div>
                                <div class="myads-data">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead class="order-text-123">
                                            <tr>
                                                <th scope="col"><?php echo e(trans('front.order_number')); ?></th>
                                                <th scope="col"><?php echo e(trans('front.product')); ?></th>
                                                <th scope="col"><?php echo e(trans('orbscope.price')); ?></th>
                                                <th scope="col"><?php echo e(trans('orbscope.date')); ?></th>
                                                <th scope="col"><?php echo e(trans('orbscope.status')); ?></th>
                                                <th scope="col"><?php echo e(trans('orbscope.show')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $od): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <?php echo e($od->order_number); ?>

                                                </td>
                                                <td>
                                                    <div class="media">
                                                        <img class="acc-avatar-image mr-2" src="<?php echo e(ShowImage(@$od->ad->main_image)); ?>">
                                                        <div class="media-body order-body-text">
                                                            <h6 class="mt-0"><?php echo e(@$od->ad->title); ?></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php echo e($od->amount); ?>

                                                </td>
                                                <td>
                                                   <?php echo e($od->created_at->format('Y-m-d')); ?>

                                                </td>
                                                <td>
                                                    <?php if($od->status=='operation'): ?>
                                                    <span class="badge-custom badge-activated"><?php echo e(trans('front.'.$od->status)); ?></span>
                                                     <?php elseif($od->status=='done'): ?>
                                                        <span class="badge-custom badge-comppleted"><?php echo e(trans('front.'.$od->status)); ?></span>
                                                        <?php else: ?>
                                                        <span class="badge-custom badge-pending"><?php echo e(trans('front.'.$od->status)); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo e(url('user/orders/'.$od->id.'/'.$od->order_number)); ?>" class="save-ads-data"><i class="far fa-eye"></i></a>
                                                </td>
                                            </tr> <!-- order detail end -->
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end">
                                            <nav aria-label="Page navigation" class="mr-3">
                                                <ul class="pagination">
                                                    <?php echo e($orders->links()); ?>

                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-ads-summary tab-pane fade in active" role="tabpanel" id="actions">

                                <div class="myads-data">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead class="order-text-123">
                                            <tr>
                                                <th scope="col"><?php echo e(trans('front.order_number')); ?></th>
                                                <th scope="col"><?php echo e(trans('front.product')); ?></th>
                                                <th scope="col"><?php echo e(trans('orbscope.price')); ?></th>
                                                <th scope="col"><?php echo e(trans('orbscope.date')); ?></th>
                                                <th scope="col"><?php echo e(trans('orbscope.status')); ?></th>
                                                <th scope="col"><?php echo e(trans('orbscope.show')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $operation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $od): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <?php echo e($od->order_number); ?>

                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <img class="acc-avatar-image mr-2" src="<?php echo e(ShowImage(@$od->ad->main_image)); ?>">
                                                            <div class="media-body order-body-text">
                                                                <h6 class="mt-0"><?php echo e(@$od->ad->title); ?></h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php echo e($od->amount); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo e($od->created_at->format('Y-m-d')); ?>

                                                    </td>
                                                    <td>
                                                        <?php if($od->status=='operation'): ?>
                                                            <span class="badge-custom badge-activated"><?php echo e(trans('front.'.$od->status)); ?></span>
                                                        <?php elseif($od->status=='done'): ?>
                                                            <span class="badge-custom badge-comppleted"><?php echo e(trans('front.'.$od->status)); ?></span>
                                                        <?php else: ?>
                                                            <span class="badge-custom badge-pending"><?php echo e(trans('front.'.$od->status)); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo e(url('user/orders/'.$od->id.'/'.$od->order_number)); ?>" class="save-ads-data"><i class="far fa-eye"></i></a>
                                                    </td>
                                                </tr> <!-- order detail end -->
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end">
                                            <nav aria-label="Page navigation" class="mr-3">
                                                <ul class="pagination">
                                                    <?php echo e($operation->links()); ?>

                                                </ul>
                                            </nav>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="filter-ads-summary tab-pane fade in active" role="tabpanel" id="Confirmed">

                                <div class="myads-data">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead class="order-text-123">
                                            <tr>
                                                <th scope="col"><?php echo e(trans('front.order_number')); ?></th>
                                                <th scope="col"><?php echo e(trans('front.product')); ?></th>
                                                <th scope="col"><?php echo e(trans('orbscope.price')); ?></th>
                                                <th scope="col"><?php echo e(trans('orbscope.date')); ?></th>
                                                <th scope="col"><?php echo e(trans('orbscope.status')); ?></th>
                                                <th scope="col"><?php echo e(trans('orbscope.show')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $done; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $od): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <?php echo e($od->order_number); ?>

                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <img class="acc-avatar-image mr-2" src="<?php echo e(ShowImage(@$od->ad->main_image)); ?>">
                                                            <div class="media-body order-body-text">
                                                                <h6 class="mt-0"><?php echo e(@$od->ad->title); ?></h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php echo e($od->amount); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo e($od->created_at->format('Y-m-d')); ?>

                                                    </td>
                                                    <td>
                                                        <?php if($od->status=='operation'): ?>
                                                            <span class="badge-custom badge-activated"><?php echo e(trans('front.'.$od->status)); ?></span>
                                                        <?php elseif($od->status=='done'): ?>
                                                            <span class="badge-custom badge-comppleted"><?php echo e(trans('front.'.$od->status)); ?></span>
                                                        <?php else: ?>
                                                            <span class="badge-custom badge-pending"><?php echo e(trans('front.'.$od->status)); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo e(url('user/orders/'.$od->id.'/'.$od->order_number)); ?>" class="save-ads-data"><i class="far fa-eye"></i></a>
                                                    </td>
                                                </tr> <!-- order detail end -->
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end">
                                            <nav aria-label="Page navigation" class="mr-3">
                                                <ul class="pagination">
                                                    <?php echo e($done->links()); ?>

                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-ads-summary tab-pane fade in active" role="tabpanel" id="Shipped">

                                <div class="myads-data">
                                    <div class="myads-data">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead class="order-text-123">
                                                <tr>
                                                    <th scope="col"><?php echo e(trans('front.order_number')); ?></th>
                                                    <th scope="col"><?php echo e(trans('front.product')); ?></th>
                                                    <th scope="col"><?php echo e(trans('orbscope.price')); ?></th>
                                                    <th scope="col"><?php echo e(trans('orbscope.date')); ?></th>
                                                    <th scope="col"><?php echo e(trans('orbscope.status')); ?></th>
                                                    <th scope="col"><?php echo e(trans('orbscope.show')); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $__currentLoopData = $canceled; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $od): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo e($od->order_number); ?>

                                                        </td>
                                                        <td>
                                                            <div class="media">
                                                                <img class="acc-avatar-image mr-2" src="<?php echo e(ShowImage(@$od->ad->main_image)); ?>">
                                                                <div class="media-body order-body-text">
                                                                    <h6 class="mt-0"><?php echo e(@$od->ad->title); ?></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <?php echo e($od->amount); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($od->created_at->format('Y-m-d')); ?>

                                                        </td>
                                                        <td>
                                                            <?php if($od->status=='operation'): ?>
                                                                <span class="badge-custom badge-activated"><?php echo e(trans('front.'.$od->status)); ?></span>
                                                            <?php elseif($od->status=='done'): ?>
                                                                <span class="badge-custom badge-comppleted"><?php echo e(trans('front.'.$od->status)); ?></span>
                                                            <?php else: ?>
                                                                <span class="badge-custom badge-pending"><?php echo e(trans('front.'.$od->status)); ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo e(url('user/orders/'.$od->id.'/'.$od->order_number)); ?>" class="save-ads-data"><i class="far fa-eye"></i></a>
                                                        </td>
                                                    </tr> <!-- order detail end -->
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-end">
                                                <nav aria-label="Page navigation" class="mr-3">
                                                    <ul class="pagination">
                                                        <?php echo e($canceled->links()); ?>

                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>