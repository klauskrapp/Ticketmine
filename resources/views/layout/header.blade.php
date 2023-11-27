<header class="header mb-4">
    <div class="container-fluid">
        <ul class="header-nav d-none d-md-flex">
            <li class="nav-item">
                <?php
                    $dashboards     = auth()->user()->dashboards;
                ?>
                <a class="nav-link"
                   @if( count( $dashboards ) > 1 )
                       data-coreui-toggle="dropdown"
                       role="button" aria-haspopup="true"
                       aria-expanded="false"
                   @endif
                   href="{{ count( $dashboards ) == 1 ? url('dashboard') : '#'}}">
                    <strong>{{ __('global.dashboard') }}</strong>
                </a>
                @if( count( $dashboards ) > 1 )
                    <div class="dropdown-menu dropdown-menu-end pt-0 mt-1">
                        <div class="dropdown-header bg-light py-2">
                            <div class="fw-semibold">{{__('global.dashboards')}}</div>
                        </div>
                        @foreach( $dashboards as $d )
                            <a class="dropdown-item" href="{{url('dashboard')}}?unique_id={{$d->unique_id}}">
                               {{$d->name}}
                            </a>
                        @endforeach
                    </div>
                @endif
            </li>
            <li class="nav-item ms-4">
                <a class="nav-link" href="{{url('search')}}"><strong>{{ __('global.search_for_tickets') }}</strong></a>
            </li>
            <li class="nav-item">
                <a href="{{url('ticket/create')}}" class="btn btn-info ms-5 w-100"  type="button">{{ __('global.create_ticket') }}</a>
            </li>
        </ul>
        <div>

            @include('layout.user_settings')
            @include('layout.admin_settings')
            @include('layout.searchbar')
        </div>
    </div>
</header>




<div class="alert alert-success w-100" id="messagebus-success" style="text-align: center; display: none"></div>

<div class="alert alert-danger w-100" id="messagebus-danger" style="text-align: center; display: none"></div>


<div class="alert alert-warning w-100" id="messagebus-warning" style="text-align: center; display: none"></div>

<?php  $flash          = session()->get('message');?>
@if( is_array( $flash ) == true && isset( $flash['message_type']) == true && $flash['message'] != '')
    <script type="text/javascript">
        $( document ).ready(function() {
            var id = '#messagebus-{{$flash['message_type']}}';
            jQuery(id).html('{{$flash['message']}}').fadeIn(500).delay(4000).fadeOut(500);
        });
    </script>
@endif



