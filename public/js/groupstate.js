function Groupstate() {

}

Groupstate.save            = function() {

    var isValid         = Validator.validateForm('#groupstate-form');
    if( isValid == true ) {
        jQuery('input:disabled, select:disabled').removeAttr('disabled');
    }
    return isValid;
};

