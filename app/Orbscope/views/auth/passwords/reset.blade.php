
<!doctype html>
<html lang="{{GetLanguage()}}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="UTF-8">
    <meta name="keywords" content="{{ VarByLang(GetSettings()->keywords, GetLanguage()) }}">
    <meta name="description" content="{{ VarByLang(GetSettings()->footer_desc, GetLanguage()) }}">
    <meta name="author" content="alweseemy">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if(isset($title)) {{$title}} || {{ VarByLang(GetSettings()->name, GetLanguage()) }} @else{{ VarByLang(GetSettings()->name, GetLanguage()) }}@endif</title>
    <link href="{{asset('uploads/'.GetSettings()->icon)}}" rel="shortcut icon" type="image/png">


    <link rel="stylesheet" href="{{url('orbscope/front')}}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url('orbscope/front')}}/css/bootstrap.css">
    <link rel="stylesheet" href="{{url('orbscope/front')}}/css/slick.css">
    <link rel="stylesheet" href="{{url('orbscope/front')}}/css/style.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Custome css -
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
     ---->
    @yield('css')
    <style>
        @media screen and (max-width: 600px) {
            .mini_ads {
                display: contents !important;
            }
        }
    </style>

</head>
<body>
<!-- top header and main header -->
<div class="row col-12 top-header align-items-center m-0">
    <div class="col-10 top-header-left">
        <a href="{{url('/terms_conditions')}}">{{trans('orbscope.terms_conditions')}}</a>
        <a href="{{url('/How_does_work')}}">{{trans('front.How_does_work')}}</a>
    </div>
    <div class="col-2 top-header-right langue_text d-flex justify-content-end">
        <div class="dropdown">
            <select onchange="window.location.href = this.value" class="btn btn-link dropdown-toggle control locale-switcher styled-select">
                <option value="?currency=USD" selected="selected">{{trans('orbscope.language')}}</option>
                <option value="{{ url('/lang/en') }}">الإنجليزية</option>
                <option value="{{ url('/lang/ar') }}">عربى</option>
            </select>
            <i class="fas fa-sort-down"></i>
        </div>

    </div>
