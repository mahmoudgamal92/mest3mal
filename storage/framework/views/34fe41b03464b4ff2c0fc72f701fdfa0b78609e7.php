<a data-toggle="modal" data-target="#myModal<?php echo e($id); ?>" href="#" class="btn btn-danger"><?php echo e(trans('orbscope.delete')); ?></a>
<div class="modal fade" id="myModal<?php echo e($id); ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">x</button>
                <h4 class="modal-title"><?php echo e(trans('orbscope.delete')); ?> <?php echo e(VarByLang($name,GetLanguage())); ?> ! </h4>
            </div>
            <div class="modal-body">
                <?php echo e(trans('orbscope.ask-delete')); ?> : <?php echo e(VarByLang($name,GetLanguage())); ?>

            </div>
            <div class="modal-footer">
                <?php echo Form::open([
               'method' => 'DELETE',
               'route' => ['cities.destroy', $id]
               ]); ?>

                <?php echo Form::submit(trans('orbscope.approval'), ['class' => 'btn btn-danger']); ?>

                <a class="btn btn-default" data-dismiss="modal"><?php echo e(trans('orbscope.cancel')); ?></a>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>