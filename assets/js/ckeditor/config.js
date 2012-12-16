/*
Copyright (c) 2003-2009, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
CKEDITOR.editorConfig = function( config )
{
config.enterMode = CKEDITOR.ENTER_BR
config.shiftEnterMode = CKEDITOR.ENTER_P
config.resize_maxWidth = '100%';
config.contentsCss = '/themes/default_bootstrap/css/default_ck.css';
config.forcePasteAsPlainText = true;
config.filebrowserBrowseUrl = 		'/assets/js/ckeditor/kcfinder/browse.php?type=files';
config.filebrowserImageBrowseUrl = 	'/assets/js/ckeditor/kcfinder/browse.php?type=images';
config.filebrowserFlashBrowseUrl = 	'/assets/js/ckeditor/kcfinder/browse.php?type=flash';
config.filebrowserUploadUrl = 		'/assets/js/ckeditor/kcfinder/upload.php?type=files';
config.filebrowserImageUploadUrl = 	'/assets/js/ckeditor/kcfinder/upload.php?type=images';
config.filebrowserFlashUploadUrl = 	'/assets/js/ckeditor/kcfinder/upload.php?type=flash';
};
CKEDITOR.on('instanceReady', function (ev) {
// Ends self closing tags the HTML4 way, like <br>.
ev.editor.dataProcessor.htmlFilter.addRules(
    {
        elements:
        {
            $: function (element) {
				if(element.name == 'li') {
					element.attributes.class = 'list_class';
					};
                // Output dimensions of images as width and height
                if (element.name == 'img') {
                    var style = element.attributes.style;
					
                    if (style) {
                        // Get the width from the style.
                        var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec(style),
                            width = match && match[1];

                        // Get the height from the style.
                        match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec(style);
                        var height = match && match[1];
						
						match = /(?:^|\s)margin-left\s*:\s*(\d+)px/i.exec(style);
                        var m_left = match && match[1];
						
						match = /(?:^|\s)margin-right\s*:\s*(\d+)px/i.exec(style);
                        var m_right = match && match[1];
						
						match = /(?:^|\s)float\s*:\s*(left|right)/i.exec(style);
                        var floating = match && match[1];

                        if (width) {
                            element.attributes.style = element.attributes.style.replace(/(?:^|\s)width\s*:\s*(\d+)px;?/i, '');
                            element.attributes.width = width;
                        }

                        if (height) {
                            element.attributes.style = element.attributes.style.replace(/(?:^|\s)height\s*:\s*(\d+)px;?/i, '');
                            element.attributes.height = height;
                        }
						
						if (floating) {
                            element.attributes.style = element.attributes.style.replace(/(?:^|\s)float\s*:\s*(left|right);?/i, '');
                            element.attributes.align = floating;
                        }
						
						if (m_left) {
                            element.attributes.style = element.attributes.style.replace(/(?:^|\s)margin-left\s*:\s*(\d+)px;?/i, '');
							element.attributes.style = element.attributes.style.replace(/(?:^|\s)margin-right\s*:\s*(\d+)px;?/i, '');
                            element.attributes.class = 'img_margin';
                        }
						
						if (m_right){
						    element.attributes.style = element.attributes.style.replace(/(?:^|\s)margin-left\s*:\s*(\d+)px;?/i, '');
							element.attributes.style = element.attributes.style.replace(/(?:^|\s)margin-right\s*:\s*(\d+)px;?/i, '');
                            element.attributes.class = 'img_margin';
						}
                    }
					
					if (element.attributes.class)
					{
					}
					else
					{
					element.attributes.class = 'img_margin';
					}
					
                }



                if (!element.attributes.style)
                    delete element.attributes.style;

                return element;
            }
        }
    });
});