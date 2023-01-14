@extends('front.layout.app')
@section('content')

    <section class="advertising">
        <div class="container">
            <div class="slider-home">
                <div>
                    <div class="row advertising-bg m-0">
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <div class="advetising-text">
                                <h4>{{VarByLang(GetSettings()->home_pageTitle,GetLanguage())}}</h4>
                                <p>{{VarByLang(GetSettings()->home_pageDesc,GetLanguage())}}</p>
                            </div>
                        </div><!-- end cols -->
                        <div class="col-md-4 col-sm-12 col-xs-12 position-relative">
                            <div class="advetising-img">
                                <img src="{{ShowImage(GetSettings()->home_image)}}" alt="image">
                            </div>
                        </div><!-- end cols -->
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="post-free">
                                @if (Auth::check())
                                <a href="{{url('/user/add_ads')}}" class="btn post-btn">{{trans('front.Post_an_ad')}}</a>
                                @else
                                    <a href="{{url('/login')}}" class="btn post-btn">{{trans('front.Post_an_ad')}}</a>
                                @endif
                            </div>
                        </div><!-- end cols -->
                    </div><!-- end row -->
                </div>
                <div>
                    <div class="row advertising-bg m-0">
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <div class="advetising-text">
                                <h4>{{VarByLang(GetSettings()->home_pageTitle,GetLanguage())}}</h4>
                                <p>{{VarByLang(GetSettings()->home_pageDesc,GetLanguage())}}</p>
                            </div>
                        </div><!-- end cols -->
                        <div class="col-md-4 col-sm-12 col-xs-12 position-relative">
                            <div class="advetising-img">
                                <img src="{{ShowImage(GetSettings()->home_image)}}" alt="image">
                            </div>
                        </div><!-- end cols -->
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="post-free">
                                @if (Auth::check())
                                    <a href="{{url('/user/add_ads')}}" class="btn post-btn">{{trans('front.Post_an_ad')}}</a>
                                @else
                                    <a href="{{url('/login')}}" class="btn post-btn">{{trans('front.Post_an_ad')}}</a>
                                @endif
                            </div>
                        </div><!-- end cols -->
                    </div><!-- end row -->
                </div>
            </div>
            <!-- browse by category -->
            @include('front.layout.messages')
            <div class="row">
                <div class="col-12">
                    <div class="category-heading">
                        <h5>{{trans('front.Browse_by_category')}}</h5>
                    </div>
                </div><!-- end cols -->
            </div><!-- end row -->
            <div class="row">
                <div class="col-12">

                    <div class="catgory_list">
                        @foreach($departs as $depart)
                        <div class="media media-1">
                            <img style="max-height: 48px;" src="{{ShowImage($depart->image)}}" class="align-self-start mr-3" alt="image">
                            <div class="media-body medai-body-1">
                                <h5 class="mt-0"><a href="{{url('main/'.$depart->id.'/'.str_replace(' ', '_', VarByLang($depart->name,GetLanguage())))}}">{{VarByLang($depart->name,GetLanguage())}}</a></h5>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div><!-- end col -->
            </div><!-- end row -->

            <!-- ads for members -->

            <div class="row">
                <div class="col-12">
                    <div class="featured_heading">
                        <h5><img src="{{url('orbscope/front')}}/img/Icon-stars.png" alt="image">{{trans('front.Latest_current_auctions')}}</h5>
                    </div>
                </div>
            </div><!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="featured_prod">
                        <ul>

                            <li class="featured-image-003"><div class="hello_123">
                                    <div>
                                        <div class="featured_text_001">

                                            <div>
                                                @if (Auth::check())
                                                <a href="{{url('user/add_auction')}}" class="btn btn-primary self_here_btn"><i class="fa fa-plus"></i>{{trans('front.Add_an_auction')}} </a>
                                                @else
                                                    <a  href="{{url('/login')}}" class="btn btn-primary self_here_btn"><i class="fa fa-plus"></i>{{trans('front.Add_an_auction')}} </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </li>
                           @foreach($auctions as $ac)
                            <li style="cursor: pointer;" onclick="window.location='{{url('auction/'.$ac->id.'/'.$ac->title)}}'"><div class="hello_123">
                                    <div class="featured-image">
                                        <img  style="height: 150px;cursor: pointer;" src="{{ShowImage($ac->main_image)}}" alt="image">
                                    </div>
                                    <div  class="featured_text">
                                        <h6 >{{$ac->title}}</h6>
                                        <h5>{{trans('front.number_offers')}} {{$ac->offers->count()}}</h5>
                                    </div>
                                </div>
                            </li>
                           @endforeach


                        </ul>

                    </div>
                </div>
            </div>

            <!-- ads for products -->



            <!-- recently products -->
            <div class="container">
                <div class="filters-products filter-products-123">
                    <div class="row align-items-center header-filter">
                        <form class="col-md-2 col-sm-12">
                            <div class="items_found">
                                <p><img src="{{url('orbscope/front')}}/img/Icon-history.png">{{trans('front.recently_added')}}</p>
                            </div>
                        </form>
                        <form class="col-md-12 col-sm-12 mb-3 recently-ads-search" method="get" action="{{url('/search')}}">
                            <div class="form-group categories-sort d-flex justify-content-center">
                                <input name="title" type="search" class="form-control" placeholder="{{trans('orbscope.search')}}">
                                <select name="depart_id" id="depart_select" class="form-control">
                                    <option value="" selected>{{trans('orbscope.department')}}</option>
                                    @foreach($departs as $de)
                                    <option value="{{$de->id}}">{{VarByLang($de->name,GetLanguage())}}</option>
                                    @endforeach
                                </select>
                                <select name="cat_id" id="categories" class="form-control">
                                    <option value="" selected>{{trans('orbscope.category')}} </option>
                                    <option>...</option>
                                </select>
                                <select name="state_id" id="states" class="form-control">
                                    <option value="" selected="">{{trans('orbscope.state')}}</option>
                                    @foreach(\App\Orbscope\Models\Country::where('status','active')->get() as $c)
                                    <option value="{{$c->id}}">{{VarByLang($c->name,GetLanguage())}}</option>
                                    @endforeach
                                </select>
                                <select name="city_id" id="cities" class="form-control downarrow">
                                    <option value="" selected="">{{trans('orbscope.city')}}</option>
                                    <option>...</option>
                                </select>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="row">

                    <div class="col-12 recently_home list-grid-prodcuts">
                        <div class="products_456 d-flex flex-wrap mini_ads" >

                            @foreach($ads as $ad)
                                <div class="product-wrapper">
                                    <div class="products_003"> <!-- start of grid product -->
                                        <div class="featured-image-2">
                                            <img  onclick="window.location='{{url('/ad/'.$ad->id.'/'.str_replace(' ', '_', $ad->title))}}'" style="height: 125px;cursor: pointer;" src="{{ShowImage($ad->main_image)}}" alt="image">
                                        </div>
                                        <div class="featured_text-2">
                                            <ul class="price price_3">
                                                <li class="price_1">{{$ad->price}}</li>
                                                <li class="yesterday yesterday_3 text-right">{{$ad->created_at->diffForHumans()}}</li>
                                            </ul>
                                            <p style="cursor: pointer;" onclick="window.location='{{url('/ad/'.$ad->id.'/'.str_replace(' ', '_', $ad->title))}}'">{{$ad->title}}</p>
                                            <ul class="rating rating_3 d-flex justify-content-between">
                                                <li><i class="fa fa-user"></i>{{@$ad->user->name}}</li>
                                                <li class="rating_list rating_list3 rating_4 text-right">
                                                    {!! stars(user_rate($ad->user_id)) !!}
                                                </li>
                                            </ul>
                                            <p class="arabic_text"><i class="fas fa-map-marker-alt"></i>{{VarByLang(@$ad->city->name,GetLanguage())}} {{VarByLang(@$ad->state->name,GetLanguage())}}</p>
                                        </div>
                                    </div>
                                </div> <!-- prodcut close -->
                            @endforeach

                        </div>
                    </div><!-- end col -->
                </div>
            </div>
        </div>

    </section><!-- end section -->
@endsection
@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
 <script>

     $(document).on('change', '#depart_select', function () {
         var shop = $(this).val();
         $.ajax({
             url: '{{url('/depart_main_page/ajax')}}',
             dataType: 'html',
             type: 'post',
             data: {_token: '{{csrf_token()}}', shop: shop},
             beforeSend: function () {

             }, success: function (data) {
                 $('#categories').html(data);

             }
         });
     });
     $(document).on('change', '#states', function () {
         var country_id = $(this).val();
         $.ajax({
             url: '{{url('/state_main_page/ajax')}}',
             dataType: 'html',
             type: 'post',
             data: {_token: '{{csrf_token()}}', country_id: country_id},
             beforeSend: function () {

             }, success: function (data) {
                 $('#cities').html(data);

             }
         });
     });
 </script>

@endsection