/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// Language
	config.language = 'zh-cn';

	// Toolbar buttons
	config.toolbar = [
        { name: 'document', items: [ 'Save' ] },
        { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike' ] },
        { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
        { name: 'links', items: [ 'Link', 'Unlink' ] },
        //{ name: 'insert', items: [ 'Image', 'Flash', '-', 'HorizontalRule', 'SpecialChar' ] },
        { name: 'insert', items: [ 'HorizontalRule', 'SpecialChar' ] },
        { name: 'styles', items: [ 'Format' ] },
        { name: 'tools', items: [ 'Maximize', 'Source' ] }
	];

	// Advanced Content Filter (ACF)
    // https://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_advanced_content_filter
    // https://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_allowed_content_rules
    config.extraAllowedContent = 'a[!href];' +
        'img(left,right)[!src,alt,width,height];';
};
