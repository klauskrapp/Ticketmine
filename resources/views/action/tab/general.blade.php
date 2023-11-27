<?php
/**
 * @var $entity \App\Models\Action
 * @var $disabeld boolean
 */
?>
<div class="tab-pane fade show active" id="general" role="tabpanel" tabindex="0">
    <input type="hidden" name="action[id]" value="{{$entity->id}}" id="action-entity-id" />

    <div class="mb-3 mt-3">
        <label for="action[name]" class="form-label bold">{{__('action.name')}} <span class="required">*</span></label>
        <input type="text" data-item-validator="text" data-item-validate="yes" class="form-control form-control-lg" value="{{$entity->name}}" name="action[name]" placeholder="{{__('action.name')}}">
    </div>

    <div class="mb-3 mt-3">
        <label for="action[position]" class="form-label bold">{{__('action.position')}} <span class="required">*</span></label>
        <input type="text" data-item-validator="text" data-item-validate="yes" class="form-control form-control-lg" value="{{$entity->position == '' ? 99 : $entity->position }}" name="action[position]" placeholder="{{__('action.position')}}">
    </div>


    <div class="mb-3 mt-3">
        <label for="action[project_id]" class="form-label bold">{{__('action.project')}} <span class="required">*</span></label>
        <select id="action-project-id" data-item-validator="select2" data-item-validate="yes" class="selectcustom selectcustom-lg"  name="action[project_id]" placeholder="{{__('action.project')}}">
            <option value="">{{__('global.please_select')}}</option>
            @foreach( \App\Models\Project::all() as $project )
                <?php $selected        = $project->id == $entity->project_id ? 'selected' : ''; ?>
                <option {{$selected}} value="{{$project->id}}">{{$project->name}}</option>
            @endforeach
        </select>
    </div>


    <div class="mb-3 mt-4">
        <label for="action[is_default]" class="form-label bold">{{__('action.is_default')}}</label>
        <select class="form-select form-select-lg" name="action[is_default]">
            <?php $selected       = $entity->is_default == 1 ? 'selected' : ''; ?>
            <option value="1" {{$selected}}>{{__('global.yes')}}</option>
            <?php $selected       = $entity->is_default == 0 ? 'selected' : ''; ?>
            <option value="0" {{$selected}}>{{__('global.no')}}</option>
        </select>
        <p class="notice">{{__('global.entity_is_default')}}</p>
    </div>


    <div class="mb-3 mt-3">
        <label for="action[icon_class]" class="form-label bold">{{__('action.icon_class')}} <span class="required">*</span></label>
        <select onchange="Action.changeIconClass();" id="action-iconclass" data-item-validator="text" data-item-validate="yes" class="form-select form-select-lg"  name="action[icon_class]">
            @include('components.icon_class', array('value' => $entity->icon_class ))
        </select>
        <p class="notice"><span>Lorem Ipsum</span></p>
    </div>

</div>
