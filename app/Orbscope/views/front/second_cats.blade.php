@extends('front.layout.app')
@section('content')



    <!-- breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-wrap">
        <div class="container">

            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="#"></a></li>
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{trans('front.home')}}</a></li>
                @if(isset($state))
                <li class="breadcrumb-item">{{VarByLang($state->name,GetLanguage())}}</li>
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
                    @if(count($sub)>0)
                    @foreach($sub as $key=>$ca)
                        <div class="prodcut-search">
                            <p>
                                <a class="category-title d-flex justify-content-between"  data-toggle="collapse" href="#{{str_replace(' ', '_', VarByLang($ca->name,'en'))}}" role="button" aria-expanded="true" aria-controls="brand">
                                    {{VarByLang($ca->name,GetLanguage())}}
                                </a>
                            </p>

                                <div class="collapse {{$key==0?'show':''}}" id="{{str_replace(' ', '_', VarByLang($ca->name,'en'))}}">
                                    <div class="category-side-123">
                                        <ul class="categories-sort4">
                                            @foreach(\App\Orbscope\Models\Country::where('status','active')->get() as $ci)
                                                <li><a href="{{url('/state/'.$ci->id.'/category/'.$ca->id.'/'.VarByLang($ca->name,GetLanguage()))}}">{{VarByLang($ci->name,GetLanguage())}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                        </div> <!-- end of brand -->
                    @endforeach
                    @else
                        <div class="category-side-123">
                            <ul class="categories-sort4">
                                @foreach(\App\Orbscope\Models\Country::where('status','active')->get() as $ci)
                                    <li><a href="{{url('/state/'.$ci->id.'/category/'.$show->id)}}">{{VarByLang($ci->name,GetLanguage())}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div> <!-- end of product sidebar -->
                <div class="col-md-9 col-xl-10 products-cate-123">
                    <div class="filter-tags d-flex flex-wrap">
                        @foreach($sub as $cat)
                            <div class="form-check mb-2">
                                <label  onclick="window.location='{{url('/subCats/'.$cat->id.'/'.VarByLang($cat->name,GetLanguage()))}}'" class="form-check-label tags-label" for="tag1">
                                    {{VarByLang($cat->name,GetLanguage())}}
                                </label>
                            </div>
                        @endforeach

                    </div> <!-- end of filter tages-->

                    <div class="col-12 products-main list-grid-prodcuts">
                        <div class="products_456 d-flex flex-wrap">
                            @foreach($ads as $ad)
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
                        {{ $ads->links() }}
                    </div><!-- end col -->
                </div>
            </div>
        </div>
    </div>


@endsection