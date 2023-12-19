<div class="mb-3 mt-3">
    <label class="form-label bold">{{$attribute->name}}</label>
    <?php $tpl  = 'ticket.view.details_attributes.' . $attribute->attributetype->template_for_filters; ?>
    @include( $tpl )
</div>
