<div class="form-horizontal">
<?php $attributes = array('name' => 'page');?>
<?php foreach($get_forum_profile as $fp):?>
<?php echo form_open_multipart('profile/edit_settings', $attributes);?>
<fieldset>
	<legend>Settings</legend>
			
			<div class="control-group">
			<label class="control-label">Display Signatures</label>
				<div class="controls">
				<select name="display_signatures">
				<option value="Y"<?php if($fp->display_signatures == 'Y'):?>selected="selected"<?php endif;?>>Yes</option>
				<option value="N"<?php if($fp->display_signatures == 'N'):?>selected="selected"<?php endif;?>>No</option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label">Display Avatars</label>
				<div class="controls">
				<select name="display_avatars">
				<option value="Y"<?php if($fp->display_avatars == 'Y'):?>selected="selected"<?php endif;?>>Yes</option>
				<option value="N"<?php if($fp->display_avatars == 'N'):?>selected="selected"<?php endif;?>>No</option>
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