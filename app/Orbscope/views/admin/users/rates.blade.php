@extends(AdminCore())
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">{{trans('orbscope.dashbord')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/admin/users')}}">{{trans('orbscope.users')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{$title}}</span>
            </li>
        </ul>
    </div>

    <div class="portlet box yellow">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-star"></i>{{trans('orbscope.rates')}}</div>

        </div>
        <div class="portlet-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th> # </th>
                        <th>{{trans('orbscope.order')}} {{trans('orbscope.number')}} </th>
                        <th> {{trans('front.degree_10')}} </th>
                        <th>{{trans('orbscope.note')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->Rates as $k=>$r)
                        <tr>
                            <td> {{$k+1}} </td>
                            <td> <a href="{{url('admin/orders/'.$r->order_id)}}">{{@$r->order->number}}</a></td>
                            <td>{{$r->degree}} </td>
                            <td> {{$r->note}}</td>



                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
