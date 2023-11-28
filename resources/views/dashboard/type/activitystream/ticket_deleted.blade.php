
@include('dashboard.type.activitystream.avatar', array( 'user' => $item->user ))
<div style="float: left;width:80%;font-size: 13px;">
    {{$item->user->name}} {{__('dashboard.deleted_ticket')}} <br />{{$item->content}}
</div>

