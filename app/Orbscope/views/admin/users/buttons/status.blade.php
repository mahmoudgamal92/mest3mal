
@if($status=='inactive')
<a href="{{ url(AdminPath().'/user/'.$id.'/active')}}" class="btn blue">{{trans('orbscope.inactive')}}</a>
@else
<a href="{{ url(AdminPath().'/user/'.$id.'/inactive')}}" class="btn btn-danger">{{trans('orbscope.active')}}</a>
@endif
