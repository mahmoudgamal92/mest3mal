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
                        

                        <span data-toggle="tooltip" title="{{trans('orbscope.delete')}}  {{trans('orbscope.logs')}}">

                        <a data-toggle="modal" data-target="#myModal{{$show->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
                        <i class="fa fa-trash"></i>
                        </a>
                        </span>


                        <div class="modal fade" id="myModal{{$show->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button class="close" data-dismiss="modal">x</button>
                                        <h4 class="modal-title">{{trans('orbscope.delete')}} {{ VarByLang($show->action,GetLanguage()) }} !</h4>
                                    </div>
                                    <div class="modal-body">
                                        {{trans('orbscope.ask-delete')}}  {{ VarByLang($show->action,GetLanguage()) }} !
                                    </div>
                                    <div class="modal-footer">
                                        {!! Form::open([
                                       'method' => 'DELETE',
                                       'route' => ['logs.destroy', $show->id]
                                       ]) !!}
                                        {!! Form::submit(trans('orbscope.approval'), ['class' => 'btn btn-danger']) !!}
                                        <a class="btn btn-default" data-dismiss="modal">{{trans('orbscope.cancel')}}</a>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/logs')}}"
                           data-toggle="tooltip" title="{{trans('orbscope.show-all')}}   {{trans('orbscope.logs')}}">
                            <i class="fa fa-list"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
                           data-original-title="{{trans('orbscope.full-screen')}}"
                           title="{{trans('orbscope.full-screen')}}">
                        </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="col-md-12">


                        <div class="row">

                            <br>
                            <div class="col-md-12">

                                <div class="col-md-6">
                                    <strong>{{trans('log.action')}} : </strong>
                                    {{VarByLang($show->action,GetLanguage())}}
                                    <br><hr>
                                </div>

                                <div class="col-md-6">
                                    <strong>{{trans('log.route')}} : </strong>
                                    {{VarByLang($show->route,GetLanguage())}}
                                    <br><hr>
                                </div>

                                <div class="col-md-6">
                                    <strong>{{trans('log.updated_at')}} : </strong>
                                    {{$show->updated_at}}
                                    <br><hr>
                                </div>

                                <div class="col-md-6">
                                    <strong>{{trans('log.user_id')}} : </strong>
                                    {{$show->user_log->name}}
                                    <br><hr>
                                </div>

                            </div>



                        </div>


                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
