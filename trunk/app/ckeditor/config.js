/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
         // File manager
    // CKFSYS_PATH — путь к файловому менеджеру у вас, чтото типа /path/to/ckeditor/filemanager,
    // путь указывать от DOCUMENT_ROOT
    config.filebrowserBrowseUrl = '/ckeditor/ckfsys/browser/default/browser.html?Connector=/ckeditor/ckfsys/connectors/php/connector.php';
    config.filebrowserImageBrowseUrl = '/ckeditor/ckfsys/browser/default/browser.html?type=Image&Connector=/ckeditor/ckfsys/connectors/php/connector.php';
    config.extraPlugins = 'iframe';
};
