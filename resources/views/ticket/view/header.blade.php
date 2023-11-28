<?php
/**
 * @var $entity \App\Models\Ticket
 */

?>
<div class="card-header">

        <span onclick="Viewticket.delete( <?php echo $entity->id; ?> );" class="btn btn-danger btn-lg" type="button">{{__('viewticket.remove_ticket')}}</span>
        <span onclick="Viewticket.addComment( true );" class="btn btn-success btn-lg" type="button">{{__('viewticket.add_comment')}}</span>

</div>
