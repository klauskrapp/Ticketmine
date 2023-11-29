@if( auth()->user()->is_admin == 1 )
    <ul class="header-nav ms-3 ms-md-5 mt-2" style="float:right;">
        <li class="nav-item dropdown">
            <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <svg class="icon icon-lg">
                    <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                </svg>
            </a>
            <div class="dropdown-menu dropdown-menu-end pt-0">
                <div class="dropdown-header bg-light py-2">
                    <div class="fw-semibold">{{__('global.adminsettings')}}</div>
                </div>
                <a class="dropdown-item" href="{{url('project')}}">
                    <svg class="icon me-2">
                        <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-sign-language"></use>
                    </svg> {{ __('global.projects') }}
                </a>

                <a class="dropdown-item" href="{{url('priority')}}">
                    <svg class="icon me-2">
                        <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-warning"></use>
                    </svg> {{ __('global.priority') }}
                </a>


                <a class="dropdown-item" href="{{url('action')}}">
                    <svg class="icon me-2">
                        <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-description"></use>
                    </svg> {{ __('global.action') }}
                </a>



                <a class="dropdown-item" href="{{url('attribute')}}">
                    <svg class="icon me-2">
                        <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-layers"></use>
                    </svg> {{ __('global.attributes') }}
                </a>




                <a class="dropdown-item" href="{{url('state')}}">
                    <svg class="icon me-2">
                        <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-chevron-double-right "></use>
                    </svg> {{ __('global.state') }}
                </a>


                <?php /*
                <a class="dropdown-item" href="{{url('groupstate')}}">
                    <svg class="icon me-2">
                        <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-object-group "></use>
                    </svg> {{ __('global.groupstate') }}
                </a>
                */
                ?>


                <a class="dropdown-item" href="{{url('user')}}">
                    <svg class="icon me-2">
                        <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                    </svg> {{ __('global.user') }}
                </a>

            </div>
        </li>
    </ul>
@endif
