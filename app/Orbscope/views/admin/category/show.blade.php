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
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/category/create')}}"
                           data-toggle="tooltip" title="{{trans('orbscope.add')}}  {{trans('orbscope.category')}}">
                            <i class="fa fa-plus"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{ url(AdminPath().'/category/'.$show->id.'/edit')}}"
                           data-toggle="tooltip" title="{{trans('orbscope.edit')}}  {{trans('orbscope.category')}}">
                            <i class="fa fa-edit"></i>
                        </a>

                        <span data-toggle="tooltip" title="{{trans('orbscope.delete')}}  {{trans('orbscope.category')}}">

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
                                       'route' => ['category.destroy', $show->id]
                                       ]) !!}
                                        {!! Form::submit(trans('orbscope.approval'), ['class' => 'btn btn-danger']) !!}
                                        <a class="btn btn-default" data-dismiss="modal">{{trans('orbscope.cancel')}}</a>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/category')}}"
                           data-toggle="tooltip" title="{{trans('orbscope.show-all')}}   {{trans('orbscope.category')}}">
                            <i class="fa fa-list"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
                           data-original-title="{{trans('orbscope.full-screen')}}"
                           title="{{trans('orbscope.full-screen')}}">
                        </a>
                    </div>

                </div>

                <ul class="nav nav-tabs nav-tabs-lg">
                    <li @if(url(AdminPath().'/category/'.$show->id) == URL::current()) class="active" @endif>
                        <a href="{{url(AdminPath().'/category/'.$show->id)}}" >{{trans('orbscope.category_information')}}</a>
                    </li>

                    <li @if(url(AdminPath().'/category/'.$show->id.'/sub_category') == URL::current()) class="active" @endif>
                        <a href="{{url(AdminPath().'/category/'.$show->id.'/sub_category')}}" >{{trans('orbscope.sub_category')}}  <i class="fa fa-server"></i></a>
                    </li>

                    <li @if(url(AdminPath().'/category/'.$show->id.'/product') == URL::current()) class="active" @endif>
                        <a href="{{url(AdminPath().'/category/'.$show->id.'/product')}}" >{{trans('orbscope.product')}}  <i class="fa fa-archive"></i></a>
                    </li>

                </ul>
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
                                    {{VarByLang($show->shop->name,GetLanguage())}}
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

                                <div class="col-md-6">
                                    <strong>{{trans('orbscope.icon')}} : </strong>
                                    <i class="fa {{ $show->icon }} fa-1x"></i>
                                    <br><hr>
                                </div>

                                <div class="col-md-12">
                                    <strong>{{trans('orbscope.description')}} : </strong>
                                    {{$show->description}}
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
