

<?php $__env->startSection('css'); ?>
    <style type="text/css">
        .thumb-image{
            float:<?php echo e(GetLanguage()=='ar'?'right':'left'); ?>;width:100px;
            position:relative;
            padding:5px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('front.layout.messages', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="main-section bg-main post-add-bg">
        <div class="container container-post-add">
            <form method="post" action="<?php echo e(url('user/update/auction/'.$edit->id)); ?>"  enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>


                <div class="custom-bg-pd mb-3 post-detail-wrap post-ads-content">
                    <h3 class="add-post-title"><?php echo e(trans('orbscope.edit')); ?> <?php echo e(trans('front.auction')); ?></h3>
                    <div class="post-detail-fields row">

                        <div class="form-group col-12 form-control-004">
                            <label for="AdTitle" class="field-heading"><?php echo e(trans('front.auction_title')); ?>  </label>
                            <input type="text" name="title" value="<?php echo e($edit->title); ?>" required class="form-control form-control-123" id="AdTitle" placeholder="<?php echo e(trans('front.auction_title')); ?>">
                        </div> <!-- title /-->
                        <div class="form-group col-12 form-control-004">
                            <label for="addescription" class="field-heading"><?php echo e(trans('orbscope.details')); ?> </label>
                            <textarea class="form-control form-control-123" required name="details" id="addescription" placeholder="<?php echo e(trans('front.product_details')); ?>" rows="3"><?php echo e($edit->details); ?></textarea>
                        </div> <!-- title /-->




                        <div class="form-group col-lg-12 form-group-123">
                            <label class="field-heading" for="price"><?php echo e(trans('orbscope.duration')); ?></label>
                            <div class="form-group categori d-flex">
                                <select  required  name="duration" class="form-control">
                                    <option  value=""><?php echo e(trans('front.indays')); ?></option>
                                    <?php for($x=1;$x<8;$x++): ?>
                                        <option <?php echo e($edit->duration==$x?'selected':''); ?> value="<?php echo e($x); ?>"><?php echo e($x); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div> <!-- Price /-->

                        <div class="form-group col-lg-4 form-group-123">
                            <div class="form-group categori">
                                <label class="field-heading" for="price"><?php echo e(trans('orbscope.state')); ?></label>
                                <select required id="country_id" name="country_id" class="form-control w-100">
                                    <option value="" selected>.....</option>
                                    <?php $__currentLoopData = \App\Orbscope\Models\Country::where('status','active')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option  <?php echo e($edit->state_id==$ca->id?'selected':''); ?> value="<?php echo e($ca->id); ?>"><?php echo e(VarByLang($ca->name,GetLanguage())); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div> <!-- Country /-->
                        <div class="form-group col-lg-4 form-group-123 city_data">
                            <div class="form-group categori">
                                <label class="field-heading" for="price"><?php echo e(trans('orbscope.city')); ?></label>
                                <div class="form-group categories-sort">
                                    <select  required name="city_id" class="form-control w-100">
                                        <?php $__currentLoopData = \App\Orbscope\Models\City::where('status','active')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e($edit->city_id==$ca->id?'selected':''); ?> value="<?php echo e($c->id); ?>" selected><?php echo e(VarByLang($c->name,GetLanguage())); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div> <!-- Country /-->
                        <div class="form-group col-lg-4 form-group-123">
                            <div class="form-group categori">
                                <label for="AdTitle" class="field-heading"><?php echo e(trans('orbscope.address')); ?></label>
                                <input type="text" value="<?php echo e($edit->address); ?>" name="address" class="form-control form-control-123" id="AdTitle" placeholder="">
                            </div>
                        </div> <!-- address /-->


                    </div>
                </div> <!-- post detail section /-->




                <div class="custom-bg-pd mb-3 post-ads-content">
                    <h3 class="add-post-title"><?php echo e(trans('orbscope.images')); ?></h3>
                    <div class="form-group-info">
                        <div id="wrapper" style="margin-top: 20px;"><input id="fileUpload" name="images[]" multiple="multiple" type="file"/>
                            <div id="image-holder" style="margin-bottom: 40px;"></div>
                        </div>
                    </div>
                </div> <!-- prodcut image  /-->





                <div class="custom-bg-pd mb-3 text-center post-ads-content">
                    <button type="submit" class="btn custom-btn published-by-ads"><?php echo e(trans('orbscope.edit')); ?></button>
                </div> <!--publish /-->
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>

        $(document).on('change', '#country_id', function () {
            var shop = $(this).val();
            $.ajax({
                url: '<?php echo e(url('/country_ads/ajax')); ?>',
                dataType: 'html',
                type: 'post',
                data: {_token: '<?php echo e(csrf_token()); ?>', shop: shop},
                beforeSend: function () {

                }, success: function (data) {
                    $('.city_data').html(data);

                }
            });
        });


        $(document).ready(function() {
            $("#fileUpload").on('change', function() {
                //Get count of selected files
                var countFiles = $(this)[0].files.length;
                var imgPath = $(this)[0].value;
                var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                var image_holder = $("#image-holder");
                image_holder.empty();
                if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                    if (typeof(FileReader) != "undefined") {
                        //loop for each file selected for uploaded.
                        for (var i = 0; i < countFiles; i++)
                        {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $("<img />", {
                                    "src": e.target.result,
                                    "class": "thumb-image"
                                }).appendTo(image_holder);
                            }
                            image_holder.show();
                            reader.readAsDataURL($(this)[0].files[i]);
                        }
                    } else {
                        alert("This browser does not support FileReader.");
                    }
                } else {
                    alert("Pls select only images");
                }
            });
        });


    </script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('front.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>