CKEDITOR.editorConfig = function( config )
	{
	config.enterMode = CKEDITOR.ENTER_BR;
	config.shiftEnterMode = CKEDITOR.ENTER_P;
	config.allowedContent = true;
	config.resize_maxWidth = '100%';
	config.contentsCss = '/themes/default_bootstrap/css/default_ck.css';
	config.forcePasteAsPlainText = true;
	config.filebrowserBrowseUrl = 		'/assets/js/ckeditor/kcfinder/browse.php?type=files';
	config.filebrowserImageBrowseUrl = 	'/assets/js/ckeditor/kcfinder/browse.php?type=images';
	config.filebrowserFlashBrowseUrl = 	'/assets/js/ckeditor/kcfinder/browse.php?type=flash';
	config.filebrowserUploadUrl = 		'/assets/js/ckeditor/kcfinder/upload.php?type=files';
	config.filebrowserImageUploadUrl = 	'/assets/js/ckeditor/kcfinder/upload.php?type=images';
	config.filebrowserFlashUploadUrl = 	'/assets/js/ckeditor/kcfinder/upload.php?type=flash';
	config.extraPlugins = 'youtube';
	config.youtube_older = false;
	};
	
CKEDITOR.on('instanceReady', function (ev) {
ev.editor.dataProcessor.htmlFilter.addRules(
    {
        elements:
        {
            $: function (element) {
				if(element.name == 'li') {
					element.attributes.class = 'list_class';
					};
					
				if (element.name == 'span') {
                    var style = element.attributes.style;
					
					if (style) {
							var match = /(?:^|\s)font-size\s*:\s*(\d+)px/i.exec(style),
								fsize = match && match[1];
						
							if (fsize) {
								element.attributes.style = element.attributes.style.replace(/(?:^|\s)font-size\s*:\s*(\d+)px;?/i, '');
								element.attributes.class = 'span_font';
							}
						}
					}	
					
                if (element.name == 'img') {
                    var style = element.attributes.style;
					
                    if (style) {
                        var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec(style),
							width = match && match[1];

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

				var style = element.attributes.style;
				if (style) {
				match = /(?:^|\s)text-align\s*:\s*(center)/i.exec(style);
				var aligntextcenter = match && match[1];
				
				match = /(?:^|\s)text-align\s*:\s*(left)/i.exec(style);
				var aligntextleft = match && match[1];
				
				match = /(?:^|\s)text-align\s*:\s*(right)/i.exec(style);
				var aligntextright = match && match[1];
				
				match = /(?:^|\s)vertical-align\s*:\s*(top)/i.exec(style);
				var alignverttop = match && match[1];
				
				match = /(?:^|\s)vertical-align\s*:\s*(middle)/i.exec(style);
				var alignvertmiddle = match && match[1];
				
				match = /(?:^|\s)vertical-align\s*:\s*(bottom)/i.exec(style);
				var alignvertbottom = match && match[1];
				
				if (aligntextcenter) {
					element.attributes.style = element.attributes.style.replace(/(?:^|\s)text-align\s*:\s*(center);?/i, '');
					element.attributes.class = 'text-align-center';
					}
				if (aligntextleft) {
					element.attributes.style = element.attributes.style.replace(/(?:^|\s)text-align\s*:\s*(left);?/i, '');
					element.attributes.class = 'text-align-left';
					}
				if (aligntextright) {
					element.attributes.style = element.attributes.style.replace(/(?:^|\s)text-align\s*:\s*(right);?/i, '');
					element.attributes.class = 'text-align-right';
					}
					
				if (alignverttop) {
					element.attributes.style = element.attributes.style.replace(/(?:^|\s)vertical-align\s*:\s*(top);?/i, '');
					element.attributes.class = 'vertical-align-top';
					}
				if (alignvertmiddle) {
					element.attributes.style = element.attributes.style.replace(/(?:^|\s)vertical-align\s*:\s*(middle);?/i, '');
					element.attributes.class = 'vertical-align-middle';
					}
				if (alignvertbottom) {
					element.attributes.style = element.attributes.style.replace(/(?:^|\s)vertical-align\s*:\s*(bottom);?/i, '');
					element.attributes.class = 'vertical-align-bottom';
					}
				}

                if (!element.attributes.style)
                    delete element.attributes.style;

                return element;
            }
        }
    });
});