</div><!-- top header close  -->
<div class="row main-header py-4 align-items-center m-0">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="logo-section">
            <nav id="sidebar" class="d-flex justify-content-between">
                <a href="{{url('/')}}"><img class="min_logo" src="{{ShowImage(GetSettings()->logo)}}"></a>
                <span type="button" class="btn collapge-menu d-none d-lg-block popover-icon"
                      tabindex="0" type="button" data-popover-content="#account-categories" data-toggle="popover" data-placement="bottom">
                  <a class="avatar-wrapper d-flex">
                    <i class="fas fa-bars"></i>
                  </a>
                </span>
                <div id="account-categories" class="d-none">
                    <div class="popover-body">
                        <div class="modelcontent">
                            <div class="col-12 p-0">
                                <div class="menu_cate_list popover-custom">
                                    <ul>
                                        @foreach(\App\Orbscope\Models\Department::all() as $de)
                                            <li><a href="{{url('main/'.$de->id.'/'.str_replace(' ', '_', VarByLang($de->name,GetLanguage())))}}"><img src="{{ShowImage($de->image)}}">{{VarByLang($de->name,GetLanguage())}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <span type="button" id="sidebarCollapse" class="collapge-menu btn d-lg-none">
                  <i class="fas fa-bars"></i>
                </span>
                <ul class="list-unstyled components">
                    <div id="close-nav" class="p-3 text-right w-100 text-light">
                        <i class="fas fa-times"></i>
                    </div>
                    @foreach(\App\Orbscope\Models\Department::all() as $de)
                        <li><a href="{{url('main/'.$de->id.'/'.str_replace(' ', '_', VarByLang($de->name,GetLanguage())))}}"><img src="{{ShowImage($de->image)}}">{{VarByLang($de->name,GetLanguage())}}</a></li>
                    @endforeach
                </ul>
                <div class="nav-overlay"></div>
            </nav>
        </div>
    </div>
    <div class="col-md-5 col-sm-12 d-none d-lg-block">
        <div class="row align-items-center header-filter">
            <form class="col-md-8 col-sm-12" action="{{url('/search')}}" method="get">
                <div class="form-group categories-sort d-flex justify-content-center">
                    <input name="title" type="search" class="form-control" placeholder="{{trans('orbscope.search')}}">
                    <select name="depart_id" id="inputState" class="form-control">
                        <option value="">{{trans('front.select_cat')}}</option>
                        @foreach(\App\Orbscope\Models\Department::all() as $de)
                            <option value="{{$de->id}}">{{VarByLang($de->name,GetLanguage())}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <div class="col-md-4 col-sm-12">

                <a class="custom-btn" href="{{url('/auctions')}}"><img src="{{url('orbscope/front')}}/img/notification-icon.png" alt="image">{{trans('front.Auctions')}}</a>

            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12 mt-sm-0 ml-0 account-wrap row justify-content-between align-items-center">


        @if (Auth::check())
            <div class="wishlist-head">
            <span onclick="window.location='{{url('/user/favorite_ads')}}'"  class="popover-icon"
                  tabindex="0" data-popover-content="#account-favorite" data-toggle="popover" data-placement="bottom">
                <a class="avatar-wrapper d-flex">
                  <i class="fas fa-heart"></i>
                </a>
              </span>
                <div id="account-favorite" style="display:none;">

                </div>
            </div>
            <div class="messages-head">
            <span  class="popover-icon"
                   tabindex="0" data-popover-content="#account-notification" data-toggle="popover" data-placement="bottom">
                <a class="avatar-wrapper d-flex">
                  <i class="fas fa-bell"></i>
                    <span style="color: black;background-color: #34ACE0;border-radius: 50%;font-size: 85%;position: absolute;bottom: 15px;" class="badge badge-light">{{ auth()->user()->unreadNotifications->count()}}</span>
                </a>
              </span>
                <div id="account-notification" style="display:none;">
                    <div class="popover-body">
                        <div class="popover-custom acc-notification">
                            <h5 class="acc-title">{{trans('front.attention')}}</h5>
                            <div class="acc-alert">
                                <ul>
                                    @foreach(auth()->user()->Notifications->take(6) as $mes)
                                        <li><a href="{{url($mes->data['url'])}}">{{GetLanguage()=='ar'?$mes->data['ar']:$mes->data['en']}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sign-in-links">

                <div class="account-links">

                    <div class="account-wrapper">
                        <a class="avatar-wrapper d-flex" tabindex="0" type="button" class="popover-icon" data-popover-content="#account-menu" data-toggle="popover" data-placement="bottom">
                            <img class="account-avatar" src="{{url('orbscope/front')}}/img/user-icon3.png">
                            <span class="account-arrow"><i class="fas fa-sort-down" aria-hidden="true"></i></span>
                        </a>
                        <div id="account-menu" style="display:none;">
                            <div class="popover-body">
                                <div class="acc-links popover-custom">
                                    <ul style="text-align: {{GetLanguage()=='ar'?'right':''}}">
                                        <li><a href="{{url('/user/profile')}}">{{trans('orbscope.profile')}}</a></li>
                                        <li><a href="{{url('/user/add_ads')}}">{{trans('orbscope.add')}} {{trans('front.ad')}}</a></li>
                                        <li><a href="{{url('/user/all_ads')}}">{{trans('front.My_Ads')}}</a></li>
                                        <li><a href="{{url('/user/chat')}}">{{trans('front.messages')}} </a></li>
                                        <li><a href="{{ route('logout') }}">{{trans('orbscope.logout')}} </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <a type="button" class="" data-toggle="modal" data-target="#loginmodal">
                <i class="fas fa-user" aria-hidden="true"></i>      {{trans('front.Sign_Join')}}
            </a>
        @endif
    </div>
</div>
<!-- header-close -->
<!-- Modal -->
<div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger" dir="{{GetDirection()}}">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form  method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="InputEmail1">{{trans('orbscope.email')}}</label>
                        <input type="email" name="email" class="form-control InputEmail1" required id="InputEmail1" aria-describedby="emailHelp" placeholder="عنوان بريدك الإلكتروني">
                        <small id="emailHelp"  class="form-text text-muted">{{trans('front.We_not_share_email_anyone')}}</small>
                    </div>
                    <div class="form-group">
                        <label for="InputPassword1">{{trans('orbscope.password')}}</label>
                        <div class="password-wrap d-flex">
                            <input type="password" name="password" required class="form-control InputPassword1 border-right-0" id="InputPassword1" placeholder="اكتب كلمة المرور الخاصة بك" data-toggle="password">

                        </div>
                    </div>
                    <br/>
                    <button type="submit" class="btn submit-btn w-100">{{trans('orbscope.login')}}</button>
                </form>
                <div class="other-logins">
                    <p>{{trans('orbscope.or')}}</p>
                    <p>{{trans('front.start_with')}}</p>
                    <ul class="social-login d-flex justify-content-around">
                        <li>
                            <a href="{{url('/register')}}">
                                {{trans('orbscope.create_account')}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- mobile filter -->


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: {{GetLanguage()=='ar'?'right':''}}">{{trans('orbscope.rest_pass')}}</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('reset-password') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{trans('orbscope.email')}}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{{trans('orbscope.password')}}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">{{trans('orbscope.password_confirmation')}}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br/>
                        <br/>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-refresh"></i> {{trans('orbscope.save')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<br/>




<footer class="footer-section">
    <div class="footer-news text-center">
        <h3>{{trans('front.Keep_lates_informations')}}</h3>
        <form class="d-flex justify-content-center" action="{{url('news/add_email')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group w-100">
                <input type="email" required name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{trans('orbscope.email')}}">
            </div>
            <button type="submit" class="btn submit-btn"><i class="fas fa-paper-plane"></i></button>
        </form>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-12 footer-about">
                <a href="{{url('/')}}"><img src="{{ShowImage(GetSettings()->logo)}}"></a>
                <p>
                    {{VarByLang(GetSettings()->footer_desc,GetLanguage())}}
                </p>
                <ul class="footer-social">
                    <li>
                        <a href="{{GetSettings()->facebook}}"><i class="fab fa-facebook-square"></i></a>
                    </li>
                    <li>
                        <a href="{{GetSettings()->twitter}}"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="{{GetSettings()->googleplus}}"><i class="fab fa-instagram"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-2 col-12 about_links">
                <h5>{{trans('orbscope.general')}}</h5>
                <ul class="footer-links">
                    <li><a href="{{url('/How_does_work')}}">{{trans('front.How_does_work')}}</a></li>
                    <li><a href="{{url('/terms_conditions')}}">{{trans('orbscope.terms_conditions')}}</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-12 user_links">
                <h5>{{trans('front.for_users')}}</h5>
                <ul class="footer-links">
                    @if (Auth::check())
                        <li><a href="{{url('/user/profile')}}">{{trans('front.Account_settings')}}</a></li>
                        <li><a href="{{url('/user/favorite_ads')}}">{{trans('front.Wish_List')}}</a></li>
                    @else
                        <li><a href="{{url('/login')}}">{{trans('orbscope.login')}}</a></li>
                        <li><a href="{{url('/login')}}">{{trans('orbscope.create_account')}}</a></li>
                        <li><a href="{{url('/login')}}">{{trans('front.Account_settings')}}</a></li>
                        <li><a href="{{url('/login')}}">{{trans('front.Wish_List')}}</a></li>

                    @endif
                </ul>
            </div>
            <div class="col-lg-3 col-12">
                <h5>{{trans('front.our_app')}}</h5>
                <ul class="footer-app-link">
                    <li>
                        <a href="#">
                            <img src="{{url('orbscope/front')}}/img/app-store.jpg">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('orbscope/front')}}/img/google-play.jpg">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="copyright row">
            <div class="col-md-6">
                <p>  كل الحقوق محفوظة مستعمل 2022 </p>
            </div>

        </div>
    </div>
</footer>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS

<script src="{{url('orbscope/front')}}/jquery-3.6.0.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"  ></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<script type="text/javascript" src="{{url('orbscope/front')}}/js/wow.js"></script>
<script type="text/javascript" src="{{url('orbscope/front')}}/js/wow.min.js"></script>
<script src="{{url('orbscope/front')}}/js/a076d05399.js"></script>
<script type="text/javascript" src="{{url('orbscope/front')}}/js/slick.min.js"></script><script src="{{url('orbscope/front')}}/js/main.js"></script>
<script>
    $('.popover-icon').on('click',function () {

        $.get('MarkAllSeen',function () {

        })
    });
</script>
@yield('js')
</body>

</html>