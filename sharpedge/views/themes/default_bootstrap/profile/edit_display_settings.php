<div class="form-horizontal">
<?php $attributes = array('name' => 'page');?>
<?php foreach($get_forum_profile as $fp):?>
<?php echo form_open_multipart('profile/edit_settings', $attributes);?>
<fieldset>
	<legend>Settings</legend>
			
			<div class="input-group">
			<span class="input-group-addon">Display Signatures</span>
				<select name="display_signatures" class="form-control">
				<option value="Y"<?php if($fp->display_signatures == 'Y'):?>selected="selected"<?php endif;?>>Yes</option>
				<option value="N"<?php if($fp->display_signatures == 'N'):?>selected="selected"<?php endif;?>>No</option>
				</select>
			</div>
			
			<div class="input-group">
			<span class="input-group-addon">Display Avatars</span>
				<select name="display_avatars" class="form-control">
				<option value="Y"<?php if($fp->display_avatars == 'Y'):?>selected="selected"<?php endif;?>>Yes</option>
				<option value="N"<?php if($fp->display_avatars == 'N'):?>selected="selected"<?php endif;?>>No</option>
				</select>
			</div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>