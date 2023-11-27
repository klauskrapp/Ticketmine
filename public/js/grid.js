Grid.objects        = new Array();


function Grid() {


    this.data       = null;
    this.params     = null;
    this.defaultgridparams  = null;


    this.init       = function( data ) {
        this.data   = data;
        this.params             = data.params;
        this.defaultgridparams  = data.params;

        if ( data.has_pager == true ) {
            this.initPagerEvents( data );
        }
    }



    this.initPagerEvents    = function( data ) {
        var self            = this;

        jQuery('#' + data.content_id).next().find('[data-item-type="first"]').on('click',function() {

            var page        = jQuery(this).attr('data-item-jump-to');
            self.addParam('start', page );
            self.load();
        });

        jQuery('#' + data.content_id).next().find('[data-item-type="previous"]').on('click',function() {

            var page        = jQuery(this).attr('data-item-jump-to');
            self.addParam('start', page );
            self.load();
        });


        jQuery('#' + data.content_id).next().find('[data-item-type="last"]').on('click',function() {

            var page        = jQuery(this).attr('data-item-jump-to');
            self.addParam('start', page );
            self.load();
        });


        jQuery('#' + data.content_id).next().find('[data-item-type="next"]').on('click',function() {

            var page        = jQuery(this).attr('data-item-jump-to');
            self.addParam('start', page );
            self.load();
        });
    }



    this.addParam   = function( key, value ) {
        var self    = this;
        self.params[ key ]  = value;
    }



    this.removeParam   = function( key ) {
        var self    = this;
        delete self.params[ key ];
    }


    this.resetParams   = function() {
        var self    = this;
        self.params     = new Array();
    }


    this.resetFilters   = function( uiElement, grid ) {
        jQuery( uiElement).parent().parent().find('[data-item-type=filter]').each(function() {
            jQuery(this).val( jQuery(this).attr('data-item-default-value') );
        });
        grid.params     = grid.defaultgridparams;
        grid.load();
    }


    this.search     = function(  grid ) {
        var filters = new Array();
        var formId  = this.data.filter_form;
        jQuery( 'body').find( formId ).find('[data-item-type=filter]').each(function() {

            var filter  = new Object();
            filter.table    = jQuery(this).attr('data-item-table');
            filter.field    = jQuery(this).attr('data-item-field');
            filter.value    = jQuery(this).val();
            filter.operator = jQuery(this).attr('data-item-operator')

            filters.push( filter );
        });

        grid.addParam( '__filters', JSON.stringify( filters ) );

        grid.load();
    }

    this.load       = function() {
        var self    = this;
        this.showModal();
        $.ajax({
            type: 'get',
            url: this.data.url,
            data: this.params,
            success: function(msg){
                self.hideModal();
                var data    = msg;
                self.applyData( data, self );
                self.applyPager( data, self );
            }
        });
    }


    this.applyData      = function( data, object ) {
        var content      = object.data.content_id;
        jQuery('#' + content).find('tbody').html( data.html );
    }



    this.applyPager      = function( data, object ) {
        if ( object.data.has_pager == true ) {
            var table       = '#' + object.data.content_id;
            var pager       = jQuery(table).next().find('[data-item-type="pager"]');


            var pages   = data.pages;
            var next    = data.current;
            var prev    = data.current;
            if ( parseInt( data.current ) == 1 ) {
                prev    = 1;
            }
            else {
                prev    = prev - 1;
            }


            if ( parseInt( next ) == parseInt( pages ) ) {
                next    = pages;
            }
            else {
                next    = parseInt( next )+1;
            }


            var first       = jQuery(table).next().find('[data-item-type="first"]').attr('data-item-jump-to', '1' );
            var previous    = jQuery(table).next().find('[data-item-type="previous"]').attr('data-item-jump-to', prev );



            var next        = jQuery(table).next().find('[data-item-type="next"]').attr('data-item-jump-to', next );


            var last        = jQuery(table).next().find('[data-item-type="last"]').attr('data-item-jump-to', pages );



            var current     = jQuery(table).next().find('[data-item-type="current"]').find('a').html( data.current );
        }
    };


    this.showModal      = function() {
        var loader  = '#' + this.data.loader_dialog;


    }





    this.hideModal      = function() {
        var loader  = '#' + this.data.loader_dialog;
        //const myModalAlternative = new coreui.Modal( loader );
        //myModalAlternative.hide();
    }
}




