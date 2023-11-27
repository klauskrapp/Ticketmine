<div class="mb-3 mt-4">
    <select style="width: 100%;z-index: 10000" id="person-selection" class="form-select form-select-lg" {{$multiple}}>
        @foreach( $persons as $item )
            <?php $selected        = in_array( $item->id, $current_value ) == true  ? 'selected' : ''; ?>
            <option value="{{$item->id}}" {{$selected}}>{{$item->name}}</option>
        @endforeach
    </select>
</div>
<script type="text/javascript">
    jQuery('#person-selection').select2(
        {
            dropdownCssClass: "increasedzindexclass"
        }
    );
</script>
