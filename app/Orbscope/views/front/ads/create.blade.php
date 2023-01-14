@extends('front.layout.app')
@section('style')

@endsection
@section('content')



    <div class="main-section bg-main category-bg">
        <div class="container container-category">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cate_heading">
                        <h3>{{trans('front.What_do_advertise')}}</h3>
                    </div>
                </div>
            </div>



            <div class="row">

                <div class="col-md-6  col-sml-6 category-wrapper custom-bg-nobd">
                    <h4>اختر الفئة</h4>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @foreach($departs as $key=>$dep)
                        <a style="padding: 3.5px;" class="nav-link {{$key==0?'active':''}}" id="v-pills-{{str_replace(' ', '_', VarByLang($dep->name,'en'))}}-tab" data-toggle="pill" href="#v-pills-{{$key}}sub" role="tab" aria-controls="v-pills-{{$key}}sub" aria-selected="true">
                            <img src="{{ShowImage($dep->image)}}" class="mr-4">
                            {{VarByLang($dep->name,GetLanguage())}}

                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 col-sml-6 mob-p-0">
                    <div class="tab-content sub-category-wrapper custom-bg-nobd">
                    <div class="tab-content" id="v-pills-tabContent">
                        @foreach($departs as $key=>$dep)
                        <div class="tab-pane fade {{$key==0?'active show':''}}" id="v-pills-{{$key}}sub" role="tabpanel" aria-labelledby="v-pills-{{$key}}sub-tab">
                            <h4>حدد الفئة الفرعية</h4>
                            <ul class="sub-cat-nav mb-0 " style="margin-top: 8px;">
                                @foreach($dep->category as $cats)
                                    <li class="nav-item"><a href="postad.html" class="d-block">
                                            {{VarByLang($cats->name,GetLanguage())}}
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        @endforeach
                    </div>
                    </div>
                </div>


            </div>

        </div>
    </div>

@endsection