@extends(AdminCore())
@section('content')
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
          type="text/css" />
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"
            type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>


    <div class='row'>
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-title">

                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>

                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/parnents')}}"
                           data-toggle="tooltip" title="{{trans('orbscope.show-all')}}   {{trans('orbscope.parnents_opnion')}}">
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
                        {!! Form::open(['files'=>true,'url'=>'admin/parents/store','method'=>'post','class'=>'form-horizontal form-row-seperated']) !!}
                        <div class="row">

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label" for="ar_name">{{trans('orbscope.name')}} <span class="required" aria-required="true"> * </span></label>

                                <div class="col-md-9">
                                    {!! Form::text('name',old('name'),['class'=>'form-control','id'=>'name','placeholder'=>trans('orbscope.name'),'required'=>'required']) !!}
                                    <i class="fa fa-spinner fa-spin loading hidden"></i>
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label" for="ar_description">{{trans('orbscope.description')}}</label>

                                <div class="col-md-9">
                                    {!! Form::textarea('desc',old('desc'),['class'=>'form-control','id'=>'desc','placeholder'=>trans('orbscope.description'),'rows'=>'3']) !!}
                                </div>
                            </div>


                            <div class="form-group">
                                {!! Form::label('logo',trans('orbscope.image'),['class'=>'col-md-3 control-label','for'=>'logo']) !!}
                                <div class="col-md-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview fileinput-exists thumbnail"
                                             style="max-width: 200px; max-height: 150px;">
                                        </div>
                                        <div>
                                    <span class="btn default btn-file">
                                         <span class="fileinput-new"> {{trans('orbscope.select-image')}}</span>
                                         <span class="fileinput-exists"> {{trans('orbscope.change')}} </span>
                                         <input type="file" name="image" id="logo" accept=".image/jpeg,.png,.jpg,.bmp,.gif">
                                    </span>
                                            <a href="javascript:;" class="btn red fileinput-exists"
                                               data-dismiss="fileinput"> {{trans('orbscope.remove')}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn blue">{{trans('orbscope.add')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <script>
        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>


@endsection
