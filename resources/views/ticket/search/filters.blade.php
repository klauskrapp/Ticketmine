<?php


?>
<div class="accordion" id="ticketsearch-index-table-filter">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" style="background-color: #F7F7F7;" type="button" data-coreui-toggle="collapse" data-coreui-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                {{__('global.filters')}}
            </button>
        </h2>
        <div class="accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne" data-coreui-parent="#accordionExample">
            <div class="row p-3">
                <div class="col-sm">
                    <div class="mb-3">
                        <label class="form-label">{{__('ticketsearch.project')}}</label>
                        <select id="project_id" class="form-select form-select-lg">
                            <option value="">{{__('global.please_select')}}</option>
                            @foreach( auth()->user()->visibleprojects as $project )
                                <option value="{{$project->id}}">{{$project->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{__('ticketsearch.assigend')}}</label>
                        <select id="assigned" class="form-select form-select-lg">
                            <option value="">{{__('global.please_select')}}</option>
                            @foreach(  $users as $user )
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{__('ticketsearch.created_by')}}</label>
                        <select id="created_by" class="form-select form-select-lg">
                            <option value="">{{__('global.please_select')}}</option>
                            @foreach(  $users as $user )
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="col-sm">

                    <div class="mb-3">
                        <label class="form-label">{{__('ticketsearch.name')}}</label>
                        <input class="form-control form-control-lg" type="text" placeholder="{{__('ticketsearch.name')}}" id="name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{__('ticketsearch.fulltext')}}</label>
                        <input class="form-control form-control-lg" type="text" placeholder="{{__('ticketsearch.fulltext')}}" id="fulltext">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{__('ticketsearch.unique_id')}}</label>
                        <input class="form-control form-control-lg" type="text" placeholder="{{__('ticketsearch.unique_id')}}" id="unique_id">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="mb-3">
                        <label class="form-label">{{__('ticketsearch.action')}}</label>
                        <select id="action_id" class="form-select form-select-lg">
                            <option value="">{{__('global.please_select')}}</option>
                            @foreach(  $action as $group )
                                <optgroup class="test" label="{{$group['project']->name}}">
                                    @foreach( $group['children'] as $child )
                                        <option value="{{$child->id}}">{{$child->name}}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{__('ticketsearch.priority')}}</label>
                        <select id="priority_id" class="form-select form-select-lg">
                            <option value="">{{__('global.please_select')}}</option>
                            @foreach(  $priority as $group )
                                <optgroup class="test" label="{{$group['project']->name}}">
                                    @foreach( $group['children'] as $child )
                                        <option value="{{$child->id}}">{{$child->name}}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{__('ticketsearch.state')}}</label>
                        <select id="state_id" class="form-select form-select-lg">
                            <option value="">{{__('global.please_select')}}</option>
                            @foreach(  $state as $group )
                                <optgroup class="test" label="{{$group['project']->name}}">
                                    @foreach( $group['children'] as $child )
                                        <option value="{{$child->id}}">{{$child->name}}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>


            <div class="card-footer">
                <div class="row">
                    <div class="col-6">
                        <button onclick="redirectTo('{{url('search')}}');" class="btn btn-danger btn-lg" type="button">{{__('global.reset')}}</button>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn btn-lg btn-warning me-3" type="button" onclick="Searchticket.openSaveOverlay (); return false;">{{__('ticketsearch.save_filters')}}</button>
                        <button onclick="Searchticket.search(); return false;" class="btn btn-lg btn-info" type="button">{{__('global.search')}}</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery( document ).ready(function() {
        jQuery('#created_by').select2();
        jQuery('#assigned').select2();
    });
</script>
