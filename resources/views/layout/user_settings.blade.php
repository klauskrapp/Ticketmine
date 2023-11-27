<ul class="header-nav ms-3" style="float:right;">
    <li class="nav-item dropdown">
        <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <div class="avatar avatar-md">
                <img class="avatar-img" src="{{ auth()->user()->getAvatar() }}">
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end pt-0">
            <div class="dropdown-header bg-light py-2">
                <div class="fw-semibold">{{__('global.settings')}}</div>
            </div>
            <a class="dropdown-item" href="{{url('profile')}}">
                <svg class="icon me-2">
                    <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                </svg> {{__('global.profile')}}
            </a>
            <a class="dropdown-item" href="{{url('manage')}}">
                <svg class="icon me-2">
                    <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                </svg> {{__('global.manage_dashboards')}}
            </a>
            <a class="dropdown-item" href="#">
                <svg class="icon me-2">
                    <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-file"></use>
                </svg> Filter
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <svg class="icon me-2">
                    <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                </svg> {{__('global.logout')}}
            </a>
        </div>
    </li>
</ul>
