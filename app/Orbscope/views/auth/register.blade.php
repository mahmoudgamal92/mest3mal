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


    <div class="login-wraper overlay-hide">
        <div class="container" style="text-align: {{GetLanguage()=='ar'?'right':''}};">
            <div class="row  justify-content-center" style="background-color: aliceblue;">
                <div class="col-md-4" >
                    <div class="login-sections b-radius-10 bx-shadow register-steps " style="background-color: #5bbce724;margin-top: 40px;padding: 10px;" >
                        <p> {{trans('orbscope.pledge')}}    </p>
                        <p>{{trans('orbscope.the_commission_trust')}}  </p>
                        <p>{{trans('orbscope.because_outside')}} </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="login-sections b-radius-10 bx-shadow register-steps " style="margin-top: 20px;margin-bottom: 20px;">

                        @include('front.layout.messages')
                        <form  action="{{ url('/register') }}" method="post">
                            {{ csrf_field() }}
                            <label><h4>{{trans('orbscope.name')}}</h4></label>
                            <div class="field-form">  <input class="form-control" type="text" required value="{{old('name')}}" name="name" placeholder="{{trans('orbscope.name')}}" > </div>
                            <label><h4>{{trans('orbscope.email')}}</h4></label>
                            <div class="field-form"> <input  class="form-control" type="email" required value="{{old('email')}}" name="email" placeholder="example@gmail.com" > </div>
                            <label><h4>{{trans('orbscope.mobile')}}</h4></label>
                            <div class="field-form"> <input class="form-control" type="number" required value="{{old('phone')}}" name="phone"  > </div>
                            <label><h4>{{trans('orbscope.password')}}</h4></label>
                            <div class="field-form">  <input class="form-control" type="password" required name="password"  > </div>
                            <label><h4>{{trans('orbscope.password_confirmation')}}</h4></label>
                            <div class="field-form">  <input type="password" class="form-control" required name="password_confirmation"  > </div>
                            <br/>
                            <div class="col-md-12" style="display: inline-flex;">
                            <div class="col-md-2">
                            <input type="checkbox" class="form-control" style="margin-top: 7px;" required name="condation"  >
                            </div>
                            <div class="col-md-10">
                            <label> <h6>{{trans('orbscope.accept_condation')}} <a target="_blank" href="{{url('/terms_conditions')}}">{{trans('orbscope.terms_conditions')}}</a></h6>  </label>
                            </div>
                            </div>

                            <br/>
                            <button type="submit" class="btn btn-green full-btns register-now register-now-next" style="background-color: #34ACE0;color: white;" >{{trans('orbscope.register')}}</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection

