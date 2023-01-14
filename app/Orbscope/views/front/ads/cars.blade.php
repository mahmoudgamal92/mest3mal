
@extends('front.layout.app')
@section('css')
    <style type="text/css">
        .thumb-image{
            float:{{GetLanguage()=='ar'?'right':'left'}};width:100px;
            position:relative;
            padding:5px;
        }
    </style>
@endsection
@section('content')



    <div class="main-section bg-main post-add-bg">
        <div class="container container-post-add">
            <form method="post" action="{{url('user/store/car_ads')}}"  enctype="multipart/form-data">
                {{ csrf_field() }}
                @if(isset($cat))
                    <input name="Category" type="hidden" value="{{$cat->id}}">
                @elseif(isset($subcat))
                    <input name="subcat" type="hidden" value="{{$subcat->id}}">
                @endif
                <div class="custom-bg-pd mb-3 post-detail-wrap post-ads-content">
                    <h3 class="add-post-title">{{trans('orbscope.details')}} {{trans('front.ad')}}</h3>
                    <div class="post-detail-fields row">

                        <div class="form-group col-12 form-control-004">
                            <label for="AdTitle" class="field-heading">عنوان الاعلان</label>
                            <input type="text" value="{{old('title')}}" name="title" required class="form-control form-control-123" id="AdTitle" placeholder="اكتب العنوان هنا">
                        </div> <!-- title /-->
                        <div class="form-group col-12 form-control-004">
                            <label for="addescription" class="field-heading">وصف الإعلان</label>
                            <textarea class="form-control form-control-123" required name="details" id="addescription"  placeholder="اكتب الوصف هنا" rows="3">{{old('details')}}</textarea>
                        </div> <!-- title /-->




                        <div class="form-group col-lg-6">
                            <p class="field-heading">{{trans('front.Car_conditions')}}</p>
                            <div class="row m-0">
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" value="new" name="car_conditions" id="car_conditions">
                                    <label class="form-check-label" for="car_conditions">
                                         {{trans('front.new')}}
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" value="used" name="car_conditions" id="2car_conditions">
                                    <label class="form-check-label" for="2car_conditions">
                                         {{trans('front.used')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- bedrooms /-->
                        <div class="form-group col-lg-6">
                            <p class="field-heading">{{trans('front.car_gear')}}</p>
                            <div class="row m-0">
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" value="manual" name="car_gear" id="car_gear">
                                    <label class="form-check-label" for="car_gear">
                                        {{trans('front.manual')}}
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" value="automatic" name="car_gear" id="car_gear2">
                                    <label class="form-check-label" for="car_gear2">
                                        {{trans('front.automatic')}}
                                    </label>
                                </div>
                            </div>
                        </div> <!-- Amenities /-->

                        <div class="form-group col-lg-6">
                            <p class="field-heading">{{trans('front.engine_type')}}</p>
                            <div class="row m-0">
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" value="electricity" name="engine_type" id="1engine_type">
                                    <label class="form-check-label" for="1engine_type">
                                       {{trans('front.electricity')}}
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" value="petrol" name="engine_type" id="4engine_type">
                                    <label class="form-check-label" for="4engine_type">
                                       {{trans('front.petrol')}}
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" value="diesel" name="engine_type" id="2engine_type">
                                    <label class="form-check-label" for="2engine_type">
                                        {{trans('front.diesel')}}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <p class="field-heading">{{trans('front.drive_system')}}</p>
                            <div class="row m-0">
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" value="four_wheel" name="drive_system" id="four_wheel">
                                    <label class="form-check-label" for="four_wheel">
                                       {{trans('front.four_wheel')}}
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" value="front" name="drive_system" id="front">
                                    <label class="form-check-label" for="front">
                                       {{trans('front.front')}}
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" value="behind" name="drive_system" id="behind">
                                    <label class="form-check-label" for="behind">
                                        {{trans('front.behind')}}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <p class="field-heading">{{trans('front.Number_seats')}}</p>
                            <div class="form-group categories-sort">
                                <select name="seats" class="form-control w-100">
                                    <option value="">...</option>
                                    @for($x = 1; $x <= 6; $x++)
                                        <option value="{{$x}}">{{$x}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div> <!-- Age /-->

                        <div class="form-group col-lg-6">
                            <p class="field-heading">{{trans('front.model')}}</p>
                            <div class="form-group categories-sort">
                                <select required name="model" class="form-control w-100">
                                    <option value="">...</option>
                                    @for($x = 1990; $x <= 2022; $x++)
                                        <option value="{{$x}}">{{$x}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div> <!-- Age /-->



                        <div class="form-group col-lg-12 form-group-123">
                            <label class="field-heading" for="price">{{trans('orbscope.price')}}</label>
                            <div class="form-group categori d-flex">
                                <input  name="price" value="{{old('price')}}" required type="number" step="any" class="form-control flex-grow-1" placeholder="" id="price">
                                <select disabled  class="form-control">
                                    <option selected>{{trans('front.In_Saudi_Riyals')}}</option>
                                </select>
                            </div>
                        </div> <!-- Price /-->

                        <div class="form-group col-lg-4 form-group-123">
                            <div class="form-group categori">
                                <label class="field-heading" for="price">{{trans('orbscope.state')}}</label>
                                <select required id="country_id" name="country_id" class="form-control w-100">
                                    <option value="" selected>.....</option>
                                    @foreach(\App\Orbscope\Models\Country::where('status','active')->get() as $ca)
                                        <option value="{{$ca->id}}">{{VarByLang($ca->name,GetLanguage())}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> <!-- Country /-->
                        <div class="form-group col-lg-4 form-group-123 city_data">
                            <div class="form-group categori">
                                <label class="field-heading" for="price">{{trans('orbscope.city')}}</label>
                                <div class="form-group categories-sort">
                                    <select  required name="city_id" class="form-control w-100">
                                        <option value="" selected>.....</option>
                                    </select>
                                </div>
                            </div>
                        </div> <!-- Country /-->
                        <div class="form-group col-lg-4 form-group-123">
                            <div class="form-group categori">
                                <label for="AdTitle" class="field-heading">{{trans('orbscope.address_google')}}</label>
                                <input type="url" value="{{old('address')}}" required class="form-control form-control-123" name="address" id="AdTitle" placeholder="">
                            </div>
                        </div> <!-- address /-->


                    </div>
                </div> <!-- post detail section /-->




                <div class="custom-bg-pd mb-3 post-ads-content">
                    <h3 class="add-post-title">{{trans('orbscope.images')}}</h3>
                    <div class="form-group-info">
                        <div id="wrapper" style="margin-top: 20px;"><input id="fileUpload" required name="images[]" multiple="multiple" type="file"/>
                            <div id="image-holder" style="margin-bottom: 40px;"></div>
                        </div>
                    </div>
                </div> <!-- prodcut image  /-->





                <div class="custom-bg-pd mb-3 text-center post-ads-content">
                    <h3 class="add-post-title">جاهز للنشر؟</h3>
                    <button type="submit" class="btn custom-btn published-by-ads">انشر إعلاني</button>
                </div> <!--publish /-->
            </form>
        </div>
    </div>

@endsection
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>

        $(document).on('change', '#country_id', function () {
            var shop = $(this).val();
            $.ajax({
                url: '{{url('/country_ads/ajax')}}',
                dataType: 'html',
                type: 'post',
                data: {_token: '{{csrf_token()}}', shop: shop},
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

@endsection


