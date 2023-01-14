

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
                                <p class="ads-number mb-0"><?php echo e(user_balance()); ?></p>
                                <p class="ads-text mb-1"><?php echo e(trans('front.balance')); ?></p>
                            </div>

                            <div class="ads-wrap deactive-ads text-center">
                                <p class="ads-number mb-0 ads-number2"><?php echo e(suspended_balance()); ?></p>
                                <p class="ads-text mb-1 ads-text2"><?php echo e(trans('front.suspended_balance')); ?></p>
                            </div>
                        </div>
                        <div class="filter-ads-summary mt-5">
                            <div class="row">


                                <div class="col-md-4 text-right">
                                    <a href="<?php echo e(url('/user/recharge')); ?>" class="btn submit-btn-radius"><?php echo e(trans('front.recharge')); ?></a>
                                </div>
                                <div class="col-md-4 text-right">
                                    <a href="<?php echo e(url('/user/withdraw')); ?>" class="btn submit-btn-radius"><?php echo e(trans('front.withdrawals')); ?></a>
                                </div>
                            </div>

                            <div class="myads-data">
                                <div class="table-responsive">
                                    <table class="table table-striped accont-myads-table">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center;" scope="col"><?php echo e(trans('front.operation_number')); ?></th>
                                            <th style="text-align: center;" scope="col"><?php echo e(trans('front.status')); ?></th>
                                            <th style="text-align: center;" scope="col"><?php echo e(trans('orbscope.description')); ?></th>
                                            <th style="text-align: center;" scope="col"><?php echo e(trans('orbscope.amount_money')); ?></th>
                                            <th style="text-align: center;" scope="col"><?php echo e(trans('orbscope.date')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                       <?php $__currentLoopData = $all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           <?php if(isset($a->amount)): ?>
                                       <tr>
                                           <td><?php echo e($a->pay_number); ?></td>
                                           <td><?php echo e(trans('orbscope.'.$a->status)); ?></td>
                                           <td><?php echo e(trans('front.order_number')); ?> <?php echo e(@$a->order->order_number); ?></td>
                                           <?php if($a->reciver_id==auth()->id()): ?>
                                           <td><?php echo e($a->net); ?></td>
                                           <?php else: ?>
                                               <td><?php echo e($a->amount); ?></td>
                                           <?php endif; ?>
                                           <td>
                                           <?php if($a->time!=null): ?>
                                               <?php echo e($a->updated_at->format('Y-m-d')); ?>

                                           <?php else: ?>
                                               <?php echo e($a->created_at->format('Y-m-d')); ?>

                                           <?php endif; ?>
                                           </td>
                                       </tr>
                                         <?php else: ?>
                                               <tr>
                                               <td><?php echo e($a->pay_id); ?></td>
                                               <td><?php echo e(trans('orbscope.'.$a->state)); ?></td>
                                               <td><?php echo e(trans('front.recharge')); ?></td>
                                               <td><?php echo e($a->price); ?></td>
                                               <td><?php echo e($a->created_at->format('Y-m-d')); ?></td>
                                               </tr>
                                         <?php endif; ?>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <nav aria-label="Page navigation" class="mr-3">
                                    <ul class="pagination">

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