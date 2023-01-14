<option value="" selected=""><?php echo e(trans('orbscope.city')); ?></option>
<?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ci): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($ci->id); ?>"><?php echo e(VarByLang($ci->name,GetLanguage())); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>