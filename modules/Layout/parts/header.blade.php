<div class="bravo_header">
    <div class="{{$container_class ?? 'container'}}">
        <div class="content">
            <div class="header-left">
                <a href="{{url(app_get_locale(false,'/'))}}" class="bravo-logo">
                    @php
                        $logo_id = setting_item("logo_id");
                        if(!empty($row->custom_logo)){
                            $logo_id = $row->custom_logo;
                        }
                    @endphp
                    @if($logo_id)
                        <?php $logo = get_file_url($logo_id,'full') ?>
                        <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
                    @endif
                </a>
                <div class="bravo-menu">
                    <?php generate_menu('primary') ?>
                </div>
            </div>
            <div class="header-right">
                @if(!empty($header_right_menu))
                    <ul class="topbar-items">
                        @include('Language::frontend.switcher')
                        @if(!Auth::check())
                            <li class="login-item">
                                <a href="#login" data-toggle="modal" data-target="#login" class="login">{{__('Connexion')}}</a>
                            </li>
                            <li class="signup-item">
                                <a href="#register" data-toggle="modal" data-target="#register" class="signup">{{__('Inscription')}}</a>
                            </li>
                        @else
                            <li class="login-item dropdown">
                                <a href="#" data-toggle="dropdown" class="is_login">
                                    @if($avatar_url = Auth::user()->getAvatarUrl())
                                        <img class="avatar" src="{{$avatar_url}}" alt="{{ Auth::user()->getDisplayName()}}">
                                    @else
                                        <span class="avatar-text">{{ucfirst( Auth::user()->getDisplayName()[0])}}</span>
                                    @endif
                                    {{__("Hi, :Name",['name'=>Auth::user()->getDisplayName()])}}
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu text-left">

                                    @if(Auth::user()->hasPermissionTo('dashboard_vendor_access'))
                                        <li><a href="{{route('vendor.dashboard')}}"><i class=""></i> {{__("Vendor Dashboard")}}</a></li>
                                    @endif
                                    <li class="@if(Auth::user()->hasPermissionTo('dashboard_vendor_access')) menu-hr @endif">
                                        <a href="{{route('user.profile.index')}}"><i class=""></i> {{__("My profile")}}</a>
                                    </li>
                                    @if(setting_item('inbox_enable'))
                                    <li class="menu-hr"><a href="{{route('user.chat')}}"><i class=""></i> {{__("Messages")}}</a></li>
                                    @endif
                                    <li class="menu-hr"><a href="{{route('user.booking_history')}}"><i class=""></i> {{__("Booking History")}}</a></li>
                                    <li class="menu-hr"><a href="{{route('user.change_password')}}"><i class=""></i> {{__("Change password")}}</a></li>
                                    @if(Auth::user()->hasPermissionTo('dashboard_access'))
                                        <li class="menu-hr"><a href="{{route('admin.index')}}"><i class=""></i> {{__("Admin Dashboard")}}</a></li>
                                    @endif
                                    <li class="menu-hr">
                                        <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class=""></i> {{__('Deconnexion')}}</a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endif
                    </ul>
                @endif

            </div>
        </div>
    </div>
    <div class="bravo-menu-mobile" style="display:none;">
        <div class="user-profile">
            <div class="b-close"><i class="icofont-scroll-left"></i></div>
            <div class="avatar"></div>
            <ul>
                @if(!Auth::check())
                    <li>
                        <a href="#login" data-toggle="modal" data-target="#login" class="login">{{__('Connexion')}}</a>
                    </li>
                    <li>
                        <a href="#register" data-toggle="modal" data-target="#register" class="signup">{{__('Inscription')}}</a>
                    </li>
                @else
                    <li>
                        <a href="{{route('user.profile.index')}}">
                            <i class="icofont-user-suited"></i> {{__("Hi, :Name",['name'=>Auth::user()->getDisplayName()])}}
                        </a>
                    </li>
                    @if(Auth::user()->hasPermissionTo('dashboard_vendor_access'))
                        <li><a href="{{route('vendor.dashboard')}}"><i class=""></i> {{__("Vendor Dashboard")}}</a></li>
                    @endif
                    @if(Auth::user()->hasPermissionTo('dashboard_access'))
                        <li>
                            <a href="{{route('admin.index')}}"><i class=""></i> {{__("Admin Dashboard")}}</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{route('user.profile.index')}}">
                            <i class=""></i> {{__("My profile")}}
                        </a>
                    </li>
                    <li>
                        <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                            <i class=""></i> {{__('Deconnexion')}}
                        </a>
                        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>

                @endif
            </ul>
            <ul class="multi-lang">

            </ul>
            <ul class="multi-lang">
                @include('Language::frontend.switcher')
            </ul>
        </div>
        <div class="g-menu">
            <?php generate_menu('primary') ?>
        </div>
    </div>
</div>
