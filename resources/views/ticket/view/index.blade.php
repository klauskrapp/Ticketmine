<?php
/**
 * @var $entity \App\Models\Ticket
 * @var $attributes array
 */


?>
@extends( 'layout.master' )
@section('content')
    <script type="text/javascript" src="/js/viewticket.js?version={{get_version()}}"></script>
    <div class="body flex-grow-1">
        @include('components.headline', array('headline' => $entity->name ))
        <div class="card p-3">
            <div class="card-body">

                @include('ticket.view.header')
                @include('ticket.view.details_persons')
                @include('ticket.view.description_date')
                @include('ticket.view.attachment')
                @include('ticket.view.comments')

                <div>

                    <div style="height: 40px;" data-item-field="toolbar" id="new-comment-toolbar">
                        <span data-item-comment_id="" data-item-config="new_comment" data-item-type="comment" data-item-ticket_id="{{$entity->id}}">
                        </span>
                    </div>

                    <div class="row ms-2 mt-3" data-item-field="content">

                    </div>

                    <div class="row ms-2 me-2" style="display:none;" data-item-field="textarea">
                        <textarea></textarea>
                    </div>
                </div>

                <div class="mt-3">
                    <span onclick="Viewticket.addComment();" class="btn btn-success btn-lg" type="button">{{__('ticketview.add_comment')}}</span>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-6">
                        <a href="{{url('search')}}" class="btn btn-secondary btn-lg" type="button">{{__('global.back')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script type="text/javascript">
    var CSRF_TOKEN      = '{{ csrf_token() }}';
    var TICKET_ID       = '{{$entity->id}}';
</script>

@section('modals')

    <div class="modal" tabindex="-1" id="product-view-modal-change-item">
        <div class="modal-dialog"   style="z-index: 400;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="z-index: 100000">

                </div>
                <div class="modal-footer">
                    <div style="width: 60%; float:left;">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">{{__('global.close')}}</button>
                    </div>
                    <div style="width: 30%;float:right;text-align: right">
                        <button type="button" class="btn btn-success" onclick="">{{__('global.save')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @include( 'editor.refer_ticket', array('project' => $entity->project ) )
    @include( 'editor.refer_user', array('project' => $entity->project) )


@endsection
