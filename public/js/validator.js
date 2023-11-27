function Validator() {

}



Validator.validateForm      = function ( id ) {
    var formIsValid         = true;
    jQuery( id ).find('[data-item-validate=yes]').each(function() {
        if ( jQuery(this).attr('data-item-validator') == 'text' ) {
            var res                 = Validator.validateField( this );
            if ( res == true ) {
                formIsValid         = false;
            }
        }
        else if(  jQuery(this).attr('data-item-validator') == 'select2' ) {
            var res                 = Validator.select2( this );
            if ( res == true ) {
                formIsValid         = false;
            }
        }
        else if(  jQuery(this).attr('data-item-validator') == 'quill' ) {
            var res                 = Validator.validateQuill( this );
            if ( res == true ) {
                formIsValid         = false;
            }
        }
        else if( jQuery(this).attr('data-item-validator') == 'number' ) {
            var res                 = Validator.validateNumber( this );
            if ( res == true ) {
                formIsValid         = false;
            }
        }
        else if( jQuery(this).attr('data-item-validator') == 'file' ) {
            var res                 = Validator.validateFile( this );
            if ( res == true ) {
                formIsValid         = false;
            }
        }
        else if( jQuery(this).attr('data-item-validator') == 'email' ) {
            var res                 = Validator.validateEmail( this );
            if ( res == true ) {
                formIsValid         = false;
            }
        }
        else if( jQuery(this).attr('data-item-validator') == 'datetime' ) {
            var res                 = Validator.validateDatetime( this );
            if ( res == true ) {
                formIsValid          = false;
            }
        }
        else if ( jQuery(this).attr('data-item-validator') == 'time'  ) {
            var res                 = Validator.validateTime( this );
            if ( res == true ) {
                formIsValid          = false;
            }
        }
        else if ( jQuery(this).attr('data-item-validator') == 'url'  ) {
            var res                 = Validator.validateUrl( this );
            if ( res == true ) {
                formIsValid          = false;
            }
        }
        else if ( jQuery(this).attr('data-item-validator') == 'date' ) {
            var res                     = Validator.validateDate( this );
            if ( res == true ) {
                formIsValid         = false;
            }
        }
    });

    return formIsValid;
};


Validator.select2       = function( uiElement ) {
    var hasError            = false;
    if ( jQuery(uiElement).val() == '' ) {
        jQuery(uiElement).next().addClass('select2-is-invalid');
        hasError            = true;
    }
    else {
        jQuery(uiElement).next().removeClass('select2-is-invalid');
    }

    return hasError;
};

Validator.validateEmail    = function( uiElement ) {
    var hasError            = false;
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if ( jQuery(uiElement).val() == '' || re.test( jQuery(uiElement).val() ) == false ) {
        jQuery(uiElement).addClass('is-invalid');
        hasError            = true;
    }
    else {
        jQuery(uiElement).removeClass('is-invalid');
    }

    return hasError;
};

Validator.validateUrl       = function( uiElement) {
    var hasError            = false;
    if ( jQuery(uiElement).val() == '' ) {
        jQuery(uiElement).addClass('is-invalid');
        hasError            = true;
    }
    else {
        jQuery(uiElement).removeClass('is-invalid');
    }

    return hasError;
};

Validator.validateFile      = function( uiElement ) {
    var hasError            = false;
    if ( jQuery(uiElement).val() == '' ) {
        jQuery(uiElement).addClass('is-invalid');
        hasError            = true;
    }
    else {
        jQuery(uiElement).removeClass('is-invalid');
    }

    return hasError;
};


Validator.validateDatetime  = function( uiElement ) {

    var hasError            = false;

    var input       = jQuery( uiElement ).val();
    if ( input.length != 19 || input == '' ) {
        jQuery(uiElement).addClass('is-invalid');
        hasError            = true;
    }
    else {
        jQuery(uiElement).removeClass('is-invalid');
    }


    return hasError;


};




Validator.validateDate  = function( uiElement ) {
    var hasError            = false;

    var input       = jQuery( uiElement ).val();
    if ( input.length != 10 || input == '' ) {
        jQuery(uiElement).addClass('is-invalid');
        hasError            = true;
    }
    else {
        jQuery(uiElement).removeClass('is-invalid');
    }


    return hasError;
};



Validator.validateTime  = function( uiElement ) {
    var hasError            = false;

    var input       = jQuery( uiElement ).val();
    if ( input == '' || parseFloat( input ) != input || parseFloat( input ) <= 0 ) {
        jQuery(uiElement).addClass('is-invalid');
        hasError            = true;
    }
    else {
        jQuery(uiElement).removeClass('is-invalid');
    }


    return hasError;
};


Validator.validateField    = function( uiElement ) {
    var hasError            = false;
    if ( jQuery(uiElement).val() == '' ) {
        jQuery(uiElement).addClass('is-invalid');
        hasError            = true;
    }
    else if( jQuery(uiElement).val() == null && jQuery(uiElement).prop('multiple') == true ) {
        jQuery(uiElement).addClass('is-invalid');
        hasError            = true;
    }
    else {
        jQuery(uiElement).removeClass('is-invalid');
    }

    return hasError;
};



Validator.validateNumber    = function( uiElement ) {
    var hasError            = false;
    if ( jQuery(uiElement).val() == '' || jQuery(uiElement).val() != parseInt(  jQuery(uiElement).val() ) ) {
        jQuery(uiElement).addClass('is-invalid');
        hasError            = true;
    }
    else {
        jQuery(uiElement).removeClass('is-invalid');
    }

    return hasError;
};


Validator.validateMultiple  = function( uiElement ) {


};
