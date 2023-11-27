function Action() {

}

Action.save            = function() {

    var isValid         = Validator.validateForm('#action-form');
    if( isValid == true ) {
        jQuery('input:disabled, select:disabled').removeAttr('disabled');
    }
    return isValid;
};


Action.changeIconClass        = function() {

    var currClass       = 'mt-3 btn ' + jQuery('#action-iconclass').val();
    jQuery('#action-iconclass').next().find('span').attr('class', currClass );
};

