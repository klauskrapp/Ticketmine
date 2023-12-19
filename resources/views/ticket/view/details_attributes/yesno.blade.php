<?php
    $value        = \App\Helpers\Attribute::getAttributesValue( $entity, $attribute, true, false  );
?>
<select id="change_attribute_element_{{$attribute->id}}" class="form-select form-select-lg">
    <?php $selected       = $value == 1 ? 'selected' : ''; ?>
    <option value="1" {{$selected}}>{{__('global.yes')}}</option>
    <?php $selected       = $value == 0 ? 'selected' : ''; ?>
    <option value="0" {{$selected}}>{{__('global.no')}}</option>
</select>
