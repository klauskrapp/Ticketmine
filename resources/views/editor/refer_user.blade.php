<?php
/**
 * @var $project \App\Models\Project
 */
$users      = $project->visibleusers;
?>
<div class="modal" tabindex="-1" id="editor-user-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('global.notify_user')}}</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 mt-3">
                    <label for="user-search-input" class="form-label bold">{{__('global.search_for_user')}}</label>
                    <input id="user-search-input"  type="text" class="form-control" onkeyup="findUser( this )"/>
                </div>
                <div id="editor-user-modal-list">
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

    function findUser( input ) {
        if( jQuery(input).val().length > 2 ) {
            showLoader();
            $.ajax({
                type: 'get',
                url: '/quickfind/user?name=' + jQuery(input).val() +  '&project_id=' + {{$project->id}},
                success: function(msg){
                    hideLoader();
                    jQuery('#editor-user-modal-list').find('tbody').html('');

                    var row                 = '';
                    for( var a = 0; a < msg.length; a++ ) {
                        var user            = msg[a];
                        row                 += '<tr>';
                        row                 += '<td>' + user.name +' ('+user.email+')</td>';
                        row                 += '<td><span class="btn btn-info btn-sm" onclick="tinyMCE.activeEditor.execCommand(\'appendUser\', \''+user.unique_id+'\', \''+user.name+'\');" >'+TRANSLATION_GLOBAL_TRANSFER+'</span></td>';
                        row                 += '</tr>';
                    }
                    jQuery('#editor-user-modal-list').find('tbody').html(row);
                }
            });
        }
    }
</script>
