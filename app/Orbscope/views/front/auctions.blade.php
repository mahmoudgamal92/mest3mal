@extends('front.layout.app')
@section('content')



    <!-- breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-wrap">
        <div class="container">

            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="#"></a></li>
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{trans('front.home')}}</a></li>
                @if(isset($state))
                    <li class="breadcrumb-item"><a href="#">{{VarByLang($state->name,GetLanguage())}}</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
            </ol>

        </div>
    </nav>
    <!--products page -->
    <div class="main-products pt-3 pb-5">
        <div class="container">
            <div class="row m-0">
                <div class="custom-bg-pd col-md-3 col-xl-2 left_side_009">

                        <div class="prodcut-search">


                                <div class="collapse show">
                                    <div class="category-side-123">
                                        <ul class="categories-sort4">
                                            @foreach(\App\Orbscope\Models\Country::where('status','active')->get() as $c)
                                            <li> <a href="{{url('auctions/state/'.$c->id.'/'.VarByLang($c->name,GetLanguage()))}}">{{VarByLang($c->name,GetLanguage())}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                        </div> <!-- end of brand -->

                </div> <!-- end of product sidebar -->
                <div class="col-md-9 col-xl-10 products-cate-123">


                    <div class="col-12 products-main list-grid-prodcuts">
                        <div class="products_456 d-flex flex-wrap">
                            @foreach($auctions as $ad)
                                <div class="product-wrapper">
                                    <div class="products_003"> <!-- start of grid product -->
                                        <div class="featured-image-2" style="cursor: pointer;" onclick="window.location='{{url('/auction/'.$ad->id.'/'.str_replace(' ', '_', $ad->title))}}'">
                                            <img style="height: 125px;" src="{{ShowImage($ad->main_image)}}" alt="image">
                                        </div>
                                        <div class="featured_text-2">
                                            <ul class="price price_3">
                                                <li class="price_1">{{trans('front.number_offers')}} : {{$ad->offers->count()}} </li>
                                                <li class="yesterday yesterday_3 text-right">{{$ad->created_at->diffForHumans()}}</li>
                                            </ul>
                                            <p style="cursor: pointer;" onclick="window.location='{{url('/auction/'.$ad->id.'/'.str_replace(' ', '_', $ad->title))}}'">{{$ad->title}}</p>
                                            <ul class="rating rating_3 d-flex justify-content-between">
                                                <li><i class="fa fa-user"></i>{{@$ad->user->name}}</li>
                                            </ul>
                                            <p class="arabic_text"><i class="fas fa-map-marker-alt"></i>{{VarByLang(@$ad->city->name,GetLanguage())}} {{VarByLang(@$ad->state->name,GetLanguage())}}</p>
                                        </div>
                                    </div>
                                </div> <!-- prodcut close -->
                            @endforeach

                        </div>
                        {{ $auctions->links() }}
                    </div><!-- end col -->
                </div>
            </div>
        </div>
    </div>


@endsection