<?php $value        = \App\Helpers\Attribute::getAttributesValue( $entity, $attribute, true, false  ); ?>
<select id="change_attribute_element_{{$attribute->id}}" class="form-select form-select-lg">
    <option value="">{{__('global.please_select')}}</option>
    @foreach($attribute->attributeoptions as $option )
        <?php $selected        = $value == $option->id ? 'selected="selected"' : '';?>
        <option value="{{$option->id}}" {{$selected}}>{{$option->name}}</option>
    @endforeach
</select>
