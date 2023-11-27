@extends( 'layout.master' )
@section('content')
    <div class="body flex-grow-1">
        <script type="text/javascript" src="/js/manage.js?version={{get_version()}}"></script>
        @include('components.headline', array('headline' => __('manage.configure_elements_for_dashboad') . ': ' . $entity->name ))
        <div class="card p-3">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation" onclick="javascript:jQuery('#save-button').hide();">
                        <button class="nav-link active" data-coreui-toggle="tab" data-coreui-target="#grid" type="button" role="tab" aria-controls="grid" aria-selected="true">{{__('global.existing_elements')}}</button>
                    </li>
                    <li class="nav-item" role="presentation" onclick="javascript:jQuery('#save-button').show();">
                        <button id="element-tab-element" class="nav-link" data-coreui-toggle="tab" data-coreui-target="#element" type="button" role="tab" aria-controls="grid" aria-selected="true">{{__('global.change_element')}}</button>
                    </li>
                </ul>
                <div class="tab-content">
                    @include('manage.configure.tab.grid')
                    @include('manage.configure.tab.element')
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-6">
                        <a href="{{url('manage')}}" class="btn btn-secondary btn-lg" type="button">{{__('global.back')}}</a>
                    </div>
                    <div class="col-6 text-end" id="save-button" style="display: none;">
                        <button type="submit" class="btn btn-success btn-lg" onclick="Manage.saveElement(); return false;">{{__('global.save')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
