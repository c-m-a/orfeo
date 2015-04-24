/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	config.language = 'es';
	config.uiColor = '#006699';

	config.toolbar = 'MyToolbar';
 
	config.toolbar_MyToolbar =
        [
            { name: 'document', items : ['Source', 'NewPage','Preview','Print','Undo','Redo' ] },
            { name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
            { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
            { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
            { name: 'styles', items : [ 'Styles','Format','Font','TextColor','BGColor' ] },
            { name: 'links', items : [ 'Link','Unlink','Table','HorizontalRule','SpecialChar','PageBreak'] },
            { name: 'tools', items : [ 'Maximize', 'ShowBlocks'] }
        ];

};

