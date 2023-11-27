<?php
/**
 * @var $entity \App\Models\State
 * @var $disabeld boolean
 */
?>
<div class="tab-pane fade show active" id="general" role="tabpanel" tabindex="0">
    <input type="hidden" name="state[id]" value="{{$entity->id}}" id="state-entity-id" />

    <div class="mb-3 mt-3">
        <label for="state[name]" class="form-label bold">{{__('state.name')}} <span class="required">*</span></label>
        <input type="text" data-item-validator="text" data-item-validate="yes" class="form-control form-control-lg" value="{{$entity->name}}" name="state[name]" placeholder="{{__('state.name')}}">
    </div>

    <div class="mb-3 mt-3">
        <label for="state[position]" class="form-label bold">{{__('state.position')}} <span class="required">*</span></label>
        <input type="text" data-item-validator="text" data-item-validate="yes" class="form-control form-control-lg" value="{{$entity->position == '' ? 99 : $entity->position }}" name="state[position]" placeholder="{{__('state.position')}}">
    </div>


    <div class="mb-3 mt-3">
        <label for="state[project_id]" class="form-label bold">{{__('state.project')}} <span class="required">*</span></label>
        <select id="state-project-id" data-item-validator="select2" data-item-validate="yes" class="selectcustom selectcustom-lg"  name="state[project_id]">
            <option value="">{{__('global.please_select')}}</option>
            @foreach( \App\Models\Project::all() as $project )
                <?php $selected        = $project->id == $entity->project_id ? 'selected' : ''; ?>
                <option {{$selected}} value="{{$project->id}}">{{$project->name}}</option>
            @endforeach
        </select>
    </div>


    <div class="mb-3 mt-4">
        <label for="state[is_default]" class="form-label bold">{{__('state.is_default')}}</label>
        <select class="form-select form-select-lg" name="state[is_default]">
            <?php $selected       = $entity->is_default == 1 ? 'selected' : ''; ?>
            <option value="1" {{$selected}}>{{__('global.yes')}}</option>
            <?php $selected       = $entity->is_default == 0 ? 'selected' : ''; ?>
            <option value="0" {{$selected}}>{{__('global.no')}}</option>
        </select>
        <p class="notice">{{__('global.entity_is_default')}}</p>
    </div>


    <div class="mb-3 mt-3">
        <label for="state[icon_class]" class="form-label bold">{{__('state.icon_class')}} <span class="required">*</span></label>
        <select onchange="State.changeIconClass();" id="state-iconclass" data-item-validator="text" data-item-validate="yes" class="form-select form-select-lg"  name="state[icon_class]">
            @include('components.icon_class', array('value' => $entity->icon_class ))
        </select>
        <p class="notice"><span>Lorem Ipsum</span></p>
    </div>

</div>
