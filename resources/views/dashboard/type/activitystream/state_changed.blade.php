
@include('dashboard.type.activitystream.avatar', array( 'user' => $item->user ))
<div style="float: left;width:80%;font-size: 13px;">
    {{$item->user->name}}
    {!!  $item->content!!} {{__('dashboard.on')}} <?php echo date ( config('app.datetime_format') , strtotime($item->created_at )); ?>
    <br />
    <a href="{{$item->ticket->getUrl()}}" class="activity_link">{{$item->ticket->unique_id}} - {{$item->ticket->name}}</a><br />
</div>

