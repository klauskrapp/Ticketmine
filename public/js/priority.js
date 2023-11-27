function Priority() {

}

Priority.save            = function() {

    var isValid         = Validator.validateForm('#priority-form');
    if( isValid == true ) {
        jQuery('input:disabled, select:disabled').removeAttr('disabled');
    }
    return isValid;
};


Priority.changeIconClass        = function() {

    var currClass       = 'mt-3 btn ' + jQuery('#priority-iconclass').val();
    jQuery('#priority-iconclass').next().find('span').attr('class', currClass );
};

