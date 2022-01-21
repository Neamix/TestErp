<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    @can('viewDashboard', Auth::user())
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ __('system.dashboard') }}</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    @endcan
                    <!-- menu title -->
                    <!-- menu item Elements-->
                    @canany(['editUser', 'viewAny'], Auth::user())
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{ __('system.users') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                            <ul id="elements" class="collapse" data-parent="#sidebarnav">
                                @can('editUser',Auth::user())
                                <li><a href="{{ route('user.index') }}">{{ __('system.create_user')  }}</a></li>
                                @endcan
                                @can('viewAny',Auth::user())
                                <li><a href="{{ route('user.filter') }}">{{ __('system.user_list')  }}</a></li>
                                @endcan
                            </ul>    
                    </li>
                    @endcanany
                    @canany(['trash-user'], Auth::user())
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#trash">
                            <div class="pull-left"><i class="ti-trash"></i><span
                                    class="right-nav-text">{{ __('system.trash_bin') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="trash" class="collapse" data-parent="#sidebarnav">
                            @can('trash-user',Auth::user())
                            <li><a href="{{ route('user.index') }}">{{ __('system.user_list')  }}</a></li>
                            @endcan
                        </ul>    
                    </li>
                    @endcanany
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#subject">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{ __('system.subjects') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="subject" class="collapse" data-parent="#sidebarnav">
                            <li><a href="accordions.html">{{ __('system.create_user')  }}</a></li>
                            <li><a href="accordions.html">{{ __('system.user_list')  }}</a></li>
                            <li><a href="alerts.html">{{ __('system.student_list') }}</a></li>
                        </ul>
                    </li>
                    <!-- menu item schedule-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{ __('system.schedule') }}</span></div>
                            <div class="clearfix"></div>
                        </a>

                    </li>
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
