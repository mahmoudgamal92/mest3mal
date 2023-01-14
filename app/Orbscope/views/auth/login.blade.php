@extends('front.layout.app')

@section('css')
    @if(GetLanguage()=='ar')
        <style>
            input{
                text-align: right;
            }
        </style>
    @endif
@endsection
@section('content')



        <!-- start hero-header -->



        <div class="login-wraper" style="background:url({{url('orbscope/front')}}/images/login-page.jpg);">
            @include('front.layout.messages')
            <div class="container"  style="text-align: {{GetLanguage()=='ar'?'right':''}};">
                <div class="row align-items-center justify-content-center" style="background-color: aliceblue;">

                    <div class="col-sm-12 col-md-7 col-lg-5"> <br/>

                        <div class="login-sections b-radius-10 bx-shadow ">
                            <h1>{{trans('orbscope.login')}}</h1>
                            <br/>
                            <form  role="form" method="POST" action="{{ url('/login') }}">
                                {{ csrf_field() }}
                                <label><h4>{{trans('orbscope.email')}}</h4></label>
                                <div class="field-form">  <input   class="form-control"  id="email" placeholder="{{trans('orbscope.email')}}" type="email"  name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                               <strong>{{ $errors->first('email') }}</strong>
                                                 </span>
                                    @endif </div>
                                <label><h4>{{trans('orbscope.password')}}</h4></label>
                                <div class="field-form">

                                    <input id="password" type="password" placeholder="{{trans('orbscope.password')}}" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                                           <strong>{{ $errors->first('password') }}</strong>
                                                       </span>
                                    @endif

                                </div>
                                <div class="field-form-half">
                                    <!--
                                    <a href="{{ route('password.request') }}">{{trans('orbscope.forget_password')}}</a>-->
                                    <a href="{{ url('forget-password') }}">{{trans('orbscope.forget_password')}}</a>
                                </div>
                                <br/>
                                <button style="background-color: #0275d8;" type="submit" class="btn btn-green full-btns" >{{trans('orbscope.login')}}</button>
                            </form>
                            <br/>
                        </div>
                    </div>

                </div>
            </div>
        </div>






        <!-- end hero-header -->



@endsection
