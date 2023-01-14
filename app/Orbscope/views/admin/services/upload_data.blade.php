@extends(AdminCore())
@section('content')
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
                </div>
                <div class="portlet-body">
                    <div class="mt-element-step">
                        <div class="row step-line">
                            <div class="mt-step-desc">
                                <div class="col-md-4 mt-step-col first done">
                                    <div class="mt-step-number bg-white">
                                        <i class="icon-cloud-upload"></i>
                                    </div>
                                    <div class="mt-step-title uppercase font-grey-cascade">{{trans('orbscope.upload')}}  {{trans('orbscope.file')}}</div>
                                    <div class="mt-step-content font-grey-cascade">{{trans('orbscope.upload_message')}}</div>
                                </div>
                                <div class="col-md-4 mt-step-col done">
                                    <div class="mt-step-number bg-white">
                                        <i class="icon-note"></i>
                                    </div>
                                    <div class="mt-step-title uppercase font-grey-cascade">{{trans('orbscope.duplicate_record')}}</div>
                                    <div class="mt-step-content font-grey-cascade">{{trans('orbscope.duplicate_message')}}</div>
                                </div>
                                <div class="col-md-4 mt-step-col last active">
                                    <div class="mt-step-number bg-white">
                                        <i class="icon-list"></i>
                                    </div>
                                    <div class="mt-step-title uppercase font-grey-cascade">{{trans('orbscope.file_map')}}</div>
                                    <div class="mt-step-content font-grey-cascade">{{trans('orbscope.message_mapping')}}</div>
                                </div>
                            </div>
                        </div><hr>
                    </div>

                    <div class="col-md-10 col-md-offset-1">
                        <div class="alert alert-block alert-info fade in text-center">
                            <button type="button" class="close" data-dismiss="alert"></button>
                            <h4 class="alert-heading">{{trans('orbscope.imp_note')}}</h4>
                            <p> -  {{trans('orbscope.required')}} </p>
                            <p> -  {{trans('orbscope.upload_status')}}</p>
                        </div>
                    </div>
                    <form action="{{ URL::to(AdminPath().'/services/upload/saveExcel') }}" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <table class="table table-striped table-bordered table-hover text-center">
                        <thead class="text-center">
                            <tr >
                                @if($has_header == "on") <th class="text-center">{{trans('orbscope.file_header')}}</th> @endif
                                <th class="text-center">{{trans('orbscope.first_row')}}</th>
                                <th class="text-center">{{trans('orbscope.orb_fields')}}</th>
                            </tr>
                        </thead>
                        <tbody>


                            @if($has_header == "on")

                                @for($i =0; $i < count($headers); $i++)
                                    <tr>
                                        <td>{{$headers[$i]}}</td>
                                        <td>{{$row[$i]}}</td>
                                        <td>
                                            <select name="feilds[]" class="form-control select2" data-placeholder="{{trans('orbscope.orb_fields')}}" required>
                                                <option></option>
                                                <option value="ar">{{trans('orbscope.ar-name')}} <span class="required" aria-required="true"> * </span></option>
                                                <option value="en">{{trans('orbscope.en-name')}} <span class="required" aria-required="true"> * </span></option>
                                                <option value="status">{{trans('orbscope.status')}} </option>
                                            </select>
                                        </td>
                                    </tr>
                                @endfor

                            @else
                                @for($i =0; $i < count($headers); $i++)
                                    <tr>
                                        <td>{{$headers[$i]}}</td>
                                        <td>
                                            <select name="feilds[]" class="form-control select2" data-placeholder="{{trans('orbscope.orb_fields')}}" required>
                                                <option></option>
                                                <option value="ar">{{trans('orbscope.ar-name')}} <span class="required" aria-required="true"> * </span></option>
                                                <option value="en">{{trans('orbscope.en-name')}} <span class="required" aria-required="true"> * </span></option>
                                                <option value="status">{{trans('orbscope.status')}} </option>
                                            </select>
                                        </td>
                                    </tr>
                                @endfor
                            @endif



                        </tbody>
                    </table>



                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn blue">{{trans('orbscope.upload')}} {{trans('orbscope.services')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection


