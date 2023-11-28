function Viewticket() {

}
Viewticket.tinymceId        = 1;
Viewticket.checkFile        = function() {
    var file        = jQuery('#collapseAttachment').find('[name="attachment"]').val();

    var result      = false;
    if( file != '' ) {
        result      = true;
    }
    return result;
};

Viewticket.removeAttachment = function( url ) {
    var r = confirm( TRANSLATION_GLOBAL_DELETE );
    if (r == true) {
        window.location.href=url;
    }
};


Viewticket.deleteComment        = function( button, id ) {
    var r = confirm( TRANSLATION_GLOBAL_DELETE );
    if (r == true) {
        window.location.href='/ticket/removecomment/' + id;
    }
};


Viewticket.download         = function( attachment_id ) {
    window.location.href='/ticket/downloadattachment/' + attachment_id;
};

Viewticket.delete           = function( id ) {
    var r = confirm( TRANSLATION_GLOBAL_DELETE );
    if (r == true) {
        window.location.href='/ticket/delete/' + id;
    }
};

Viewticket.addComment       = function( scrollToBottom ) {
    var span                = jQuery('#new-comment-toolbar').find('span');
    Viewticket.openTinyMCE( span );

    if( scrollToBottom == true ) {
        var height      = $(document).height();
        $(document).scrollTop( height  );
    }
};

Viewticket.openTinyMCE      = function( uiElement ) {
    var textarea        = jQuery(uiElement).parent().parent().find('textarea');
    if( textarea.hasClass( 'is-open' ) == false ) {
        textarea.addClass('is-open');
        var url     = '/ticket/getcomment?ticket_id='+ TICKET_ID + '&type=' + jQuery(uiElement).attr('data-item-type') + '&comment_id=' + jQuery(uiElement).attr('data-item-comment_id');
        $.ajax({
            url: url,
            type: 'get',
            success: function( msg ) {
                Viewticket.tinymceId++;
                textarea.html('');
                jQuery(uiElement).parent().parent().find('[data-item-field="content"]').hide();
                jQuery(textarea).attr('id', 'description-textarea-' + Viewticket.tinymceId );
                jQuery(textarea).val( msg.html );
                jQuery(uiElement).parent().parent().find('[data-item-field="textarea"]').show();

                var editor	= new Editor( textarea, msg.html, {
                    height:		200,
                    close_callback:	function( oEditor ){
                        textarea.removeClass( 'is-open' ).parent().hide();
                        jQuery(uiElement).parent().parent().find('[data-item-field="content"]').show();
                        jQuery(uiElement).parent().parent().find('[data-item-field="textarea"]').hide();
                    },
                    save_callback:	function( oEditor ) {
                        var content	= (tinyMCE.get( oEditor.id ).getContent({format: 'raw'}))

                        $.ajax({
                            url:    '/ticket/savecomment',
                            type:   'post',
                            data:   {
                                content: content,
                                ticket_id: TICKET_ID,
                                _token: CSRF_TOKEN,
                                type: jQuery(uiElement).attr('data-item-type'),
                                config_key: jQuery(uiElement).attr('data-item-config'),
                                comment_id: jQuery(uiElement).attr('data-item-comment_id')
                            },
                            success: function( msg ) {
                                jQuery(uiElement).parent().parent().find('[data-item-field="content"]').html(msg.html_replaced).show();
                                jQuery(uiElement).parent().parent().find('[data-item-field="textarea"]').hide();
                                tinyMCE.remove( oEditor.identifier );
                                jQuery(uiElement).parent().parent().find('[data-item-field="textarea"]').html('<textarea></textarea>');
                                window.location.reload();
                                /*if( jQuery(uiElement).attr('data-item-comment_id') == '' && jQuery(uiElement).attr('data-item-type') == 'comment' ) {
                                    window.location.reload();
                                }*/
                            }
                        })
                    }
                } );
            }
        });
    }
};


Viewticket.changePerson   = function( uiElement, persontype ) {

    var ticket_id           = jQuery(uiElement).attr('data-item-ticket-id');
    var headline           = jQuery(uiElement).attr('data-item-headline');
    var muliple             = jQuery(uiElement).attr('data-item-multiple');
    var config             = jQuery(uiElement).attr('data-item-config-key');
    var is_required             = jQuery(uiElement).attr('data-item-is_required');
    var id                 = jQuery(uiElement).attr('id');
    var current_value       = new Array();
    jQuery(uiElement).find('td').eq(1).find('span').each(function() {
       current_value.push( jQuery(this).attr('data-item-user_id'));
    });

    var onclick             = 'Viewticket.savePerson( this );return false;';
    jQuery('#product-view-modal-change-item').find('.modal-footer').find('.btn-success').attr('onclick', onclick );

    showLoader();
    $.ajax({
        type: 'GET',
        url: '/ticket/getpersons',
        data: {
            _token: CSRF_TOKEN,
            ticket_id: ticket_id,
            multiple: muliple,
            type: persontype,
            current_value: current_value.join(',')
        },
        success: function(msg){
            hideLoader();

            jQuery('#product-view-modal-change-item').find('.modal-title').html( headline );
            //alert( jQuery(uiElement).attr('data-item-model'));
            const myModal = new coreui.Modal(document.getElementById('product-view-modal-change-item'), {

            });
            jQuery('#product-view-modal-change-item').find('.modal-body').html( msg );
            myModal.show();


            jQuery('#product-view-modal-change-item').find('.modal-footer').find('.btn-success').attr('data-item-ticket-id', ticket_id );
            jQuery('#product-view-modal-change-item').find('.modal-footer').find('.btn-success').attr('data-item-container-id', id );
            jQuery('#product-view-modal-change-item').find('.modal-footer').find('.btn-success').attr('data-item-person_type', persontype );
            jQuery('#product-view-modal-change-item').find('.modal-footer').find('.btn-success').attr('data-item-config_key', config );
            jQuery('#product-view-modal-change-item').find('.modal-footer').find('.btn-success').attr('data-item-is_required', is_required );

        }
    });

};

