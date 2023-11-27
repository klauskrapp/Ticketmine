function State() {

}

State.save            = function() {

    var isValid         = Validator.validateForm('#state-form');
    if( isValid == true ) {
        jQuery('input:disabled, select:disabled').removeAttr('disabled');
    }
    return isValid;
};


State.changeIconClass        = function() {

    var currClass       = 'mt-3 btn ' + jQuery('#state-iconclass').val();
    jQuery('#state-iconclass').next().find('span').attr('class', currClass );
};

