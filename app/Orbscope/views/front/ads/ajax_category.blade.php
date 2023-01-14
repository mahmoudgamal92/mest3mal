<div class="col-lg-12">
    <div class="cate_heading">
        <h3>{{trans('front.What_do_advertise')}}</h3>
        <h5 style="padding-bottom: 15px;">{{trans('front.chose_cat')}}</h5>
    </div>
</div>
        <div class="col-md-8 category-wrapper custom-bg-nobd">
            <ul class="cat-nav mb-0 nav nav-tabs d-block border-0">
                @foreach($cats as $depart)
                    <li class="nav-item">
                        <a href="{{url('user/select/category/'.$depart->id)}}" class="d-block position-relative"  >
                            <i class="fas fa-bars" aria-hidden="true"></i> {{VarByLang($depart->name,GetLanguage())}} </a>
                    </li>
                @endforeach

            </ul>
        </div>






