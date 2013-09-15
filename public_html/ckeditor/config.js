/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	// Add WIRIS to the plugin list
	config.extraPlugins += (config.extraPlugins.length == 0 ? '' : ',') + 'ckeditor_wiris';
	
	// Add WIRIS buttons to the "Full toolbar"
	// Optionally, you can remove the following line and follow http://docs.cksource.com/CKEditor_3.x/Developers_Guide/Toolbar
	config.toolbar_Full.push({name:'wiris', items:['ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS']});
};
