
<div>
    @foreach( $attribute->options as $option )
        <div class="form-check">
            <input class="form-check-input" name="attribute[{{$attribute->id}}][]" type="checkbox" value="{{$option->id}}" id="attribute-{{$attribute->id}}-option-{{$option->id}}">
            <label class="form-check-label" for="attribute-{{$attribute->id}}-option-{{$option->id}}">
                {{$option->name}}
            </label>
        </div>
    @endforeach
</div>
