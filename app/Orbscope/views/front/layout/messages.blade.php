@if (count($errors) > 0)
    <div class="alert alert-danger" dir="{{GetDirection()}}">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session()->has('message'))

    <div class="alert alert-success" dir="ar">
        <ul>
            لقد تم ارسال الرسالة شكرا لتواصلكم
        </ul>
    </div>
@endif

@if(session()->has('register'))
    <div class="alert-wrapper" id="alert-success" style="background-color: gainsboro;">
        <div id="success">

            <div class="wrapper" style="background-color: lightgreen">
                <p>  لقد تم التسجيل سيتم التواصل لاحقا وشكرا.</p>
            </div>
        </div>
    </div>

    @endif
@if(session()->has('success'))
    <script>
        swal({
            title: '{{trans('orbscope.success')}}',
            type: 'success',
            icon: 'success',
            timer: 2000
        });
    </script>

@endif
@if(session()->has('message_reset_send'))
    <script>
        swal({
            title: 'تم ارسال الرسالة الي البريد الخاص بك !',
            type: 'success',
            icon: 'success',
            timer: 2000
        });
    </script>

@endif
@if(session()->has('password_has_ghange'))
    <script>
        swal({
            title: 'تم تغير كلمة السر بنجاح',
            type: 'success',
            icon: 'success',
            timer: 2000
        });
    </script>

@endif
@if(session()->has('email_error'))
    <script>
        swal({
            title: '{{trans('front.email_error')}}',
            type: 'error',
            icon: 'error',
            timer: 2000
        });
    </script>

@endif

@if(session()->has('noblance'))
    <script>
        swal({
            title: '{{trans('front.noblance')}}',
            type: 'error',
            icon: 'error',
            timer: 2000
        });
    </script>

@endif
@if(session()->has('time_end'))
    <script>
        swal({
            title: '{{trans('front.time_end')}}',
            type: 'error',
            icon: 'error',
            timer: 2000
        });
    </script>

@endif
@if(session()->has('cant_delete'))
    <script>
        swal({
            title: '{{trans('front.cant_delete')}}',
            type: 'error',
            icon: 'error',
            timer: 2000
        });
    </script>

@endif


@if(session()->has('updated'))
    <script>
        swal({
            title: '{{trans('orbscope.updated')}}',
            type: 'success',
            html: true,
            timer: 2000
        });
    </script>
@endif

@if(session()->has('success_order'))
    <div class="alert-wrapper" id="alert-success" style="background-color: gainsboro;">
        <div id="success">

            <div class="wrapper" style="background-color: rgba(157,255,157,0.68);text-align: center" >
                <p style="color: green;">{{trans('front.success_order')}}</p>
            </div>
        </div>
    </div>

@endif





@if(session()->has('success_profile'))
    <div class="alert-wrapper" id="alert-success" style="background-color: gainsboro;">
        <div id="success">

            <div class="wrapper" style="background-color: lightgreen">
                <p> تم التعديل.</p>
            </div>
        </div>
    </div>
@endif



