/**
 * Shortcodes common scripts
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

/* global jQuery:false */
/* global TRX_ADDONS_STORAGE:false */


(function() {

	"use strict";
	
	//jQuery(document).on('action.init_hidden_elements', trx_addons_sc_fullheight_init);
	//jQuery(document).on('action.init_shortcodes', trx_addons_sc_fullheight_init);
	//jQuery(document).on('action.resize_trx_addons', trx_addons_sc_fullheight_init);
	
	// Fullheight elements init
	function trx_addons_sc_fullheight_init(e, container) {
	
		if (arguments.length < 2) var container = jQuery('body');
		if (container===undefined || container.length === undefined || container.length == 0) return;
	
		container.find('.trx_addons_stretch_height').each(function () {
			var fullheight_item = jQuery(this);
			// If item now invisible
			if (jQuery(this).parents('div:hidden,article:hidden').length > 0) {
				return;
			}
			var wh = 0;
			var fullheight_row = jQuery(this).parents('.vc_row-o-full-height');
			if (fullheight_row.length > 0) {
				wh = fullheight_row.css('height') != 'auto' ? fullheight_row.height() : 'auto';
			} else {
				if (screen.height > 1000) {
					var adminbar = jQuery('#wpadminbar');
					wh = jQuery(window).height() - (adminbar.length > 0 ? adminbar.height() : 0);
				} else
					wh = 'auto';
			}
			if (wh == 'auto' || wh > 0) fullheight_item.height(wh);
		});
	}

})();