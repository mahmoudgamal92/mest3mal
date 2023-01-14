

@extends('front.layout.app')
@section('content')



<!-- breadcrumb -->
<nav aria-label="breadcrumb" class="breadcrumb-wrap">
    <div class="container">

        <ol class="breadcrumb bg-transparent">
            <li class="breadcrumb-item"><a href="#"></a></li>
            <li class="breadcrumb-item"><a href="#">{{trans('front.home')}}</a></li>
            <li class="breadcrumb-item"><a href="#">{{VarByLang(@$show->depart->name,GetLanguage())}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
        </ol>

    </div>
</nav>
<!-- single prodcut page -->
<div class="single-prodcut-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-12">
                @include('front.layout.messages')
                <div class="row">
                    <div class="col-lg-6">
                        @if ($show->images != null)
                        <div class="single-slider d-lg-flex">
                            <div class="main-container order-lg-2 mb-3">
                                <div class="slider slider-main">
                                    @foreach(explode('|', $show->images) as $key => $image)
                                    <div>
                                        <img src="{{ShowImage($image)}}">
                                    </div>
                                   @endforeach
                                </div>
                            </div>
                            <div class="nav-container mr-3 other-lg-1">
                                <div class="slider-nav">
                                    @foreach(explode('|', $show->images) as $key => $image)
                                        <div>
                                            <img src="{{ShowImage($image)}}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <h2 class="sinpro-title">
                           {{$show->title}}
                        </h2>
                        <div>
                            <span class="publish-date">{{$show->created_at->diffForHumans()}}</span>
                        </div>

                        <h2 class="prodcut-price mt-3 mb-3">{{$show->price}}
                            @if (Auth::check())
                                @if($show->user_id != auth()->id())
                                    @if( $show->status == 'active')
                            <a href="{{url('user/add/new/order/'.$show->id)}}" style="float: {{GetLanguage()=='ar'?'left':'right'}};color: white;font-size: initial;" class="custom-btn"> <i class="fa fa-shopping-cart"></i> {{trans('front.send_order_message')}}</a>
                                    @elseif($show->status == 'done')
                                        <span style="top: 0px;padding: 3px;" class="badge-custom badge-comppleted">{{trans('front.sold')}}</span>
                                    @endif

                                @endif
                            @else
                                <a type="button"  data-toggle="modal" data-target="#loginmodal"  style="float: {{GetLanguage()=='ar'?'left':'right'}};color: white;font-size: initial;" class="custom-btn"> <i class="fa fa-shopping-cart"></i> {{trans('front.send_order_message')}}</a>

                            @endif
                        </h2>





                        <div class="prodcut-attr table-responsive">
                            <table class="table table-striped sigle-prod-table">
                                <tbody>
                                <tr>
                                    <td class="attr-title">{{trans('orbscope.country')}}</td>
                                    <td class="attr-value">{{VarByLang(@$show->city->name,GetLanguage())}}</td>
                                    <td class="attr-title">{{trans('orbscope.city')}}</td>
                                    <td class="attr-value">{{VarByLang(@$show->state->name,GetLanguage())}}</td>
                                </tr>

                                <tr>
                                    @if(!empty($show->surface_area))
                                        <td class="attr-title">{{trans('front.surface_area')}}</td>
                                        <td class="attr-value">{{$show->surface_area}}</td>
                                    @endif
                                    @if(!empty($show->number_halls))
                                        <td class="attr-title">{{trans('front.number_halls')}}</td>
                                        <td class="attr-value">{{$show->number_halls}}</td>
                                    @endif
                                </tr>
                                <tr>
                                    @if(!empty($show->number_bathrooms))
                                        <td class="attr-title">{{trans('front.number_bathrooms')}}</td>
                                        <td class="attr-value">{{$show->number_bathrooms}}</td>
                                    @endif
                                    @if(!empty($show->bedrooms))
                                        <td class="attr-title">{{trans('front.Bedrooms')}}</td>
                                        <td class="attr-value">{{$show->bedrooms}}</td>
                                    @endif
                                </tr>
                                <tr>
                                    @if(!empty($show->age))
                                        <td class="attr-title">{{trans('front.age')}}</td>
                                        <td class="attr-value">{{$show->age}}</td>
                                    @endif
                                    @if(!empty($show->model))
                                        <td class="attr-title">{{trans('front.model')}}</td>
                                        <td class="attr-value">{{$show->model}}</td>
                                    @endif

                                </tr>
                                <tr>
                                    @if(!empty($show->car_type))
                                        <td class="attr-title">{{trans('front.Car_conditions')}}</td>
                                        <td class="attr-value">{{$show->car_type}}</td>
                                    @endif
                                    @if(!empty($show->car_gear))
                                        <td class="attr-title">{{trans('front.car_gear')}}</td>
                                        <td class="attr-value">{{trans('front.'.$show->car_gear)}}</td>
                                    @endif
                                </tr>
                                <tr class="attr-tags">
                                    @if(!empty($show->engine_type))
                                        <td class="attr-title">{{trans('front.engine_type')}}</td>
                                        <td class="attr-value">{{trans('front.'.$show->engine_type)}}</td>
                                    @endif
                                    @if(!empty($show->drive_system))
                                        <td class="attr-title">{{trans('front.drive_system')}}</td>
                                        <td class="attr-value">{{trans('front.'.$show->drive_system)}}</td>
                                    @endif
                                </tr>
                                <tr class="attr-tags">
                                    @if(!empty($show->seats_number))
                                        <td class="attr-title">{{trans('front.Number_seats')}}</td>
                                        <td class="attr-value">{{$show->seats_number}}</td>
                                    @endif
                                    @if(!empty($show->address))
                                        <td class="attr-title">{{trans('orbscope.address')}}</td>
                                        <td class="attr-value"><a target="_blank" href="{{$show->address}}">{{trans('orbscope.click_here')}}</a></td>
                                    @endif
                                </tr>
                                <tr class="attr-tags">
                                    @if(count(@$show->services)>0)
                                        <td class="attr-title">{{trans('orbscope.services')}}</td>
                                        <td class="attr-value">
                                            @foreach(@$show->services as $se)
                                                {{VarByLang(@$se->service_name->name,GetLanguage())}}
                                            @endforeach</td>
                                    @endif
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-12">
                        <h2 class="prodcut-titles">{{trans('orbscope.description')}}</h2>
                        <p class="desc-text">
                            {{$show->details}}
                        </p>
                        <!--
                        <div class="single-location">
                            <h4 class="loc-title">موقع الإعلانات</h4>
                            <p class="loc-name">الدمام ، الشرق</p>
                            <div class="map-wrapper">

                            </div>
                        </div>-->
                        <div class="prodcut-comment">


                            <div class="seller-social">
                            <p class="text-center">{{trans('front.Share_with_your_friend')}}</p>
                            <ul class="footer-social-2 text-center mb-0" style="display: inline-flex;
    margin-right: 40%;">


                                {!! Share::page(url('ad/'.$show->id.'/'.$show->title),$show->title)
                                          ->facebook()
                                          ->twitter()
                                          ->whatsapp()
                                          ->linkedin( $show->title )!!}

                                <div class="social-links">

                                <li><a  onclick="copyToClipboard('#p1')" id="p1" data-action="{{url()->current()}}" title="نسخ"><i class="fas fa-link"></i></a></li>
                                </div>
                            </ul>
                            </div>



                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                @if (Auth::check())
                    @if(Favorites($show->id)=='add')
                <a id="{{$show->id}}"  class="custom-btn btn-prodcut-fav d-block text-center mb-4 add_favorite" ><i class="far fa-heart mr-2"></i>
                    {{trans('front.add_to_favorites')}}</a>
                    @endif
                @else
                    <a href="{{url('/login')}}"  class="custom-btn btn-prodcut-fav d-block text-center mb-4" ><i class="far fa-heart mr-2"></i>
                        {{trans('front.add_to_favorites')}}</a>
                @endif

                <div class="seller-info-prod rounded p-3 mt-4">
                    <p class="text-center">{{trans('front.seller_information')}}</p>
                    <div class="media mb-3">
                        <div class="position-relative">
                            <img src="{{ShowImage(@$show->user->image)}}" class="mr-3 rounded-circle acc-avatar-image" alt="image">
                        </div>
                        <div class="media-body abdul-123">
                            <h6 class="mt-0 mb-0">{{@$show->user->name}} <span></span>
                            </h6>
                            <span class="font12">{{trans('front.member')}} {{@$show->user->created_at->diffForHumans()}}</span>

                        </div>
                    </div>
                    <div style="margin-{{GetLanguage()=='ar'?'right':'left'}}: 32px;" class="media mb-3 align-items-center">
                        {!! stars(user_rate($show->user_id)) !!}
                    </div>
                    <div class="media mb-3 align-items-center">
                        <i class="fas fa-phone-alt mr-2"></i>
                        <div class="media-body call_number">
                            <h6 class="mt-0 mb-0">{{@$show->user->phone}}</span>
                            </h6>

                        </div>

                    </div>

                <!--
                    <p class="abdul_gmail"><i class="fas fa-at"></i> عبدالرحمن@gmail.com</p>-->

                    <div class="seller-contact-btn">
                        @if (Auth::check())
                            @if(auth()->id()!=$show->user_id)
                        <a style="position: inherit;" class="custom-btn btn-prodcut-seller d-block text-center mb-2" href="{{url('/user/contact/'.@$show->user->id)}}">
                            {{trans('front.send_message')}}
                        </a>
                            @endif
                        @else
                            <a  style="position: inherit;" class="custom-btn btn-prodcut-seller d-block text-center mb-2" href="{{url('/login')}}">
                                {{trans('front.send_message')}}
                            </a>

                        @endif

                    </div>
                </div>
                    <!--
                <div class="seller-social p-3 mt-4 mb-3">
                    <p class="text-center">{{trans('front.Share_with_your_friend')}}</p>
                    <ul class="footer-social-2 text-center mb-0">



                    </ul>
                </div>-->
                <p class="seller-prod-id mb-0">{{trans('front.ad_number')}}: {{$show->ad_number}}</p>

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="related-ads-heading">
                    <h4>{{trans('front.related_ads')}}</h4>
                </div>
            </div>
        </div>
        <div>
            <div class="products_456 d-flex flex-wrap">

                    @foreach($related as $ad)
                        <div class="product-wrapper">
                            <div class="products_003"> <!-- start of grid product -->
                                <div class="featured-image-2" style="cursor: pointer;" onclick="window.location='{{url('/ad/'.$ad->id.'/'.str_replace(' ', '_', $ad->title))}}'">
                                    <img style="height: 125px;" src="{{ShowImage($ad->main_image)}}" alt="image">
                                </div>
                                <div class="featured_text-2">
                                    <ul class="price price_3">
                                        <li class="price_1">{{$ad->price}}</li>
                                        <li class="yesterday yesterday_3 text-right">{{$ad->created_at->diffForHumans()}}</li>
                                    </ul>
                                    <p style="cursor: pointer;" onclick="window.location='{{url('/ad/'.$ad->id.'/'.str_replace(' ', '_', $ad->title))}}'">{{$ad->title}}</p>
                                    <ul class="rating rating_3 d-flex justify-content-between">
                                        <li><i class="fa fa-user"></i>{{@$ad->user->name}}</li>
                                        <li  class="rating_list rating_list3 rating_4 text-right">
                                            {!! stars(user_rate($ad->user_id)) !!}
                                        </li>
                                    </ul>
                                    <p class="arabic_text"><i class="fas fa-map-marker-alt"></i>{{VarByLang(@$ad->city->name,GetLanguage())}} {{VarByLang(@$ad->state->name,GetLanguage())}}</p>
                                </div>
                            </div>
                        </div> <!-- prodcut close -->
                    @endforeach

            </div>
        </div>

    </div>
</div>



@endsection
@section('js')
    <script>

        $(document).on('click', '.add_favorite', function () {

            var ad_id = $(this).attr('id');
            $.ajax({
                url: '{{url('add_to_favorites/ajax')}}',
                dataType: 'html',
                type: 'post',
                data: {_token: '{{csrf_token()}}', ad_id: ad_id},
                beforeSend: function () {

                }, success: function (data) {
                    $(".add_favorite").remove();
                    // $('select[name="cat_id"]').val("{{old('cat_id')}}").select2();
                }
            });
        });

        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).attr('data-action')).select();
            document.execCommand("copy");
            $temp.remove();
        }

    </script>

@endsection