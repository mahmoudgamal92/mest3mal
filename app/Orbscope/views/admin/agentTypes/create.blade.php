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
                <div class="portlet-body form">
                    <div class="col-md-12">

                        {!! Form::open(['files'=>true,'route'=>'agentTypes.store','class'=>'form-horizontal form-row-seperated']) !!}
                        <div class="row">


                            <div class="form-group{{ $errors->has('ar_name') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label" for="ar_name">{{trans('orbscope.ar-name')}} <span class="required" aria-required="true"> * </span></label>

                                <div class="col-md-9">
                                    {!! Form::text('ar_name',old('ar_name'),['class'=>'form-control','id'=>'ar_name','placeholder'=>trans('orbscope.ar-name')]) !!}
                                    @if ($errors->has('ar_name'))
                                        <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('ar_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('en_name') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label" for="en_name">{{trans('orbscope.en-name')}} <span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-9">
                                    {!! Form::text('en_name',old('en_name'),['class'=>'form-control','id'=>'en_name','placeholder'=>trans('orbscope.en-name')]) !!}
                                    @if ($errors->has('en_name'))
                                        <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('en_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="description">{{trans('orbscope.description')}} </label>
                                <div class="col-md-9">
                                    {!! Form::textarea('description',old('description'),['class'=>'form-control','id'=>'description','placeholder'=>trans('orbscope.description')]) !!}
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn blue">{{trans('orbscope.add')}} {{trans('orbscope.agentTypes')}}</button>
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
@endsection
