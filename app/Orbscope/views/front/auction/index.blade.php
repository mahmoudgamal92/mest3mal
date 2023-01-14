
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
                        <div class="myads-wrapper d-flex">
                            <div class="ads-wrap active-ads mr-5 text-center">
                                <p class="ads-number mb-0">{{\App\Orbscope\Models\Auction::where('user_id',auth()->id())->where('status','active')->count()}}</p>
                                <p class="ads-text mb-1">{{trans('front.Your_active_acutions')}}</p>
                            </div>

                            <div class="ads-wrap  text-center">

                                    <a href="{{url('/user/add_auction')}}" class="btn submit-btn-radius">{{trans('orbscope.add')}} {{trans('front.auction')}}</a>

                            </div>
                        </div>
                        <div class="filter-ads-summary mt-5">
                            <div class="row">



                            </div>
                            <div class="myads-data">
                                <div class="table-responsive">
                                    <table class="table table-striped accont-myads-table">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center;" scope="col">{{trans('front.auction_ID')}}</th>
                                            <th style="text-align: center;" scope="col">{{trans('orbscope.title')}}</th>
                                            <th style="text-align: center;" scope="col">{{trans('orbscope.details')}}</th>
                                            <th style="text-align: center;" scope="col">{{trans('orbscope.end_date')}}</th>
                                            <th style="text-align: center;" scope="col">{{trans('front.action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                       @foreach($auctions as $ad)
                                        <tr>
                                            <td>{{$ad->auction_number}}</td>
                                            <td>{{$ad->title}}</td>
                                            <td>{{str_limit($ad->details,100)}}</td>
                                            <td>
                                                {{$ad->end_date}}
                                            </td>

                                            <td>

                                                <a href="{{url('/user/edit/auction/'.$ad->id)}}" class="save-ads-data">
                                                    <i class="fas fa-edit"></i>
</a>
                                                <br/>
                                                <a href="{{url('/auction/'.$ad->id.'/'.$ad->title)}}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <br/>
                                                <a onclick="return confirm('Are you sure you want to Delete?');" href="{{url('user/delete/auction/'.$ad->id)}}" class="remove-ads-data">
                                    <i class="fas fa-trash"></i>
</a>
                                            </td>
                                        </tr>
                                       @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <nav aria-label="Page navigation" class="mr-3">
                                    <ul class="pagination">
                                        {{ $auctions->links() }}
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