Viewticket.savePerson       = function( uiElement ) {
    var value               = jQuery('#product-view-modal-change-item').find('select').val();
    var config              = jQuery(uiElement).attr('data-item-config_key');
    var ticket_id           = jQuery(uiElement).attr('data-item-ticket-id');
    var idToChange          = jQuery(uiElement).attr('data-item-container-id');
    var type          = jQuery(uiElement).attr('data-item-person_type');
    var isRequired      = jQuery(uiElement).attr('data-item-is_required');

    if( ( isRequired == 'no' && value == '' ) || value != '' ) {
        showLoader();
        const myModal = jQuery('#product-view-modal-change-item').modal('hide');
        $.ajax({
            type: 'POST',
            url: '/ticket/saveperson',
            data: {
                _token: CSRF_TOKEN,
                ticket_id: ticket_id,
                config_key: config,
                new_value: value,
                type: type,
            },
            success: function (msg) {
                hideLoader();

                if (msg.do_change == true) {
                    jQuery('#' + idToChange).find('td').eq(1).html(msg.html);
                }
            }
        });
    }

};

Viewticket.saveUpperEntity   = function( uiElement ) {
    showLoader();
    const myModal = jQuery('#product-view-modal-change-item').modal('hide');



    var config              = jQuery(uiElement).attr('data-item-config-key');
    var dbfield             = jQuery(uiElement).attr('data-item-db-field');
    var ticket_id           = jQuery(uiElement).attr('data-item-ticket-id');
    var model               = jQuery(uiElement).attr('data-item-model');
    var value               = jQuery('#product-view-modal-change-item').find('select').val();
    var idToChange          = jQuery(uiElement).attr('data-item-container-id');
    $.ajax({
        type: 'POST',
        url: '/ticket/saveupperentity',
        data: {
            _token: CSRF_TOKEN,
            ticket_id: ticket_id,
            config_key: config,
            db_field: dbfield,
            new_value: value,
            model: model
        },
        success: function(msg){
            hideLoader();

            if( msg.do_change == true ) {
                jQuery('#' + idToChange).find('td').eq(1).html(msg.html);
            }
        }
    });
};

Viewticket.changeValue      = function( uiElement ) {

    var headline            = jQuery(uiElement).attr('data-item-headline');
    var model               = jQuery(uiElement).attr('data-item-model');
    var ticket_id           = jQuery(uiElement).attr('data-item-ticket-id');
    var value               = jQuery(uiElement).attr('data-item-current-value');
    var url                 = jQuery(uiElement).attr('data-item-url');
    var config              = jQuery(uiElement).attr('data-item-config-key');
    var dbfield             = jQuery(uiElement).attr('data-item-db-field');
    var id                  = jQuery(uiElement).attr('id');

    var onclick             = 'Viewticket.saveUpperEntity( this );return false;';
    jQuery('#product-view-modal-change-item').find('.modal-footer').find('.btn-success').attr('onclick', onclick );
    showLoader();
    $.ajax({
        type: 'GET',
        url: url,
        data: {
            model: model,
            current_value: value,
            ticket_id: ticket_id,
            config_key: config,
            db_field: dbfield,
        },
        success: function(msg){
            hideLoader();

            jQuery('#product-view-modal-change-item').find('.modal-title').html( headline );
            //alert( jQuery(uiElement).attr('data-item-model'));
            const myModal = new coreui.Modal(document.getElementById('product-view-modal-change-item'), {

            });
            jQuery('#product-view-modal-change-item').find('.modal-body').html( msg );
            myModal.show();

            jQuery('#product-view-modal-change-item').find('.modal-footer').find('.btn-success').attr('data-item-db-field', dbfield );
            jQuery('#product-view-modal-change-item').find('.modal-footer').find('.btn-success').attr('data-item-config-key', config );
            jQuery('#product-view-modal-change-item').find('.modal-footer').find('.btn-success').attr('data-item-ticket-id', ticket_id );
            jQuery('#product-view-modal-change-item').find('.modal-footer').find('.btn-success').attr('data-item-model', model );
            jQuery('#product-view-modal-change-item').find('.modal-footer').find('.btn-success').attr('data-item-container-id', id );

        }
    });

};
