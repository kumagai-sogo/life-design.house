/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {


	config.language = 'ja';
	config.width = '600px';
	config.height = '300px';
	config.skin = 'moonocolor';
  config.extraPlugins='confighelper'; 
  config.placeholder = 'Type here...';



	CKEDITOR.config.enterMode = 2;

	config.toolbar = [
	{ name: 'document', items : [ 'Source','Preview' ] },
	{ name: 'clipboard', items : [ 'Cut','Copy','Paste','-','Undo','Redo' ] },
	//{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker' ] },
	{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
	{ name: 'styles', items : [ 'Font','FontSize' ] },
	'/',
	{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','-','RemoveFormat' ] },
	{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
	{ name: 'insert', items : [ /*'Image',*/'HorizontalRule','SpecialChar' ] },
	{ name: 'colors', items : [ 'TextColor','BGColor' ] },
	{ name: 'tools', items : [ 'Maximize' ] }
		];

    config.extraPlugins = 'wordcount';  // �J�E���^�v���O�C�����g�p����B
    config.wordcount = {
        showWordCount: false,     // �P�ꐔ���J�E���g���邩�ۂ�
        showCharCount: true,     // ���������J�E���g���邩�ۂ�
        countHTML: false,        // HTML�̕����𕶎����J�E���g�Ɋ܂߂邩�ۂ�
        charLimit: 'unlimited',  // �������̏��
        wordLimit: 'unlimited'   // �P�ꐔ�̏��
    };

};



