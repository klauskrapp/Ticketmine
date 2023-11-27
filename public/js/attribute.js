function Attribute() {

}

Attribute.save            = function() {

    var isValid         = Validator.validateForm('#attribute-form');
    var validateUnique          = Attribute.validateCode();
    if( isValid == true && validateUnique == true ) {
        jQuery('input:disabled, select:disabled').removeAttr('disabled');
    }
    return isValid;
}

Attribute.unique_id                 = 0;

Attribute.addOption                 = function( id, name, position, is_selected ) {

    var html                = '<tr>';
    html                            += '<td><input type="hidden" name="option['+Attribute.unique_id+'][id]" value="'+id+'" /><input name="option['+Attribute.unique_id+'][name]" type="text" class="form-control" value="'+name+'" placeholder="'+TRANSLATION_ATTRIBUTE_OPTIONNAME+'"/></td>';
    html                            += '<td style="width: 200px;"><input style="width: 150px;" name="option['+Attribute.unique_id+'][position]" type="text" class="form-control" value="'+position+'" placeholder="'+TRANSLATION_GLOBAL_POSITION+'" /></td>';
    html                            += '<td><span class="btn btn-danger" onclick="Attribute.removeOption(\''+id+'\', this );"> <svg class="icon">\n' +
                        '                    <use xlink:href="'+CORE_UI_PATH+'vendors/@coreui/icons/svg/free.svg#cil-trash"></use>\n' +
                        '                </svg></span></td>';
    html                            += '</tr>';

    Attribute.unique_id++;
    jQuery('#attribute-option-table').find('tbody').append( html );
};


Attribute.removeOption              = function( id, box ) {
    jQuery(box).parent().parent().remove();

    if( id != '' ) {
        var deleteOption      = '<input type="hidden" name="deleteoption[]" value="'+id+'" />';
        jQuery('#options-to-delete').append( deleteOption );
    }

};
Attribute.changeFilterable          = function() {
    if( jQuery('#attribute-type-id').val() == 1 || jQuery('#attribute-type-id').val() == 2 || jQuery('#attribute-type-id').val() == 4 || jQuery('#attribute-type-id').val() == 5 ) {
        jQuery('#filterable-dropdown').show();
    }
    else {
        jQuery('#filterable-dropdown').hide();
    }


    if( jQuery('#attribute-entity-id').val() == '' ) {
        jQuery('#attribute-save_to_table').val( jQuery('#attribute-type-id').find(":selected").attr('data-item-save-to-table'));
        jQuery('#attribute-source_model').val( jQuery('#attribute-type-id').find(":selected").attr('data-item-source-model'));
    }
};

Attribute.validateCode        = function() {
    var isValid                 = true;
    if( jQuery('#attribute-code').val() == '' ) {
        var input           = jQuery('#attribute-code').val().replace(/[0-9]/g, '');
        input               = input.replace(/[^\w\s]/gi, '');

        if( input != jQuery('#attribute-code').val() ) {
            isValid         = false;
            jQuery('#attribute-code').addClass('is-invalid');
            jQuery('#attribute-code').val( input );
        }
    }

    if( isValid == true && jQuery('#attribute-code').val()  != '' ) {
        jQuery('#attribute-code').removeClass('is-invalid');
    }


    return isValid;
}
