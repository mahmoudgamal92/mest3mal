

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
        <div class="container">
            <div class="row align-items-start">
            <?php echo $__env->make('front.user.menu_side', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- account-sidebar/-->


                <div class="col-lg-9 col-md-9 col-12 account-content-wrapper">

                    <div class="account-content-wrap summery-content">


            <form method="post" action="<?php echo e(url('user/update/ads/'.$edit->id)); ?>"  enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>


                <div class="custom-bg-pd mb-3 post-detail-wrap post-ads-content">
                    <h3 class="add-post-title"><?php echo e(trans('orbscope.edit')); ?> <?php echo e($edit->title); ?></h3>
                    <div class="post-detail-fields row">

                        <div class="form-group col-12 form-control-004">
                            <label for="AdTitle" class="field-heading">عنوان الاعلان</label>
                            <input type="text" value="<?php echo e($edit->title); ?>" name="title" required class="form-control form-control-123" id="AdTitle" placeholder="اكتب العنوان هنا">
                        </div> <!-- title /-->

                        <div class="form-group col-12 form-control-004">
                            <label for="addescription" class="field-heading">وصف الإعلان</label>
                            <textarea class="form-control form-control-123" required name="details" id="addescription" placeholder="اكتب الوصف هنا" rows="3"><?php echo e($edit->details); ?></textarea>
                        </div> <!-- title /-->

                        <?php if(@$edit->category->type=='cars'): ?>
                            <input type="hidden" name="cars" value="real">

                        <div class="form-group col-lg-6">
                            <p class="field-heading"><?php echo e(trans('front.Car_conditions')); ?></p>
                            <div class="row m-0">
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" value="new" <?php echo e($edit->car_type=='new'?'checked':''); ?> name="car_conditions" id="car_conditions">
                                    <label class="form-check-label" for="car_conditions">
                                        <?php echo e(trans('front.new')); ?>

                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" value="used" <?php echo e($edit->car_type=='used'?'checked':''); ?> name="car_conditions" id="2car_conditions">
                                    <label class="form-check-label" for="2car_conditions">
                                        <?php echo e(trans('front.used')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- bedrooms /-->
                        <div class="form-group col-lg-6">
                            <p class="field-heading"><?php echo e(trans('front.car_gear')); ?></p>
                            <div class="row m-0">
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" <?php echo e($edit->car_gear=='manual'?'checked':''); ?> value="manual" name="car_gear" id="car_gear">
                                    <label class="form-check-label" for="car_gear">
                                        <?php echo e(trans('front.manual')); ?>

                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" <?php echo e($edit->car_gear=='automatic'?'checked':''); ?> value="automatic" name="car_gear" id="car_gear2">
                                    <label class="form-check-label" for="car_gear2">
                                        <?php echo e(trans('front.automatic')); ?>

                                    </label>
                                </div>
                            </div>
                        </div> <!-- Amenities /-->

                        <div class="form-group col-lg-6">
                            <p class="field-heading"><?php echo e(trans('front.engine_type')); ?></p>
                            <div class="row m-0">
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio"  <?php echo e($edit->engine_type=='electricity'?'checked':''); ?> value="electricity" name="engine_type" id="1engine_type">
                                    <label class="form-check-label" for="1engine_type">
                                        <?php echo e(trans('front.electricity')); ?>

                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" <?php echo e($edit->engine_type=='petrol'?'checked':''); ?> value="petrol" name="engine_type" id="4engine_type">
                                    <label class="form-check-label" for="4engine_type">
                                        <?php echo e(trans('front.petrol')); ?>

                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" <?php echo e($edit->engine_type=='diesel'?'checked':''); ?> value="diesel" name="engine_type" id="2engine_type">
                                    <label class="form-check-label" for="2engine_type">
                                        <?php echo e(trans('front.diesel')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <p class="field-heading"><?php echo e(trans('front.drive_system')); ?></p>
                            <div class="row m-0">
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" value="four_wheel" <?php echo e($edit->drive_system=='four_wheel'?'checked':''); ?> name="drive_system" id="four_wheel">
                                    <label class="form-check-label" for="four_wheel">
                                        <?php echo e(trans('front.four_wheel')); ?>

                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" value="front" <?php echo e($edit->drive_system=='front'?'checked':''); ?> name="drive_system" id="front">
                                    <label class="form-check-label" for="front">
                                        <?php echo e(trans('front.front')); ?>

                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" value="behind"  <?php echo e($edit->drive_system=='behind'?'checked':''); ?> name="drive_system" id="behind">
                                    <label class="form-check-label" for="behind">
                                        <?php echo e(trans('front.behind')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <p class="field-heading"><?php echo e(trans('front.Number_seats')); ?></p>
                            <div class="form-group categories-sort">
                                <select name="seats" class="form-control w-100">
                                    <option value="">...</option>
                                    <?php for($x = 1; $x <= 6; $x++): ?>
                                        <option <?php echo e($edit->seats_number == $x ? 'selected':''); ?> value="<?php echo e($x); ?>"><?php echo e($x); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div> <!-- Age /-->

                        <div class="form-group col-lg-6">
                            <p class="field-heading"><?php echo e(trans('front.model')); ?></p>
                            <div class="form-group categories-sort">
                                <select required name="model" class="form-control w-100">
                                    <option value="">...</option>
                                    <?php for($x = 1990; $x <= 2022; $x++): ?>
                                        <option <?php echo e($edit->model==$x?'selected':''); ?> value="<?php echo e($x); ?>"><?php echo e($x); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div> <!-- Age /-->
                        <?php endif; ?>
                        <?php if(@$edit->category->type=='realtstate'): ?>
                            <input type="hidden" name="realtstate" value="real">


                            <div class="form-group col-lg-6">
                                <p class="field-heading"><?php echo e(trans('front.number_rooms')); ?></p>
                                <div class="row m-0">
                                    <div class="form-check col-sm-6 col-12 custom-check">
                                        <input class="form-check-input" type="radio" <?php echo e($edit->bedrooms==1?'checked':''); ?> value="1" name="bedrooms" id="1Bedroom">
                                        <label class="form-check-label" for="1Bedroom">
                                            1  <?php echo e(trans('front.Bedrooms')); ?>

                                        </label>
                                    </div>
                                    <div class="form-check col-sm-6 col-12 custom-check">
                                        <input class="form-check-input" type="radio" value="4" <?php echo e($edit->bedrooms==4?'checked':''); ?> name="bedrooms" id="4Bedroom">
                                        <label class="form-check-label" for="4Bedroom">
                                            4  <?php echo e(trans('front.Bedrooms')); ?>

                                        </label>
                                    </div>
                                    <div class="form-check col-sm-6 col-12 custom-check">
                                        <input class="form-check-input" type="radio" value="2" <?php echo e($edit->bedrooms==2?'checked':''); ?> name="bedrooms" id="2Bedroom">
                                        <label class="form-check-label" for="2Bedroom">
                                            2  <?php echo e(trans('front.Bedrooms')); ?>

                                        </label>
                                    </div>
                                    <div class="form-check col-sm-6 col-12 custom-check">
                                        <input class="form-check-input" type="radio" value="5" <?php echo e($edit->bedrooms==5?'checked':''); ?> name="bedrooms" id="5Bedroom">
                                        <label class="form-check-label" for="5Bedroom">
                                            5  <?php echo e(trans('front.Bedrooms')); ?>

                                        </label>
                                    </div>
                                    <div class="form-check col-sm-6 col-12 custom-check">
                                        <input class="form-check-input" type="radio" value="3" <?php echo e($edit->bedrooms==3?'checked':''); ?> name="bedrooms" id="3Bedroom">
                                        <label class="form-check-label" for="3Bedroom">
                                            3  <?php echo e(trans('front.Bedrooms')); ?>

                                        </label>
                                    </div>
                                    <div class="form-check col-sm-6 col-12 custom-check">
                                        <input class="form-check-input" type="radio" value="more_than" <?php echo e($edit->bedrooms=='more_than'?'checked':''); ?> name="bedrooms" id="6plusbed">
                                        <label class="form-check-label" for="6plusbed">
                                            5   <?php echo e(trans('front.more_than')); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- bedrooms /-->
                            <div class="form-group col-lg-6">
                                <p class="field-heading"><?php echo e(trans('orbscope.services')); ?></p>
                                <div class="row m-0">
                                    <?php $__currentLoopData = \App\Orbscope\Models\Service::where('status','active')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$se): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-check col-sm-6 col-12 custom-check">
                                            <input class="form-check-input" name="service[]" type="checkbox" <?php $__currentLoopData = @$edit->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serve): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <?php echo e($serve['service_id'] == $se->id?'checked':''); ?>   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="<?php echo e($se->id); ?>" id="<?php echo e($key); ?>servies">
                                            <label class="form-check-label" for="<?php echo e($key); ?>servies">
                                                <?php echo e(VarByLang($se->name,GetLanguage())); ?>

                                            </label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>
                            </div> <!-- Amenities /-->

                            <div class="form-group col-lg-6">
                                <p class="field-heading"><?php echo e(trans('front.number_halls')); ?></p>
                                <div class="row m-0">
                                    <div class="form-check col-sm-6 col-12 custom-check">
                                        <input class="form-check-input" type="radio" value="1" <?php echo e($edit->number_halls==1?'checked':''); ?> name="number_halls" id="1number_halls">
                                        <label class="form-check-label" for="1number_halls">
                                            1
                                        </label>
                                    </div>
                                    <div class="form-check col-sm-6 col-12 custom-check">
                                        <input class="form-check-input" type="radio" value="4" <?php echo e($edit->number_halls==4?'checked':''); ?> name="number_halls" id="4number_halls">
                                        <label class="form-check-label" for="4number_halls">
                                            4
                                        </label>
                                    </div>
                                    <div class="form-check col-sm-6 col-12 custom-check">
                                        <input class="form-check-input" type="radio" value="2"  <?php echo e($edit->number_halls==2?'checked':''); ?> name="number_halls" id="2number_halls">
                                        <label class="form-check-label" for="2number_halls">
                                            2
                                        </label>
                                    </div>
                                    <div class="form-check col-sm-6 col-12 custom-check">
                                        <input class="form-check-input" type="radio" value="3" <?php echo e($edit->number_halls==3?'checked':''); ?> name="number_halls" id="3number_halls">
                                        <label class="form-check-label" for="3number_halls">
                                            3
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-lg-6">
                                <p class="field-heading"><?php echo e(trans('front.number_bathrooms')); ?></p>
                                <div class="row m-0">
                                    <div class="form-check col-sm-6 col-12 custom-check">
                                        <input class="form-check-input" type="radio" value="1" <?php echo e($edit->number_bathrooms==1?'checked':''); ?> name="number_bathrooms" id="1number_bathrooms">
                                        <label class="form-check-label" for="1number_bathrooms">
                                            1
                                        </label>
                                    </div>
                                    <div class="form-check col-sm-6 col-12 custom-check">
                                        <input class="form-check-input" type="radio" value="4" <?php echo e($edit->number_bathrooms==4?'checked':''); ?>  name="number_bathrooms" id="4number_bathrooms">
                                        <label class="form-check-label" for="4number_bathrooms">
                                            4
                                        </label>
                                    </div>
                                    <div class="form-check col-sm-6 col-12 custom-check">
                                        <input class="form-check-input" type="radio" value="2" <?php echo e($edit->number_bathrooms==2?'checked':''); ?>  name="number_bathrooms" id="2number_bathrooms">
                                        <label class="form-check-label" for="2number_bathrooms">
                                            2
                                        </label>
                                    </div>
                                    <div class="form-check col-sm-6 col-12 custom-check">
                                        <input class="form-check-input" type="radio" value="3" <?php echo e($edit->number_bathrooms==3?'checked':''); ?>  name="number_bathrooms" id="3number_bathrooms">
                                        <label class="form-check-label" for="3number_bathrooms">
                                            3
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-lg-6">
                                <p class="field-heading"><?php echo e(trans('front.surface_area')); ?></p>
                                <div class="form-group categories-sort d-flex">
                                    <input name="surface_area" value="<?php echo e($edit->surface_area); ?>" type="number" class="form-control" placeholder="" id="areavalue">
                                    <select disabled id="surface-araa" class="form-control">
                                        <option selected><?php echo e(trans('front.Square_meters')); ?></option>
                                    </select>
                                </div>
                            </div> <!-- surface area /-->

                            <div class="form-group col-lg-6">
                                <p class="field-heading"><?php echo e(trans('front.age')); ?></p>
                                <div class="form-group categories-sort">
                                    <select name="age" class="form-control w-100">
                                        <option value="">...</option>
                                        <?php for($x = 0; $x <= 50; $x++): ?>
                                            <option <?php echo e($edit->age==$x?'selected':''); ?> value="<?php echo e($x); ?>"><?php echo e($x); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div> <!-- Age /-->


                        <?php endif; ?>


                        <div class="form-group col-lg-12 form-group-123">
                            <label class="field-heading" for="price"><?php echo e(trans('orbscope.price')); ?></label>
                            <div class="form-group categori d-flex">
                                <input  name="price" required type="number" value="<?php echo e($edit->price); ?>" step="any" class="form-control flex-grow-1" placeholder="" id="price">
                                <select disabled  class="form-control">
                                    <option selected><?php echo e(trans('front.In_Saudi_Riyals')); ?></option>
                                </select>
                            </div>
                        </div> <!-- Price /-->

                        <div class="form-group col-lg-4 form-group-123">
                            <div class="form-group categori">
                                <label class="field-heading" for="price"><?php echo e(trans('orbscope.state')); ?></label>
                                <select required id="country_id" name="country_id" class="form-control w-100">
                                    <option value="" selected>.....</option>
                                    <?php $__currentLoopData = \App\Orbscope\Models\Country::where('status','active')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e($edit->state_id==$ca->id?'selected':''); ?> value="<?php echo e($ca->id); ?>"><?php echo e(VarByLang($ca->name,GetLanguage())); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div> <!-- Country /-->
                        <div class="form-group col-lg-4 form-group-123 city_data">
                            <div class="form-group categori">
                                <label class="field-heading" for="price"><?php echo e(trans('orbscope.city')); ?></label>
                                <div class="form-group categories-sort">
                                    <select  required name="city_id" class="form-control w-100">
                                        <?php $__currentLoopData = \App\Orbscope\Models\City::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ci): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e($edit->city_id==$ci->id?'selected':''); ?> value="<?php echo e($ci->id); ?>" selected><?php echo e(VarByLang($ci->name,GetLanguage())); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div> <!-- Country /-->
                        <div class="form-group col-lg-4 form-group-123">
                            <div class="form-group categori">
                                <label for="AdTitle" class="field-heading"><?php echo e(trans('orbscope.address_google')); ?></label>
                                <input type="url" name="address" value="<?php echo e($edit->address); ?>" class="form-control form-control-123" id="AdTitle" placeholder="">
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
            </div>
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