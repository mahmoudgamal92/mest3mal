<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a  @if(url()->current()==url('/user/all_ads')) style="color: #0275d8" @endif  class="nav-link" href="{{url('user/all_ads')}}" >{{trans('front.all_ads')}}</a>
    </li>
    <li class="nav-item">
        <a @if(url()->current()==url('/user/ads_type/active')) style="color: #0275d8" @endif class="nav-link" href="{{url('user/ads_type/active')}}" >{{trans('front.active_ads')}}</a>
    </li>
    <li class="nav-item">
        <a @if(url()->current()==url('/user/ads_type/inactive')) style="color: #0275d8" @endif class="nav-link" href="{{url('user/ads_type/inactive')}}" >{{trans('front.inactive_ads')}}</a>
    </li>
    <li class="nav-item">
        <a @if(url()->current()==url('/user/ads_type/done')) style="color: #0275d8" @endif class="nav-link" href="{{url('user/ads_type/done')}}" >{{trans('front.done_ads')}}</a>
    </li>
</ul>