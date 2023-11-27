function collapse( uiElment ) {
    jQuery(uiElment).next().toggle();
}


function redirectTo( url ) {
    window.location.href        = url;
}

function getUrlParameter( param ) {
    var url_string = window.location;

    var url = new URL(url_string);
    var c = url.searchParams.get( param );
    return c;
}
function gridsearch( gridId ) {
    var grid                = Grid.objects[ gridId ];
    grid.search( grid  );
}


function changeMaxItems( uiElement, gridId ) {
    var grid                = Grid.objects[ gridId ];

    grid.addParam('limit', jQuery(uiElement).val() );
    grid.addParam('start', 1 );
    grid.load();
}


function deleteEntity( url, gridId ) {
    var r = confirm( TRANSLATION_GLOBAL_DELETE );
    if (r == true) {


        showLoader();
        $.ajax({
            type: 'get',
            url: url,
            success: function(msg){
                var id      = '#messagebus-' + msg.message_type;
                jQuery(id).html(msg.message).fadeIn(500).delay(4000).fadeOut(500);
                hideLoader();
                var grid                = Grid.objects[ gridId ];
                grid.search( grid  );
            }
        });

    }
}


function showLoader() {

}


function getObjectsValue( obj, value, defaultValue ) {
    var toReturn            = defaultValue;
    if( typeof obj[ value ] != "undefined") {
        toReturn                = obj[ value ];
    }

    return toReturn;

}

function hideLoader() {

}
