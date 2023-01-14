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
                <input type="text" class="form-control" id="search_menu" placeholder="<?php echo e(trans('orbscope.search_menu')); ?>">
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

            <li class="nav-item start <?php echo e(ActiveAdminMenu('/')); ?>">
                <a href="<?php echo e(url(AdminPath())); ?>" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title"><?php echo e(trans('orbscope.dashboard')); ?></span>
                    <span class="selected"></span>
                </a>
            </li>

            <?php if(auth()->user()->can('Settings')): ?>
                <li class="heading">
                    <h3 class="uppercase"><?php echo e(trans('log.settings')); ?></h3>
                </li>

                <li class="nav-item <?php echo e(ActiveAdminMenu('settings')); ?>">
                    <a href="<?php echo e(url(AdminPath().'/settings')); ?>" class="nav-link nav-toggle">
                        <i class="fa fa-cog"></i>
                        <span class="title"><?php echo e(trans('log.settings')); ?></span>
                        <span class="selected"></span>
                    </a>
                </li>






            <?php endif; ?>



            <?php if(auth()->user()->can('Department')): ?>

            <li class="nav-item <?php echo e(ActiveAdminMenu('department')); ?>">
                <a href="javascript:" class="nav-link nav-toggle">
                    <i class="fa fa-server"></i>
                    <span class="title"><?php echo e(trans('orbscope.departments')); ?>  </span>
                    <span class="arrow <?php echo e(ActiveAdminMenu('department')); ?>"></span>
                </a>
                <ul class="sub-menu">

                        <li class="nav-item <?php echo e(ActiveAdminLink('department.create')); ?>">
                            <a href="<?php echo e(url(AdminUrl('department/create'))); ?>" class="nav-link ">
                                <span class="title"><?php echo e(trans('orbscope.add')); ?> <?php echo e(trans('orbscope.department')); ?></span>
                            </a>
                        </li>


                        <li class="nav-item  <?php echo e(ActiveAdminLink('department.index')); ?>">
                            <a href="<?php echo e(url(AdminUrl('department'))); ?>" class="nav-link ">
                                <span class="title"><?php echo e(trans('orbscope.show-all')); ?> <?php echo e(trans('orbscope.departments')); ?></span>
                            </a>
                        </li>

                </ul>
            </li>

           <?php endif; ?>


            <?php if(auth()->user()->can('Category')): ?>
                <li class="nav-item <?php echo e(ActiveAdminMenu('category')); ?>">
                    <a href="javascript:" class="nav-link nav-toggle">
                        <i class="fa fa-server"></i>
                        <span class="title"><?php echo e(trans('orbscope.categorys')); ?></span>
                        <span class="arrow <?php echo e(ActiveAdminMenu('category')); ?>"></span>
                    </a>
                    <ul class="sub-menu">

                            <li class="nav-item <?php echo e(ActiveAdminLink('category.create')); ?>">
                                <a href="<?php echo e(url(AdminUrl('category/create'))); ?>" class="nav-link ">
                                    <span class="title"><?php echo e(trans('orbscope.add')); ?> <?php echo e(trans('orbscope.category')); ?></span>
                                </a>
                            </li>



                            <li class="nav-item  <?php echo e(ActiveAdminLink('category.index')); ?>">
                                <a href="<?php echo e(url(AdminUrl('category'))); ?>" class="nav-link ">
                                    <span class="title"><?php echo e(trans('orbscope.show-all')); ?> <?php echo e(trans('orbscope.categorys')); ?></span>
                                </a>
                            </li>

                    </ul>
                </li>

            <?php endif; ?>


            <?php if(auth()->user()->can('Sub Category')): ?>

                    <li class="nav-item <?php echo e(ActiveAdminMenu('sub_category')); ?>">
                        <a href="javascript:" class="nav-link nav-toggle">
                            <i class="fa fa-server"></i>
                            <span class="title"><?php echo e(trans('orbscope.sub_categories')); ?></span>
                            <span class="arrow <?php echo e(ActiveAdminMenu('sub_category')); ?>"></span>
                        </a>
                        <ul class="sub-menu">

                                <li class="nav-item <?php echo e(ActiveAdminLink('sub_category.create')); ?>">
                                    <a href="<?php echo e(url(AdminUrl('sub_category/create'))); ?>" class="nav-link ">
                                        <span class="title"><?php echo e(trans('orbscope.add')); ?> <?php echo e(trans('orbscope.sub_category')); ?></span>
                                    </a>
                                </li>


                                <li class="nav-item  <?php echo e(ActiveAdminLink('sub_category.index')); ?>">
                                    <a href="<?php echo e(url(AdminUrl('sub_category'))); ?>" class="nav-link ">
                                        <span class="title"><?php echo e(trans('orbscope.show-all')); ?> <?php echo e(trans('orbscope.sub_categories')); ?></span>
                                    </a>
                                </li>

                        </ul>
                    </li>

            <?php endif; ?>









        <?php if(auth()->user()->can('States')): ?>
            <li class="nav-item <?php echo e(ActiveAdminMenu('countries')); ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-globe-alt"></i>
                    <span class="title"><?php echo e(trans('orbscope.countries')); ?></span>
                    <span class="arrow <?php echo e(ActiveAdminMenu('countries')); ?>"></span>
                </a>
                <ul class="sub-menu">

                        <li class="nav-item <?php echo e(ActiveAdminLink('countries.create')); ?>">
                            <a href="<?php echo e(url(AdminUrl('countries/create'))); ?>" class="nav-link ">
                                <span class="title"><?php echo e(trans('orbscope.add')); ?> <?php echo e(trans('orbscope.countries')); ?></span>
                            </a>
                        </li>


                        <li class="nav-item  <?php echo e(ActiveAdminLink('countries.index')); ?>">
                            <a href="<?php echo e(url(AdminUrl('countries'))); ?>" class="nav-link ">
                                <span class="title"><?php echo e(trans('orbscope.show-all')); ?> <?php echo e(trans('orbscope.countries')); ?></span>
                            </a>
                        </li>

                </ul>
            </li>
            <?php endif; ?>

            <?php if(auth()->user()->can('Cities')): ?>

                <li class="nav-item <?php echo e(ActiveAdminMenu('cities')); ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-direction"></i>
                        <span class="title"><?php echo e(trans('orbscope.cities')); ?></span>
                        <span class="arrow <?php echo e(ActiveAdminMenu('cities')); ?>"></span>
                    </a>
                    <ul class="sub-menu">

                            <li class="nav-item <?php echo e(ActiveAdminLink('cities.create')); ?>">
                                <a href="<?php echo e(url(AdminUrl('cities/create'))); ?>" class="nav-link ">
                                    <span class="title"><?php echo e(trans('orbscope.add')); ?> <?php echo e(trans('orbscope.cities')); ?></span>
                                </a>
                            </li>



                            <li class="nav-item  <?php echo e(ActiveAdminLink('cities.index')); ?>">
                                <a href="<?php echo e(url(AdminUrl('cities'))); ?>" class="nav-link ">
                                    <span class="title"><?php echo e(trans('orbscope.show-all')); ?> <?php echo e(trans('orbscope.cities')); ?></span>
                                </a>
                            </li>

                    </ul>
                </li>


            <?php endif; ?>
            <?php if(auth()->user()->can('Services')): ?>
            <li class="nav-item <?php echo e(ActiveAdminMenu('services')); ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-gears"></i>
                    <span class="title"><?php echo e(trans('orbscope.services')); ?> </span>
                    <span class="arrow <?php echo e(ActiveAdminMenu('services')); ?>"></span>
                </a>
                <ul class="sub-menu">

                        <li class="nav-item <?php echo e(ActiveAdminLink('services.create')); ?>">
                            <a href="<?php echo e(url(AdminUrl('services/create'))); ?>" class="nav-link ">
                                <span class="title"><?php echo e(trans('orbscope.add')); ?> <?php echo e(trans('orbscope.services')); ?> </span>
                            </a>
                        </li>



                        <li class="nav-item  <?php echo e(ActiveAdminLink('services.index')); ?>">
                            <a href="<?php echo e(url(AdminUrl('services'))); ?>" class="nav-link ">
                                <span class="title"><?php echo e(trans('orbscope.show-all')); ?> <?php echo e(trans('orbscope.services')); ?> </span>
                            </a>
                        </li>

                </ul>
            </li>
            <?php endif; ?>







            <?php if(auth()->user()->can('Ads')): ?>
            <li class="nav-item <?php echo e(ActiveAdminMenu('ads')); ?>">
                <a href="<?php echo e(url(AdminPath().'/ads')); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-server"></i>
                    <span class="title"><?php echo e(trans('front.ads')); ?></span>
                    <span class="selected"></span>
                </a>
            </li>
            <?php endif; ?>
            <?php if(auth()->user()->can('Auctions')): ?>
            <li class="nav-item <?php echo e(ActiveAdminMenu('auctions')); ?>">
                <a href="<?php echo e(url(AdminPath().'/auctions')); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-server"></i>
                    <span class="title"><?php echo e(trans('front.Auctions')); ?></span>
                    <span class="selected"></span>
                </a>
            </li>
            <?php endif; ?>
            <?php if(auth()->user()->can('Orders')): ?>
            <li class="nav-item <?php echo e(ActiveAdminMenu('orders')); ?>">
                <a href="<?php echo e(url(AdminPath().'/orders')); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-server"></i>
                    <span class="title"><?php echo e(trans('front.orders')); ?></span>
                    <span class="selected"></span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(auth()->user()->can('Users')): ?>
            <li class="nav-item <?php echo e(ActiveAdminMenu('users')); ?>">
                <a href="<?php echo e(url(AdminPath().'/users')); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-user"></i>
                    <span class="title"><?php echo e(trans('orbscope.users')); ?></span>
                    <span class="selected"></span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(auth()->user()->can('News')): ?>
            <li class="nav-item <?php echo e(ActiveAdminMenu('news')); ?>">
                <a href="<?php echo e(url(AdminPath().'/news')); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-user"></i>
                    <span class="title">المشتركين بالنشرة البريدية</span>
                    <span class="selected"></span>
                </a>
            </li>
            <?php endif; ?>




            <?php if(auth()->user()->can('Finance')): ?>
            <li class="heading">
                <h3 class="uppercase"><?php echo e(trans('orbscope.finance')); ?></h3>
            </li>

            <li class="nav-item <?php echo e(ActiveAdminMenu('depositing')); ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-usd"></i>
                    <span class="title"><?php echo e(trans('orbscope.finance')); ?></span>
                    <span class="arrow <?php echo e(ActiveAdminMenu('depositing')); ?>"></span>
                </a>
                <ul class="sub-menu">
                    <?php if(auth()->user()->can('Depositing')): ?>
                    <li class="nav-item <?php echo e(ActiveAdminLink('depositing')); ?>">
                        <a href="<?php echo e(url(AdminUrl('depositing'))); ?>" class="nav-link ">
                            <span class="title"> <?php echo e(trans('orbscope.depositing')); ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
                <!--

                    <li class="nav-item  <?php echo e(ActiveAdminLink('withdrawals')); ?>">
                        <a href="<?php echo e(url(AdminUrl('withdrawals'))); ?>" class="nav-link ">
                            <span class="title"><?php echo e(trans('front.withdrawals')); ?></span>
                        </a>
                    </li>

                    <li class="nav-item  <?php echo e(ActiveAdminLink('withdrawals/requests')); ?>">
                        <a href="<?php echo e(url(AdminUrl('withdrawals/requests'))); ?>" class="nav-link ">
                            <span class="title"><?php echo e(trans('orbscope.orders')); ?> <?php echo e(trans('front.withdrawals')); ?></span>
                            <span class="badge badge-success"><?php echo e(@\App\Orbscope\Models\Withdrawal::where('status','pending')->count()); ?></span>
                        </a>
                    </li>-->

                </ul>
            </li>
            <?php endif; ?>





            <?php if(auth()->user()->can('Agents')): ?>
                <li class="heading">
                    <h3 class="uppercase"><?php echo e(trans('orbscope.agents')); ?></h3>
                </li>


                <?php if(auth()->user()->can('Add Agents') || auth()->user()->can('Edit Agents') || auth()->user()->can('Show Agents') || auth()->user()->can('Delete Agents')): ?>
                    <li class="nav-item <?php echo e(ActiveAdminMenu('agents')); ?>">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-people"></i>
                            <span class="title"><?php echo e(trans('orbscope.agents')); ?></span>
                            <span class="arrow <?php echo e(ActiveAdminMenu('agents')); ?>"></span>
                        </a>
                        <ul class="sub-menu">
                            <?php if(auth()->user()->can('Add Agents')): ?>
                                <li class="nav-item <?php echo e(ActiveAdminLink('agents.create')); ?>">
                                    <a href="<?php echo e(url(AdminUrl('agents/create'))); ?>" class="nav-link ">
                                        <span class="title"><?php echo e(trans('orbscope.add')); ?> <?php echo e(trans('orbscope.agents')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if(auth()->user()->can('Show Agents')): ?>
                                <li class="nav-item  <?php echo e(ActiveAdminLink('agents.index')); ?>">
                                    <a href="<?php echo e(url(AdminUrl('agents'))); ?>" class="nav-link ">
                                        <span class="title"><?php echo e(trans('orbscope.show-all')); ?> <?php echo e(trans('orbscope.agents')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
            <?php endif; ?>


            <?php if(auth()->user()->can('Roles')): ?>
                <li class="heading">
                    <h3 class="uppercase"><?php echo e(trans('orbscope.roles')); ?></h3>
                </li>

                <li class="nav-item <?php echo e(ActiveAdminMenu('roles')); ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-globe-alt"></i>
                        <span class="title"><?php echo e(trans('orbscope.roles')); ?></span>
                        <span class="arrow <?php echo e(ActiveAdminMenu('roles')); ?>"></span>
                    </a>
                    <ul class="sub-menu">

                            <li class="nav-item <?php echo e(ActiveAdminLink('roles.create')); ?>">
                                <a href="<?php echo e(url(AdminUrl('roles/create'))); ?>" class="nav-link ">
                                    <span class="title"><?php echo e(trans('orbscope.add')); ?> <?php echo e(trans('orbscope.roles')); ?></span>
                                </a>
                            </li>


                            <li class="nav-item  <?php echo e(ActiveAdminLink('roles.index')); ?>">
                                <a href="<?php echo e(url(AdminUrl('roles'))); ?>" class="nav-link ">
                                    <span class="title"><?php echo e(trans('orbscope.show-all')); ?> <?php echo e(trans('orbscope.roles')); ?></span>
                                </a>
                            </li>

                    </ul>
                </li>

                <li class="nav-item <?php echo e(ActiveAdminMenu('permissions')); ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-globe-alt"></i>
                        <span class="title"><?php echo e(trans('orbscope.permissions')); ?></span>
                        <span class="arrow <?php echo e(ActiveAdminMenu('permissions')); ?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo e(ActiveAdminLink('permissions.create')); ?>">
                            <a href="<?php echo e(url(AdminUrl('permissions/create'))); ?>" class="nav-link ">
                                <span class="title"><?php echo e(trans('orbscope.add')); ?> <?php echo e(trans('orbscope.permissions')); ?></span>
                            </a>
                        </li>
                        <li class="nav-item  <?php echo e(ActiveAdminLink('permissions.index')); ?>">
                            <a href="<?php echo e(url(AdminUrl('permissions'))); ?>" class="nav-link ">
                                <span class="title"><?php echo e(trans('orbscope.show-all')); ?> <?php echo e(trans('orbscope.permissions')); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>






            <?php if(auth()->user()->can('Logs')): ?>
                <li class="nav-item <?php echo e(ActiveAdminMenu('logs')); ?>">
                    <a href="<?php echo e(url(AdminPath().'/logs')); ?>" class="nav-link nav-toggle">
                        <i class="icon-info"></i>
                        <span class="title"><?php echo e(trans('log.logs')); ?></span>
                        <span class="selected"></span>
                    </a>
                </li>
            <?php endif; ?>





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
