(function() {
	// Load plugin specific language pack
	var modalTicket	= jQuery( '#editor-ticket-modal' );
	var modalUser	= jQuery( '#editor-user-modal' );

	tinymce.create('tinymce.plugins.refer', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			ed.addCommand('appendTicket', function( unique_id, name ) {

                modalTicket.modal( 'hide' );
                jQuery('#ticket-search-input').val('');
                jQuery('#editor-ticket-modal-list').find('tbody').html('');
                var anchor      = '<a href="{{app_url}}/ticket/browse/'+unique_id+'" data-item-user-id="'+unique_id+'">'+unique_id+'</a>';
                ed.execCommand('mceInsertRawHTML', false, anchor );
			});



			ed.addCommand('appendUser', function( unique_id, name ) {
				modalUser.modal( 'hide' );
                jQuery('#user-search-input').val('');
                jQuery('#editor-user-modal-list').find('tbody').html('');
                var anchor      = '[u:<a href="#" data-item-user-id="'+unique_id+'">'+name+'</a>]';
                ed.execCommand('mceInsertRawHTML', false, anchor );
			});


			ed.addButton('referticket', {
				image: 		false,
				icon:		'line',
				onclick:	function(  ) {
					modalTicket.modal( 'show' );
				}
			});



			// Register example button
			ed.addButton('referuser', {
				image: 		false,
				icon:		'user',
				onclick:	function() {
					modalUser.modal( 'show' );

                    jQuery('#user-search-input').val('');
                    jQuery('#editor-user-modal-list').find('tbody').html('');
				}
			});


			// Add a node change handler, selects the button in the UI when a image is selected
			// ed.onNodeChange.add(function(ed, cm, n) {
			// 	cm.setActive('referuser', n.nodeName == 'IMG');
			// });
		},

		/**
		 * Creates control instances based in the incomming name. This method is normally not
		 * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
		 * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
		 * method can be used to create those.
		 *
		 * @param {String} n Name of the control to create.
		 * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
		 * @return {tinymce.ui.Control} New control instance or null if no control was created.
		 */
		createControl : function(n, cm) {
			return null;
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
				longname : 'refer plugin',
				author : 'Manuel Schaefer',
				authorurl : 'http://tinymce.moxiecode.com',
				infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/example',
				version : "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('refer', tinymce.plugins.refer);
})();
