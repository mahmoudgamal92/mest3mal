
@extends('front.layout.app')
@section('content')


    <div class="main-section bg-main account-myads">
        @include('front.layout.messages')
        <div class="container">
            <div class="row align-items-start">
                @include('front.user.menu_side')
                <!-- account-sidebar/-->


                <div class="col-lg-9 col-md-9 col-12 account-content-wrapper">

                    <div class="account-content-wrap summery-content">

                        @include('front.ads.menu_ad_user')

                        <div class="myads-wrapper d-flex">
                            <!--
                            <div class="ads-wrap active-ads mr-5 text-center">
                                <p class="ads-number mb-0">3</p>
                                <p class="ads-text mb-1">{{trans('front.Your_active_ads')}}</p>
                            </div>

                            <div class="ads-wrap deactive-ads text-center">
                                <p class="ads-number mb-0 ads-number2">3</p>
                                <p class="ads-text mb-1 ads-text2">{{trans('front.Your_inactive_ads')}}</p>
                            </div>-->
                        </div>
                        <div class="filter-ads-summary mt-5">
                            <div class="row">


                                <div class="col-md-4 text-right pr-0 mr-n2 align-self-center">
                                    <a href="{{url('/user/add_ads')}}" class="btn submit-btn-radius">{{trans('orbscope.add')}} {{trans('front.ad')}}</a>
                                </div>
                            </div>
                            <div class="myads-data">
                                <div class="table-responsive">
                                    <table class="table table-striped accont-myads-table">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center;" scope="col">{{trans('front.Ads_ID')}}</th>
                                            <th style="text-align: center;" scope="col">{{trans('orbscope.title')}}</th>
                                            <th style="text-align: center;" scope="col">{{trans('orbscope.description')}}</th>
                                            <th style="text-align: center;" scope="col">{{trans('orbscope.price')}}</th>
                                            <th style="text-align: center;" scope="col">{{trans('front.action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                       @foreach($ads as $ad)
                                        <tr>
                                            <td>{{$ad->ad_number}}</td>
                                            <td>{{$ad->title}}</td>
                                            <td>{{str_limit($ad->details,100)}}</td>
                                            <td>
                                                {{$ad->price}}
                                            </td>
                                            @if($ad->status == 'active')
                                            <td>

                                                <a href="{{url('/user/edit/ad/'.$ad->id)}}" class="save-ads-data">
                                                    <i class="fas fa-edit"></i>
</a>
                                                <br/>
                                                <a href="{{url('/ad/'.$ad->id.'/'.$ad->title)}}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <br/>
                                                <a onclick="return confirm('Are you sure you want to Delete?');" href="{{url('user/delete/ad/'.$ad->id)}}" class="remove-ads-data">
                                    <i class="fas fa-trash"></i>
</a>
                                            </td>
                                            @elseif($ad->status == 'inactive')
                                               <td>
                                                   <a href="{{url('/user/activation_ads/'.$ad->id.'/active')}}" class="btn ">
                                                      {{trans('orbscope.make_active')}}
                                                   </a>
                                               </td>
                                            @else
                                                <td>
                                                <a href="{{url('/ad/'.$ad->id.'/'.$ad->title)}}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                </td>
                                            @endif
                                        </tr>
                                       @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <nav aria-label="Page navigation" class="mr-3">
                                    <ul class="pagination">
                                        {{ $ads->links() }}
                                    </ul>
                                </nav>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection