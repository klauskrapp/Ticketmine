function Createticket() {

}

Createticket.editorInitialized  = false;

Createticket.save               = function() {
    var isValid         = Validator.validateForm('#createticket-form');
    if( isValid == true ) {
        jQuery('input:disabled, select:disabled').removeAttr('disabled');
    }
    return isValid;
};



Createticket.loadForm           = function() {
    if( jQuery('#create-ticket-project-id').val() != '' ) {

        if( Createticket.editorInitialized  == true ) {
            tinymce.get( 'create-ticket-description' ).remove();
            Createticket.editorInitialized  = false;
        }


        showLoader();
        $.ajax({
            type: 'GET',
            url: '/ticket/form/' + jQuery('#create-ticket-project-id').val(),
            success: function(msg){
                hideLoader();
                jQuery('#tab-content').html( msg );

                jQuery('#create-ticket-created_by').select2();
                jQuery('#create-ticket-follower').select2();
                jQuery('#create-ticket-assigned').select2();


                var tinyOptions = $.extend({
                    selector: 		'#create-ticket-description',
                    height: 		400,
                }, Editor.tinyMCEOptions );

                tinymce.init( tinyOptions );
                Createticket.editorInitialized  = true;
            }
        });
    }
};
