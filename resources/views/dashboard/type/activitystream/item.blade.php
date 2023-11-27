@foreach( $elements as $item )
    <div class="row">
        <?php $path        = 'dashboard.type.activitystream.' . $item->template; ?>

        @include( $path, array( 'item' => $item ) )
        <hr style="margin: 1px;">
    </div>
@endforeach
