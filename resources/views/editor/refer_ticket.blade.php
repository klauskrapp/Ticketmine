<?php
/**
 * @var $project \App\Models\Project
 */
?>
<div class="modal" tabindex="-1" id="editor-ticket-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('global.notify_ticket')}}</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 mt-3">
                    <label for="ticket-search-input" class="form-label bold">{{__('global.search_for_ticket')}}</label>
                    <input id="ticket-search-input"  type="text" class="form-control" onkeyup="findTicket( this )"/>
                </div>
                <div id="editor-ticket-modal-list">
                    <div class="col-sm-12">
                        <table class="table table-striped border datatable dataTable no-footer" aria-describedby="DataTables_Table_0_info" style="border-collapse: collapse !important">
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function findTicket( input ) {
        if( jQuery(input).val().length > 2 ) {
            showLoader();
            $.ajax({
                type: 'get',
                url: '/quickfind/ticket?name=' + jQuery(input).val() +  '&user_id=' + {{auth()->user()->id}},
                success: function(msg){
                    hideLoader();
                    jQuery('#editor-ticket-modal-list').find('tbody').html('');

                    var row                 = '';
                    for( var a = 0; a < msg.length; a++ ) {
                        var user            = msg[a];
                        row                 += '<tr>';
                        row                 += '<td>' + user.unique_id +' ('+user.name+')</td>';
                        row                 += '<td><span class="btn btn-info btn-sm" onclick="tinyMCE.activeEditor.execCommand(\'appendTicket\', \''+user.unique_id+'\', \''+user.name+'\');" >'+TRANSLATION_GLOBAL_TRANSFER+'</span></td>';
                        row                 += '</tr>';
                    }
                    jQuery('#editor-ticket-modal-list').find('tbody').html(row);
                }
            });
        }
    }
</script>
