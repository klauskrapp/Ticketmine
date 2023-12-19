<input type="text" data-item-validator="text" data-item-validate="yes" id="change_attribute_element_{{$attribute->id}}"
       class="form-control form-control-lg" data-item-attribute_id="{{$attribute->id}}"
       value="{{\App\Helpers\Attribute::getAttributesValue( $entity, $attribute, true, true  )}}">
