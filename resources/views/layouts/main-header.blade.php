        <!--=================================
 header start-->
        <nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- logo -->
            <div class="text-left navbar-brand-wrapper">
                <a class="navbar-brand brand-logo" href="/"><img src="/assets/images/logo-dark.png" alt=""></a>
                <a class="navbar-brand brand-logo-mini" href="/"><img src="/assets/images/logo-icon-dark.png"
                        alt=""></a>
            </div>
            <!-- Top bar left -->
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left"
                        href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
                </li>
                <li class="nav-item">
                    <div class="search">
                        <a class="search-btn not_click" href="javascript:void(0);"></a>
                        <div class="search-box not-click">
                            <input type="text" class="not-click form-control" placeholder="Search" value=""
                                name="search">
                            <button class="search-button" type="submit"> <i class="fa fa-search not-click"></i></button>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- top bar right -->
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item fullscreen">
                    <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
                </li>

                <li class="nav-item dropdown mr-30 d-flex justify-content-center align-items-center  pl-3 pr-3">
                    <p class="mb-0 d-flex align-items-center">
                        @if(Auth::user()->lang == 'ar')
                            العربية
                        @else
                            English
                        @endif
                        <i class="ti-angle-down ml-3"></i>
                    </p>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('lang',['lang'=> 'ar']) }}">العربية</a>
                        <a class="dropdown-item" href="{{ route('lang',['lang'=> 'en']) }}">English</a>
                    </div>
                </li>
             
                <li class="nav-item dropdown mr-30">
                    <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="/assets/images/users/{{ Auth::user()->avatar }}"  class="myAvatar">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-0">{{ Auth::user()->name }}</h5>
                                    <span>{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="text-info ti-settings"></i>{{ __('system.settings') }}</a>
                        <a href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="text-danger ti-unlock"></i> {{ __('system.logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            </ul>
            
        </nav>

        <!--=================================
 header End-->
