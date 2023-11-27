<?php
/**
 * @var $entity \App\Models\Priority
 * @var $disabeld boolean
 */
?>
<div class="tab-pane fade show active" id="general" role="tabpanel" tabindex="0">
    <input type="hidden" name="dashboard[id]" value="{{$entity->id}}" id="dashboard-entity-id" />

    <div class="mb-3 mt-3">
        <label for="dashboard[name]" class="form-label bold">{{__('manage.name')}} <span class="required">*</span></label>
        <input type="text" data-item-validator="text" data-item-validate="yes" class="form-control form-control-lg" value="{{$entity->name}}" name="dashboard[name]" placeholder="{{__('manage.name')}}">
    </div>



    <div class="mb-3 mt-4">
        <label for="dashboard[is_default]" class="form-label bold">{{__('manage.is_default')}}</label>
        <select class="form-select form-select-lg" name="dashboard[is_default]">
            <?php $selected       = $entity->is_default == 1 ? 'selected' : ''; ?>
            <option value="1" {{$selected}}>{{__('global.yes')}}</option>
            <?php $selected       = $entity->is_default == 0 ? 'selected' : ''; ?>
            <option value="0" {{$selected}}>{{__('global.no')}}</option>
        </select>
    </div>
</div>
