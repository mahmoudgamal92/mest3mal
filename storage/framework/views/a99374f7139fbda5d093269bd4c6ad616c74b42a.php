<div class="form-group categori">
    <label class="field-heading" for="city_id"><?php echo e(trans('orbscope.city')); ?></label>
    <div class="form-group categories-sort">
        <select name="city_id" class="form-control w-100" required>
            <?php $__currentLoopData = $city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($c->id); ?>" ><?php echo e(VarByLang($c->name,GetLanguage())); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>