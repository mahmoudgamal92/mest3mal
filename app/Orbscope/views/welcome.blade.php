
@extends('front.layout.app')
@section('style')

@endsection
@section('content')



<div class="main-section bg-main post-add-bg">
    <div class="container container-post-add">
        <form method="post" action="{{url('user/store/real/state_add')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="Category" type="hidden" value="1">
            <div class="custom-bg-pd mb-3 post-detail-wrap post-ads-content">
                <h3 class="add-post-title">{{trans('orbscope.details')}} {{trans('front.ad')}}</h3>
                <div class="post-detail-fields row">

                    <div class="form-group col-12 form-control-004">
                        <label for="AdTitle" class="field-heading">عنوان الاعلان</label>
                        <input type="text" class="form-control form-control-123" id="AdTitle" placeholder="اكتب العنوان هنا">
                    </div> <!-- title /-->
                    <div class="form-group col-12 form-control-004">
                        <label for="addescription" class="field-heading">وصف الإعلان</label>
                        <textarea class="form-control form-control-123" id="addescription" placeholder="اكتب الوصف هنا" rows="3"></textarea>
                    </div> <!-- title /-->




                    <div class="form-group col-lg-6">
                        <p class="field-heading">{{trans('front.number_rooms')}}</p>
                        <div class="row m-0">
                            <div class="form-check col-sm-6 col-12 custom-check">
                                <input class="form-check-input" type="radio" value="1" name="bedrooms" id="1Bedroom">
                                <label class="form-check-label" for="1Bedroom">
                                    1  {{trans('front.Bedrooms')}}
                                </label>
                            </div>
                            <div class="form-check col-sm-6 col-12 custom-check">
                                <input class="form-check-input" type="radio" value="4" name="bedrooms" id="4Bedroom">
                                <label class="form-check-label" for="4Bedroom">
                                    4  {{trans('front.Bedrooms')}}
                                </label>
                            </div>
                            <div class="form-check col-sm-6 col-12 custom-check">
                                <input class="form-check-input" type="radio" value="2" name="bedrooms" id="2Bedroom">
                                <label class="form-check-label" for="2Bedroom">
                                    2  {{trans('front.Bedrooms')}}
                                </label>
                            </div>
                            <div class="form-check col-sm-6 col-12 custom-check">
                                <input class="form-check-input" type="radio" value="5" name="bedrooms" id="5Bedroom">
                                <label class="form-check-label" for="5Bedroom">
                                    5  {{trans('front.Bedrooms')}}
                                </label>
                            </div>
                            <div class="form-check col-sm-6 col-12 custom-check">
                                <input class="form-check-input" type="radio" value="3" name="bedrooms" id="3Bedroom">
                                <label class="form-check-label" for="3Bedroom">
                                    3  {{trans('front.Bedrooms')}}
                                </label>
                            </div>
                            <div class="form-check col-sm-6 col-12 custom-check">
                                <input class="form-check-input" type="radio" value="more_than" name="bedrooms" id="6plusbed">
                                <label class="form-check-label" for="6plusbed">
                                    5   {{trans('front.more_than')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- bedrooms /-->
                    <div class="form-group col-lg-6">
                        <p class="field-heading">{{trans('orbscope.services')}}</p>
                        <div class="row m-0">
                            @foreach(\App\Orbscope\Models\Service::where('status','active')->get() as $key=>$se)
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" name="service[]" type="checkbox"  id="{{$key}}servies">
                                    <label class="form-check-label" for="{{$key}}servies">
                                        {{VarByLang($se->name,GetLanguage())}}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                    </div> <!-- Amenities /-->

                    <div class="form-group col-lg-6">
                        <p class="field-heading">{{trans('front.number_halls')}}</p>
                        <div class="row m-0">
                            <div class="form-check col-sm-6 col-12 custom-check">
                                <input class="form-check-input" type="radio" value="1" name="number_halls" id="1number_halls">
                                <label class="form-check-label" for="1number_halls">
                                    1
                                </label>
                            </div>
                            <div class="form-check col-sm-6 col-12 custom-check">
                                <input class="form-check-input" type="radio" value="4" name="number_halls" id="4number_halls">
                                <label class="form-check-label" for="4number_halls">
                                    4
                                </label>
                            </div>
                            <div class="form-check col-sm-6 col-12 custom-check">
                                <input class="form-check-input" type="radio" value="2" name="number_halls" id="2number_halls">
                                <label class="form-check-label" for="2number_halls">
                                    2
                                </label>
                            </div>
                            <div class="form-check col-sm-6 col-12 custom-check">
                                <input class="form-check-input" type="radio" value="3" name="number_halls" id="3number_halls">
                                <label class="form-check-label" for="3number_halls">
                                    3
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-lg-6">
                        <p class="field-heading">{{trans('front.number_bathrooms')}}</p>
                        <div class="row m-0">
                            <div class="form-check col-sm-6 col-12 custom-check">
                                <input class="form-check-input" type="radio" value="1" name="number_bathrooms" id="1number_bathrooms">
                                <label class="form-check-label" for="1number_bathrooms">
                                    1
                                </label>
                            </div>
                            <div class="form-check col-sm-6 col-12 custom-check">
                                <input class="form-check-input" type="radio" value="4" name="number_bathrooms" id="4number_bathrooms">
                                <label class="form-check-label" for="4number_bathrooms">
                                    4
                                </label>
                            </div>
                            <div class="form-check col-sm-6 col-12 custom-check">
                                <input class="form-check-input" type="radio" value="2" name="number_bathrooms" id="2number_bathrooms">
                                <label class="form-check-label" for="2number_bathrooms">
                                    2
                                </label>
                            </div>
                            <div class="form-check col-sm-6 col-12 custom-check">
                                <input class="form-check-input" type="radio" value="3" name="number_bathrooms" id="3number_bathrooms">
                                <label class="form-check-label" for="3number_bathrooms">
                                    3
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-lg-6">
                        <p class="field-heading">{{trans('front.surface_area')}}</p>
                        <div class="form-group categories-sort d-flex">
                            <input name="surface_area" type="text" class="form-control" placeholder="" id="areavalue">
                            <select disabled id="surface-araa" class="form-control">
                                <option selected>{{trans('front.Square_meters')}}</option>
                            </select>
                        </div>
                    </div> <!-- surface area /-->

                    <div class="form-group col-lg-6">
                        <p class="field-heading">{{trans('front.age')}}</p>
                        <div class="form-group categories-sort">
                            <select name="age" class="form-control w-100">
                                <option value="">...</option>
                                @for($x = 0; $x <= 50; $x++)
                                    <option value="{{$x}}">{{$x}}</option>
                                @endfor
                            </select>
                        </div>
                    </div> <!-- Age /-->



                    <div class="form-group col-lg-12 form-group-123">
                        <label class="field-heading" for="price">{{trans('orbscope.price')}}</label>
                        <div class="form-group categori d-flex">
                            <input  name="price" required type="number" step="any" class="form-control flex-grow-1" placeholder="" id="price">
                            <select disabled  class="form-control">
                                <option selected>بالريال السعودي</option>
                            </select>
                        </div>
                    </div> <!-- Price /-->

                    <div class="form-group col-lg-4 form-group-123">
                        <div class="form-group categori">
                            <label class="field-heading" for="price">{{trans('orbscope.state')}}</label>
                            <select required id="country_id" class="form-control w-100">
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
                            <label for="AdTitle" class="field-heading">{{trans('orbscope.address')}}</label>
                            <input type="text" class="form-control form-control-123" id="AdTitle" placeholder="اكتب العنوان هنا">
                        </div>
                    </div> <!-- address /-->


                </div>
            </div> <!-- post detail section /-->
            <div class="custom-bg-pd mb-3 post-ads-content">
                <h3 class="add-post-title">صورة المنتج</h3>
                <div class="form-group-info">
                    <div class="avatar-upload">
                        <fieldset class="form-group">
                            <input type="file" onchange="showname()" id="pro-image" name="pro-image" style="display: none;" class="form-control" multiple>
                        </fieldset>
                        <div class="preview-images-zone">
                            <a href="javascript:void(0)" onclick="$('#pro-image').click()" class="upload-image"><img src="{{url('orbscope/front')}}/img/signs%20-icon.png"></a>

                        </div>
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


</script>

@endsection


