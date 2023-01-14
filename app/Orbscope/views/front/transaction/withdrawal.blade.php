
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
                        <h3 style="margin-bottom: 10px;">{{$title}}</h3>
                        <div class="myads-wrapper d-flex">

                            <div class="ads-wrap active-ads mr-5 text-center">
                                <p class="ads-number mb-0">{{user_balance()}}</p>
                                <p class="ads-text mb-1">{{trans('front.balance')}}</p>
                            </div>
                        </div>
                        <div class="filter-ads-summary mt-5">
                            <div class="row">

                                @if(user_balance()>0)
                                <div class="col-md-4 text-right">
                                    <a href="{{url('/user/balance/withdrawal')}}" class="btn submit-btn-radius">{{trans('front.Balance_withdrawal')}}</a>
                                </div>
                                @endif

                            </div>

                            <div class="myads-data">
                                <div class="table-responsive">
                                    <table class="table table-striped accont-myads-table">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center;" scope="col">{{trans('front.transaction_id')}}</th>
                                            <th style="text-align: center;" scope="col">{{trans('front.status')}}</th>
                                            <th style="text-align: center;" scope="col">{{trans('orbscope.amount_money')}}</th>
                                            <th style="text-align: center;" scope="col">{{trans('orbscope.date')}}</th>
                                            <th style="text-align: center;" scope="col">{{trans('orbscope.show')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($with as $a)
                                                <tr>
                                                    <td>{{$a->transaction_id}}</td>
                                                    <td>{{trans('orbscope.'.$a->status)}}</td>
                                                    <td>{{$a->amount}}</td>
                                                    <td>{{$a->created_at->format('Y-m-d')}}</td>
                                                    <td><a href="{{url('/user/withdraw/'.$a->id.'/'.$a->transaction_id)}}">
                                                            <i class="fas fa-eye"></i>
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
