(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
    $(document).ready(function(){
        $('a.pelim-button.save').click(function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                data: {action: 'pelim_save_plugins'},
                url: ajaxurl
            }).done(function() {
                location.reload();
            });
        });

        $('a.pelim-button.restore').click(function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                data: {action: 'pelim_restore_plugins'},
                url: ajaxurl
            }).done(function() {
                location.reload();
            });
        });

        $('a.pelim-button.deactivate').click(function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                data: {action: 'pelim_deactivate_plugins'},
                url: ajaxurl
            }).done(function() {
                location.reload();
            });
        });
    })

})( jQuery );
