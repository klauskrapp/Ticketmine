@foreach( $entity->comments as $comment )
    <div class="card mt-3">
        <div class="row p-3" style="overflow: hidden">
            <div style="text-align:center;height: 50px; width: 5%;float:left;">
                <div class="avatar avatar-md mt-1">
                    <img class="avatar-img" src="{{$comment->creator->getAvatar()}}">
                </div>
            </div>
            <div style="height: 50px; width: 90%;float:left;">
                <span style="font-size: 12px;">
                    <span style="color:#3399FF;">{{$comment->creator->name}}</span> {{__('viewticket.wrote_at')}} {{\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at)->format(config('app.datetime_format'))}}
                    @if( $comment->updated_by != '')
                        <br /><span style="color:#3399FF;">{{__('viewticket.last_changed_by')}} </span>{{$comment->updatedby->name}} {{\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $comment->updated_at)->format(config('app.datetime_format'))}}
                    @endif
                </span>
            </div>
        </div>
        <div class="row p-3">
            <div style="height: 40px;background-color: lightblue" data-item-field="toolbar">

                    <span class="btn btn-danger" onclick="Viewticket.deleteComment( this, '<?php echo $comment->id; ?>' );" style="float:right; margin-top: 5px;margin-right: 10px;">
                        <svg class="icon">
                            <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-trash"></use>
                        </svg>
                    </span>

                    <span onclick="Viewticket.openTinyMCE( this );" data-item-comment_id="{{$comment->id}}" data-item-config="comment_changed" data-item-type="comment" data-item-ticket_id="{{$entity->id}}" class="btn btn-success" style="float:right; margin-top: 5px;margin-right: 10px;">
                        <svg class="icon">
                            <use xlink:href="/coreui/4_2/dist/vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass"></use>
                        </svg>
                    </span>
            </div>

            <div class="row ms-2 mt-3" data-item-field="content">
                {!! $comment->getParsedDescription() !!}
            </div>

            <div class="row ms-2 me-2" style="display:none;" data-item-field="textarea">
                <textarea></textarea>
            </div>
        </div>
    </div>
@endforeach
