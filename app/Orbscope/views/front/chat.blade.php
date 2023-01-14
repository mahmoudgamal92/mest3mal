<!doctype html>
<html lang="{{GetLanguage()}}">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
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

  <!-- Custome css -
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
   ---->
 <style>
   .smal_img{
     height: 45px;
   }
   @if(GetLanguage()=='ar')

     ul.all-chats li {
     padding: 10px 60px 10px 10px;
   }
   ul.all-chats li img {
     left: auto;
     right: 10px;
   }
   span.chat-time {
     left: 9px;
     right: auto;
   }
   .user-p {
     padding-right: 60px;
     padding-left: 10px;
   }
   .user-p img {
     right: 10px;
     left: auto;
   }
   li.left-align-chat {
     text-align: right;
   }
   li.right-align-chat {
     text-align: left;
   }
   li.chat-bx span.white-chat::after {
     left: auto;
     right: 8px;
   }

   li.chat-bx span.green-chat::after {
     right: auto;
     left: 8px;
   }
   li.chat-bx span::after {
     -webkit-transform: scaleX(-1);
     transform: scaleX(-1);
   }
   .right-chat-history {
     border-left: 0;
     border-right: 3px;
   }

   .chat-btm-typing button.btn {
     float: left;
     padding: 0 0 0 0;
   }
   .chat-btm-typing i.fa.fa-paperclip {
     left: auto;
     right: 16px;

   .notif-chats > div {
     text-align: right;
   }
   .notif-chats > div i.fa, .notif-chats > div > button > img {
     margin-right: 0;
     margin-left: 10px;
   }
   .notif-chats > div > button {
     text-align: right;
   }
   .login-signup a {
     margin-right: 0;
     margin-left: 0;
   }
   .chat-left-d.chat-swipe, .chat-right-d.chat-swipe {
     left: auto;
     right: -100%;
   }
   .chat-btm-typing textarea {
     padding: 11px 39px 11px 57px;
   }
   .textatt{
     border: solid 2px #959589d1 !important;
   }
   .msg_card_body{
     overflow: auto;
   }

  @endif
 </style>
  <link href="{{asset('/css/app.css')}}">
</head>
<body>
<div id="app">
  <div class="row col-12 top-header align-items-center m-0">
    <div class="col-10 top-header-left">
      <a href="{{url('/')}}"><img style="max-height: 40px;" src="{{ShowImage(GetSettings()->logo)}}"></a>
      <a href="{{url('/')}}">{{trans('front.home')}}</a>
      <a href="{{url('user/profile')}}">{{trans('orbscope.profile')}}</a>
      <a href="{{url('/user/all_ads')}}">{{trans('front.My_Ads')}}</a>
      <a href="{{url('user/all_auctions')}}">{{trans('front.Auctions')}}</a>
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

  <!-- header-close -->
  <!-- Modal -->

  <!-- mobile filter -->



  <div class="main-products pt-3 pb-5" style="">
    <div class="container">
      <div class="row m-0">

        <chat-component :user="{{auth()->user()}}"></chat-component>

      </div>
    </div>
  </div>






  <footer class="footer-section">

    <div class="container">

      <div class="copyright row">
        <div class="col-md-6">
          <p>2022 alweseemy. كل الحقوق محفوظة. </p>
        </div>

      </div>
    </div>
  </footer>

</div>

<script src="{{asset('js/app.js')}}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"  ></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  <script type="text/javascript" src="{{url('orbscope/front')}}/js/wow.js"></script>
  <script type="text/javascript" src="{{url('orbscope/front')}}/js/wow.min.js"></script>
  <script src="{{url('orbscope/front')}}/js/a076d05399.js"></script>
  <script type="text/javascript" src="{{url('orbscope/front')}}/js/slick.min.js"></script><script src="{{url('orbscope/front')}}/js/main.js"></script>
@yield('js')

</body>

</html>