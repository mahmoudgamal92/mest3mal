@extends(AdminCore())
@section('content')
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css" />
    <div class='row'>
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/sub_category/create')}}"
                           data-toggle="tooltip" title="{{trans('orbscope.add')}}  {{trans('orbscope.sub_category')}}">
                            <i class="fa fa-plus"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{ url(AdminPath().'/sub_category/'.$show->id.'/edit')}}"
                           data-toggle="tooltip" title="{{trans('orbscope.edit')}}  {{trans('orbscope.sub_category')}}">
                            <i class="fa fa-edit"></i>
                        </a>

                        <span data-toggle="tooltip" title="{{trans('orbscope.delete')}}  {{trans('orbscope.sub_category')}}">

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
                                       'route' => ['sub_category.destroy', $show->id]
                                       ]) !!}
                                        {!! Form::submit(trans('orbscope.approval'), ['class' => 'btn btn-danger']) !!}
                                        <a class="btn btn-default" data-dismiss="modal">{{trans('orbscope.cancel')}}</a>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/sub_category')}}"
                           data-toggle="tooltip" title="{{trans('orbscope.show-all')}}   {{trans('orbscope.sub_category')}}">
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
                                    <strong>{{trans('orbscope.shop')}} : </strong>
                                    {{VarByLang(@$show->depart->name,GetLanguage())}}
                                    <br><hr>
                                </div>


                                <div class="col-md-6">
                                    <strong>{{trans('orbscope.category')}} : </strong>
                                    {{VarByLang(@$show->category->name,GetLanguage())}}
                                    <br><hr>
                                </div>

                                <div class="col-md-6">
                                    <strong>{{trans('orbscope.status')}} : </strong>
                                    {{trans('orbscope.'.$show->status)}}
                                    <br><hr>
                                </div>




                                <div class="col-md-12">
                                    <div class="col-md-1"><strong>{{trans('orbscope.image')}} : </strong></div>
                                    <div class="col-md-11">
                                        <div class="fileinput fileinput-new" data-provides="fileinput" style="width: 200px; height: auto">


                                            <a href="{{ShowImage($show->image)}}" class="fancybox-button" data-rel="fancybox-button">
                                                <img class="img-responsive" src="{{ShowImage($show->image)}}" alt=""> </a>
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

    <script src="{{url('orbscope/admin')}}/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
@endsection
