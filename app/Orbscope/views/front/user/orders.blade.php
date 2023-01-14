
@extends('front.layout.app')
@section('content')


    <div class="main-section bg-main account-myads">
        @include('front.layout.messages')
        <div class="container">
            <div class="row align-items-start">
            @include('front.user.menu_side')
            <!-- account-sidebar/-->


                <div class="col-md-9 col-12 account-content-wrapper">
                    <div class="account-content-wrap my-order-content">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a  class="nav-link" href="#allorders" role="tab" data-toggle="tab">{{trans('orbscope.show-all')}} {{trans('front.orders')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#actions" role="tab" data-toggle="tab">{{trans('orbscope.order_underway')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#Confirmed" role="tab" data-toggle="tab">{{trans('orbscope.order_done')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#Shipped" role="tab" data-toggle="tab">{{trans('orbscope.order_cancelled')}}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="filter-ads-summary tab-pane fade in active show" role="tabpanel" id="allorders">
                                <div class="top-show-result d-flex justify-content-end align-items-center mt-3 mb-3">

                                </div>
                                <div class="myads-data">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead class="order-text-123">
                                            <tr>
                                                <th scope="col">{{trans('front.order_number')}}</th>
                                                <th scope="col">{{trans('front.product')}}</th>
                                                <th scope="col">{{trans('orbscope.price')}}</th>
                                                <th scope="col">{{trans('orbscope.date')}}</th>
                                                <th scope="col">{{trans('orbscope.status')}}</th>
                                                <th scope="col">{{trans('orbscope.show')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($orders as $od)
                                            <tr>
                                                <td>
                                                    {{$od->order_number}}
                                                </td>
                                                <td>
                                                    <div class="media">
                                                        <img class="acc-avatar-image mr-2" src="{{ShowImage(@$od->ad->main_image)}}">
                                                        <div class="media-body order-body-text">
                                                            <h6 class="mt-0">{{@$od->ad->title}}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{$od->amount}}
                                                </td>
                                                <td>
                                                   {{$od->created_at->format('Y-m-d')}}
                                                </td>
                                                <td>
                                                    @if($od->status=='operation')
                                                    <span class="badge-custom badge-activated">{{trans('front.'.$od->status)}}</span>
                                                     @elseif($od->status=='done')
                                                        <span class="badge-custom badge-comppleted">{{trans('front.'.$od->status)}}</span>
                                                        @else
                                                        <span class="badge-custom badge-pending">{{trans('front.'.$od->status)}}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{url('user/orders/'.$od->id.'/'.$od->order_number)}}" class="save-ads-data"><i class="far fa-eye"></i></a>
                                                </td>
                                            </tr> <!-- order detail end -->
                                            @endforeach

                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end">
                                            <nav aria-label="Page navigation" class="mr-3">
                                                <ul class="pagination">
                                                    {{$orders->links()}}
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-ads-summary tab-pane fade in active" role="tabpanel" id="actions">

                                <div class="myads-data">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead class="order-text-123">
                                            <tr>
                                                <th scope="col">{{trans('front.order_number')}}</th>
                                                <th scope="col">{{trans('front.product')}}</th>
                                                <th scope="col">{{trans('orbscope.price')}}</th>
                                                <th scope="col">{{trans('orbscope.date')}}</th>
                                                <th scope="col">{{trans('orbscope.status')}}</th>
                                                <th scope="col">{{trans('orbscope.show')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($operation as $od)
                                                <tr>
                                                    <td>
                                                        {{$od->order_number}}
                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <img class="acc-avatar-image mr-2" src="{{ShowImage(@$od->ad->main_image)}}">
                                                            <div class="media-body order-body-text">
                                                                <h6 class="mt-0">{{@$od->ad->title}}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{$od->amount}}
                                                    </td>
                                                    <td>
                                                        {{$od->created_at->format('Y-m-d')}}
                                                    </td>
                                                    <td>
                                                        @if($od->status=='operation')
                                                            <span class="badge-custom badge-activated">{{trans('front.'.$od->status)}}</span>
                                                        @elseif($od->status=='done')
                                                            <span class="badge-custom badge-comppleted">{{trans('front.'.$od->status)}}</span>
                                                        @else
                                                            <span class="badge-custom badge-pending">{{trans('front.'.$od->status)}}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{url('user/orders/'.$od->id.'/'.$od->order_number)}}" class="save-ads-data"><i class="far fa-eye"></i></a>
                                                    </td>
                                                </tr> <!-- order detail end -->
                                            @endforeach

                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end">
                                            <nav aria-label="Page navigation" class="mr-3">
                                                <ul class="pagination">
                                                    {{$operation->links()}}
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="filter-ads-summary tab-pane fade in active" role="tabpanel" id="Confirmed">

                                <div class="myads-data">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead class="order-text-123">
                                            <tr>
                                                <th scope="col">{{trans('front.order_number')}}</th>
                                                <th scope="col">{{trans('front.product')}}</th>
                                                <th scope="col">{{trans('orbscope.price')}}</th>
                                                <th scope="col">{{trans('orbscope.date')}}</th>
                                                <th scope="col">{{trans('orbscope.status')}}</th>
                                                <th scope="col">{{trans('orbscope.show')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($done as $od)
                                                <tr>
                                                    <td>
                                                        {{$od->order_number}}
                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <img class="acc-avatar-image mr-2" src="{{ShowImage(@$od->ad->main_image)}}">
                                                            <div class="media-body order-body-text">
                                                                <h6 class="mt-0">{{@$od->ad->title}}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{$od->amount}}
                                                    </td>
                                                    <td>
                                                        {{$od->created_at->format('Y-m-d')}}
                                                    </td>
                                                    <td>
                                                        @if($od->status=='operation')
                                                            <span class="badge-custom badge-activated">{{trans('front.'.$od->status)}}</span>
                                                        @elseif($od->status=='done')
                                                            <span class="badge-custom badge-comppleted">{{trans('front.'.$od->status)}}</span>
                                                        @else
                                                            <span class="badge-custom badge-pending">{{trans('front.'.$od->status)}}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{url('user/orders/'.$od->id.'/'.$od->order_number)}}" class="save-ads-data"><i class="far fa-eye"></i></a>
                                                    </td>
                                                </tr> <!-- order detail end -->
                                            @endforeach

                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end">
                                            <nav aria-label="Page navigation" class="mr-3">
                                                <ul class="pagination">
                                                    {{$done->links()}}
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-ads-summary tab-pane fade in active" role="tabpanel" id="Shipped">

                                <div class="myads-data">
                                    <div class="myads-data">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead class="order-text-123">
                                                <tr>
                                                    <th scope="col">{{trans('front.order_number')}}</th>
                                                    <th scope="col">{{trans('front.product')}}</th>
                                                    <th scope="col">{{trans('orbscope.price')}}</th>
                                                    <th scope="col">{{trans('orbscope.date')}}</th>
                                                    <th scope="col">{{trans('orbscope.status')}}</th>
                                                    <th scope="col">{{trans('orbscope.show')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($canceled as $od)
                                                    <tr>
                                                        <td>
                                                            {{$od->order_number}}
                                                        </td>
                                                        <td>
                                                            <div class="media">
                                                                <img class="acc-avatar-image mr-2" src="{{ShowImage(@$od->ad->main_image)}}">
                                                                <div class="media-body order-body-text">
                                                                    <h6 class="mt-0">{{@$od->ad->title}}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{$od->amount}}
                                                        </td>
                                                        <td>
                                                            {{$od->created_at->format('Y-m-d')}}
                                                        </td>
                                                        <td>
                                                            @if($od->status=='operation')
                                                                <span class="badge-custom badge-activated">{{trans('front.'.$od->status)}}</span>
                                                            @elseif($od->status=='done')
                                                                <span class="badge-custom badge-comppleted">{{trans('front.'.$od->status)}}</span>
                                                            @else
                                                                <span class="badge-custom badge-pending">{{trans('front.'.$od->status)}}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{url('user/orders/'.$od->id.'/'.$od->order_number)}}" class="save-ads-data"><i class="far fa-eye"></i></a>
                                                        </td>
                                                    </tr> <!-- order detail end -->
                                                @endforeach

                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-end">
                                                <nav aria-label="Page navigation" class="mr-3">
                                                    <ul class="pagination">
                                                        {{$canceled->links()}}
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
