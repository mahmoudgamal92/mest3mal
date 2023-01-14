<option value="" selected><?php echo e(trans('orbscope.category')); ?> </option>
<?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($c->id); ?>"><?php echo e(VarByLang($c->name,GetLanguage())); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<script>


</script>