<?php
/**
 * @var $entity \App\Models\Attribute
 * @var $disabeld boolean
 */
?>
<div class="tab-pane fade show active ms-2 me-2 " id="general" role="tabpanel" tabindex="0">
    <input type="hidden" name="attribute[id]" value="{{$entity->id}}" id="attribute-entity-id" />

    <div class="mb-3 mt-3">
        <label for="attribute[name]" class="form-label bold">{{__('attribute.name')}} <span class="required">*</span></label>
        <input type="text" data-item-validator="text" data-item-validate="yes" class="form-control form-control-lg" value="{{$entity->name}}" name="attribute[name]" placeholder="{{__('attribute.name')}}">
    </div>


    <div class="mb-3 mt-4">
        <label for="attribute[code]" class="form-label bold">{{__('attribute.code')}} <span class="required">*</span></label>
            <input {{$disableForm}} id="attribute-code" data-item-validator="text" data-item-validate="yes" type="text" class="form-control form-control-lg" value="{{$entity->code}}" name="attribute[code]" placeholder="{{__('attribute.code')}}">
        <p class="notice">{{__('attribute.code_cannot_be_changed')}}</p>
    </div>


    <div class="mb-3 mt-4">
        <label for="attribute[attribute_type_id]" class="form-label bold">{{__('attribute.type')}}</label>
        <select {{$disableForm}} type="text" class="form-select form-select-lg" name="attribute[attribute_type_id]" onchange="Attribute.changeFilterable();" id="attribute-type-id">
            @foreach( \App\Models\AttributeType::all() as $item )
                <?php $selected     = $item->id == $entity->attribute_type_id ? 'selected' : '' ;?>
                <option {{$selected}} value="{{$item->id}}" data-item-save-to-table="{{$item->save_to_table}}" data-item-source-model="{{$item->source_model}}">{{__('attribute.'. $item->name )}}</option>
            @endforeach
        </select>
    </div>


    <div class="mb-3 mt-4" id="filterable-dropdown">
        <label for="attribute[filterable]" class="form-label bold">{{__('attribute.filterable')}}</label>
        <select class="form-select form-select-lg" name="attribute[filterable]" >
            <?php $selected       = $entity->filterable == 1 ? 'selected' : ''; ?>
            <option value="1" {{$selected}}>{{__('global.yes')}}</option>
            <?php $selected       = $entity->filterable == 0 ? 'selected' : ''; ?>
            <option value="0" {{$selected}}>{{__('global.no')}}</option>
        </select>
    </div>

</div>
