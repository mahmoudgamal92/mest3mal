<div class="col-lg-3 col-md-3 account-sidebar">
    <div class="account-bio d-flex">
        <img class="acc-avatar-bio" src="{{ShowImage(auth()->user()->image)}}">
        <div class="account-info-wrap">
            <div class="account-info">
                <span class="account-name">{{auth()->user()->name}}</span>
                <!--
                <span class="account-verified"><img src="img/tick-icon.png"></span>-->
                <span class="account-date">تاريخ التسجيل {{auth()->user()->created_at->diffForHumans()}}</span>
            </div>
        </div>
    </div> <!-- end account-bio -->
    <div class="account-links">
        <ul>
            <li @if(url()->current()==url('user/profile')) style="background-color: #34ACE0;" @endif>
                <a href="{{url('user/profile')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17.74" height="21.204" viewBox="0 0 17.74 21.204">
                        <g id="man-avatar_1_" data-name="man-avatar (1)" transform="translate(0.15 0.15)" opacity="0.8">
                            <path id="Path_2479" data-name="Path 2479" d="M92.067,10.07a4.872,4.872,0,0,0,3.56-1.475A4.872,4.872,0,0,0,97.1,5.035a4.872,4.872,0,0,0-1.475-3.56,5.034,5.034,0,0,0-7.12,0,4.872,4.872,0,0,0-1.475,3.56,4.872,4.872,0,0,0,1.475,3.56A4.873,4.873,0,0,0,92.067,10.07ZM89.373,2.341a3.808,3.808,0,0,1,5.387,0,3.64,3.64,0,0,1,1.116,2.694A3.64,3.64,0,0,1,94.76,7.728a3.808,3.808,0,0,1-5.387,0,3.639,3.639,0,0,1-1.116-2.694,3.64,3.64,0,0,1,1.116-2.694Zm0,0" transform="translate(-83.479)" fill="#fff" stroke="#fff" stroke-width="0.3"/>
                            <path id="Path_2480" data-name="Path 2480" d="M17.4,253.293a12.436,12.436,0,0,0-.169-1.321,10.406,10.406,0,0,0-.325-1.328,6.56,6.56,0,0,0-.546-1.239,4.668,4.668,0,0,0-.823-1.073,3.629,3.629,0,0,0-1.183-.743,4.087,4.087,0,0,0-1.51-.273,1.532,1.532,0,0,0-.818.347c-.245.16-.532.345-.852.55a4.885,4.885,0,0,1-1.1.486,4.283,4.283,0,0,1-2.7,0,4.87,4.87,0,0,1-1.1-.486c-.317-.2-.6-.388-.853-.55a1.531,1.531,0,0,0-.818-.347,4.082,4.082,0,0,0-1.51.273,3.627,3.627,0,0,0-1.183.743,4.67,4.67,0,0,0-.823,1.073,6.572,6.572,0,0,0-.546,1.239,10.431,10.431,0,0,0-.325,1.328,12.351,12.351,0,0,0-.169,1.321c-.028.4-.042.815-.042,1.234a3.471,3.471,0,0,0,1.031,2.626,3.711,3.711,0,0,0,2.657.969H13.753a3.711,3.711,0,0,0,2.656-.969,3.47,3.47,0,0,0,1.031-2.626c0-.421-.014-.837-.042-1.235Zm-1.833,2.973a2.5,2.5,0,0,1-1.812.631H3.687a2.5,2.5,0,0,1-1.812-.631,2.267,2.267,0,0,1-.651-1.739c0-.392.013-.778.039-1.15a11.14,11.14,0,0,1,.153-1.19,9.2,9.2,0,0,1,.286-1.171,5.35,5.35,0,0,1,.444-1.007,3.462,3.462,0,0,1,.6-.793,2.408,2.408,0,0,1,.787-.489,2.82,2.82,0,0,1,.965-.186c.043.023.119.066.243.147.252.164.542.351.863.556a6.068,6.068,0,0,0,1.384.619,5.507,5.507,0,0,0,3.452,0,6.076,6.076,0,0,0,1.385-.619c.328-.21.611-.392.862-.556.124-.081.2-.124.243-.147a2.821,2.821,0,0,1,.965.186,2.411,2.411,0,0,1,.787.489,3.452,3.452,0,0,1,.6.793,5.332,5.332,0,0,1,.444,1.007,9.179,9.179,0,0,1,.286,1.171,11.232,11.232,0,0,1,.153,1.19h0c.026.37.039.756.039,1.149a2.266,2.266,0,0,1-.651,1.739Zm0,0" transform="translate(0 -237.219)" fill="#fff" stroke="#fff" stroke-width="0.3"/>
                        </g>
                    </svg>
                    {{trans('orbscope.profile')}}</a></li>
            <li>
                <a href="{{url('/user/chat')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="15.234" viewBox="0 0 20 15.234">
                        <g id="interface_21_" data-name="interface (21)" transform="translate(0 -61)">
                            <g id="Group_584" data-name="Group 584" transform="translate(0 61)">
                                <path id="Path_2473" data-name="Path 2473" d="M18.242,61H1.758A1.761,1.761,0,0,0,0,62.758V74.477a1.761,1.761,0,0,0,1.758,1.758H18.242A1.761,1.761,0,0,0,20,74.477V62.758A1.761,1.761,0,0,0,18.242,61ZM18,62.172l-7.962,7.962L2.006,62.172ZM1.172,74.234V62.995l5.644,5.6ZM2,75.063l5.647-5.647,1.979,1.962a.586.586,0,0,0,.827,0l1.929-1.929L18,75.063Zm16.828-.829-5.617-5.617L18.828,63Z" transform="translate(0 -61)" fill="#2e2e2e" opacity="0.8"/>
                            </g>
                        </g>
                    </svg>
                    {{trans('front.messages')}}</a></li>
            <!--
            <li>
                <a href="account-notifications.html">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18.238" height="22.075" viewBox="0 0 18.238 22.075">
                        <path id="Icon_material-notifications-none" data-name="Icon material-notifications-none" d="M14.769,25.125a2.2,2.2,0,0,0,2.192-2.192H12.577A2.2,2.2,0,0,0,14.769,25.125Zm6.577-6.577V13.067c0-3.365-1.787-6.182-4.933-6.928V5.394a1.644,1.644,0,1,0-3.288,0V6.14c-3.135.745-4.933,3.552-4.933,6.928v5.481L6,20.74v1.1H23.538v-1.1Zm-2.192,1.1H10.385V13.067c0-2.718,1.655-4.933,4.385-4.933s4.385,2.214,4.385,4.933Z" transform="translate(-5.65 -3.4)" fill="#31353b" stroke="#fff" stroke-width="0.7" opacity="0.8"/>
                    </svg>
                    {{trans('front.notfications')}}</a></li>-->

            <li @if(url()->current()==url('user/all_ads')) style="background-color: #34ACE0;" @endif>
                <a href="{{url('/user/all_ads')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="15.234" viewBox="0 0 20 15.234">
                        <g id="interface_21_" data-name="interface (21)" transform="translate(0 -61)">
                            <g id="Group_584" data-name="Group 584" transform="translate(0 61)">
                                <path id="Path_2473" data-name="Path 2473" d="M18.242,61H1.758A1.761,1.761,0,0,0,0,62.758V74.477a1.761,1.761,0,0,0,1.758,1.758H18.242A1.761,1.761,0,0,0,20,74.477V62.758A1.761,1.761,0,0,0,18.242,61ZM18,62.172l-7.962,7.962L2.006,62.172ZM1.172,74.234V62.995l5.644,5.6ZM2,75.063l5.647-5.647,1.979,1.962a.586.586,0,0,0,.827,0l1.929-1.929L18,75.063Zm16.828-.829-5.617-5.617L18.828,63Z" transform="translate(0 -61)" fill="#2e2e2e" opacity="0.8"/>
                            </g>
                        </g>
                    </svg>
                    {{trans('front.My_Ads')}}</a>
            </li>

            <li @if(url()->current()==url('user/all_auctions')) style="background-color: #34ACE0;" @endif>
                <a href="{{url('/user/all_auctions')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="15.234" viewBox="0 0 20 15.234">
                        <g id="interface_21_" data-name="interface (21)" transform="translate(0 -61)">
                            <g id="Group_584" data-name="Group 584" transform="translate(0 61)">
                                <path id="Path_2473" data-name="Path 2473" d="M18.242,61H1.758A1.761,1.761,0,0,0,0,62.758V74.477a1.761,1.761,0,0,0,1.758,1.758H18.242A1.761,1.761,0,0,0,20,74.477V62.758A1.761,1.761,0,0,0,18.242,61ZM18,62.172l-7.962,7.962L2.006,62.172ZM1.172,74.234V62.995l5.644,5.6ZM2,75.063l5.647-5.647,1.979,1.962a.586.586,0,0,0,.827,0l1.929-1.929L18,75.063Zm16.828-.829-5.617-5.617L18.828,63Z" transform="translate(0 -61)" fill="#2e2e2e" opacity="0.8"/>
                            </g>
                        </g>
                    </svg>
                    {{trans('front.Auctions')}}</a>
            </li>


            <li @if(url()->current()==url('user/orders')) style="background-color: #34ACE0;" @endif>

                <a href="{{url('/user/orders')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23">
                        <g id="cart" transform="translate(-11 -11)">
                            <g id="Group_1822" data-name="Group 1822" transform="translate(11 11)">
                                <path id="Path_3106" data-name="Path 3106" d="M32.287,24.617,34,16.262H17.116l-.587-2.779L11.441,11,11,11.878l4.647,2.244L17.994,25.33H31.559s1.338.84.821,1.9a1.463,1.463,0,0,1-1.225.732h-13.5v.967h13.5a2.438,2.438,0,0,0,2.154-1.267C34.178,26.049,32.287,24.617,32.287,24.617Zm-13.457-.268-1.516-7.116H32.827l-1.469,7.116Z" transform="translate(-11 -11)" fill="#31353b"/>
                                <path id="Path_3107" data-name="Path 3107" d="M174.459,422.1a1.849,1.849,0,1,0,1.859,1.849A1.852,1.852,0,0,0,174.459,422.1Zm0,2.727a.878.878,0,1,1,.882-.878A.877.877,0,0,1,174.459,424.827Z" transform="translate(-165.015 -402.803)" fill="#31353b"/>
                                <path id="Path_3108" data-name="Path 3108" d="M387.159,422.1a1.852,1.852,0,1,0,0,3.7,1.82,1.82,0,0,0,1.859-1.849A1.856,1.856,0,0,0,387.159,422.1Zm.882,1.854a.882.882,0,1,1-.882-.878A.847.847,0,0,1,388.041,423.954Z" transform="translate(-367.731 -402.803)" fill="#31353b"/>
                            </g>
                        </g>
                    </svg>
                    {{trans('front.my_orders')}}</a></li>

            <li @if(url()->current()==url('user/favorite_ads')) style="background-color: #34ACE0;" @endif>
                <a  href="{{url('/user/favorite_ads')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22.166" height="19.893" viewBox="0 0 22.166 19.893">
                        <path id="heart" d="M10.333,18.083c.815-.78,5.468-5.234,8.377-8.016a5.644,5.644,0,0,0,.181-8.382,6.246,6.246,0,0,0-8.558.022,6.246,6.246,0,0,0-8.558-.022,5.644,5.644,0,0,0,.181,8.382l8.376,8.016" transform="translate(0.75 0.75)" fill="none" stroke="#31353b" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" opacity="0.8"/>
                    </svg>
                    {{trans('front.Favorite_ads')}}</a>
            </li>

            <li @if(url()->current()==url('user/wallet')) style="background-color: #34ACE0;" @endif>


                <a href="{{url('user/wallet')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19.922" viewBox="0 0 20 19.922">
                        <g id="wallet_1_" data-name="wallet (1)" transform="translate(0 -1)">
                            <g id="Group_1839" data-name="Group 1839" transform="translate(0 1)">
                                <path id="Path_3116" data-name="Path 3116" d="M18.242,9.437h-.156V6.82a1.76,1.76,0,0,0-1.758-1.758h-.117V2.836a.586.586,0,0,0-.586-.586H11.836V1.586A.586.586,0,0,0,11.25,1H1.875a.586.586,0,0,0-.586.586V5.126A1.761,1.761,0,0,0,0,6.82V19.164a1.76,1.76,0,0,0,1.758,1.758h14.57a1.76,1.76,0,0,0,1.758-1.758V15.609h.156A1.76,1.76,0,0,0,20,13.852V11.2A1.76,1.76,0,0,0,18.242,9.437Zm-3.2-6.016V5.063h-3.2V3.422ZM2.461,2.172h8.2V5.063h-8.2ZM16.328,19.75H1.758a.587.587,0,0,1-.586-.586v-.742H16.914v.742A.587.587,0,0,1,16.328,19.75Zm.586-2.5H1.172V6.82a.587.587,0,0,1,.586-.586h14.57a.587.587,0,0,1,.586.586V9.437H13.047A1.76,1.76,0,0,0,11.289,11.2v2.656a1.76,1.76,0,0,0,1.758,1.758h3.867Zm1.914-3.4a.587.587,0,0,1-.586.586h-5.2a.587.587,0,0,1-.586-.586V11.2a.587.587,0,0,1,.586-.586h5.2a.587.587,0,0,1,.586.586Z" transform="translate(0 -1)" fill="#31353b"/>
                            </g>
                            <g id="Group_1840" data-name="Group 1840" transform="translate(13.79 11.938)">
                                <path id="Path_3117" data-name="Path 3117" d="M354.172,281.478a.586.586,0,1,0-.4.675A.586.586,0,0,0,354.172,281.478Z" transform="translate(-353.012 -281.007)" fill="#31353b"/>
                            </g>
                        </g>
                    </svg>
                    {{trans('front.my_wallet')}}</a></li></li>
        </ul>
    </div>
</div>