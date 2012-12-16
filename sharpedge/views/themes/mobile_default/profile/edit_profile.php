<script type="text/javascript">
    function insert_bbcode(bbopen, bbclose)
    {
        var input = window.document.page.post_text;
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
<?$attributes = array('name' => 'page');?>
<?php foreach($get_forum_profile as $fp):?>
<?php echo form_open_multipart('profile/edit_avatar');?>
<fieldset>
	<legend>Forum Avatar</legend>
	
			<div class="control-group">
			<label class="control-label"></label>
				<div class="controls">
				<img src="<?php echo base_url();?><?php echo $this->config->item('ava_upload_directory');?>/<?php echo $fp->avatar?>" alt="Current Image" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label">Avatar</label>
				<div class="controls">
				<input type="file" class="span3" name="avatar" value="" /><br />
				<small>
				Current File: <?php echo $fp->avatar?><br />
				Max Size: <?php echo $this->config->item('ava_max_file_size');?>KB<br />
				Max Dimensions: <?php echo $this->config->item('ava_max_width');?>x<?php echo $this->config->item('ava_max_height');?>
				</small>
				</div>
			</div>
						
			<div class="form-actions">
			<input class="btn btn-success" type="submit" value="Upload" />
			</div>
</fieldset>
<?php echo form_close();?>

<?php echo form_open_multipart('profile/edit_profile', $attributes);?>
<fieldset>
	<legend>Forum Profile</legend>
	
			<div class="control-group">
			<label class="control-label">Website</label>
				<div class="controls">
				<input type="text" class="span3" name="website" value="<?php echo $fp->website?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label">Display Nickname</label>
				<div class="controls">
				<select name="display_name">
				<option value="Y"<?php if($fp->display_name == 'Y'):?>selected="selected"<?php endif;?>>Yes</option>
				<option value="N"<?php if($fp->display_name == 'N'):?>selected="selected"<?php endif;?>>No</option>
				</select>
				<?php echo form_error('display_name'); ?>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label">Nickname</label>
				<div class="controls">
				<input type="text" class="span3" name="nickname" value="<?php echo $fp->nickname?>" />
				<?php echo form_error('nickname'); ?>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label">Location</label>
				<div class="controls">
				<input type="text" class="span3" name="location" value="<?php echo $fp->location?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label">Interests</label>
				<div class="controls">
				<input type="text" class="span3" name="intrests" value="<?php echo $fp->intrests?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label">Occupation</label>
				<div class="controls">
				<input type="text" class="span3" name="occupation" value="<?php echo $fp->occupation?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label">Signature</label>
				<div class="controls">
				<textarea class="span6" name="signature" rows="5"><?php echo $fp->signature?></textarea>
				</div>
			</div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
</fieldset>
<?php echo form_close();?>
<?php endforeach;?>