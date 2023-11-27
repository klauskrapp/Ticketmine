tinyMCE.baseURL = '/plugins/tinymce/';


var Editor		= function( element, value, options ) {
    var self		= this;
    this.element	= jQuery( element );
    this.oldContent	= '';
    this.id			= this.element.attr( 'id' );
    this.identifier	= '#' + this.element.attr( 'id' );
    this.editor		= null;
    this.defaultValue   = value;
    this.options 	= $.extend({
        height:			500,
        tinyMCEOptions:	{},
        blur_callback:	function( oEditor ){},
        close_callback:	function( oEditor ){},
        save_callback:	function( oEditor ){},
        init_callback:	function( oEditor, callback ){

            callback( oEditor );
        },
    }, options );

    this.init		= function() {
        self.options.init_callback( self, function( oEditor ) {
            var options	= $.extend( {
                selector: 		oEditor.identifier,
                height: 		oEditor.options.height,
                setup: 			function (ed) {
                    ed.addButton('save', {
                        text : TRANSLATION_GLOBAL_SAVE,
                        icon:	'save',
                        image : false,
                        onclick : function() {
                            oEditor.save();
                        }
                    });

                    ed.addButton('cancel', {
                        text : TRANSLATION_GLOBAL_CLOSE,
                        icon: 	'home',
                        image : false,
                        onclick : function() {
                            oEditor.close();
                        }
                    });
                }
            }, Editor.tinyMCEOptions );
            options		= $.extend( self.options.tinyMCEOptions, options );

            tinymce.init( options );
            //var tinyid      = 'description-textarea-' + Viewticket.tinymceId;
            //tinymce.get(tinyid).dom.setHTML( self.defaultValue );
            //oEditor.editor 		= tinyMCE.get( oEditor.id );



            /*if( oEditor.element.is( 'input,textarea' ) == true ) {
                oEditor.oldContent	= oEditor.element.val();
            }
            else {
                oEditor.oldContent	= oEditor.element.html();
            }*/
        } );
    };


    this.close				= function() {
        tinyMCE.remove( self.identifier );
        self.options.close_callback( self );
    };



    this.save			= function() {
        self.options.save_callback( self );
        self.close();
    };



    this.initEvents		= function() {
        self.element.on( 'init', function( editor ) {
            tinyMCE.execCommand( 'mceFocus', false, self.id );
        });

        self.element.on( 'blur', function( e, editor ) {
            e.stopPropagation();
            e.preventDefault();

            self.options.blur_callback( self );
        });
    };


    (function(){
        self.init();
        self.initEvents();
    }())

};




Editor.parseEditorContent	= function( content ) {
    var xhr	= $.ajax({
        url:    '/editor/parse',
        type:   'post',
        type:	'async',
        data: 	{
            content: content
        },
    });

    return xhr.responseText;
};



Editor.getTicketImages	= function() {
    var images      = $( '.attachment-wrapper' ).find( 'img' );
    var imageList   = [];
    images.each( function() {
        imageList.push({
            title:  $( this ).attr( 'data-title' ),
            value:  $( this ).attr( 'src' )
        });
    });

    return imageList;
};



Editor.tinyMCEOptions	= {
    valid_children:"+a[div|i|span|img|p|ul|ol|li|h1|h2|h3|h4|h5|h5|h6]",
    theme: 			'modern',
    plugins: 		'lists autolink refer fullscreen link table hr anchor textcolor imagetools colorpicker',
    toolbar1: 		'formatselect | bold italic strikethrough forecolor backcolor | link | numlist bullist outdent indent  | removeformat | referuser referticket | save cancel',
    image_advtab:	true,
    theme_url: 		'/plugins/tinymce/themes/modern/theme.min.js',
    skin_url: 		'/plugins/tinymce/skins/lightgray',
    //image_list: 	Editor.getTicketImages(),
};



Editor.init		= function() {

}



