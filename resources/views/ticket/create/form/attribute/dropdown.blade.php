<br />
<select style="width: 100% !important;" id="attribute-{{$attribute->id}}" name="attribute[{{$attribute->id}}]" class="selectcustom selectcustom-lg">
    <option value="">{{__('global.please_select')}}</option>
    @foreach( $attribute->options as $option )
        <option value="{{$option->id}}">{{$option->name}}</option>
    @endforeach
</select>
<script type="text/javascript">
    jQuery( document ).ready(function() {
        jQuery('#attribute-{{$attribute->id}}').select2();
    });
</script>
