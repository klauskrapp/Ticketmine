<?php
/**
 * @var $entity \App\Models\User
 * @var $disabeld boolean
 */

$disabled               = $entity->id != '' ? true : false;
$disableForm            = $disabled == true ? 'disabled' : '';
?>
@extends( 'layout.master' )
@section('content')
    <script type="text/javascript" src="/js/user.js?version={{get_version()}}"></script>
    <div class="body flex-grow-1">
        @include('components.headline', array('headline' => $entity->id == '' ? __('user.create_user') : __('global.edit') . ' "' . $entity->name . '"'  ) )
        <div class="card p-3">
            <form action="{{url('user/save')}}" method="POST" id="user-form" enctype="multipart/form-data">
                <input type="hidden" name="save_back_url" value="{{$save_back_url}}" />
                @csrf
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-coreui-toggle="tab" data-coreui-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">{{__('global.general')}}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-coreui-toggle="tab" data-coreui-target="#emailsettings" type="button" role="tab" aria-controls="emailsettings" aria-selected="true">{{__('user.emailsettings')}}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-coreui-toggle="tab" data-coreui-target="#columnsettings" type="button" role="tab" aria-controls="columnsettings" aria-selected="true">{{__('user.columnsettings')}}</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                            @include('user.tab.general')
                            @include('user.tab.email')
                            @include('user.tab.columns')
                    </div>
                </div>


                <div class="card-footer">
                    <div class="row">
                        @if( $back_url != '')
                            <div class="col-6">
                                <a href="{{$back_url}}" class="btn btn-secondary btn-lg" type="button">{{__('global.back')}}</a>
                            </div>
                        @endif
                        <div class="col-6 text-end">
                            <button type="submit" class="btn btn-success btn-lg" onclick="return User.save();">{{__('global.save')}}</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <script type="text/javascript">
        jQuery( document ).ready(function() {
            @if( auth()->user()->is_admin )
                User.changeFreeForAll();
                jQuery('#user-free-for-all').select2();
            @endif
        });
    </script>

@endsection
