<script>
    $(document).ready(function () {
        var search = $("#search_menu").quicksearch("li");
    });
</script>
<!-- BEGIN SIDEBAR -->

<div class="page-sidebar-wrapper">

    <div class="page-sidebar navbar-collapse collapse">



        <div style="margin: 10px;padding: 0px" class="form-group form-md-line-input has-info sidebar-search-wrapper">
            <div class="input-group">
                <input type="text" class="form-control" id="search_menu" placeholder="{{trans('orbscope.search_menu')}}">
                <span class="input-group-addon">
                    <i class="fa fa-search"></i>
                </span>
            </div>
        </div>
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>

            <li class="nav-item start {{ActiveAdminMenu('/')}}">
                <a href="{{url(AdminPath())}}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">{{trans('orbscope.dashboard')}}</span>
                    <span class="selected"></span>
                </a>
            </li>

            @if (auth()->user()->can('Settings'))
                <li class="heading">
                    <h3 class="uppercase">{{trans('log.settings')}}</h3>
                </li>

                <li class="nav-item {{ActiveAdminMenu('settings')}}">
                    <a href="{{url(AdminPath().'/settings')}}" class="nav-link nav-toggle">
                        <i class="fa fa-cog"></i>
                        <span class="title">{{trans('log.settings')}}</span>
                        <span class="selected"></span>
                    </a>
                </li>






            @endif



            @if (auth()->user()->can('Department'))

            <li class="nav-item {{ ActiveAdminMenu('department') }}">
                <a href="javascript:" class="nav-link nav-toggle">
                    <i class="fa fa-server"></i>
                    <span class="title">{{trans('orbscope.departments')}}  </span>
                    <span class="arrow {{ ActiveAdminMenu('department') }}"></span>
                </a>
                <ul class="sub-menu">

                        <li class="nav-item {{ActiveAdminLink('department.create')}}">
                            <a href="{{url(AdminUrl('department/create'))}}" class="nav-link ">
                                <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.department')}}</span>
                            </a>
                        </li>


                        <li class="nav-item  {{ActiveAdminLink('department.index')}}">
                            <a href="{{url(AdminUrl('department'))}}" class="nav-link ">
                                <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.departments')}}</span>
                            </a>
                        </li>

                </ul>
            </li>

           @endif


            @if (auth()->user()->can('Category'))
                <li class="nav-item {{ ActiveAdminMenu('category') }}">
                    <a href="javascript:" class="nav-link nav-toggle">
                        <i class="fa fa-server"></i>
                        <span class="title">{{trans('orbscope.categorys')}}</span>
                        <span class="arrow {{ ActiveAdminMenu('category') }}"></span>
                    </a>
                    <ul class="sub-menu">

                            <li class="nav-item {{ActiveAdminLink('category.create')}}">
                                <a href="{{url(AdminUrl('category/create'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.category')}}</span>
                                </a>
                            </li>



                            <li class="nav-item  {{ActiveAdminLink('category.index')}}">
                                <a href="{{url(AdminUrl('category'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.categorys')}}</span>
                                </a>
                            </li>

                    </ul>
                </li>

            @endif


            @if (auth()->user()->can('Sub Category'))

                    <li class="nav-item {{ ActiveAdminMenu('sub_category') }}">
                        <a href="javascript:" class="nav-link nav-toggle">
                            <i class="fa fa-server"></i>
                            <span class="title">{{trans('orbscope.sub_categories')}}</span>
                            <span class="arrow {{ ActiveAdminMenu('sub_category') }}"></span>
                        </a>
                        <ul class="sub-menu">

                                <li class="nav-item {{ActiveAdminLink('sub_category.create')}}">
                                    <a href="{{url(AdminUrl('sub_category/create'))}}" class="nav-link ">
                                        <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.sub_category')}}</span>
                                    </a>
                                </li>


                                <li class="nav-item  {{ActiveAdminLink('sub_category.index')}}">
                                    <a href="{{url(AdminUrl('sub_category'))}}" class="nav-link ">
                                        <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.sub_categories')}}</span>
                                    </a>
                                </li>

                        </ul>
                    </li>

            @endif









        @if (auth()->user()->can('States'))
            <li class="nav-item {{ ActiveAdminMenu('countries') }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-globe-alt"></i>
                    <span class="title">{{trans('orbscope.countries')}}</span>
                    <span class="arrow {{ ActiveAdminMenu('countries') }}"></span>
                </a>
                <ul class="sub-menu">

                        <li class="nav-item {{ActiveAdminLink('countries.create')}}">
                            <a href="{{url(AdminUrl('countries/create'))}}" class="nav-link ">
                                <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.countries')}}</span>
                            </a>
                        </li>


                        <li class="nav-item  {{ActiveAdminLink('countries.index')}}">
                            <a href="{{url(AdminUrl('countries'))}}" class="nav-link ">
                                <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.countries')}}</span>
                            </a>
                        </li>

                </ul>
            </li>
            @endif

            @if (auth()->user()->can('Cities'))

                <li class="nav-item {{ ActiveAdminMenu('cities') }}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-direction"></i>
                        <span class="title">{{trans('orbscope.cities')}}</span>
                        <span class="arrow {{ ActiveAdminMenu('cities') }}"></span>
                    </a>
                    <ul class="sub-menu">

                            <li class="nav-item {{ActiveAdminLink('cities.create')}}">
                                <a href="{{url(AdminUrl('cities/create'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.cities')}}</span>
                                </a>
                            </li>



                            <li class="nav-item  {{ActiveAdminLink('cities.index')}}">
                                <a href="{{url(AdminUrl('cities'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.cities')}}</span>
                                </a>
                            </li>

                    </ul>
                </li>


            @endif
            @if (auth()->user()->can('Services'))
            <li class="nav-item {{ ActiveAdminMenu('services') }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-gears"></i>
                    <span class="title">{{trans('orbscope.services')}} </span>
                    <span class="arrow {{ ActiveAdminMenu('services') }}"></span>
                </a>
                <ul class="sub-menu">

                        <li class="nav-item {{ActiveAdminLink('services.create')}}">
                            <a href="{{url(AdminUrl('services/create'))}}" class="nav-link ">
                                <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.services')}} </span>
                            </a>
                        </li>



                        <li class="nav-item  {{ActiveAdminLink('services.index')}}">
                            <a href="{{url(AdminUrl('services'))}}" class="nav-link ">
                                <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.services')}} </span>
                            </a>
                        </li>

                </ul>
            </li>
            @endif







            @if (auth()->user()->can('Ads'))
            <li class="nav-item {{ActiveAdminMenu('ads')}}">
                <a href="{{url(AdminPath().'/ads')}}" class="nav-link nav-toggle">
                    <i class="fa fa-server"></i>
                    <span class="title">{{trans('front.ads')}}</span>
                    <span class="selected"></span>
                </a>
            </li>
            @endif
            @if (auth()->user()->can('Auctions'))
            <li class="nav-item {{ActiveAdminMenu('auctions')}}">
                <a href="{{url(AdminPath().'/auctions')}}" class="nav-link nav-toggle">
                    <i class="fa fa-server"></i>
                    <span class="title">{{trans('front.Auctions')}}</span>
                    <span class="selected"></span>
                </a>
            </li>
            @endif
            @if (auth()->user()->can('Orders'))
            <li class="nav-item {{ActiveAdminMenu('orders')}}">
                <a href="{{url(AdminPath().'/orders')}}" class="nav-link nav-toggle">
                    <i class="fa fa-server"></i>
                    <span class="title">{{trans('front.orders')}}</span>
                    <span class="selected"></span>
                </a>
            </li>
            @endif

            @if (auth()->user()->can('Users'))
            <li class="nav-item {{ActiveAdminMenu('users')}}">
                <a href="{{url(AdminPath().'/users')}}" class="nav-link nav-toggle">
                    <i class="fa fa-user"></i>
                    <span class="title">{{trans('orbscope.users')}}</span>
                    <span class="selected"></span>
                </a>
            </li>
            @endif

            @if (auth()->user()->can('News'))
            <li class="nav-item {{ActiveAdminMenu('news')}}">
                <a href="{{url(AdminPath().'/news')}}" class="nav-link nav-toggle">
                    <i class="fa fa-user"></i>
                    <span class="title">المشتركين بالنشرة البريدية</span>
                    <span class="selected"></span>
                </a>
            </li>
            @endif




            @if (auth()->user()->can('Finance'))
            <li class="heading">
                <h3 class="uppercase">{{trans('orbscope.finance')}}</h3>
            </li>

            <li class="nav-item {{ ActiveAdminMenu('depositing') }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-usd"></i>
                    <span class="title">{{trans('orbscope.finance')}}</span>
                    <span class="arrow {{ ActiveAdminMenu('depositing') }}"></span>
                </a>
                <ul class="sub-menu">
                    @if (auth()->user()->can('Depositing'))
                    <li class="nav-item {{ActiveAdminLink('depositing')}}">
                        <a href="{{url(AdminUrl('depositing'))}}" class="nav-link ">
                            <span class="title"> {{trans('orbscope.depositing')}}</span>
                        </a>
                    </li>
                    @endif
                <!--

                    <li class="nav-item  {{ActiveAdminLink('withdrawals')}}">
                        <a href="{{url(AdminUrl('withdrawals'))}}" class="nav-link ">
                            <span class="title">{{trans('front.withdrawals')}}</span>
                        </a>
                    </li>

                    <li class="nav-item  {{ActiveAdminLink('withdrawals/requests')}}">
                        <a href="{{url(AdminUrl('withdrawals/requests'))}}" class="nav-link ">
                            <span class="title">{{trans('orbscope.orders')}} {{trans('front.withdrawals')}}</span>
                            <span class="badge badge-success">{{@\App\Orbscope\Models\Withdrawal::where('status','pending')->count()}}</span>
                        </a>
                    </li>-->

                </ul>
            </li>
            @endif





            @if (auth()->user()->can('Agents'))
                <li class="heading">
                    <h3 class="uppercase">{{trans('orbscope.agents')}}</h3>
                </li>


                @if (auth()->user()->can('Add Agents') || auth()->user()->can('Edit Agents') || auth()->user()->can('Show Agents') || auth()->user()->can('Delete Agents'))
                    <li class="nav-item {{ ActiveAdminMenu('agents') }}">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-people"></i>
                            <span class="title">{{trans('orbscope.agents')}}</span>
                            <span class="arrow {{ ActiveAdminMenu('agents') }}"></span>
                        </a>
                        <ul class="sub-menu">
                            @if (auth()->user()->can('Add Agents'))
                                <li class="nav-item {{ActiveAdminLink('agents.create')}}">
                                    <a href="{{url(AdminUrl('agents/create'))}}" class="nav-link ">
                                        <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.agents')}}</span>
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->can('Show Agents'))
                                <li class="nav-item  {{ActiveAdminLink('agents.index')}}">
                                    <a href="{{url(AdminUrl('agents'))}}" class="nav-link ">
                                        <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.agents')}}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
            @endif


            @if (auth()->user()->can('Roles'))
                <li class="heading">
                    <h3 class="uppercase">{{trans('orbscope.roles')}}</h3>
                </li>

                <li class="nav-item {{ ActiveAdminMenu('roles') }}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-globe-alt"></i>
                        <span class="title">{{trans('orbscope.roles')}}</span>
                        <span class="arrow {{ ActiveAdminMenu('roles') }}"></span>
                    </a>
                    <ul class="sub-menu">

                            <li class="nav-item {{ActiveAdminLink('roles.create')}}">
                                <a href="{{url(AdminUrl('roles/create'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.roles')}}</span>
                                </a>
                            </li>


                            <li class="nav-item  {{ActiveAdminLink('roles.index')}}">
                                <a href="{{url(AdminUrl('roles'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.roles')}}</span>
                                </a>
                            </li>

                    </ul>
                </li>

                <li class="nav-item {{ ActiveAdminMenu('permissions') }}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-globe-alt"></i>
                        <span class="title">{{trans('orbscope.permissions')}}</span>
                        <span class="arrow {{ ActiveAdminMenu('permissions') }}"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{ActiveAdminLink('permissions.create')}}">
                            <a href="{{url(AdminUrl('permissions/create'))}}" class="nav-link ">
                                <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.permissions')}}</span>
                            </a>
                        </li>
                        <li class="nav-item  {{ActiveAdminLink('permissions.index')}}">
                            <a href="{{url(AdminUrl('permissions'))}}" class="nav-link ">
                                <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.permissions')}}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif






            @if (auth()->user()->can('Logs'))
                <li class="nav-item {{ActiveAdminMenu('logs')}}">
                    <a href="{{url(AdminPath().'/logs')}}" class="nav-link nav-toggle">
                        <i class="icon-info"></i>
                        <span class="title">{{trans('log.logs')}}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endif





        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->



<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
