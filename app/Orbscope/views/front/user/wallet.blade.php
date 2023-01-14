
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
                                <p class="ads-number mb-0">{{user_balance()}}</p>
                                <p class="ads-text mb-1">{{trans('front.balance')}}</p>
                            </div>

                            <div class="ads-wrap deactive-ads text-center">
                                <p class="ads-number mb-0 ads-number2">{{suspended_balance()}}</p>
                                <p class="ads-text mb-1 ads-text2">{{trans('front.suspended_balance')}}</p>
                            </div>
                        </div>
                        <div class="filter-ads-summary mt-5">
                            <div class="row">


                                <div class="col-md-4 text-right">
                                    <a href="{{url('/user/recharge')}}" class="btn submit-btn-radius">{{trans('front.recharge')}}</a>
                                </div>
                                <div class="col-md-4 text-right">
                                    <a href="{{url('/user/withdraw')}}" class="btn submit-btn-radius">{{trans('front.withdrawals')}}</a>
                                </div>
                            </div>

                            <div class="myads-data">
                                <div class="table-responsive">
                                    <table class="table table-striped accont-myads-table">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center;" scope="col">{{trans('front.operation_number')}}</th>
                                            <th style="text-align: center;" scope="col">{{trans('front.status')}}</th>
                                            <th style="text-align: center;" scope="col">{{trans('orbscope.description')}}</th>
                                            <th style="text-align: center;" scope="col">{{trans('orbscope.amount_money')}}</th>
                                            <th style="text-align: center;" scope="col">{{trans('orbscope.date')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                       @foreach($all as $a)
                                           @if(isset($a->amount))
                                       <tr>
                                           <td>{{$a->pay_number}}</td>
                                           <td>{{trans('orbscope.'.$a->status)}}</td>
                                           <td>{{trans('front.order_number')}} {{@$a->order->order_number}}</td>
                                           @if($a->reciver_id==auth()->id())
                                           <td>{{$a->net}}</td>
                                           @else
                                               <td>{{$a->amount}}</td>
                                           @endif
                                           <td>
                                           @if($a->time!=null)
                                               {{$a->updated_at->format('Y-m-d')}}
                                           @else
                                               {{$a->created_at->format('Y-m-d')}}
                                           @endif
                                           </td>
                                       </tr>
                                         @else
                                               <tr>
                                               <td>{{$a->pay_id}}</td>
                                               <td>{{trans('orbscope.'.$a->state)}}</td>
                                               <td>{{trans('front.recharge')}}</td>
                                               <td>{{$a->price}}</td>
                                               <td>{{$a->created_at->format('Y-m-d')}}</td>
                                               </tr>
                                         @endif
                                       @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <nav aria-label="Page navigation" class="mr-3">
                                    <ul class="pagination">

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
