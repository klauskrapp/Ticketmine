<?php
/**
 * @var $entity \App\Models\Attribute
 * @var $disabeld boolean
 */
?>
<div class="tab-pane fade ms-2 me-2" id="advanced" role="tabpanel" tabindex="0">


    <div class="mb-3 mt-3">
        <label for="attribute[save_to_table]" class="form-label bold">{{__('attribute.save_to_table')}} <span class="required">*</span></label>
        <input {{$disableForm}} id="attribute-save_to_table" type="text" data-item-validator="text" data-item-validate="yes" class="form-control form-control-lg" value="{{$entity->save_to_table}}" name="attribute[save_to_table]" placeholder="{{__('attribute.save_to_table')}}">
        <p class="notice">{{__('attribute.save_to_table_notice')}}</p>
    </div>


    <div class="mb-3 mt-4">
        <label for="attribute[source_model]" class="form-label bold">{{__('attribute.source_model')}} <span class="required">*</span></label>
        <input {{$disableForm}} id="attribute-source_model" data-item-validator="text" data-item-validate="no" type="text" class="form-control form-control-lg" value="{{$entity->source_model}}" name="attribute[source_model]" placeholder="{{__('attribute.source_model')}}">
        <p class="notice">{{__('attribute.source_model_notice')}}</p>
    </div>


</div>
