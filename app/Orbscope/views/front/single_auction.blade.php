

@extends('front.layout.app')
@section('content')
    <style>
        #timer {
            font-size: 2.4em;
            font-weight: 400;
            color: #FC783F;
            display: inline-flex;
            padding: 10px
        }


        span {
            color: #40c6f1;
            display: block;
            font-size: .65em;
            font-weight: 400;
        }



    </style>



    <!-- breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-wrap">
        <div class="container">

            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="#"></a></li>
                <li class="breadcrumb-item"><a href="#">{{trans('front.home')}}</a></li>
                <li class="breadcrumb-item"><a href="#">{{trans('front.Auctions')}}</a></li>
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

                            <h2 class="prodcut-price mt-3 mb-3">{{trans('front.number_offers')}} : {{@$show->offers->count()}}</h2>


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
                                        @if(!empty($show->address))
                                            <td class="attr-title">{{trans('orbscope.address')}}</td>
                                            <td class="attr-value">{{$show->address}}</td>
                                        @endif
                                    </tr>

                                    </tbody>
                                </table>

                            </div>
                            @if($show->status=='active')
                                <div  id="timer"></div>
                            @else
                                <h4 style="color: red;">{{trans('log.'.$show->status)}}</h4>
                            @endif
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


                                @if (Auth::check())
                               @if(check_offers($show->id)==0)
                               <form method="post" action="{{url('user/add_offer/'.$show->id)}}">
                                   {{ csrf_field() }}
                                   <div class="form-group">
                                       <input type="number" required name="amount" class="form-control" id="exampleFormControlTextarea1"  placeholder="{{trans('front.add_offers')}}">
                                   </div>
                                   <button type="submit" class="btn custom-btn w-150 submit-btn-123">{{trans('orbscope.add')}}</button>
                               </form>
                               @endif
                                @endif
                                <br/>
                                <h2 class="prodcut-titles">{{trans('front.offers')}}</h2>
                               <div class="pro-comment-list bg-light p-4 mt-4 mb-4">
                                   @foreach($offers as $of)
                                   <div class="media mb-3" style="background: aliceblue;padding: 10px;">
                                       <img src="{{ShowImage(@$of->user->image)}}" class="mr-3 rounded-circle acc-avatar-image" alt="...">
                                       <div class="media-body single-prod-body">
                                           <h6 class="mt-0">{{@$of->user->name}} <span>{{$of->created_at->diffForHumans()}}</span>
                                           </h6>
                                           <p><strong>{{trans('orbscope.amount_money')}} : {{$of->amount}} </strong></p>
                                           @if (Auth::check())
                                           @if(auth()->id()==$show->user_id)
                                           <a href="{{url('/user/contact/'.$of->user_id)}}" style="color: white;background-color: #34ACE0;" class="custom-btn  d-block text-center">تواصل مع صاحب العرض</a>
                                           @endif
                                           @endif
                                       </div>
                                   </div>
                                   @endforeach
                                   @if(count($offers)==0)

                                      {{trans('front.no_offers')}}
                                   @endif
                               </div>
                                {{ $offers->links() }}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">

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
                        <div class="media mb-3 align-items-center">
                            <i class="fas fa-phone-alt mr-2"></i>
                            <div class="media-body call_number">
                                <h6 class="mt-0 mb-0">{{@$show->user->phone}}
                                </h6>
                                <!--
                                <spsn class="font12">انقر لإظهار رقم الهاتف</spsn>-->
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
                    <div class="seller-social p-3 mt-4 mb-3">
                        <p class="text-center">{{trans('front.Share_with_your_friend')}}</p>
                        <ul class="footer-social-2 text-center mb-0">


                            {!! Share::page(url('ad/'.$show->id.'/'.$show->title),$show->title)
                                      ->facebook()
                                      ->twitter()

                                      ->linkedin( $show->title )!!}
                        </ul>
                    </div>
                    <p class="seller-prod-id mb-0">{{trans('front.auction_ID')}}: {{$show->auction_number}}</p>

                </div>
            </div>

        </div>
    </div>



@endsection
@section('js')
    <script>
        function updateTimer() {
            future  = Date.parse("{{$show->end_date}}");
            now     = new Date($.now());
            diff    = future - now;

            days  = Math.floor( diff / (1000*60*60*24) );
            hours = Math.floor( diff / (1000*60*60) );
            mins  = Math.floor( diff / (1000*60) );
            secs  = Math.floor( diff / 1000 );

            d = days;
            h = hours - days  * 24;
            m = mins  - hours * 60;
            s = secs  - mins  * 60;

            document.getElementById("timer")
                .innerHTML =
                '<div style="margin:10px;">' + d + '<br><span>{{trans('front.day')}}</span></div>' +
                '<div style="margin:10px;">' + h + '<br><span>{{trans('front.hour')}}</span></div>' +
                '<div style="margin:10px;">' + m + '<br><span>{{trans('front.minute')}}</span></div>' +
                '<div style="margin:10px;">' + s + '<br><span>{{trans('front.second')}}</span></div>' ;
        }
        setInterval('updateTimer()', 1000 );

    </script>

@endsection