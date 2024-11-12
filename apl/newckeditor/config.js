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

    config.extraPlugins = 'wordcount';  // カウンタプラグインを使用する。
    config.wordcount = {
        showWordCount: false,     // 単語数をカウントするか否か
        showCharCount: true,     // 文字数をカウントするか否か
        countHTML: false,        // HTMLの文字を文字数カウントに含めるか否か
        charLimit: 'unlimited',  // 文字数の上限
        wordLimit: 'unlimited'   // 単語数の上限
    };

};



