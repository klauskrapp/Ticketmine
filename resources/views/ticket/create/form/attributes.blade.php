
<div class="tab-pane fade show" id="attributes" role="tabpanel" tabindex="0">
    @foreach( $attributes as $attribute )
        <div class="mb-3 mt-3">
            <label for="attribute-{{$attribute->id}}" class="form-label bold">{{$attribute->name}}</label>
            <?php $path     = 'ticket.create.form.attribute.' . $attribute->datatype; ?>
            @include( $path, array(
                'attribute' => $attribute
            ) )
        </div>


    @endforeach


</div>
