<div class="col-md-2" style="padding-top: 10px">
    <div class="card" style="border-radius: 10px">
        <div class="card-header donor-menu-card-header">
            Menus
        </div>
        <div class="card-body" style="padding: 0">
            <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
                <ul>
                    <li style="border-bottom:lightgray solid 1px"
                        class="sidebar-menu-item {{ menuActive('donor.dashboard') }}">
                        <a href="{{ route('donor.dashboard') }}" class="nav-link ">
                            <i style="color: #00B074" class="fa-solid fa-gauge"></i>
                            <span class="menu-title">@lang('My Profile')</span>
                        </a>
                    </li>
                    <li style="border-bottom:lightgray solid 1px"
                        class="sidebar-menu-item {{ menuActive('donor.blood-request.index') }}">
                        <a href="{{ Route('donor.blood-request.index') }}" class="nav-link ">
                            <i class="fa-solid fa-user"></i>
                            <span class="menu-title">@lang('Blood Request List')</span>
                        </a>
                    </li>
                    <li style="border-bottom:lightgray solid 1px"
                        class="sidebar-menu-item {{ menuActive('donor.blood-request.create') }}">
                        <a href="{{ route('donor.blood-request.create') }}" class="nav-link ">
                            <i class="fa-solid fa-plus"></i>
                            <span class="menu-title">@lang('New Blood Request')</span>
                        </a>
                    </li>
                    @if (auth()->guard('donor')->user()->referer_id)
                    <li style="border-bottom:lightgray solid 1px"
                        class="sidebar-menu-item">
                        <a href="{{ route('donor.referer.index') }}" class="nav-link ">
                            <i class="fa-solid fa-share"></i>
                            <span class="menu-title">@lang('Refer Donor')</span>
                        </a>
                    </li>
                    @else

                    @endif

                    <li style="border-bottom:lightgray solid 1px"
                        class="sidebar-menu-item {{ menuActive('donor.profile') }}">
                        <a href="{{ Route('donor.profile') }}" class="nav-link ">
                            <i class="fa-solid fa-pen-to-square"></i>
                            <span class="menu-title">@lang('Edit Profile')</span>
                        </a>
                    </li>
                    <li style="border-bottom:lightgray solid 1px"
                        class="sidebar-menu-item {{ menuActive('donor.password') }}">
                        <a href="{{ Route('donor.password') }}" class="nav-link ">
                            <i class="fa-solid fa-key"></i>
                            <span class="menu-title">@lang('Change Password')</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item {{ menuActive('donor.logout') }}">
                        <a href="{{ route('donor.logout') }}" class="nav-link ">
                            <i class="fa fa-sign-out"></i>
                            <span class="menu-title">@lang('Sign Out')</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
