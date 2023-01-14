@extends(AdminCore())
@section('content')


    <div class='row'>
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">

                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>
                    <div class="actions">
                        <span data-toggle="tooltip" title="{{trans('orbscope.delete')}}  {{trans('orbscope.users')}}">
                            <a data-toggle="modal" data-target="#myModal{{$show->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
                                <i class="fa fa-trash"></i>
                            </a>
                        </span>
                        <div class="modal fade" id="myModal{{$show->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button class="close" data-dismiss="modal">x</button>
                                        <h4 class="modal-title">{{trans('orbscope.delete')}} {{  $show->name }} !</h4>
                                    </div>
                                    <div class="modal-body">
                                        {{trans('orbscope.ask-delete')}}  {{ $show->name }} !
                                    </div>
                                    <div class="modal-footer">
                                        {!! Form::open([ 'method' => 'DELETE', 'route' => ['users.destroy', $show->id] ]) !!}
                                        {!! Form::submit(trans('orbscope.approval'), ['class' => 'btn btn-danger']) !!}
                                        <a class="btn btn-default" data-dismiss="modal">{{trans('orbscope.cancel')}}</a>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/users')}}" data-toggle="tooltip" title="{{trans('orbscope.show-all')}}   {{trans('orbscope.users')}}"><i class="fa fa-list"></i></a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#" data-original-title="{{trans('orbscope.full-screen')}}" title="{{trans('orbscope.full-screen')}}"></a>
                    </div>
                </div>

                <div class="portlet-body">
                    <div class="tabbable-line">
                        <ul class="nav nav-tabs nav-tabs-lg">
                            <li @if(url(AdminPath().'/users/'.$show->id) == URL::current()) class="active" @endif>
                                <a href="{{url(AdminPath().'/users/'.$show->id)}}" >{{trans('orbscope.agent_information')}}</a>
                            </li>
                            <!--
                            <li @if(url(AdminPath().'/users/'.$show->id.'/rates') == URL::current()) class="active" @endif>
                                <a href="{{ url(AdminPath().'/users/'.$show->id.'/rates')}}" >{{trans('orbscope.rate')}}</a>
                            </li>
                            --->

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="row static-info">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <strong>{{trans('orbscope.name')}} : </strong>
                                            {{$show->name}}
                                            <br><hr>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>{{trans('orbscope.email')}} : </strong>
                                            <a href="mailto:{{$show->email}}">{{$show->email}}</a>
                                            <br><hr>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>{{trans('orbscope.phone')}} : </strong>
                                            {{$show->phone}}
                                            <br><hr>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>{{trans('orbscope.type')}} : </strong>
                                            {{$show->type}}
                                            <br><hr>
                                        </div>

                                        
                                        <div class="clearfix"></div>
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
