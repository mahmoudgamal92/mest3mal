
<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(url('orbscope/admin')); ?>/datatables/dataTables.bootstrap<?php echo e(GetLangAdds()); ?>.css">
    <script src="<?php echo e(url('orbscope/admin/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(url('orbscope/admin/datatables/dataTables.bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(url('orbscope/admin/datatables/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(url('vendor/datatables/buttons.server-side.js')); ?>"></script>
    <div class='row'>
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark"><?php echo e($title); ?></span>
                    </div>
                </div>

                <div class="portlet-body">
                    <?php echo Form::open([
                       'method' => 'post',
                       'url' => [AdminPath().'/countries/multi_delete']
                       ]); ?>

                    <?php echo $dataTable->table(['class'=> 'table table-striped table-bordered table-hover'],true); ?>

                </div>
            </div>
        </div>
        <script>

            $(document).on('click', '.createBtn', function() {
                window.location = "countries/create";
            });
            $(document).on('click', '.uploadBtn', function() {
                window.location = "countries/upload";
            });
            $(document).on('click', '.deleteBtn', function() {
                $('#multi_delete').modal('show');
                var number_checkbox = $(".selected_data").filter(":checked").length;
                $('#count').html(number_checkbox);
                if(number_checkbox > 0){
                    $('.delete_done').show();
                    $('.check_delete').hide();
                }else{
                    $('.delete_done').hide();
                    $('.check_delete').show();
                }
            });
        </script>

        <div class="modal fade" id="multi_delete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">x</button>
                        <h4 class="modal-title"><?php echo e(trans('orbscope.delete')); ?> </h4>
                    </div>
                    <div class="modal-body">
                       <div class="delete_done"> <?php echo e(trans('orbscope.ask-delete')); ?> <span id="count"></span> <?php echo e(trans('orbscope.record')); ?> ! </div>
                        <div class="check_delete"><?php echo e(trans('orbscope.check-delete')); ?></div>
                    </div>
                    <div class="modal-footer">

                        <?php echo Form::submit(trans('orbscope.approval'), ['class' => 'btn btn-danger delete_done']); ?>

                        <a class="btn btn-default" data-dismiss="modal"><?php echo e(trans('orbscope.cancel')); ?></a>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php echo $dataTable->scripts(); ?>

    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>



<?php echo $__env->make(AdminCore(), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>