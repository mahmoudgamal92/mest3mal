@extends(AdminCore())
@section('content')
<style>
    .emty_star{
        color: rgba(213, 208, 202, 0.86);
    }
</style>
    <div class='row'>
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>
                    <div class="actions">


                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/orders')}}"
                           data-toggle="tooltip" title="{{trans('orbscope.show-all')}}   {{trans('orbscope.orders')}}">
                            <i class="fa fa-list"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
                           data-original-title="{{trans('orbscope.full-screen')}}"
                           title="{{trans('orbscope.full-screen')}}">
                        </a>
                    </div>
                </div>
                <div class="portlet-body form">



                        <div class="row">



                                <div class="col-md-6">
                                    <strong>{{trans('front.seller')}} : </strong>
                                    {{@$show->seller->name}}
                                    <br><hr>
                                </div>
                                <div class="col-md-6">
                                    <strong>{{trans('front.buyer')}} : </strong>
                                    {{@$show->owner->name}}
                                    <br><hr>
                                </div>
                                <div class="col-md-6">
                                    <strong>{{trans('orbscope.status')}} : </strong>
                                    {{trans('front.'.$show->status)}}
                                    <br><hr>
                                </div>
                                <div class="col-md-6">
                                    <strong>{{trans('front.ad')}} : </strong>
                                    <a href="{{url('ad/'.$show->ad_id.'/'.@$show->ad->title)}}">{{@$show->ad->title}}</a>
                                    <br><hr>
                                </div>
                                <div class="col-md-6">
                                    <strong>{{trans('orbscope.amount_money')}} : </strong>
                                    {{@$show->amount}}
                                    <br><hr>
                                </div>
                                @if(!empty($show->review))
                                <div class="col-md-12">
                                    <strong>{{trans('orbscope.rate')}} : </strong>
                                    {!! orderStars(@$show->review->rate) !!} - {{@$show->review->details}}
                                    <br><hr>
                                </div>
                                @endif












                        </div>



                </div>
            </div>
        </div>
    </div>

@endsection
