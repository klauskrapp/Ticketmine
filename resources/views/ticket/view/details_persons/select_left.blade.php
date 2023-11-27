<div class="mb-3 mt-4">
    <select class="form-select form-select-lg">
        @foreach( $entities as $item )
            <?php $selected        = $item->id == $current_value ? 'selected' : ''; ?>
            <option value="{{$item->id}}" {{$selected}}>{{$item->name}}</option>
        @endforeach
    </select>
</div>
