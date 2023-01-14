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
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/countries/create')}}"
                           data-toggle="tooltip" title="{{trans('orbscope.add')}}  {{trans('orbscope.countries')}}">
                            <i class="fa fa-plus"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{ url(AdminPath().'/countries/'.$show->id.'/edit')}}"
                           data-toggle="tooltip" title="{{trans('orbscope.edit')}}  {{trans('orbscope.countries')}}">
                            <i class="fa fa-edit"></i>
                        </a>

                        <span data-toggle="tooltip" title="{{trans('orbscope.delete')}}  {{trans('orbscope.countries')}}">

                        <a data-toggle="modal" data-target="#myModal{{$show->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
                        <i class="fa fa-trash"></i>
                        </a>
                        </span>


                        <div class="modal fade" id="myModal{{$show->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button class="close" data-dismiss="modal">x</button>
                                        <h4 class="modal-title">{{trans('orbscope.delete')}} {{ VarByLang($show->name,GetLanguage()) }} !</h4>
                                    </div>
                                    <div class="modal-body">
                                        {{trans('orbscope.ask-delete')}}  {{ VarByLang($show->name,GetLanguage()) }} !
                                    </div>
                                    <div class="modal-footer">
                                        {!! Form::open([
                                       'method' => 'DELETE',
                                       'route' => ['countries.destroy', $show->id]
                                       ]) !!}
                                        {!! Form::submit(trans('orbscope.approval'), ['class' => 'btn btn-danger']) !!}
                                        <a class="btn btn-default" data-dismiss="modal">{{trans('orbscope.cancel')}}</a>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/countries')}}"
                           data-toggle="tooltip" title="{{trans('orbscope.show-all')}}   {{trans('orbscope.countries')}}">
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
                                    <strong>{{trans('orbscope.ar-name')}} : </strong>
                                    {{VarByLang($show->name,'ar')}}
                                    <br><hr>
                                </div>

                                <div class="col-md-6">
                                    <strong>{{trans('orbscope.en-name')}} : </strong>
                                    {{VarByLang($show->name,'en')}}
                                    <br><hr>
                                </div>







                                <div class="col-md-6">
                                    <strong>{{trans('orbscope.status')}} : </strong>
                                    {{trans('orbscope.'.$show->status)}}
                                    <br><hr>
                                </div>

                                <div class="col-md-6">
                                    <strong>{{trans('orbscope.show_website')}} : </strong>
                                    {{trans('orbscope.'.$show->show_website)}}
                                    <br><hr>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-1"><strong>{{trans('orbscope.flag')}} : </strong></div>
                                    <div class="col-md-11">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">


                                        <div class="fileinput-new thumbnail" style="width: 200px; height: auto">
                                            <img src="{{ShowImage($show->flag)}}" />
                                        </div>
                                    </div>
                                    </div>
                                    <br><hr>
                                </div>




                                <div class="clearfix"></div>


                            </div>



                        </div>


                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>


@endsection
