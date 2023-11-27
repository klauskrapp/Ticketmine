function Project() {

}

Project.save            = function() {

    var isValid         = Validator.validateForm('#project-form');
    var validateUnique          = Project.validateUniqueId();
    if( isValid == true && validateUnique == true ) {
        jQuery('input:disabled, select:disabled').removeAttr('disabled');
    }
    return isValid;
}


Project.changeFreeForAll          = function() {
    jQuery('#project-select-free-for-all-users').show();
    if( jQuery('#project-free-for-all').val() == 1 ) {
        jQuery('#project-select-free-for-all-users').hide();
    }

};



Project.validateUniqueId        = function() {
    var isValid                 = true;
    if( jQuery('#project-entity-id').val() == '' ) {
        var input           = jQuery('#project-unique-id').val().replace(/[0-9]/g, '');
        input               = input.replace(/[^\w\s]/gi, '');

        if( input != jQuery('#project-unique-id').val() ) {
            isValid         = false;
            jQuery('#project-unique-id').addClass('is-invalid');
            jQuery('#project-unique-id').val( input );
        }
    }

    if( isValid == true && jQuery('#project-unique-id').val()  != '' ) {
        jQuery('#project-unique-id').removeClass('is-invalid');
    }


    return isValid;
}
