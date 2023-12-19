<?php
    $value          = \App\Helpers\Attribute::getAttributesValue( $entity, $attribute, false, false  );
    $value          = is_array( $value ) == false ? array() : $value;
?>
<select id="change_attribute_element_{{$attribute->id}}" class="form-select form-select-lg" multiple>
    <option value="">{{__('global.please_select')}}</option>
    @foreach($attribute->attributeoptions as $option )
        <?php $selected        = in_array( $option->id, $value ) == true ? 'selected="selected"' : '';?>
        <option value="{{$option->id}}" {{$selected}}>{{$option->name}}</option>
    @endforeach
</select>
<script type="text/javascript">
    $( document ).ready(function() {
        jQuery('#change_attribute_element_{{$attribute->id}}').select2(
            {
                dropdownCssClass: "increasedzindexclass"
            }
        );
    });
</script>
