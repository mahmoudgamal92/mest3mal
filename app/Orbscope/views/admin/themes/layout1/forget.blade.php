<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="{{GetDirection()}}">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>{{ @SettingsByLang('name',GetLanguage() ) }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="{{ @SettingsByLang('description',GetLanguage() ) }}" name="description" />
        <meta content="{{ @SettingsByLang('keywords',GetLanguage() ) }}" name="keywords" />
        <meta content="OrbScope Co." name="author" />

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        {!! Html::style('orbscope/admin/assets/global/plugins/font-awesome/css/font-awesome.min.css') !!}
        {!! Html::style('orbscope/admin/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') !!}
        {!! Html::style('orbscope/admin/assets/global/css/components.min.css') !!}

        @if (GetDirection() == 'rtl')
        {!! Html::style('orbscope/admin/assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css') !!}
        {!! Html::style('orbscope/admin/assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css') !!}
        {!! Html::style('orbscope/admin/assets/global/css/components-rtl.min.css') !!}
        {!! Html::style('orbscope/admin/assets/global/css/plugins-rtl.min.css') !!}
        @else

        {!! Html::style('orbscope/admin/assets/global/plugins/bootstrap/css/bootstrap.min.css') !!}
        {!! Html::style('orbscope/admin/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}
        {!! Html::style('orbscope/admin/assets/global/css/plugins.min.css') !!}
        @endif

        {!! Html::style('orbscope/admin/assets/global/plugins/select2/css/select2.min.css') !!}
        {!! Html::style('orbscope/admin/assets/global/plugins/select2/css/select2-bootstrap.min.css') !!}
        {!! Html::style('orbscope/admin/assets/global/plugins/bootstrap-sweetalert/sweetalert.css') !!}
        {!! Html::style('orbscope/admin/assets/global/custom.css') !!}
        @include(AdminTheme().'/login_color'.GetLangAdds())


        <link rel="shortcut icon" href="{{url(GetSettings()->icon)}}" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="{{url('/')}}">
                <img src="{{GetImage(GetSettings()->logo)}}" alt="" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">

            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form action="{{ route('password.email') }}" method="post">
                {{ csrf_field() }}
                <h3 class="font-green">{{trans('orbscope.forget_password')}}</h3>
                <p> {{trans('orbscope.forget_message')}} </p>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="{{trans('orbscope.email')}}" name="email" />
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-actions forget-a">
                    <a href="{{url('/').'/'.GetSettings()->admin_path.'/login'}}" class="btn green btn-outline">{{trans('orbscope.back')}}</a>
                    <button type="submit" class="btn btn-success uppercase pull-right forget">{{trans('orbscope.submit_password')}}</button>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->
        </div>
        <div class="copyright"> All Copyrights Reserved  © <a href="https://orbscope.com">OrbScope Co.</a>   2017 - @php echo date('Y', strtotime('+1 year')); @endphp . CRM </div>
        <!--[if lt IE 9]>
        {!! Html::script('orbscope/admin/assets/global/plugins/respond.min.js') !!}
        {!! Html::script('orbscope/admin/assets/global/plugins/excanvas.min.js') !!}
        {!! Html::script('orbscope/admin/assets/global/plugins/ie8.fix.min.js') !!}
        <![endif]-->

        <!-- BEGIN CORE PLUGINS -->
        {!! Html::script('orbscope/admin/assets/global/plugins/jquery.min.js') !!}
        {!! Html::script('orbscope/admin/assets/global/plugins/bootstrap/js/bootstrap.min.js') !!}
        {!! Html::script('orbscope/admin/assets/global/plugins/js.cookie.min.js') !!}
        {!! Html::script('orbscope/admin/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!}
        {!! Html::script('orbscope/admin/assets/global/plugins/jquery.blockui.min.js') !!}
        {!! Html::script('orbscope/admin/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}
        <!-- END CORE PLUGINS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {!! Html::script('orbscope/admin/assets/global/plugins/jquery-validation/js/jquery.validate.min.js') !!}
        {!! Html::script('orbscope/admin/assets/global/plugins/jquery-validation/js/additional-methods.min.js') !!}
        {!! Html::script('orbscope/admin/assets/global/plugins/select2/js/select2.full.min.js') !!}
        {!! Html::script('orbscope/admin/assets/global/scripts/app.min.js') !!}
        {!! Html::script('orbscope/admin/assets/pages/scripts/login.js') !!}
        {!! Html::script('orbscope/admin/assets/global/plugins/bootstrap-sweetalert/sweetalert.js') !!}
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->

        <script>
            @if(session()->has('success'))
                swal({
                    title                  : "{{trans('orbscope.success')}}",
                    text                   : "{{session()->get('success') }}",
                    type                   : "success",
                    customClass            : "sweet-alert showSweetAlert",
                    confirmButtonClass     : "btn-success",
                    cancelButtonClass      : "btn-success",
                    closeOnCancel          : true,
                    confirmButtonText      : "{{trans('orbscope.close')}}",
                    cancelButtonText       : "{{trans('orbscope.close')}}",
                    timer                  : "4000"
                });
            @endif
            @if(session()->has('info'))
                swal({
                title                  : "{{trans('orbscope.info')}}",
                text                   : "{{session()->get('info') }}",
                type                   : "info",
                customClass            : "sweet-alert showSweetAlert",
                confirmButtonClass     : "btn-info",
                cancelButtonClass      : "btn-info",
                closeOnCancel          : true,
                confirmButtonText      : "{{trans('orbscope.close')}}",
                cancelButtonText       : "{{trans('orbscope.close')}}",
                timer                  : "4000"
            });
            @endif
            @if(session()->has('warning'))
                swal({
                title                  : "{{trans('orbscope.warning')}}",
                text                   : "{{session()->get('warning') }}",
                type                   : "warning",
                customClass            : "sweet-alert showSweetAlert",
                confirmButtonClass     : "btn-warning",
                cancelButtonClass      : "btn-warning",
                closeOnCancel          : true,
                confirmButtonText      : "{{trans('orbscope.close')}}",
                cancelButtonText       : "{{trans('orbscope.close')}}",
                timer                  : "4000"
            });
            @endif
            @if(session()->has('error'))
                swal({
                    title                  : "{{trans('orbscope.error')}}",
                    text                   : "{{session()->get('error') }}",
                    type                   : "error",
                    customClass            : "sweet-alert showSweetAlert",
                    confirmButtonClass     : "btn-danger",
                    cancelButtonClass      : "btn-danger",
                    closeOnCancel          : true,
                    confirmButtonText      : "{{trans('orbscope.close')}}",
                    cancelButtonText       : "{{trans('orbscope.close')}}",
                    timer                  : "4000"
                });
            @endif

        </script>
    </body>

</html>