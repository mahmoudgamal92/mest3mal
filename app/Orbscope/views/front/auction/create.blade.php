
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

    @include('front.layout.messages')

    <div class="main-section bg-main post-add-bg">
        <div class="container container-post-add">
            <form method="post" action="{{url('user/store/auction')}}"  enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="custom-bg-pd mb-3 post-detail-wrap post-ads-content">
                    <h3 class="add-post-title">{{trans('orbscope.add')}} {{trans('front.auction')}}</h3>
                    <div class="post-detail-fields row">

                        <div class="form-group col-12 form-control-004">
                            <label for="AdTitle" class="field-heading">{{trans('front.auction_title')}}  </label>
                            <input type="text" value="{{old('title')}}" name="title" required class="form-control form-control-123" id="AdTitle" placeholder="{{trans('front.auction_title')}}">
                        </div> <!-- title /-->
                        <div class="form-group col-12 form-control-004">
                            <label for="addescription" class="field-heading">{{trans('orbscope.details')}} </label>
                            <textarea class="form-control form-control-123" required name="details" id="addescription" placeholder="{{trans('front.product_details')}}" rows="3">{{old('details')}}</textarea>
                        </div> <!-- title /-->




                        <div class="form-group col-lg-12 form-group-123">
                            <label class="field-heading" for="price">{{trans('orbscope.duration')}}</label>
                            <div class="form-group categori d-flex">
                                <select  required  name="duration" class="form-control">
                                    <option  value="">{{trans('front.indays')}}</option>
                                    @for($x=1;$x<8;$x++)
                                        <option {{old('duration')==$x?'selected':''}} value="{{$x}}">{{$x}}</option>
                                    @endfor
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
                                <label for="AdTitle" class="field-heading">{{trans('orbscope.address')}}</label>
                                <input type="text" required value="{{old('address')}}" name="address" class="form-control form-control-123" id="AdTitle" placeholder="">
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
                    <h3 class="add-post-title">{{trans('front.ready_for_publish')}}</h3>
                    <button type="submit" class="btn custom-btn published-by-ads">{{trans('front.publich_auction')}}</button>
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


