
@extends('front.layout.app')
@section('content')
    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .rate:not(:checked) > input {
            position:absolute;
            top:-9999px;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:25px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }
        .rating{

            color: #deb217 !important;
            cursor: none !important;
        }
        .fa-star{
            color: #eec207;
        }
        .emty_star{
            color: #bdb8b2db;
        }
    </style>


    <div class="main-section bg-main account-myads">
        @include('front.layout.messages')
        <div class="container">
            <div class="row align-items-start">
            @include('front.user.menu_side')
            <!-- account-sidebar/-->


                <div class="col-md-9 col-12 account-content-wrapper">
                    <div class="account-content-wrap account-profile2">
                        <div class="col-md-12">
                            <form class="account-info-form">
                                <h4 class="accheading">{{trans('front.order_number')}} {{$show->order_number}}</h4>
                                @if($show->status=='operation')
                                    @if(auth()->id()==$show->user_id)
                                        <div class="row form-group-info">
                                        <div class="col-md-6 order-md-2 avatar-upload text-center">

                                            <a href="{{url('user/order_received/'.$show->id)}}" style="cursor: pointer;" type="submit" class="submit-btn">{{trans('front.product_received')}}</a>
                                        </div>
                                        <div class="col-md-6 order-md-2 avatar-upload text-center">

                                            <a href="{{url('user/order_cancelled/'.$show->id)}}" type="submit" style="background-color: #d30000;cursor: pointer;" class="submit-btn">{{trans('front.cancelling_order')}}</a>
                                        </div>
                                        </div>
                                         @else
                                        <span class="badge-custom badge-delivered">{{trans('front.order_awaiting')}}</span>

                                    @endif
                                     @endif
                                    <div class="row form-group-info">



                                    <div class="row col-lg-9 col-12 order-md-1">
                                        <div class="form-group col-12 col-md-6 pr-md-0">
                                            <label for="username">{{trans('front.product')}} :  <a style="color: #0275d8;" href="{{url('ad/'.$show->ad_id.'/'.@$show->ad->title)}}">{{@$show->ad->title}}</a></label>
                                        </div>
                                        <div class="form-group col-12 col-md-6 pr-md-0">
                                            <label for="FullName">{{trans('orbscope.status')}} :

                                                @if($show->status=='operation')
                                                    <span style="top: 0px;" class="badge-custom badge-activated">{{trans('front.'.$show->status)}}</span>
                                                @elseif($show->status=='done')
                                                    <span style="top: 0px;" class="badge-custom badge-comppleted">{{trans('front.'.$show->status)}}</span>
                                                @else
                                                    <span style="top: 0px;" class="badge-custom badge-pending">{{trans('front.'.$show->status)}}</span>
                                                @endif
                                                
                                            </label>
                                        </div>
                                        <div class="form-group col-12 col-md-6 pr-md-0">
                                            <label for="username">{{trans('orbscope.price')}} :  {{$show->amount}}</label>
                                        </div>
                                        <div class="form-group col-12 col-md-6 pr-md-0">
                                            <label for="date">{{trans('orbscope.date')}} :  {{$show->created_at->format('Y-m-d')}}</label>
                                        </div>
                                        <div class="form-group col-12 col-md-6 pr-md-0">
                                            <label for="date">{{trans('front.seller')}} :  {{@$show->seller->name}} / {{@$show->seller->phone}}</label>
                                        </div>
                                        <div class="form-group col-12 col-md-6 pr-md-0">
                                            <label for="date">{{trans('front.buyer')}} :  {{@$show->owner->name}} / {{@$show->owner->phone}}</label>
                                        </div>

                                        <div class="form-group col-12 col-md-6 pr-md-0">
                                            <label for="date">{{trans('orbscope.address_google')}} :  <a href="{{@$show->ad->address}}" target="_blank" >{{trans('orbscope.click_here')}}</a></label>
                                        </div>
                                        <!--
                                        <div class="seller-contact-btn">

                                            <a style="position: inherit;" class="custom-btn btn-prodcut-seller d-block text-center mb-2" href="{{url('/user/contact/1')}}">{{trans('front.messages')}} <i class="far fa-envelope"></i></a>

                                        </div>-->
                                    </div>
                                </div>
                            </form>
                        </div>
                         @if($show->status=='done')
                        <div class="prodcut-comment">
                            <h2 class="prodcut-titles">{{trans('front.evaluation')}}</h2>
                            @if(empty($show->review))
                            <form method="post" action="{{url('user/add_review/'.$show->id)}}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <textarea class="form-control" required name="details" value="{{old('details')}}" id="exampleFormControlTextarea1" rows="1" placeholder="{{trans('front.write_comment')}}"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="rate" style="float:{{GetLanguage()=='ar'?'right':'left'}};">
                                        <input type="radio" id="star5" name="rate" value="5" />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" name="rate" value="4" />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" name="rate" value="3" />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" name="rate" value="2" />
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" name="rate" value="1" />
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                </div>
                                <button style="margin-top: 60px;" type="submit" class="btn custom-btn w-150 submit-btn-123">{{trans('orbscope.send')}}</button>
                            </form>
                            @else
                            <div class="pro-comment-list bg-light p-4 mt-4 mb-4" style="margin-bottom: -160px !important;">
                                <div class="media mb-3">
                                    <img src="{{ShowImage(@$show->review->owner->image)}}" class="mr-3 rounded-circle acc-avatar-image" alt="...">
                                    <div class="media-body single-prod-body">
                                        <h6 class="mt-0">{{@$show->review->owner->name}} <span>{{@$show->review->created_at->format('Y-M-d')}}</span>
                                        </h6>
                                        <p>
                                            {!! orderStars($show->review->rate)!!}

                                        </p>
                                        <p>{{@$show->review->details}}</p>
                                    </div>
                                </div> <!-- comeent -->

                            </div>
                            @endif
                        </div>
                        @endif

                        <div class="row mt-3 mb-5">
                            <div class="col-md-4">
                                <img src="{{url('orbscope/front')}}/img/multiply-men.png" alt="" class="w-100">
                            </div>
                            <div class="col-md-8">
                                <h4 class="accheading">ما هو العقد الالكتروني ؟</h4>
                                <p>يكون موقع مستعمل هو الضامن بين البائع والمشتري عن طريق طلب المنتج من خلال موقعنا</p>
                                <p>يتم عملية البيع والشراء من الموقع علي ان يكون الموقع هو الضامن للبائع والمشتري</p>
                                <p>الموقع هو مجرد وسيط بين البائع والمشتري</p>
                                <br/>
                                <h4 class="accheading">ما هي عمولة الموقع؟</h4>
                                <p>كما هو مذكور في البند رقم 4 من اتفاقية استخدام الموقع ، يحصل الموقع على عمولة بنسبة 3٪ من القيمة الكاملة</p>
                                <p>يرجي مقابلة المشتري او البائع بمكان عام</p>
                                <p>الموقع هو مجرد وسيط بين البائع والمشتري</p>


                                     </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
