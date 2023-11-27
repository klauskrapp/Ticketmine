
@include('dashboard.type.activitystream.avatar', array( 'user' => $item->user ))
<div style="float: left;width:80%;font-size: 13px;">
    {{$item->user->name}} {{__('dashboard.created')}} <a href="{{$item->ticket->getUrl()}}" class="activity_link">{{$item->ticket->unique_id}} - {{$item->ticket->name}}</a><br />
    {{__('dashboard.on')}} <?php echo date ( config('app.date_format') , strtotime($item->created_at )); ?> {{__('dashboard.at')}} <?php echo date (config('app.hour_format') , strtotime($item->created_at) ); ?><br />
    {!! \App\Helpers\Editor::replaceUsers( $item->ticket->description ) !!}
</div>

