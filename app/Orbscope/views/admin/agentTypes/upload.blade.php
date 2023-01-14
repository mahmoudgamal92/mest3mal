@extends(AdminCore())
@section('content')
    <link href="{{url('orbscope/admin/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{url('orbscope/admin/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
    <link href="{{url('orbscope/admin/assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin/assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{url('orbscope/admin/assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{url('orbscope/admin/assets/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>

    <div class='row'>
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-title">

                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>

                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/agentTypes')}}"
                           data-toggle="tooltip" title="{{trans('orbscope.show-all')}}   {{trans('orbscope.agentTypes')}}">
                            <i class="fa fa-list"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
                           data-original-title="{{trans('orbscope.full-screen')}}"
                           title="{{trans('orbscope.full-screen')}}">
                        </a>
                    </div>
                </div>

                <div class="mt-element-step">
                    <div class="row step-line">
                        <div class="mt-step-desc">
                        <div class="col-md-4 mt-step-col first active">
                            <div class="mt-step-number bg-white">
                                <i class="icon-cloud-upload"></i>
                            </div>
                            <div class="mt-step-title uppercase font-grey-cascade">{{trans('orbscope.upload')}}  {{trans('orbscope.file')}}</div>
                            <div class="mt-step-content font-grey-cascade">{{trans('orbscope.upload_message')}}</div>
                        </div>
                        <div class="col-md-4 mt-step-col active">
                            <div class="mt-step-number bg-white">
                                <i class="icon-note"></i>
                            </div>
                            <div class="mt-step-title uppercase font-grey-cascade">{{trans('orbscope.duplicate_record')}}</div>
                            <div class="mt-step-content font-grey-cascade">{{trans('orbscope.duplicate_message')}}</div>
                        </div>
                        <div class="col-md-4 mt-step-col last">
                            <div class="mt-step-number bg-white">
                                <i class="icon-list"></i>
                            </div>
                            <div class="mt-step-title uppercase font-grey-cascade">{{trans('orbscope.file_map')}}</div>
                            <div class="mt-step-content font-grey-cascade">{{trans('orbscope.message_mapping')}}</div>
                        </div>
                    </div>
                </div><hr>
                </div>
                <div class="portlet-body form">
                    <div class="col-md-12">


                        <form action="{{ URL::to(AdminPath().'/agentTypes/upload/importExcel') }}" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="row">

                            <div class="form-group">



                                <label class="control-label col-md-3"> {{trans('orbscope.select_file')}} CSV <span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <span class="btn green btn-file">
                                                            <span class="fileinput-new">{{trans('orbscope.select_file')}} {{trans('orbscope.type_csv')}}</span>
                                                            <span class="fileinput-exists"> {{trans('orbscope.change')}} </span>
                                                            <input type="file" name="import_file" accept=".csv"> </span>
                                        <span class="fileinput-filename"> </span> &nbsp;
                                        <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3"> {{trans('orbscope.has_header')}} </label>
                                <div class="col-md-9 ">
                                    <div class="mt-checkbox-inline">
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        <input type="checkbox" name="has_header" checked>
                                        <span></span>
                                    </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3"> {{trans('orbscope.encoding')}} </label>
                                <div class="col-md-9">
                                    <select name="encoding" class="form-control select2">
                                        <option value="UTF-8">UTF-8</option>
                                        <option value="ISO-8859-1">ISO-8859-1</option>
                                        <option value="Windows-1256">Windows-1256</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3"> {{trans('orbscope.delimiter')}} </label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio mt-radio-outline">
                                            <input type="radio" name="delimiter" value="," checked=""> Comma ' , '
                                            <span></span>
                                        </label>
                                        <label class="mt-radio mt-radio-outline">
                                            <input type="radio" name="delimiter" value=";"> Semicolon ' ; '
                                            <span></span>
                                        </label>
                                        <label class="mt-radio mt-radio-outline">
                                            <input type="radio" name="delimiter" value="|"> Pipe ' | '
                                            <span></span>
                                        </label>
                                        <label class="mt-radio mt-radio-outline">
                                            <input type="radio" name="delimiter" value="^"> Caret ' ^ '
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3"> {{trans('orbscope.duplicate_record')}} </label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" name="duplicate_record" checked> {{trans('orbscope.remove')}}
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn blue">{{trans('orbscope.upload')}} {{trans('orbscope.agentTypes')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
@endsection


