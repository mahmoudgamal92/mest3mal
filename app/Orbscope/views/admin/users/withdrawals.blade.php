@extends(AdminCore())
@section('content')

    <link rel="stylesheet" href="{{url('orbscope/admin')}}/datatables/dataTables.bootstrap{{GetLangAdds()}}.css">
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
          type="text/css" />
    <script src="{{url('orbscope/admin/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('orbscope/admin/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{url('orbscope/admin/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('vendor/datatables/buttons.server-side.js')}}"></script>

    <style>
        table {
            table-layout: fixed; !important;
        }
        table{
            display: block; !important;
            overflow-x: auto; !important;
            white-space: nowrap; !important;

        }
    </style>
    <div class="page-bar">
        <div class="page-toolbar" style="width: 100%;">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">{{$title}}</span>
                            </div>

                        </div>

                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                <thead>
                                <tr>
                                    <th><i class="fa fa-plus"></i></th>
                                    <th> {{trans('orbscope.user')}} </th>
                                    <th> {{trans('orbscope.email')}}</th>
                                    <th>{{trans('orbscope.amount_money')}} </th>
                                    <th>{{trans('orbscope.date')}} </th>
                                    <th>{{trans('orbscope.status')}} </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(@\App\Orbscope\Models\Withdrawal::where('status','pending')->get() as $p)
                                    <tr class="odd gradeX">
                                        <td>  <i class="fa fa-plus"></i> </td>
                                        <td style="width: 30% !important;">{{@$p->user->name}} </td>
                                        <td  style="width: 30% !important;">
                                            {{$p->email}}
                                        </td>
                                        <td>
                                           {{$p->amount}}
                                        </td>
                                        <td>
                                          {{$p->created_at}}
                                        </td>

                                        <td  style="width: 10% !important;"><a href="{{url('admin/order_withdrawals/'.$p->id)}}" class="btn blue btn-xs">{{trans('orbscope.send')}}  </a></td>



                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>


        </div>
        <!-- Modal -->
    </div>









    <script src="{{url('orbscope/admin')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
@endsection
