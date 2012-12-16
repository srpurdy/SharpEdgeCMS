<script type="text/javascript">
    function insert_bbcode(bbopen, bbclose)
    {
        var input = window.document.page.message;
        input.focus();
        
        /* for Internet Explorer )*/
        if(typeof document.selection != 'undefined')
        {
            var range = document.selection.createRange();
            var insText = range.text;
            range.text = bbopen + insText + bbclose;
            range = document.selection.createRange();
            if (insText.length == 0)
            {
                range.move('character', -bbclose.length);
            }
            else
            {
                range.moveStart('character', bbopen.length + insText.length + bbclose.length);
            }
            range.select();
        }
        
        /* for newer browsers like Firefox */

        else if(typeof input.selectionStart != 'undefined')
        {
            var start = input.selectionStart;
            var end = input.selectionEnd;
            var insText = input.value.substring(start, end);
            input.value = input.value.substr(0, start) + bbopen + insText + bbclose + input.value.substr(end);
            var pos;
            if (insText.length == 0)
            {
                pos = start + bbopen.length;
            }
            else
            {
                pos = start + bbopen.length + insText.length + bbclose.length;
            }
            input.selectionStart = pos;
            input.selectionEnd = pos;
        }    

        /* for other browsers like Netscape... */
        else
        {
            var pos;
            var re = new RegExp('^[0-9]{0,3}$');
            while(!re.test(pos))
            {
                pos = prompt("insertion (0.." + input.value.length + "):", "0");
            }
            if(pos > input.value.length)
            {
                pos = input.value.length;
            }
            var insText = prompt("Please tape your text");
            input.value = input.value.substr(0, pos) + bbopen + insText + bbclose + input.value.substr(pos);
        }
    } 
</script>
<div class="form-horizontal">
<?php foreach($query->result() as $id):?>
<?php echo form_open('blog_admin/edit_comment/'.$this->uri->segment(3));?>
		<input type="hidden" id="id" name="blog_id" value="<?php echo $id->blog_id?>">
		<input type="hidden" id="id" name="datetime" value="<?php echo $id->datetime?>">
		<fieldset>
		
			<legend><?php echo $this->lang->line('label_new_comment');?></legend>
			
			<?php echo form_error('postedby'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="postedby" value="<?php echo $id->postedby?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_text');?></label>
				<div class="controls">
				<div class="format_button">
				<a class="btn" href="javascript:void(0);" onClick="insert_bbcode('[b]', '[/b]')" title="Bold">B</a>
				
				<a class="btn" href="javascript:void(0);" onClick="insert_bbcode('[i]', '[/i]')" title="Italic">I</a>
				
				<a class="btn" href="javascript:void(0);" onClick="insert_bbcode('[u]', '[/u]')" title="Underline">U</a>
				
				<a class="btn" href="javascript:void(0);" onClick="insert_bbcode('[p]', '[/p]')" title="Paragraph">P</a>
				
				<a class="btn" href="javascript:void(0);" onClick="insert_bbcode('[url]', '[/url]')" title="Link URL">URL</a>
				
				<a class="btn" href="javascript:void(0);" onClick="insert_bbcode('[quote]', '[/quote]')" title="Quote">Quote</a>
				
				<a class="btn" href="javascript:void(0);" onClick="insert_bbcode('[img]', '[/img]')" title="Image">IMG</a>
				
				<a class="btn" href="javascript:void(0);" onClick="insert_bbcode('[youtube]', '[/youtube]')" title="Youtube Video">YouTube</a>
				</div>
				<div style="clear: both;"></div>
				<br />
				
				<?php echo form_error('message'); ?>
				<textarea class="span7" name="message" rows="20" cols="50"><?php echo $id->message?></textarea>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_active');?></label>
				<div class="controls">
				<select name="active">
				<option value="Y"<?php if($id->active == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if($id->active == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
            
            <div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
		</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>