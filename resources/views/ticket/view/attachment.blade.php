<div class="accordion mt-5">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" style="background-color: #F7F7F7;" type="button" data-coreui-toggle="collapse" data-coreui-target="#collapseAttachment" aria-expanded="true" aria-controls="collapseDetails">
                {{__('viewticket.attachment')}}
            </button>
        </h2>
        <div class="accordion-collapse collapse show" id="collapseAttachment" aria-labelledby="headingOne" data-coreui-parent="#accordionExample">
            <div class="mt-3 ms-3">
                <form action="{{url('ticket/uploadattachment')}}" method="post" enctype="multipart/form-data" onsubmit="return Viewticket.checkFile();">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{$entity->id}}">
                    <div class="row">
                        <input style="width: 50%;float:left;" type="file" name="attachment" class="form-control" />
                        <input style="float: left;width: 150px;" type="submit" class="btn btn-success ms-3" value="{{__('viewticket.uploadfile')}}">
                    </div>
                </form>
            </div>
            <div class="mt-5 mb-3" style="overflow:hidden;">

                @foreach( $entity->attachments as $attachment )
                    <div style="float: left;width: 200px; border: 1px solid black;" class="ms-2 mt-2">
                        <div style="text-align:center;width: 100%; height: 180px;cursor: pointer" onclick="Viewticket.download('{{$attachment->id}}')">
                            @if( strstr( $attachment->mime, 'image') === false )
                                <svg class="icon" style="margin-top: 20px;width: 60%; height: 60%">
                                    <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-file"></use>
                                </svg>
                            @else
                                <img src="{{url('ticket/downloadattachment/' . $attachment->id)}}" style="padding-top: 10px;width:190px;max-height:170px; "/>
                            @endif
                        </div>
                        <div class="ms-2" style="height: 80px;white-space: nowrap;overflow: hidden">
                                    <span style="font-size: 12px">
                                        {{$attachment->name}}
                                    </span> <br />
                            <span style="font-size: 12px">{{\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $attachment->created_at)->format(config('app.datetime_format'))}}</span><br />
                            <span style="font-size: 12px; cursor: pointer">
                                        <span onclick="Viewticket.removeAttachment('{{url('/ticket/removeattachment/' . $attachment->id )}}')" class="btn btn-sm btn-danger">{{__('viewticket.removeattachment')}}
                                        </span>
                                    </span>
                        </div>
                    </div>

                @endforeach


            </div>

        </div>
    </div>
</div>
