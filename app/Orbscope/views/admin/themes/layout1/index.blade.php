@extends(AdminCore())
@section('content')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />




            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Admin Dashboard </h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE BREADCRUMB -->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">Dashboard</span>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat2 bordered">
                        <div class="display">
                            <div class="number">
                                <h3 class="font-green-sharp">
                                    <span data-counter="counterup" data-value="7800">0</span>
                                    <small class="font-green-sharp">$</small>
                                </h3>
                                <small>TOTAL PROFIT</small>
                            </div>
                            <div class="icon">
                                <i class="icon-pie-chart"></i>
                            </div>
                        </div>
                        <div class="progress-info">
                            <div class="progress">
                                        <span style="width: 76%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">76% progress</span>
                                        </span>
                            </div>
                            <div class="status">
                                <div class="status-title"> progress </div>
                                <div class="status-number"> 76% </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat2 bordered">
                        <div class="display">
                            <div class="number">
                                <h3 class="font-red-haze">
                                    <span data-counter="counterup" data-value="1349">0</span>
                                </h3>
                                <small>NEW FEEDBACKS</small>
                            </div>
                            <div class="icon">
                                <i class="icon-like"></i>
                            </div>
                        </div>
                        <div class="progress-info">
                            <div class="progress">
                                        <span style="width: 85%;" class="progress-bar progress-bar-success red-haze">
                                            <span class="sr-only">85% change</span>
                                        </span>
                            </div>
                            <div class="status">
                                <div class="status-title"> change </div>
                                <div class="status-number"> 85% </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat2 bordered">
                        <div class="display">
                            <div class="number">
                                <h3 class="font-blue-sharp">
                                    <span data-counter="counterup" data-value="567"></span>
                                </h3>
                                <small>NEW ORDERS</small>
                            </div>
                            <div class="icon">
                                <i class="icon-basket"></i>
                            </div>
                        </div>
                        <div class="progress-info">
                            <div class="progress">
                                        <span style="width: 45%;" class="progress-bar progress-bar-success blue-sharp">
                                            <span class="sr-only">45% grow</span>
                                        </span>
                            </div>
                            <div class="status">
                                <div class="status-title"> grow </div>
                                <div class="status-number"> 45% </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat2 bordered">
                        <div class="display">
                            <div class="number">
                                <h3 class="font-purple-soft">
                                    <span data-counter="counterup" data-value="276"></span>
                                </h3>
                                <small>NEW USERS</small>
                            </div>
                            <div class="icon">
                                <i class="icon-user"></i>
                            </div>
                        </div>
                        <div class="progress-info">
                            <div class="progress">
                                        <span style="width: 57%;" class="progress-bar progress-bar-success purple-soft">
                                            <span class="sr-only">56% change</span>
                                        </span>
                            </div>
                            <div class="status">
                                <div class="status-title"> change </div>
                                <div class="status-number"> 57% </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->






<!-- END QUICK NAV -->
<script src="{{url('orbscope/admin')}}/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="{{url('orbscope/admin')}}/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{url('orbscope/admin')}}/assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
    $(document).ready(function()
    {
        $('#clickmewow').click(function()
        {
            $('#radio1003').attr('checked', 'checked');
        });
    })
</script>


@endsection
