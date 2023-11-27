function User() {

}

User.save            = function() {

    var isValid         = Validator.validateForm('#user-form');
    if( isValid == true ) {
        jQuery('input:disabled, select:disabled').removeAttr('disabled');
    }
    return isValid;
};


User.changeFreeForAll          = function() {
    jQuery('#project-select-free-for-all-projects').show();
    if( jQuery('#project-free-for-all').val() == 1 ) {
        jQuery('#project-select-free-for-all-projects').hide();
    }

};
