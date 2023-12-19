
@include('dashboard.type.activitystream.avatar', array( 'user' => $item->user ))
<div style="float: left;width:80%;font-size: 13px;">
    {{$item->user->name}} {{__('dashboard.deleted_a_comment')}} <br /><a href="{{$item->ticket->getUrl()}}">{{$item->content}}</a>
</div>

