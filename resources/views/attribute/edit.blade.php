<?php
/**
 * @var $entity \App\Models\Attribute
 * @var $disabeld boolean
 */

$disabled           = $entity->id != '' ? true : false;
$disableForm        = $disabled == true ? 'disabled' : '';
?>
@extends( 'layout.master' )
@section('content')
    <script type="text/javascript" src="/js/attribute.js?version={{get_version()}}"></script>
    <div class="body flex-grow-1">
        @include('components.headline', array('headline' => $entity->id == '' ? __('attribute.create_attribute') : __('global.edit') . ' "' . $entity->name . '"'  ) )
        <div class="card p-3">
            <form action="{{url('attribute/save')}}" method="POST" id="attribute-form">
                @csrf
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active"  data-coreui-toggle="tab" data-coreui-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">{{__('global.general')}}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-coreui-toggle="tab" data-coreui-target="#options" type="button" role="tab" aria-controls="options" aria-selected="false">{{__('attribute.options')}}</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-coreui-toggle="tab" data-coreui-target="#advanced" type="button" role="tab" aria-controls="advanced" aria-selected="false">{{__('attribute.advanced')}}</button>
                        </li>
                    </ul>
                    <div class="tab-content">

                            @include('attribute.tab.general')
                            @include('attribute.tab.options')
                            @include('attribute.tab.advanced')

                    </div>


                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{url('attribute')}}" class="btn btn-secondary btn-lg" type="button">{{__('global.back')}}</a>
                        </div>
                        <div class="col-6 text-end">
                            <button type="submit" class="btn btn-success btn-lg" onclick="return Attribute.save();">{{__('global.save')}}</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <script type="text/javascript">
        jQuery( document ).ready(function() {
            Attribute.changeFilterable();
        });
    </script>

@endsection
