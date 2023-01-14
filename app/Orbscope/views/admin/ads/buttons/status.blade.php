
@if($status=='active')
    <span class="label label-success"> {{trans('orbscope.'.$status)}} </span>
    <br/>
    <a href="{{url('admin/status/'.$id.'/ad/inactive')}}" class="btn btn-xs red"> {{trans('orbscope.make_not_active')}}
        <i class="fa fa-edit"></i>
    </a>
@else

    <span class="label label-danger"> {{trans('orbscope.'.$status)}} </span>
    <a href="{{url('admin/status/'.$id.'/ad/active')}}" class="btn btn-xs blue">{{trans('orbscope.active')}}
        <i class="fa fa-edit"></i>
    </a>
@endif
