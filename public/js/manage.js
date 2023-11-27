function Manage() {

}

Manage.save            = function() {

    var isValid         = Validator.validateForm('#manage-form');
    if( isValid == true ) {
        jQuery('input:disabled, select:disabled').removeAttr('disabled');
    }
    return isValid;
}
Manage.changeHeadlineClass      = function() {
    var currClass       = 'mt-3 btn ' + jQuery('#manage-headlinelass').val();
    jQuery('#manage-headlinelass').next().find('span').attr('class', currClass );
};

Manage.addElement           = function( dashboard_id, id ) {
    var url             = '/manage/configure/' + dashboard_id + '/edit'
    if( id != '' ) {
        url                    += '/' + id;
    }
    showLoader();
    $.ajax({
        type: 'get',
        url: url,
        success: function(msg){
            hideLoader();
            Manage.handleElementCallback( msg );
            jQuery('#element-tab-element').trigger('click');
            Manage.changeHeadlineClass();
        }
    });
};

Manage.handleElementCallback        = function( jsonData ) {
    jQuery('#element-name').val( getObjectsValue( jsonData.entity, 'name', '' ) );
    jQuery('#element-id').val( getObjectsValue( jsonData.entity, 'id', '' ) );
    jQuery('#element-type').val( getObjectsValue( jsonData.entity, 'type', 'activitystream' ) );
    if( getObjectsValue( jsonData.entity, 'type', 'activitystream' )  == 'activitystream') {
        jQuery('#filter_id_container').hide();
    }
    else {
        jQuery('#filter_id_container').show();
    }
    jQuery('#element-position').val( getObjectsValue( jsonData.entity, 'position', '99' ) );
    jQuery('#element-align').val( getObjectsValue( jsonData.entity, 'align', 'left' ) );
    jQuery('#element-height').val( getObjectsValue( jsonData.entity, 'height', '250' ) );
    jQuery('#element-elements_per_page').val( getObjectsValue( jsonData.entity, 'elements_per_page', '7' ) );

}

Manage.changeType               = function() {
    jQuery('#filter_id_container').show();
    if( jQuery('#element-type').val() == 'activitystream' ) {
        jQuery('#filter_id_container').hide();
    }
};

Manage.saveElement              = function() {
    var isValid         = Validator.validateForm('#element-form');
    if( isValid == true ) {
        jQuery('#element-form').submit();
    }
};
