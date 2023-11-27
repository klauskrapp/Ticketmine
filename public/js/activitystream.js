function Activitystream() {

}


Activitystream.load     = function( id ) {
    var complete_id     = '#dashboardelement-' + id;
    var url             = '/dashboard/activitystream/' + id;

    var snippet         = '?current=' + jQuery(complete_id).attr('data-item-current-page') + '&limit=' + jQuery(complete_id).attr('data-item-items-per-page');
    url                         = url + snippet;
    showLoader();
    var currentPage                 = parseInt(jQuery(complete_id).attr('data-item-current-page') );
    var nextPage             = parseInt(jQuery(complete_id).attr('data-item-current-page') )  + 1;
    jQuery(complete_id).attr('data-item-current-page', nextPage );
    $.ajax({
        type: 'get',
        url: url,
        success: function(msg){
            hideLoader();



            jQuery( complete_id  ).find('.card-body').append( msg );
            var rows    = jQuery( complete_id  ).find('.card-body').find( '.row' );
            if( rows.length > 0 && currentPage > 0 ) {
                var lastEl  = rows.length-1;
                var last    = rows[ lastEl ];
                jQuery( complete_id  ).find('.card-body').scrollTo( last, {
                    duration: 400
                } );
            }
        }
    });
};
