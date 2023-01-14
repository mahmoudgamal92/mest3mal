

<?php $__env->startSection('content'); ?>


    <div class="main-section bg-main account-myads">
        <?php echo $__env->make('front.layout.messages', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="container">
            <div class="row align-items-start">
            <?php echo $__env->make('front.user.menu_side', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- account-sidebar/-->


                <div class="col-lg-9 col-md-9 col-12 account-content-wrapper">
                    <div class="account-content-wrap summery-content">
                        <h3 style="margin-bottom: 10px;"><?php echo e($title); ?></h3>
                        <div class="myads-wrapper d-flex">

                            <div class="ads-wrap active-ads mr-5 text-center">
                                <p class="ads-number mb-0"><?php echo e(user_balance()); ?></p>
                                <p class="ads-text mb-1"><?php echo e(trans('front.balance')); ?></p>
                            </div>
                        </div>
                        <div class="filter-ads-summary mt-5">
                            <div class="row">

                                <?php if(user_balance()>0): ?>
                                <div class="col-md-4 text-right">
                                    <a href="<?php echo e(url('/user/balance/withdrawal')); ?>" class="btn submit-btn-radius"><?php echo e(trans('front.Balance_withdrawal')); ?></a>
                                </div>
                                <?php endif; ?>

                            </div>

                            <div class="myads-data">
                                <div class="table-responsive">
                                    <table class="table table-striped accont-myads-table">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center;" scope="col"><?php echo e(trans('front.transaction_id')); ?></th>
                                            <th style="text-align: center;" scope="col"><?php echo e(trans('front.status')); ?></th>
                                            <th style="text-align: center;" scope="col"><?php echo e(trans('orbscope.amount_money')); ?></th>
                                            <th style="text-align: center;" scope="col"><?php echo e(trans('orbscope.date')); ?></th>
                                            <th style="text-align: center;" scope="col"><?php echo e(trans('orbscope.show')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $with; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($a->transaction_id); ?></td>
                                                    <td><?php echo e(trans('orbscope.'.$a->status)); ?></td>
                                                    <td><?php echo e($a->amount); ?></td>
                                                    <td><?php echo e($a->created_at->format('Y-m-d')); ?></td>
                                                    <td><a href="<?php echo e(url('/user/withdraw/'.$a->id.'/'.$a->transaction_id)); ?>">
                                                            <i class="fas fa-eye"></i>
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