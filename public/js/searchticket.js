function Searchticket() {

}
Searchticket.openSaveOverlay    = function() {
    Searchticket.search();
    const myModal = new coreui.Modal(document.getElementById('ticketsearch-save-filter'), {

    });
    myModal.show();
};

Searchticket.saveFilters        = function() {
    const queryString   = window.location.search;
    var name                    = jQuery('#ticketsearch-save-filter').find('input').val();
    if( name != '' ) {
        $.ajax({
            type: 'POST',
            url: '/filter/save',
            data: {
                _token: CSRF_TOKEN,
                querystring: queryString,
                name: name
            },
            success: function (msg) {
                window.location.reload();
            }
        });
    }
    else {
        jQuery('#ticketsearch-save-filter').find('input').addClass('is-invalid');
    }
};


Searchticket.addFilters     = function() {

    var fileds              = new Array();
    fileds.push('priority_id');
    fileds.push('action_id');
    fileds.push('project_id');
    fileds.push('created_by');
    fileds.push('fulltext');
    fileds.push('assigned');
    fileds.push('name');
    fileds.push('name');
    fileds.push('unique_id');

    for( var a = 0; a < fileds.length; a++ ) {
        var value       = fileds[a];
        var id          = '#' + value;
        if( getUrlParameter( value ) != '' ) {
            jQuery( id ).val( getUrlParameter( value ) );
        }
    }
};


Searchticket.search     = function() {
    var url             = '/search?filter=1';

    if( jQuery('#priority_id').val() != '' ) {
        url             += '&priority_id=' + jQuery('#priority_id').val();
    }

    if( jQuery('#action_id').val() != '' ) {
        url             += '&action_id=' + jQuery('#action_id').val();
    }

    if( jQuery('#project_id').val() != '' ) {
        url             += '&project_id=' + jQuery('#project_id').val();
    }

    if( jQuery('#created_by').val() != '' ) {
        url             += '&created_by=' + jQuery('#created_by').val();
    }

    if( jQuery('#fulltext').val() != '' ) {
        url             += '&fulltext=' + jQuery('#fulltext').val();
    }

    if( jQuery('#assigned').val() != '' ) {
        url             += '&assigned=' + jQuery('#assigned').val();
    }

    if( jQuery('#name').val() != '' ) {
        url             += '&name=' + jQuery('#name').val();
    }

    if( jQuery('#unique_id').val() != '' ) {
        url             += '&unique_id=' + jQuery('#unique_id').val();
    }



    history.replaceState({}, '', url );


    Searchticket.gridsearch();
};



Searchticket.gridsearch         = function() {

    var params                  = {};
    if( jQuery('#priority_id').val() != '' ) {
        params.priority_id =  jQuery('#priority_id').val()
    }

    if( jQuery('#action_id').val() != '' ) {
        params.action_id =  jQuery('#action_id').val()
    }

    if( jQuery('#project_id').val() != '' ) {
        params.project_id =  jQuery('#project_id').val()
    }

    if( jQuery('#unique_id').val() != '' ) {
        params.unique_id =  jQuery('#unique_id').val()
    }

    if( jQuery('#name').val() != '' ) {
        params.name =  jQuery('#name').val()
    }


    if( jQuery('#fulltext').val() != '' ) {
        params.fulltext =  jQuery('#fulltext').val()
    }


    if( jQuery('#created_by').val() != '' ) {
        params.created_by =  jQuery('#created_by').val()
    }

    if( jQuery('#assigned').val() != '' ) {
        params.assigned =  jQuery('#assigned').val()
    }



    var grid                = Grid.objects[ 'ticketsearch-index-table' ];
        grid.addParam('grid_filters', JSON.stringify( params ) );
        grid.addParam('start', 1 );
        grid.addParam('limit', 50 );
        grid.search( grid  );

};
