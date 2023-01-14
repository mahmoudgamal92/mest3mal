
<?php $__env->startSection('content'); ?>

    <div class='row'>
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark"><?php echo e($title); ?></span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="<?php echo e(url(AdminPath().'/countries/create')); ?>"
                           data-toggle="tooltip" title="<?php echo e(trans('orbscope.add')); ?>  <?php echo e(trans('orbscope.countries')); ?>">
                            <i class="fa fa-plus"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="<?php echo e(url(AdminPath().'/countries/'.$show->id.'/edit')); ?>"
                           data-toggle="tooltip" title="<?php echo e(trans('orbscope.edit')); ?>  <?php echo e(trans('orbscope.countries')); ?>">
                            <i class="fa fa-edit"></i>
                        </a>

                        <span data-toggle="tooltip" title="<?php echo e(trans('orbscope.delete')); ?>  <?php echo e(trans('orbscope.countries')); ?>">

                        <a data-toggle="modal" data-target="#myModal<?php echo e($show->id); ?>" class="btn btn-circle btn-icon-only btn-default" href="">
                        <i class="fa fa-trash"></i>
                        </a>
                        </span>


                        <div class="modal fade" id="myModal<?php echo e($show->id); ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button class="close" data-dismiss="modal">x</button>
                                        <h4 class="modal-title"><?php echo e(trans('orbscope.delete')); ?> <?php echo e(VarByLang($show->name,GetLanguage())); ?> !</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo e(trans('orbscope.ask-delete')); ?>  <?php echo e(VarByLang($show->name,GetLanguage())); ?> !
                                    </div>
                                    <div class="modal-footer">
                                        <?php echo Form::open([
                                       'method' => 'DELETE',
                                       'route' => ['countries.destroy', $show->id]
                                       ]); ?>

                                        <?php echo Form::submit(trans('orbscope.approval'), ['class' => 'btn btn-danger']); ?>

                                        <a class="btn btn-default" data-dismiss="modal"><?php echo e(trans('orbscope.cancel')); ?></a>
                                        <?php echo Form::close(); ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <a class="btn btn-circle btn-icon-only btn-default" href="<?php echo e(url(AdminPath().'/countries')); ?>"
                           data-toggle="tooltip" title="<?php echo e(trans('orbscope.show-all')); ?>   <?php echo e(trans('orbscope.countries')); ?>">
                            <i class="fa fa-list"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
                           data-original-title="<?php echo e(trans('orbscope.full-screen')); ?>"
                           title="<?php echo e(trans('orbscope.full-screen')); ?>">
                        </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="col-md-12">


                        <div class="row">

                            <br>
                            <div class="col-md-12">

                                <div class="col-md-6">
                                    <strong><?php echo e(trans('orbscope.ar-name')); ?> : </strong>
                                    <?php echo e(VarByLang($show->name,'ar')); ?>

                                    <br><hr>
                                </div>

                                <div class="col-md-6">
                                    <strong><?php echo e(trans('orbscope.en-name')); ?> : </strong>
                                    <?php echo e(VarByLang($show->name,'en')); ?>

                                    <br><hr>
                                </div>







                                <div class="col-md-6">
                                    <strong><?php echo e(trans('orbscope.status')); ?> : </strong>
                                    <?php echo e(trans('orbscope.'.$show->status)); ?>

                                    <br><hr>
                                </div>

                                <div class="col-md-6">
                                    <strong><?php echo e(trans('orbscope.show_website')); ?> : </strong>
                                    <?php echo e(trans('orbscope.'.$show->show_website)); ?>

                                    <br><hr>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-1"><strong><?php echo e(trans('orbscope.flag')); ?> : </strong></div>
                                    <div class="col-md-11">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">


                                        <div class="fileinput-new thumbnail" style="width: 200px; height: auto">
                                            <img src="<?php echo e(ShowImage($show->flag)); ?>" />
                                        </div>
                                    </div>
                                    </div>
                                    <br><hr>
                                </div>




                                <div class="clearfix"></div>


                            </div>



                        </div>


                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make(AdminCore(), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>