@extends(AdminCore())
@section('content')
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
          type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/dropzone/basic.min.css" rel="stylesheet" type="text/css" />
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
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/users')}}"
                           data-toggle="tooltip" title="{{trans('orbscope.show-all')}}   {{trans('orbscope.users')}}">
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

                        {!! Form::open(['files'=>true,'route'=>'users.store','class'=>'form-horizontal form-row-seperated']) !!}
                        <div class="row">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label" for="name">{{trans('orbscope.name')}} <span class="required" aria-required="true"> * </span></label>

                                <div class="col-md-10">
                                    {!! Form::text('name',old('name'),['class'=>'form-control','id'=>'name','placeholder'=>trans('orbscope.name'),'required'=>'required']) !!}
                                    <i class="fa fa-spinner fa-spin loading hidden"></i>
                                </div>

                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label" for="email">{{trans('orbscope.email')}} <span class="required" aria-required="true"> * </span></label>

                                <div class="col-md-10">
                                    {!! Form::email('email',old('email'),['class'=>'form-control','id'=>'email','placeholder'=>trans('orbscope.email')]) !!}
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label" for="password">{{trans('orbscope.password')}} <span class="required" aria-required="true"> * </span></label>

                                <div class="col-md-10">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="{{trans('orbscope.password')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="agentType">{{trans('orbscope.agent')}} </label>
                                <div class="col-md-10">
                                    <select class="form-control select2" name="employee_id"  data-placeholder="{{trans('orbscope.agent')}}">
                                        <option></option>
                                        @foreach(\App\Orbscope\Models\Employee::where('soft_delete','no')->get() as $type)
                                            <option value="{{$type->id}}">{{VarByLang($type->name,GetLanguage())}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            
                            <div class='form-group'>
                                <label class="col-md-2 control-label">{{ trans('orbscope.assign_rolles') }}</label>
                                <div class="col-md-10">
                                    @foreach ($roles->chunk(4) as $roleCh)
                                        <div class="row">
                                            @foreach ($roleCh as $role)
                                                <div class="col-md-3">
                                                    <span style="margin-right: 3px">
                                                        {{ Form::checkbox('roles[]',  $role->id) }}
                                                        {{ Form::label($role->name, ucfirst($role->name)) }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn blue">{{trans('orbscope.add')}} {{trans('orbscope.user')}}</button>
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
